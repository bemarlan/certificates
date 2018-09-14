<?php

namespace Drupal\certificates\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Certificate entities.
 *
 * @ingroup certificates
 */
interface CertificateInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Certificate name.
   *
   * @return string
   *   Name of the Certificate.
   */
  public function getName();

  /**
   * Sets the Certificate name.
   *
   * @param string $name
   *   The Certificate name.
   *
   * @return \Drupal\certificates\Entity\CertificateInterface
   *   The called Certificate entity.
   */
  public function setName($name);

  /**
   * Gets the Certificate creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Certificate.
   */
  public function getCreatedTime();

  /**
   * Sets the Certificate creation timestamp.
   *
   * @param int $timestamp
   *   The Certificate creation timestamp.
   *
   * @return \Drupal\certificates\Entity\CertificateInterface
   *   The called Certificate entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Certificate published status indicator.
   *
   * Unpublished Certificate are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Certificate is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Certificate.
   *
   * @param bool $published
   *   TRUE to set this Certificate to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\certificates\Entity\CertificateInterface
   *   The called Certificate entity.
   */
  public function setPublished($published);

  /**
   * Gets the Certificate revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Certificate revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\certificates\Entity\CertificateInterface
   *   The called Certificate entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Certificate revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Certificate revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\certificates\Entity\CertificateInterface
   *   The called Certificate entity.
   */
  public function setRevisionUserId($uid);

}
