<?php
if (!defined('ABSPATH')) exit;

if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Options',
        'menu_title' => 'Options',
        'menu_slug'  => 'theme-settings',
        'capability' => 'edit_posts',
        'autoload'   => true,
        'position'   => 3,
    ]);
}

// ACF Google Maps API key
// add_action('acf/init', function () {
//     acf_update_setting('google_api_key', 'ACF_KEY');
// });
