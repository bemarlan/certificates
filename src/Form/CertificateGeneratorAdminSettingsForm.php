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
      '#type' => 'checkbox',
      '#title' => $this->t('Place an icon next to external links.'),
      '#default_value' => '',
      '#description' => $this->t('Places an <span class="ext"> </span>&nbsp; icon next to external links.'),
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
