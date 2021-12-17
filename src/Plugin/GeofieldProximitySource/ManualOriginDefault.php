<?php

namespace Drupal\geofield\Plugin\GeofieldProximitySource;

use Drupal\Core\Form\FormStateInterface;
use Drupal\geofield\Plugin\GeofieldProximitySourceBase;
use Drupal\Component\Render\FormattableMarkup;

/**
 * Defines 'Geofield Manual Origin' plugin.
 *
 * @package Drupal\geofield\Plugin
 *
 * @GeofieldProximitySource(
 *   id = "geofield_manual_origin",
 *   label = @Translation("Manual Origin (Default)"),
 *   description = @Translation("Allow the Manual input of Distance and Origin (as couple of Latitude and Longitude in decimal degrees.)"),
 *   exposedDescription = @Translation("Manual input of Distance and Origin (as couple of Latitude and Longitude in decimal degrees.)"),
 *   context = {},
 * )
 */
class ManualOriginDefault extends GeofieldProximitySourceBase {

  /**
   * Constructs a ManualOriginDefault object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->origin['lat'] = isset($configuration['origin']) && is_numeric($configuration['origin']['lat']) ? $configuration['origin']['lat'] : '';
    $this->origin['lon'] = isset($configuration['origin']) && is_numeric($configuration['origin']['lon']) ? $configuration['origin']['lon'] : '';
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(array &$form, FormStateInterface $form_state, array $options_parents, $is_exposed = FALSE) {

    $lat = isset($this->configuration['origin']['lat']) ? $this->configuration['origin']['lat'] : $this->origin['lat'];
    $lon = isset($this->configuration['origin']['lon']) ? $this->configuration['origin']['lon'] : $this->origin['lon'];

    $form["origin"] = [
      '#title' => $this->t('Origin Coordinates'),
      '#type' => 'geofield_latlon',
      '#description' => $this->t('Value in decimal degrees. Use dot (.) as decimal separator.'),
      '#default_value' => [
        'lat' => $lat,
        'lon' => $lon,
      ],
    ];
  }

}
