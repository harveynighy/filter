<?php
if (! defined('ABSPATH')) exit;

/**
 * Grabs the part from the parts folder
 * @param string $name The name of the php file (minus the extension) to pull through.
 * @param array|null $vars Any variables to inject into the php file
 */
function tw_get_component($name, $vars = null) {
  if (! $__file = locate_template("parts/$name.php")) return;
  unset($name);
  if (is_array($vars)) {
    extract( $vars, EXTR_SKIP );
    if (array_key_exists('vars', $vars)) $vars = $vars['vars'];
    else unset($vars);
  }
  include $__file;
}

/**
 * Returns the alt text of an image from the media library
 * 
 * @param int $id Get the alt text of the image from the media library
 * @return string The alt text of the image
 */
function tw_get_alt_text($id) {
  return get_post_meta($id, '_wp_attachment_image_alt', true);
}


/**
 * Create custom post type labels
 * @param  str $singular Singular name
 * @param  str $plural Plural name, leave blank to append 's' to singular
 * @return array Full list of required labels
 */
function tw_post_type_labels($singular, $plural = null) {
  
  if ($plural === null) {
    $plural = $singular . 's';
  }

  $labels = [
    'name' => $plural,
    'singular_name' => $singular,
    'menu_name' => $plural,
    'name_admin_bar' => $singular,
    'add_new' => 'Add New '.$singular,
    'add_new_item' => 'Add New '.$singular,
    'new_item' => 'New '.$singular,
    'edit_item' => 'Edit '.$singular,
    'view_item' => 'View '.$singular,
    'all_items' => 'All '.$plural,
    'search_items' => 'Search '.$plural,
    'parent_item_colon' => 'Parent '.$plural.': ',
    'not_found' => 'No '.$plural.' found.',
    'not_found_in_trash' => 'No '.$plural.' found in Trash.',
  ];

  return $labels;
}

function tw_get_menu($menuLocation, $containerClass = ' ', $walker = '') {
  
  wp_nav_menu([
    'theme_location'  => $menuLocation,
    'menu'            => '',
    'container'       => 'nav',
    'container_class' => $containerClass,
    'container_id'    => '',
    'menu_class'      => '',
    'menu_id'         => '',
    'echo'            => true,
    'fallback_cb'     => 'wp_page_menu',
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul>%3$s</ul>',
    'depth'           => 0,
    'walker'          => $walker,
  ]);

};

add_action('wp_enqueue_scripts', 'my_register_script_method');

/**
 * Returns the array to be apended in the filter
 * 
 * @param string $taxonomy_name Enter the Taxonomy name
 * @param string $term Enter the term slug 
 * @return array The Array that needs to be appended within the 'tax_query'
 * 
 */
function query_to_append($taxonomy_name, $term) {
  return array(
    'taxonomy' => $taxonomy_name,
    'field'    => 'slug',
    'terms'    => array($term),
  );
}

function my_register_script_method () {
  wp_deregister_script('jquery');
  wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jqueryexample.min.js');
}