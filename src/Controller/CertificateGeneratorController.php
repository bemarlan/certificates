<?php

namespace Drupal\certificate_generator\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * 
 */
class CertificateGeneratorController extends ControllerBase {

  /**
   * Current user.
   *
   * @var Drupal\Core\Session\AccountInterface
   */
  protected $user;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static (
      $container->get('current_user')
    );
  }

  /**
   * Constructs the CertificateGeneratorController.
   *
   * @param Drupal\Core\Session\AccountInterface $account
   *   Current account.
   */
  public function __construct(AccountInterface $account) {
    $this->user = $account;
  }

  /**
   * Returns the current user's Display Name.
   *
   * @return string
   *   The display name of the current user.
   */
  protected function getName() {
    /** @var \Drupal\Core\Session\AccountInterface->getDisplayName() $username */
    $username = $this->user->getDisplayName();
    return $username;
  }

  /**
   * Builds the thank you page when the user downloads their certificate.
   *
   * @return html
   *   HTML displayed on the thank you page.
   */
  public function buildThankYouPage() {
    $username = $this->getName();

    return [
      '#type' => 'markup',
      '#markup' => '<div class="none CertificateName">' . $username . '</div><div class="content center"><h1 class="pt orange">Thank You</h1><p>Your certificate with your username has been downloaded. Please check your downloads folder to retrieve it.</p></div>',
    ];
  }

  /**
   * Builds the playground page for the site builder to create a PDF.
   *
   * @return -
   *   -
   */
  public function buildPlayGround() {

    return [
      '#theme' => 'certificate_generator_playground',
      '#variable1' => t("First"),
      '#variable2' => t("Second"),
      '#save' => t("Save Certificate Template")
    ];

  }

}
