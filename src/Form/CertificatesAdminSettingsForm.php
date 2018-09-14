<?php

namespace Drupal\certificates\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Displays the certificates settings form.
 */
class CertificatesAdminSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * CertificateGeneratorAdminSettingsForm class constructor.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    parent::__construct($config_factory);
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'certificates_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('certificates.settings');

    $form['url_prefix'] = [
      '#type' => 'url',
      '#title' => $this->t('Website URL'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
      '#default_value' => $config->get('certificates_url_prefix'),
      '#field_prefix' => '/certificate/',
      '#description' => $this->t('The URL prefix that will be used when adding new certificates.'),
    ];
    
    $form['submit'] = [
      '#type' => 'submit',
      '#name' => 'submit_button',
      '#value' => $this->t('Save Settings'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    $this->config('certificates.settings')
      ->set('certificates_url_prefix', $values['url_prefix'])
      ->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['certificates.settings'];
  }

}
