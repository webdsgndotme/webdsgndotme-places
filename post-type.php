<?php

class webdsgndotme_places_content extends webdsgndotme_singleton {

  public function get_option($name, $default = '') {
    return webdsgndotme_places::get()->get_option($name, $default);
  }

  public function register() {

    $places_category_slug = $this->get_option('places_category_slug');
    $places_category_with_front = $this->get_option('places_category_with_front');
    $taxonomy = 'webdsgndotme_places';
    register_taxonomy($taxonomy,
                      null,
                      apply_filters('webdsgndotme_places:places_category', array(
                                      'hierarchical' => false,
                                      'update_count_callback' => '_update_post_term_count',
                                      'labels' => array(
                                        'name' => __( 'Places Categories', 'webdsgndotme_places'),
                                        'singular_name' => __( 'Place Category', 'webdsgndotme_places'),
                                        'search_items' =>  __( 'Search Places Categories', 'webdsgndotme_places'),
                                        'all_items' => __( 'All Places Categories', 'webdsgndotme_places'),
                                        'parent_item' => __( 'Parent Places Category', 'webdsgndotme_places'),
                                        'parent_item_colon' => __( 'Parent Places Category:', 'webdsgndotme_places'),
                                        'edit_item' => __( 'Edit Places Category', 'webdsgndotme_places'),
                                        'update_item' => __( 'Update Places Category', 'webdsgndotme_places'),
                                        'add_new_item' => __( 'Add New Places Category', 'webdsgndotme_places'),
                                        'new_item_name' => __( 'New Places Category', 'webdsgndotme_places')
                                      ),
                                      'show_ui' => true,
                                      'query_var' => true,
                                      'rewrite' => array('slug' => _x($places_category_slug, 'slug', 'webdsgndotme_places'), 'with_front' => $places_category_with_front),
                                    ))
    );


    $place_slug = $this->get_option('place_slug');
    $place_with_front = false;

    // The content type
    register_post_type('webdsgdotme_place',
                       apply_filters('webdsgndotme_places:place_post_type', array(
                                       'labels' => array(
                                         'name' => __('Places', 'webdsgndotme_places'),
                                         'singular_name' => __('Place', 'webdsgndotme_places'),
                                         'all_items' => __('All Places', 'webdsgndotme_places'),
                                         'add_new' => __('Add Place', 'webdsgndotme_places'),
                                         'add_new_item' => __('Add New Place', 'webdsgndotme_places'),
                                         'edit' => __('Edit', 'webdsgndotme_places'),
                                         'edit_item' => __('Edit Place', 'webdsgndotme_places'),
                                         'new_item' => __('New Place', 'webdsgndotme_places'),
                                         'view' => __('View Place', 'webdsgndotme_places'),
                                         'view_item' => __('View Place', 'webdsgndotme_places'),
                                         'search_items' => __('Search Places', 'webdsgndotme_places'),
                                         'not_found' => __('No Places found', 'webdsgndotme_places'),
                                         'not_found_in_trash' => __('No Placess found in trash', 'webdsgndotme_places'),
                                         'parent' => __('Parent Place', 'webdsgndotme_places')
                                       ),
                                       'description' => __('You can add new places using this feature.', 'webdsgndotme_places'),
                                       'public' => true,
                                       'show_ui' => true,
                                       'capability_type' => 'post',
                                       'publicly_queryable' => true,
                                       'exclude_from_search' => false,
                                       'hierarchical' => true,
                                       'rewrite' => array('slug' => $place_slug, 'with_front' => $place_with_front),
                                       'query_var' => true,
                                       'supports' => array('title', 'editor', 'excerpt', 'thumbnail'), // TODO: Add comments
                                       'taxonomies' => array($taxonomy),
                                       'register_meta_box_cb' => array($this, 'place_metabox'),
                                       'has_archive' => $place_slug,
                                       'show_in_nav_menus' => false,
                                     ))
    );

    $tour_slug = $this->get_option('tour_slug');
    $tour_with_front = false;
    register_post_type('webdsgdotme_tour',
                       apply_filters('webdsgndotme_places:tour_post_type', array(
                                       'labels' => array(
                                         'name' => __('Tour', 'webdsgndotme_places'),
                                         'singular_name' => __('Tour', 'webdsgndotme_places'),
                                         'all_items' => __('All Tours', 'webdsgndotme_places'),
                                         'add_new' => __('Add Tour', 'webdsgndotme_places'),
                                         'add_new_item' => __('Add New Tour', 'webdsgndotme_places'),
                                         'edit' => __('Edit', 'webdsgndotme_places'),
                                         'edit_item' => __('Edit Tour', 'webdsgndotme_places'),
                                         'new_item' => __('New Tour', 'webdsgndotme_places'),
                                         'view' => __('View Tour', 'webdsgndotme_places'),
                                         'view_item' => __('View Tour', 'webdsgndotme_places'),
                                         'search_items' => __('Search Tour', 'webdsgndotme_places'),
                                         'not_found' => __('No Tours found', 'webdsgndotme_places'),
                                         'not_found_in_trash' => __('No Tours found in trash', 'webdsgndotme_places'),
                                         'parent' => __('Parent Tour', 'webdsgndotme_places')
                                       ),
                                       'description' => __('You can add new places using this feature.', 'webdsgndotme_places'),
                                       'public' => true,
                                       'show_ui' => true,
                                       'capability_type' => 'post',
                                       'publicly_queryable' => true,
                                       'exclude_from_search' => false,
                                       'hierarchical' => true,
                                       'rewrite' => array('slug' => $tour_slug, 'with_front' => $tour_with_front),
                                       'query_var' => true,
                                       'supports' => array('title', 'editor', 'excerpt', 'thumbnail'), // TODO: Add comments
                                       'taxonomies' => array('category'),
                                       'register_meta_box_cb' => array($this, 'tour_metabox'),
                                       'has_archive' => $tour_slug,
                                       'show_in_nav_menus' => false,
                                     ))
    );

  }

  function place_metabox() {

  }

  function tour_metabox() {
  }

}


class webdsgndotme_place extends webdsgndotme_base {
}


class webdsgndotme_tour extends webdsgndotme_base {
}

