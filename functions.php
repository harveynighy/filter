<?php
if (!defined('ABSPATH')) exit;

define('THEME_PUBLIC', get_stylesheet_directory_uri() . '/dist');

require __dir__ . '/inc/utils.php';
require __dir__ . '/inc/types.php';
require __dir__ . '/inc/setup.php';
require __dir__ . '/inc/login.php';
require __dir__ . '/inc/block.php';

if (is_admin()) {
    require __dir__ . '/inc/admin/acf.php';
}

function rclr_query_string($q)
{
    foreach (get_taxonomies(array(), 'objects') as $taxonomy => $t) {
        if ('post_tag' == $taxonomy) {
            continue;   // Handled further down in the $q['tag'] block
        }
        if ($t->query_var && !empty($q[$t->query_var])) {
            if (is_array($q[$t->query_var])) {
                $q[$t->query_var] = implode(',', $q[$t->query_var]);
            }
        }
    }
    return $q;
}

add_filter('request', 'rclr_query_string', 1);