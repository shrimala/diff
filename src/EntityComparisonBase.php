<?php

namespace Drupal\diff;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\diff\DiffEntityComparison;

/**
 * Provides a base class for diff revision controllers.
 */
class EntityComparisonBase extends ControllerBase {

  /**
   * The date service.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $date;
  
  /**
   * The entity comparison service for diff.
   */
  protected $entityComparison;

  /**
   * Constructs an EntityComparisonBase object.
   *
   * @param DateFormatter $date
   *   DateFormatter service.
   * @param DiffEntityComparison $entityComparison
   *   The diff entity comparison service.
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
