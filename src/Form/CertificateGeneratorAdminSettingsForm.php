<?php

namespace Drupal\certificate_generator\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Displays the certificate_generator settings form.
 */
class CertificateGeneratorAdminSettingsForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'certificate_generator_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['class'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Certificate Code'),
      '#description' => $this->t('The code created from the <a href="/admin/config/certificate-generator/playground" target="_blank">playground</a> that will make up the certificate.'),
    ];
    
    $form['submit'] = [
      '#type' => 'submit',
      '#name' => 'submit_button',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
  }

}
