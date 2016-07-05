<?php

namespace Drupal\diff;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\diff\DiffEntityComparison;
use Drupal\Component\Render\FormattableMarkup;

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
   * Represents non breaking space HTML character entity marked as safe markup.
   */
  protected $nonBreakingSpace;
  
  /**
   * The entity comparison service for diff.
   */
  protected $entityComparison;

  /**
   * Constructs an EntityComparisonBase object.
   *
   * @param DateFormatter $date
   *   DateFormatter service.
   * @param DiffEntityComparison $entity_comparison
   *   The diff entity comparison service.
   */
  public function __construct(DateFormatter $date, $entity_comparison) {
    $this->date = $date;
    $this->nonBreakingSpace = new FormattableMarkup('&nbsp;', array());
    $this->entityComparison = $entity_comparison;
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
