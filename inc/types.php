<?php
if (!defined('ABSPATH')) exit;

// Blog custom post type:
register_post_type('Blog', [
    'public' => true,
    'supports'  => [
        'title',
        'excerpt',
        'thumbnail'
    ],
    'has_archive' => true,
    'menu_icon' => 'dashicons-sticky',
    'labels' => tw_post_type_labels('Product'),
    'rewrite' => ['slug' => 'product'],
    'public' => true,
    'show_in_rest' => true,
    'taxonomies'  => array('type'),
]);

function add_blog_taxonomies()
{
    // Add new "language" taxonomy to Blogs
    register_taxonomy('language', 'blog', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => tw_post_type_labels('Type'),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'products', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/language/"
            'hierarchical' => true // This will allow URL's like "/language/boston/cambridge/"
        ),
    ));
}
add_action('init', 'add_blog_taxonomies', 0);

function add_product_brands()
{
    // Add new "language" taxonomy to Blogs
    register_taxonomy('brands', 'blog', array(
        // Hierarchical taxonomy (like categories)
        'hierarchical' => true,
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels' => tw_post_type_labels('Brand'),
        // Control the slugs used for this taxonomy
        'rewrite' => array(
            'slug' => 'brand', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/language/"
            'hierarchical' => true // This will allow URL's like "/language/boston/cambridge/"
        ),
    ));
}
add_action('init', 'add_product_brands', 0);

function custom_taxonomy_flush_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action('init', 'custom_taxonomy_flush_rewrite');
