<?php

/**
 * @file
 * Contains \Drupal\diff\EntityComparisonBase.
 */

namespace Drupal\diff;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\diff\DiffEntityComparison;

/**
 * Builds an array of data out of entity fields.
 *
 * The resulted data is then passed through the Diff component and
 * displayed on the UI and represents the differences between two entities.
 */
class EntityComparisonBase extends ControllerBase {

  /**
   * The entity comparison service for diff.
   */
  protected $entityComparison;

  /**
   * Constructs an EntityComparisonBase object.
   *
   * @param DiffEntityComparison $entityComparison
   *   The diff entity comparison service.
   */
  public function __construct($entityComparison) {
    $this->entityComparison = $entityComparison;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('diff.entity_comparison')
    );
  }

  /**
   * This method should return an array of items ready to be compared.
   *
   * @param ContentEntityInterface $left_entity
   *   The left entity
   * @param ContentEntityInterface $right_entity
   *   The right entity
   *
   * @return array
   *   Items ready to be compared by the Diff component.
   */
  public function compareRevisions(ContentEntityInterface $left_entity, ContentEntityInterface $right_entity) {
    $result = $this->entityComparison->compareRevisions($left_entity, $right_entity);
    return $result;
  }

}
