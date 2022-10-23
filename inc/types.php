<?php
if (!defined('ABSPATH')) exit;

function productPostType()
{
    // Blog custom post type:
    register_post_type('product', [
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

    register_taxonomy('type', 'product', array(
        'hierarchical' => true,
        'labels' => tw_post_type_labels('Type'),
        'rewrite' => array(
            'slug' => 'products', // This controls the base slug that will display before each term
            'with_front' => false, // Don't display the category base before "/language/"
            'hierarchical' => true // This will allow URL's like "/language/boston/cambridge/"
        ),
    ));
}
add_action('init', 'productPostType', 0);