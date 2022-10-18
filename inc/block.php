<?php
if (!defined('ABSPATH')) exit;

// Check if function exists and hook into setup.
if (function_exists('acf_register_block_type')) add_action('acf/init', function () {

    // Add blocks under array after registering


    // Register The Dummy Block
    acf_register_block_type([
        'name' => 'patient-recruitment/dummy',
        'title' => __('Dummy'),
        'category' => 'layout',
        'render_template' => locate_template('block/dummy.php'),
    ]);
});
