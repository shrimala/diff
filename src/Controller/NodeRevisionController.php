<?php

/**
 * @file
 * Contains \Drupal\diff\Controller\RevisionController.
 */

namespace Drupal\diff\Controller;

use Drupal\node\NodeInterface;

/**
 * Returns responses for Node Revision routes.
 */
class NodeRevisionController extends EntityComparisonBase {

  /**
   * @param NodeInterface $node The node whose revisions are inspected.
   * @return array Render array containing the revisions table for $node.
   */
  public function revisionOverview(NodeInterface $node) {
    return $this->formBuilder()->getForm('Drupal\diff\Form\RevisionOverviewForm', $node);
  }

}