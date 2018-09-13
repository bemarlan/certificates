<?php

namespace Drupal\certificate_generator\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class CertificateTypeForm.
 */
class CertificateTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $certificate_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $certificate_type->label(),
      '#description' => $this->t("Label for the Certificate type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $certificate_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\certificate_generator\Entity\CertificateType::load',
      ],
      '#disabled' => !$certificate_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $certificate_type = $this->entity;
    $status = $certificate_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Certificate type.', [
          '%label' => $certificate_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Certificate type.', [
          '%label' => $certificate_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($certificate_type->toUrl('collection'));
  }

}
