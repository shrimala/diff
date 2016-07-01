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
use Drupal\Core\Datetime\DateFormatter;

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
   * The date service.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $date;

  /**
   * Constructs an EntityComparisonBase object.
   *
   * @param DiffEntityComparison $entityComparison
   *   The diff entity comparison service.
   * @param DateFormatter $date
   *   DateFormatter service.
   */
  public function __construct(DateFormatter $date, $entityComparison) {
	$this->date = $date;
    $this->entityComparison = $entityComparison;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('date.formatter'),
      $container->get('diff.entity_comparison')
    );
  }

}
