<?php

namespace Drupal\certificates\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\certificates\Entity\CertificateInterface;

/**
 * Class CertificateController.
 *
 *  Returns responses for Certificate routes.
 */
class CertificateController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Certificate  revision.
   *
   * @param int $certificate_revision
   *   The Certificate  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($certificate_revision) {
    $certificate = $this->entityManager()->getStorage('certificate')->loadRevision($certificate_revision);
    $view_builder = $this->entityManager()->getViewBuilder('certificate');

    return $view_builder->view($certificate);
  }

  /**
   * Page title callback for a Certificate  revision.
   *
   * @param int $certificate_revision
   *   The Certificate  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($certificate_revision) {
    $certificate = $this->entityManager()->getStorage('certificate')->loadRevision($certificate_revision);
    return $this->t('Revision of %title from %date', ['%title' => $certificate->label(), '%date' => format_date($certificate->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Certificate .
   *
   * @param \Drupal\certificates\Entity\CertificateInterface $certificate
   *   A Certificate  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(CertificateInterface $certificate) {
    $account = $this->currentUser();
    $langcode = $certificate->language()->getId();
    $langname = $certificate->language()->getName();
    $languages = $certificate->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $certificate_storage = $this->entityManager()->getStorage('certificate');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $certificate->label()]) : $this->t('Revisions for %title', ['%title' => $certificate->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all certificate revisions") || $account->hasPermission('administer certificate entities')));
    $delete_permission = (($account->hasPermission("delete all certificate revisions") || $account->hasPermission('administer certificate entities')));

    $rows = [];

    $vids = $certificate_storage->revisionIds($certificate);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\certificates\CertificateInterface $revision */
      $revision = $certificate_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $certificate->getRevisionId()) {
          $link = $this->l($date, new Url('entity.certificate.revision', ['certificate' => $certificate->id(), 'certificate_revision' => $vid]));
        }
        else {
          $link = $certificate->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.certificate.translation_revert', ['certificate' => $certificate->id(), 'certificate_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.certificate.revision_revert', ['certificate' => $certificate->id(), 'certificate_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.certificate.revision_delete', ['certificate' => $certificate->id(), 'certificate_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['certificate_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
