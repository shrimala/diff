<?php

/**
 * @file
 * Contains \Drupal\diff\Diff\Entity\CoreFieldBuilder.
 */

namespace Drupal\diff\Diff\Entity;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\diff\Diff\FieldDiffBuilderInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Field\FieldDefinitionInterface;


class CoreFieldBuilder implements FieldDiffBuilderInterface {
  use StringTranslationTrait;

  /**
   * Form builder service.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;


  /**
   * Constructs a TextFieldBuilder object.
   *
   * @param FormBuilderInterface $form_builder
   *   Form builder service.
   */
  public function __construct(FormBuilderInterface $form_builder) {
    $this->formBuilder = $form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public function applies(FieldDefinitionInterface $field_definition) {
    // List of the field types for which this class provides diff support.
    $field_types = array('decimal', 'integer', 'float', 'email', 'telephone',
      'path', 'date', 'changed', 'uri', 'string', 'timestamp', 'created',
      'string_long', 'language', 'uuid', 'map');
    // Check if this class can handle diff for a certain field.
    if (in_array($field_definition->getType(), $field_types)) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function build(FieldItemListInterface $field_items, array $context) {
    $result = array();

    // Every item from $field_items is of type FieldItemInterface.
    foreach ($field_items as $field_key => $field_item) {
      if (!$field_item->isEmpty()) {
        $values = $field_item->getValue();
        if (isset($values['value'])) {
          $result[$field_key][] = $values['value'];
        }
      }
    }

    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function getSettingsForm($field_type) {
    return $this->formBuilder->getForm('Drupal\diff\Form\DiffFieldBaseSettingsForm', $field_type);
  }

}