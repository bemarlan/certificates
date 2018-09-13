<?php

namespace Drupal\certificate_generator\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Certificate type entity.
 *
 * @ConfigEntityType(
 *   id = "certificate_type",
 *   label = @Translation("Certificate type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\certificate_generator\CertificateTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\certificate_generator\Form\CertificateTypeForm",
 *       "edit" = "Drupal\certificate_generator\Form\CertificateTypeForm",
 *       "delete" = "Drupal\certificate_generator\Form\CertificateTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\certificate_generator\CertificateTypeHtmlRouteProvider",
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
 *     "canonical" = "/admin/structure/certificate_type/{certificate_type}",
 *     "add-form" = "/admin/structure/certificate_type/add",
 *     "edit-form" = "/admin/structure/certificate_type/{certificate_type}/edit",
 *     "delete-form" = "/admin/structure/certificate_type/{certificate_type}/delete",
 *     "collection" = "/admin/structure/certificate_type"
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
