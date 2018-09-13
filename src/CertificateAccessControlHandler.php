<?php

namespace Drupal\certificate_generator;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Certificate entity.
 *
 * @see \Drupal\certificate_generator\Entity\Certificate.
 */
class CertificateAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\certificate_generator\Entity\CertificateInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished certificate entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published certificate entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit certificate entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete certificate entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add certificate entities');
  }

}
