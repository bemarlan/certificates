<?php

namespace Drupal\certificates\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for certificates.
 */
class CertificatesController extends ControllerBase {

  /**
   * Current user.
   *
   * @var Drupal\Core\Session\AccountInterface
   */
  protected $user;

  /**
   * Creation form.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $form_builder;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static (
      $container->get('current_user'),
      $container->get('form_builder')
    );
  }

  /**
   * Constructs the CertificatesController.
   *
   * @param Drupal\Core\Session\AccountInterface $account
   *   Current account.
   */
  public function __construct(AccountInterface $account, FormBuilderInterface $formBuilder) {
    $this->user = $account;
    $this->form_builder = $formBuilder;
  }

  /**
   * Returns the current user's Display Name.
   *
   * @return string
   *   The display name of the current user.
   */
  protected function getName() {
    /**
     * User's display name.
     *
     * @var \Drupal\Core\Session\AccountInterface->getDisplayName()
     */
    $username = $this->user->getDisplayName();

    return $username;
  }

  /**
   * Builds the thank you page when the user downloads their certificate.
   *
   * @param string $certificate_url
   *  The certificate url
   *
   * @return html
   *   HTML displayed on the thank you page.
   */
  public function buildThankYouPage($certificate_url) {
    $username = $this->getName();

    return [
      '#type' => 'markup',
      '#markup' => $this->t('<div class="none CertificatesName">' . $username . '</div><div class="content center"><h1 class="pt orange">Thank You, @certificate_url.</h1><p>Your certificate with your username has been downloaded. Please check your downloads folder to retrieve it.</p></div>', ['@certificate_url' => $certificate_url])
    ];
  }

  // /**
  //  * Builds the playground page for the site builder to create a PDF.
  //  *
  //  * @return -
  //  *   -
  //  */
  // public function buildPlayGround() {
  //   // $form = $this->form_builder->getForm('Drupal\certificates\Form\CertificatesCreateForm');
  //   // $form = $this->form_builder->getForm('Drupal\certificates\Form\CertificateForm');

  //   return [
  //     '#theme' => 'certificate_playground',
  //     // '#add_form' => $form
  //   ];

  // }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['certificates.settings'];
  }

}
