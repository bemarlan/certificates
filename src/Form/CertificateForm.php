<?php

namespace Drupal\certificates\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Certificate edit forms.
 *
 * @ingroup certificates
 */
class CertificateForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    /* @var $entity \Drupal\certificates\Entity\Certificate */
    $entity = $this->entity;

    if (!$this->entity->isNew()) {
      $form['new_revision'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Create new revision'),
        '#default_value' => FALSE,
        '#weight' => 10,
      ];
    }

    $form['file_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Certficate file name'),
      '#required' => TRUE,
      '#size' => 60,
      '#maxlength' => 128,
      '#description' => $this->t('Enter the file name for the certificate download.'),
      '#field_suffix' => '.pdf'
    ];

     $form['message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Thank you page text'),
      '#required' => TRUE,
      '#description' => $this->t('The text displayed on the thank you page.'),
      '#default_value' => $this->t('<p>Your certificate has been downloaded. Please check your downloads folder to retrieve it.</p>')
    ];

    $form['pretty'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Pretty code'),
      '#attributes' => ['class' => ['pretty-code']],
      '#required' => TRUE,
      '#description' => $this->t('The pretty code generated.')
    ];

    $form['code'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Certificate Code'),
      '#attributes' => ['class' => ['creation-code']],
      '#required' => TRUE,
      '#description' => $this->t('The code created from the <a href="/admin/config/media/certificate-generator/playground" target="_blank">playground<span class="ext"><span class="visually-hidden">(link to certificate creation playground)</span> </span></a> that will make up the certificate.')
    ];

    return $form;
  }
  
  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    // Save as a new revision if requested to do so.
    if (!$form_state->isValueEmpty('new_revision') && $form_state->getValue('new_revision') != FALSE) {
      $entity->setNewRevision();

      // If a new revision is created, save the current user as revision author.
      $entity->setRevisionCreationTime(REQUEST_TIME);
      $entity->setRevisionUserId(\Drupal::currentUser()->id());
    }
    else {
      $entity->setNewRevision(FALSE);
    }

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Certificate.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Certificate.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.certificate.canonical', ['certificate' => $entity->id()]);
  }

}
