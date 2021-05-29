<?php

namespace Drupal\geofield\Plugin\GeofieldBackend;

use Drupal\geofield\Plugin\GeofieldBackendBase;

/**
 * Postgis backend for Geofield.
 *
 * @GeofieldBackend(
 *   id = "geofield_backend_postgis",
 *   admin_label = @Translation("Geofield PostGIS Backend")
 * )
 */
class GeofieldBackendPostgis extends GeofieldBackendBase {

  /**
   * {@inheritdoc}
   */
  public function schema() {
    return array(
      'type' => 'geometry',
      'size' => 'big',
      'not null' => FALSE,
    );
  }

  /**
   * {@inheritdoc}
   */
  public function save($geometry) {
    $geom = $this->geoPhpWrapper->load($geometry);
    $unpacked = unpack('H*', $geom->out('ewkb'));
    return $unpacked[1];
  }

}
