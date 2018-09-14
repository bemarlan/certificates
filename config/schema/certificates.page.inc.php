<?php

/**
 * @file
 * Contains certificates.page.inc.
 *
 * Page callback for Certificate entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Certificate templates.
 *
 * Default template: certificate.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_certificate(array &$variables) {
  // Fetch Certificate Entity Object.
  $certificate = $variables['elements']['#certificate'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
