<?php

namespace Drupal\certificates\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Displays the certificates creation form.
 */
class CertificatesCreateForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'certificates_create_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('certificates.settings');

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Certficate Name'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
      '#description' => $this->t('The administrative name for this certificate.')
    ];

    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('URL'),
      '#size' => 60,
      '#maxlength' => 128,
      '#required' => TRUE,
      //'#field_prefix' => $config->get('certificates_url_prefix') . '/certificate/'
      '#field_prefix' => $this->getRequest()->getSchemeAndHttpHost() . '/certificate/'
    ];

    /**
     * @todo When we let content authors start making certificates, make this
     * a select instead of an object property in the code editor.
     */
    // $form['orientation'] = [
    //   '#type' => 'select',
    //   '#title' => $this->t('Orientation'),
    //   '#required' => TRUE,
    //   '#options' => [
    //     'landscape' => $this->t('Landscape'),
    //     'portrait' => $this->t('Portrait')
    //   ]
    // ];

    $form['download'] = [
      '#type' => 'select',
      '#title' => $this->t('Automatically download'),
      '#required' => TRUE,
      '#options' => [
        FALSE => $this->t('No'),
        TRUE => $this->t('Yes')
      ],
      '#description' => $this->t('Whether the certificate should automatically download for the user.')
    ];

    $form['file_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Certficate file name'),
      '#size' => 60,
      '#maxlength' => 128,
      '#description' => $this->t('If the certificate is set to download automatically, enter the file name.'),
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
    
    $form['submit'] = [
      '#type' => 'submit',
      '#name' => 'submit_button',
      '#value' => $this->t('Create Certificate')
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    // File name must be entered if it is downloading automatically
    if ($values['download']) {
      if (!$values['file_name']) {
        $form_state->setErrorByName('file_name', $this->t('A certificate file name is required when the certificate is set to automatically download.'));
      }
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $name = $values['name'];
    $url = $values['url'];
    $oritentation = $values['orientation'];
    $download = $values['download'];
    $fileName = $values['file_name'];
    $message = $values['message'];
    $code = $values['code'];

    // If the url begins with /, remove it.
    if ( preg_match( '/^[\/]/', $url) ) {
      $url = ltrim($url, '/');
    }

    // prefix url with '/certificate/'.
    $url = '/certificate/' . $url;

    /**
     * @todo When we let content authors start making certificates, make the
     * orientation be added to the doc object in the editor.
     */
    // if ($orientation == 'landscape') {
    //   $code += ''
    // }

    if ($download) {
      $code += 'doc.save("'. trim($fileName) .'.pdf");';
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['certificates.settings'];
  }

}
