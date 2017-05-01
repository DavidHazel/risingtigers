<?php

namespace Drupal\views_simple_math_field\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\PluralTranslatableMarkup;
use Drupal\views\Plugin\views\field\NumericField;
use Drupal\views\ResultRow;

/**
 * @file
 * Defines Drupal\views_simple_math_field\Plugin\views\field\SimpleMathField.
 */

/**
 * Field handler to flag the node type.
 *
 * @ingroup views_field_handlers
 * @ViewsField("field_views_simple_math_field")
 */
class SimpleMathField extends NumericField {

  /**
   * Sets the initial field data at zero.
   */
  public function query() {
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['fieldset_one']['data_field_one'] = array('default' => NULL);
    $options['fieldset_two']['data_field_two'] = array('default' => NULL);
    $options['operation'] = array('default' => NULL);
    $options['fieldset_one']['constant_one'] = array('default' => NULL);
    $options['fieldset_two']['constant_two'] = array('default' => NULL);
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
    $fieldList = $this->displayHandler->getFieldLabels();
    $fieldList['const'] = t('Enter a constant');
    $form['fieldset_one'] = array(
      '#type' => 'fieldset',
      '#title' => t('Select the field representing the first value.'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
      '#weight' => -10,
    );
    $form['fieldset_one']['data_field_one'] = array(
      '#type' => 'radios',
      '#title' => t('Data Field One'),
      '#options' => $fieldList,
      '#default_value' => $this->options['fieldset_one']['data_field_one'],
      '#weight' => -10,
    );
    $form['fieldset_one']['constant_one'] = array(
      '#type' => 'textfield',
      '#title' => t('Constant Value'),
      '#default_value' => $this->options['fieldset_one']['constant_one'],
      '#states' => array(
          'visible' => array(
              ':input[name="options[fieldset_one][data_field_one]"]' => array('value' => 'const'),
          ),
      ),
      '#weight' => -9,
    );
    $form['fieldset_two'] = array(
      '#type' => 'fieldset',
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
      '#title' => t('Select the field representing the second value.'),
      '#weight' => -8,
    );
    $form['fieldset_two']['data_field_two'] = array(
      '#type' => 'radios',
      '#title' => t('Data Field Two'),
      '#options' => $fieldList,
      '#default_value' => $this->options['fieldset_two']['data_field_two'],
      '#weight' => -8,
    );
    $form['fieldset_two']['constant_two'] = array(
      '#type' => 'textfield',
      '#title' => t('Constant Value'),
      '#default_value' => $this->options['fieldset_two']['constant_two'],
      '#states' => array(
          'visible' => array(
              ':input[name="options[fieldset_two][data_field_two]"]' => array('value' => 'const'),
          ),
      ),
      '#weight' => -7,
    );
    $form['operation'] = array(
      '#type' => 'radios',
      '#title' => t('Operation'),
      '#options' => array(
          '+' => t('Add'),
          '-' => t('Subtract'),
          '*' => t('Multiply'),
          '/' => t('Divide'),
          '%' => t('Modulo'),
          '**' => t('Power'),
      ),
      '#default_value' => $this->options['operation'],
      '#description' => t('Choose your operation.'),
      '#weight' => -6,
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getValue(ResultRow $values, $field = NULL) {
    parent::getValue($values, $field);
    $dataFieldOne = $this->options['fieldset_one']['data_field_one'];
    $dataFieldTwo = $this->options['fieldset_two']['data_field_two'];
    $operation = $this->options['operation'];
    $entity = $this->getEntity($values);
    if ($dataFieldOne == 'const') {
      $dataFieldOneValue = $this->options['fieldset_one']['constant_one'];
    }
    else {
      $dataFieldOneValue = $entity->get($dataFieldOne)->getValue()[0]['value'];
    }
    if ($dataFieldTwo == 'const') {
      $dataFieldTwoValue = $this->options['fieldset_two']['constant_two'];
    }
    else {
      $dataFieldTwoValue = $entity->get($dataFieldTwo)->getValue()[0]['value'];
    }

    if ($operation === '+') {
      $value = $dataFieldOneValue + $dataFieldTwoValue;
    }
    elseif ($operation === '-') {
      $value = $dataFieldOneValue - $dataFieldTwoValue;
    }
    elseif ($operation === '*') {
      $value = $dataFieldOneValue * $dataFieldTwoValue;
    }
    elseif ($operation === '/') {
      $value = $dataFieldOneValue / $dataFieldTwoValue;
    }
    elseif ($operation === '%') {
      $value = $dataFieldOneValue % $dataFieldTwoValue;
    }
    elseif ($operation === '**') {
      $value = pow($dataFieldOneValue, $dataFieldTwoValue);
    }
    else {
      $value = NULL;
    }

    return $value;
  }

  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    $dataFieldOne = $this->options['fieldset_one']['data_field_one'];
    $dataFieldTwo = $this->options['fieldset_two']['data_field_two'];
    $operation = $this->options['operation'];
    $entity = $this->getEntity($values);
    if ($dataFieldOne == 'const') {
      $dataFieldOneValue = $this->options['fieldset_one']['constant_one'];
    }
    else {
      $dataFieldOneValue = $entity->get($dataFieldOne)->getValue()[0]['value'];
    }
    if ($dataFieldTwo == 'const') {
      $dataFieldTwoValue = $this->options['fieldset_two']['constant_two'];
    }
    else {
      $dataFieldTwoValue = $entity->get($dataFieldTwo)->getValue()[0]['value'];
    }

    if ($operation === '+') {
      $value = $dataFieldOneValue + $dataFieldTwoValue;
    }
    elseif ($operation === '-') {
      $value = $dataFieldOneValue - $dataFieldTwoValue;
    }
    elseif ($operation === '*') {
      $value = $dataFieldOneValue * $dataFieldTwoValue;
    }
    elseif ($operation === '/') {
      $value = $dataFieldOneValue / $dataFieldTwoValue;
    }
    elseif ($operation === '%') {
      $value = $dataFieldOneValue % $dataFieldTwoValue;
    }
    elseif ($operation === '**') {
      $value = pow($dataFieldOneValue, $dataFieldTwoValue);
    }
    else {
      $value = NULL;
    }

    if (!empty($this->options['set_precision'])) {
      $value = number_format($value, $this->options['precision'], $this->options['decimal'], $this->options['separator']);
    }
    else {
      $remainder = abs($value) - intval(abs($value));
      $value = $value > 0 ? floor($value) : ceil($value);
      $value = number_format($value, 0, '', $this->options['separator']);
      if ($remainder) {
        // The substr may not be locale safe.
        $value .= $this->options['decimal'] . substr($remainder, 2);
      }
    }

    // Check to see if hiding should happen before adding prefix and suffix.
    if ($this->options['hide_empty'] && empty($value) && ($value !== 0 || $this->options['empty_zero'])) {
      return '';
    }

    // If we should format as plural, take the (possibly) translated plural
    // setting and format with the current language.
    if (!empty($this->options['format_plural'])) {
      $value = PluralTranslatableMarkup::createFromTranslatedString($value, $this->options['format_plural_string']);
    }

    return $this->sanitizeValue($this->options['prefix'], 'xss') . $this->sanitizeValue($value) . $this->sanitizeValue($this->options['suffix'], 'xss');
  }

}
