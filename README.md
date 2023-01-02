# Geofield

Geofield is an advanced module for storing, managing and representing dynamic Geographic data in Drupal.
It supports all geo-types (points, lines, polygons, multi types geometries, etc.), and integrates with various Js Mapping Libraries (Google Maps, Leaflet, Open Layers, etc.) and advanced Geocoding / Reverse Geocoding functionalities, via many other Drupal Geo Mapping modules.

For a full description of the module, visit the
[project page](https://www.drupal.org/project/geofield).

Submit bug reports and feature suggestions, or track changes in the
[issue queue](https://www.drupal.org/project/issues/geofield).


## Requirements

This module requires no modules outside of Drupal core.


## Installation

Install as you would normally install a contributed Drupal module. For further
information, see
[Installing Drupal Modules](https://www.drupal.org/docs/extending-drupal/installing-drupal-modules).


## Configuration

Once enabled the module it will be possible to add a "Geofield" field type to
any entity type/bundle and then choose the preferred widget or formatter.


## Mapping with Geofield

It is possible to implement advanced Mapping and Geocoding functionalities
adding compatible and specialized modules for Drupal, such as:

- [Geofield Map module](https://www.drupal.org/project/geofield_map)
- [Leaflet module](https://www.drupal.org/project/leaflet)
- [Leaflet Widget module](https://www.drupal.org/project/leaflet_widget)
- [Geocoder](https://www.drupal.org/project/geocoder)


## Geofield Schema

Geofield fields contain nine columns of information about the geographic data
that is stores. At its heart is the 'wkt' column where it stores the full
geometry in the 'Well Known Text' (WKT) format. All other columns are metadata
derived from the WKT column. Columns are as follows:
```
'wkt'          Raw value. By default, stored as WKB, loaded as WKT
'geo_type'     Type of geometry (point, linestring, polygon etc.)
'lat'          Centroid (Latitude or Y)
'lon'          Centroid (Longitude or X)
'top'          Bounding Box Top (Latitude or Max Y)
'bottom'       Bounding Box Bottom (Latitude or Min Y)
'left'         Bounding Box Left (Longitude or Min X)
'right'        Bounding Box Right (Longitude or Max X)
'geohash'      Geohash equivalent of geom column value
```


## Save or Updated a Geofield programmatically

To save or update programatically a Geofield (both single and multivalue) it is sufficient to pass the WKT values/geometries to the

{Drupal\geofield\Plugin\Field\FieldType\GeofieldItem} setValue public method

For instance in case of a node entity containing a geofield named "field_geofield",
it is possible to update/set its multiple values in the following way:

     // The location of the Empire State Building, in New York City (US)
     $empire_location_lon_lat = [-73.985664, 40.748441];

     // Generate the WKT version of the point geometry: 'POINT (-73.985664 41.748441)'
     $empire_location_wkt = \Drupal::service('geofield.wkt_generator')->wktBuildPoint($empire_location_lon_lat);

     // Generate the (first) geofield value in the proper format.
     $geofield_point = [
     'value' => $empire_location_wkt,
     ];

     // Generate the (second) geofield value in the proper format.
     // The permiter of Bryant Park, in New York City (US)
     $geofield_polygon = [
     'value' => 'POLYGON((-73.98411932014324 40.754779803566606,-73.98502054237224 40.75354445673964,-73.98186626457073 40.75221155678824,-73.98092212699748 40.75344692838096,-73.98411932014324 40.754779803566606))',
     ];

      // Get the wanted entity ($id of a node in this example) and set the
      // 'field_geofield' with the goefield values/geometries
      $entity =  \Drupal\node\Entity\Node::load($id);
      $geofield = $entity->get('field_geofield');
      $geofield->setValue([$geofield_point, $geofield_polygon]);
      $entity->save();


## Maintainers

- Italo Mairo (itamair) - https://www.drupal.org/u/itamair
- Brandon Bergren (bdragon) - https://www.drupal.org/u/bdragon
- Brandon Morrison (Brandonian) - https://www.drupal.org/u/brandonian
- Patrick Hayes (phayes) - https://www.drupal.org/u/phayes
- Pablo López (plopesc) - https://www.drupal.org/u/plopesc