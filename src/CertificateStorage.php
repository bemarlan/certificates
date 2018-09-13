<?php

namespace Drupal\certificate_generator;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Language\LanguageInterface;
use Drupal\certificate_generator\Entity\CertificateInterface;

/**
 * Defines the storage handler class for Certificate entities.
 *
 * This extends the base storage class, adding required special handling for
 * Certificate entities.
 *
 * @ingroup certificate_generator
 */
class CertificateStorage extends SqlContentEntityStorage implements CertificateStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(CertificateInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {certificate_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {certificate_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function countDefaultLanguageRevisions(CertificateInterface $entity) {
    return $this->database->query('SELECT COUNT(*) FROM {certificate_field_revision} WHERE id = :id AND default_langcode = 1', [':id' => $entity->id()])
      ->fetchField();
  }

  /**
   * {@inheritdoc}
   */
  public function clearRevisionsLanguage(LanguageInterface $language) {
    return $this->database->update('certificate_revision')
      ->fields(['langcode' => LanguageInterface::LANGCODE_NOT_SPECIFIED])
      ->condition('langcode', $language->getId())
      ->execute();
  }

}
