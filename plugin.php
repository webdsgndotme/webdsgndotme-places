<?php

/**
 * Add places and let posts relate to them.
 *
 * Plugin Name: webdsgndotme - Places
 * Plugin URI:  http://webdsgn.me
 * Description: Create places and relate them to posts. Feature them on a fancy custom map.
 * Author:  webdsgndotme
 * Author URI: http://webdsgn.me
 * Version: 0.0.1
 */

$lib = 'webdsgndotme.inc.php';
// Let's find our base class on plugins dir first, load it from inc dir otherwise.
if (file_exists(WP_PLUGIN_DIR . '/' . $lib)) {
  include_once(WP_PLUGIN_DIR . '/' . $lib);
} else {
  include_once dirname(__FILE__) . '/inc/' . $lib;
}

class webdsgndotme_places extends webdsgndotme_plugin {

  const VERSION = '0.0.1';

  protected function __construct() {
    $name = dirname(plugin_basename(__FILE__));
    parent::__construct($name, self::VERSION);
  }

  protected function set_options() {
    if ($options = parent::set_options()) {
      return $options;
    }

    $options = new stdClass;

    // Default slug for place posts
    $options->place_slug = 'place';
    // Prepend slug to places permalinks?
    $options->place_with_front = false;
    // Default sluf for tour posts
    $options->tour_slug = 'tour';
    // Prepend slug to tours permalinks?
    $options->tour_with_front = false;
    // Places category slug
    $options->places_category_slug = 'place-categories';
    // Prepend slug to places categories permalinks?
    $options->places_category_with_front = true;

    update_option($this->domain, $options);

    $this->options = $options;
    return $this->options;
  }

  public function init() {
    require_once self::plugin_path() . '/post-type.php';
    webdsgndotme_places_content::get()->register();
  }

}


$instance = webdsgndotme_places::get();
register_activation_hook(__FILE__, array($instance, 'install'));
register_deactivation_hook(__FILE__, array($instance, 'uninstall'));
