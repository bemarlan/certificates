<?php

namespace Drupal\certificates\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Certificate entities.
 */
class CertificateViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins.

    return $data;
  }

}
