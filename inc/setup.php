<?php
if (!defined('ABSPATH')) exit;


// Hide WordPress version.
add_filter('the_generator', '__return_empty_string');

// Register theme support and nav menus.
add_action('after_setup_theme', function () {

    register_nav_menus([
        'main' => 'Main navigation',
        'side' => 'Sidebar navigation',
        'footer' => 'Footer',
    ]);

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', [
        'comment-list',
        'comment-form',
        'search-form',
        'gallery',
    ]);
});

// Register and enqueue scripts and styles.
add_action('wp_enqueue_scripts', function () {

    wp_enqueue_style( 'main', get_template_directory_uri() . '/dist/app.css');

    wp_enqueue_script( 'main', get_template_directory_uri() . '/dist/app.js');
});

// put gravity form scripts in the footer
add_filter('gform_init_scripts_footer', '__return_true');

// Adds a defer tag onto whitelisted scripts
add_filter('script_loader_tag', function ($tag, $handle) {
    $deferHandles = [ // handles to add defer tag to
        'main',
    ];
    if (array_search($handle, $deferHandles) === false) return $tag;
    return str_replace(' src', ' defer src', $tag);
}, 10, 2);

// Disable emoji stuff
add_action('init', function () {
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
});

// filter to remove TinyMCE emojis
add_filter('tiny_mce_plugins', function ($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, ['wpemoji']);
    } else {
        return [];
    }
});

// Removes wp-embed script
add_action('wp_footer', function () {
    wp_deregister_script('wp-embed');
});


// Remove nav menu item IDs
add_filter('nav_menu_item_id', '__return_null',  100);

// Set excerpt continued to "..."
add_filter('excerpt_more', function () {
    return '...';
});

// Set excerpt length to 45 words
add_filter('excerpt_length', function () {
    return 45;
});

// Wrap embeds in responsive wrapper
add_filter('the_content', function ($html) {
    if (preg_match_all('/(?:<p[^>]*>\s*)?(<iframe[^<]+<\/iframe>)(?:\s*<\/p>)?/', $html, $matches, PREG_SET_ORDER)) {
        $swap = [];
        foreach ($matches as $match) {
            $swap[$match[0]] = sprintf('<div class="embed">%s</div>', $match[1]);
        }
        $html = strtr($html, $swap);
    }
    return $html;
}, 15);
