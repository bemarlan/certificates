<?php

namespace Drupal\certificate_generator\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Defines the Certificate entity.
 *
 * @ingroup certificate
 *
 * @ContentEntityType(
 *   id = "certificate",
 *   label = @Translation("Certificate"),
 *   base_table = "certificate",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "certificate_name",
 *     "uuid" = "uuid",
 *   },
 * )
 */

class Certificate extends ContentEntityBase implements ContentEntityInterface {

  /**
   * Determines the schema for the base_table property defined above.
   *
   * {@inheritdoc}
   */
	public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
      
    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Certificate entity.'))
      ->setReadOnly(TRUE);

    // Standard field, unique outside of the scope of the current project.
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Certificate entity.'))
      ->setReadOnly(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))
      ->setDescription(t('The time that the Certificate was created.'))
      ->setDisplayOptions('form', array(
        // 'region' => 'hidden',
        'weight' => 0,
      ));

    // Name field for the Certificate.
    $fields['certificate_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t("Certificate name"))
      ->setDescription(t('The name of the Certficate.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 128,
        'text_processing' => 0,
      ));

    // URI for the Certificate.
    $fields['certificate_uri'] = BaseFieldDefinition::create('uri')
      ->setLabel(t('URI'))
      ->setDescription(t('The URI to access the certificate'));

    // Whether the Certificate should automatically download.
    $fields['automatic_download'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Automatically Download'))
      ->setDescription(t('Whether the certificate should automatically download for the user.'));

    // File name for the Certificate.
    $fields['file_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t("Certficate file name"))
      ->setDescription(t('If the certificate is set to download automatically, enter the file name.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 128,
        'text_processing' => 0,
      ));

    /**
     * @todo When we let content authors start making certificates, make
     * orientation a field we track.
     */
    // $fields['certificate_oritentation'] = BaseFieldDefinition::create('string')
    //   ->setLabel(t('Certificate oritentation'))
    //   ->setDescription(t('The print orientation for the certificate.'))
    //   ->setSettings(array(
    //     'default_value' => '',
    //     'text_processing' => 0,
    //   ));

    // Body field for the Certificate's thank you page.
    $fields['thankyou_body'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Thank you page text'))
      ->setDescription(t('The text displayed on the thank you page.'))
      ->setSettings(array(
        'default_value' => '',
        'text_processing' => 0,
      ));

    // Body field for the Certificate.
    $fields['certificate_body_pretty'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Pretty code body'))
      ->setDescription(t('The pretty code for the certificate.'))
      ->setSettings(array(
        'default_value' => '',
        'text_processing' => 0,
      ));

    // Body field for the Certificate.
    $fields['certificate_body'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Body'))
      ->setDescription(t('The body of the certificate.'))
      ->setSettings(array(
        'default_value' => '',
        'text_processing' => 0,
      ));
      
    return $fields;
  }

}
