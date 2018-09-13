<?php

namespace Drupal\certificate_generator;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Certificate entities.
 *
 * @ingroup certificate_generator
 */
class CertificateListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Certificate ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\certificate_generator\Entity\Certificate */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.certificate.edit_form',
      ['certificate' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
