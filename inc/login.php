<?php
if (!defined('ABSPATH')) exit;

// Enqueue login styles.
add_action('login_enqueue_scripts', function () {
    wp_enqueue_style(
        'theme-login',
        get_template_directory_uri() . '/public/styles/login.css',
        null,
        null
    );
});

// Use site title for login header.
add_filter('login_headertitle', function () {
    return get_bloginfo('name');
});

// Use site URL for login header.
add_filter('login_headerurl', function () {
    return home_url('/');
});
