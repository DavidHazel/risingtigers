<?php

/**
 * @file
 * Implements hook_views_data().
 */

/**
 * Implements hook_views_data().
 */
function views_simple_math_field_views_data() {
  $data['views_simple_math_field']['table']['group'] = t('Global');
  $data['views_simple_math_field']['table']['join'] = array(
    // Exist in all views.
    '#global' => array(),
  );
  $data['views_simple_math_field']['field_views_simple_math_field'] = array(
    'title' => t('Simple Math Field'),
    'help' => t('Views field that performs simple math expressions.'),
    'field' => array(
      'id' => 'field_views_simple_math_field',
    ),
  );
  return $data;
}
