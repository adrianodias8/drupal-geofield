<?php

namespace Drupal\geofield\Plugin\GeofieldProximitySource;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Render\FormattableMarkup;

/**
 * Defines 'Geofield Client Location Origin' plugin.
 *
 * @package Drupal\geofield\Plugin
 *
 * @GeofieldProximitySource(
 *   id = "geofield_client_location_origin",
 *   label = @Translation("Client Location Origin"),
 *   description = @Translation("Gets the Client Location through the browser HTML5 Geolocation API."),
 *   context = {
 *     "filter",
 *   },
 *   exposedOnly = true
 * )
 */
class ClientLocationOriginFilter extends ManualOriginDefault {

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(array &$form, FormStateInterface $form_state, array $options_parents, $is_exposed = FALSE) {

    $form['#attributes'] = [
      'class' => ['proximity-origin-client'],
    ];

    $form["origin"] = [
      '#title' => $this->t('Client Coordinates'),
      '#type' => 'geofield_latlon',
      '#description' => $this->t('Value in decimal degrees. Use dot (.) as decimal separator.'),
      '#default_value' => [
        'lat' => '',
        'lon' => '',
      ],
    ];

    // If it IS exposed load the geolocation library.
    if ($is_exposed) {
      $form['origin']['#attached']['library'][] = 'geofield/geolocation';
    }
  }

}
