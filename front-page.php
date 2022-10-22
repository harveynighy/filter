<?php
if (!defined('ABSPATH')) exit;
get_header();
the_post();
the_content();
?>



<?php

$terms = get_terms(array(
    'taxonomy' => 'language',
    'hide_empty' => false,
    'posts_per_page' => -1,
)); ?>

<?php $args = array(
    'post_type' => 'blog',
    'order' => 'ASC',
);

$query = new WP_Query($args);

if ($query->have_posts()) {
    echo "<section class=\"blog\">";
    echo "<div class=\"blog__archive\">";
    while ($query->have_posts()) {
        $query->the_post();

        // Get Data
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        $thumbnail = get_the_post_thumbnail();

        echo "<div class=\"blog__archive__card\">";
        echo "<div class=\"blog__archive__card--thumbnail\">{$thumbnail}</div>";
        echo "<h2>{$title}</h2>";
        echo "<p>{$excerpt}</p>";
        echo "</div>";
    }
    echo "</div>";
    echo "</section>";
} else {
    print 'no posts found';
}
the_content();
get_footer();
