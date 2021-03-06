<?php

/**
 * @file
 * Unit suggester plugin that suggests different units based on current locale.
 */

$plugin = array(
  'title' => t('Per Locale'),
  'description' => t('Output value in different units based on the current locale.'),
  'applicable callback' => TRUE,
  'enabled callback' => NULL,
  'disabled callback' => NULL,
  'settings form callback' => 'mvf_unit_suggester_locale_form',
  'suggest unit callback' => 'mvf_unit_suggester_locale_unit',
);

/**
 * Settings form for 'locale' mvf unit suggester plugin.
 *
 * @param object $measure
 *   Fully loaded 'units_measure' entity, on which the MVF field is set up
 * @param array $field
 *   Field API field definition array of MVF field
 * @param array $instance
 *   Field API instance definition array of MVF field
 * @param array $settings
 *   Array of currently stored settings in the provided $instance, you are
 *   encouraged to use it as source of #default_value for the form elements
 *   you are defining in this form
 * @param array $plugin
 *   cTools plugin definition array of your unit suggester plugin
 *
 * @return array
 *   Field API form elements definition representing additional settings that
 *   this unit suggester needs for its functionality
 */
function mvf_unit_suggester_locale_form($measure, $field, $instance, $settings = array(), $plugin) {
  $form = array();

  $options = array(
    MVF_UNIT_ORIGINAL => t('Original Unit'),
  );
  foreach (units_unit_by_measure_load_multiple($measure) as $unit) {
    $umid = entity_extract_ids('units_unit', $unit);
    $umid = reset($umid);
    $options[$umid] = entity_label('units_unit', $unit);
  }
  foreach (language_list() as $language) {
    $form[$language->language] = array(
      '#type' => 'select',
      '#title' => $language->name,
      '#options' => $options,
      '#default_value' => isset($settings[$language->language]) ? $settings[$language->language] : NULL,
    );
  }

  return $form;
}

/**
 * Suggest output unit for a MVF field.
 *
 * @param array $items
 *   Array of MVF field items for which you are requested to suggest output
 *   unit
 * @param array $field
 *   Field API field definition array of MVF field
 * @param array $instance
 *   Field API instance definition array of MVF field
 * @param object $entity
 *   Fully loaded entity, for which you are requested to suggest output unit
 * @param string $entity_type
 *   Entity type of $entity
 * @param array $settings
 *   Array of currently stored settings in the provided $instance, you are
 *   encouraged to use it when deciding what output unit to suggest
 * @param array $plugin
 *   cTools plugin definition array of your unit suggester plugin
 *
 * @return int
 *   ID of a 'units_unit' entity, that you suggest as output unit. Two
 *   additional constants can be used as output here:
 *   - MVF_UNIT_ORIGINAL: means to output $items as they are, in whatever
 *     units they were entered
 *   - MVF_UNIT_UNKNOWN: means you cannot make any good suggestion for output
 *     unit
 */
function mvf_unit_suggester_locale_unit($items, $field, $instance, $entity, $entity_type, $settings = array(), $plugin) {
  global $language;
  return isset($settings[$language->language]) ? $settings[$language->language] : MVF_UNIT_UNKNOWN;
}
