<?php

namespace Drupal\certificate_generator;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface CertificateStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of Certificate revision IDs for a specific Certificate.
   *
   * @param \Drupal\certificate_generator\Entity\CertificateInterface $entity
   *   The Certificate entity.
   *
   * @return int[]
   *   Certificate revision IDs (in ascending order).
   */
  public function revisionIds(CertificateInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as Certificate author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   Certificate revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

  /**
   * Counts the number of revisions in the default language.
   *
   * @param \Drupal\certificate_generator\Entity\CertificateInterface $entity
   *   The Certificate entity.
   *
   * @return int
   *   The number of revisions in the default language.
   */
  public function countDefaultLanguageRevisions(CertificateInterface $entity);

  /**
   * Unsets the language for all Certificate with the given language.
   *
   * @param \Drupal\Core\Language\LanguageInterface $language
   *   The language object.
   */
  public function clearRevisionsLanguage(LanguageInterface $language);

}
