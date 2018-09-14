<?php

namespace Drupal\certificates\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Certificate type entity.
 *
 * @ConfigEntityType(
 *   id = "certificate_type",
 *   label = @Translation("Certificate type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\certificates\CertificateTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\certificates\Form\CertificateTypeForm",
 *       "edit" = "Drupal\certificates\Form\CertificateTypeForm",
 *       "delete" = "Drupal\certificates\Form\CertificateTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\certificates\CertificateTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "certificate_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "certificate",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/certificates/certificate_type/{certificate_type}",
 *     "add-form" = "/admin/structure/certificates/certificate_type/add",
 *     "edit-form" = "/admin/structure/certificates/certificate_type/{certificate_type}/edit",
 *     "delete-form" = "/admin/structure/certificates/certificate_type/{certificate_type}/delete",
 *     "collection" = "/admin/structure/certificates/certificate_type"
 *   }
 * )
 */
class CertificateType extends ConfigEntityBundleBase implements CertificateTypeInterface {

  /**
   * The Certificate type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Certificate type label.
   *
   * @var string
   */
  protected $label;

}
