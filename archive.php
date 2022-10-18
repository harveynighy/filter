<?php
if (!defined('ABSPATH')) exit;
get_header();
the_post(); ?>

<h1>Archive Page</h1>

<?php
have_posts();

$terms = get_terms(array(
    'taxonomy' => 'language',
    'hide_empty' => false,
)); ?>

<form method="GET">

<?php if (have_posts()) :
    echo "<section class=\"blog\">";
    echo "<div class=\"blog__archive\">";
    while (have_posts()) : the_post();

        // Get Data
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        $thumbnail = get_the_post_thumbnail();

        echo "<div class=\"blog__archive__card\">";
        echo "<div class=\"blog__archive__card--thumbnail\">{$thumbnail}</div>";
        echo "<h2>{$title}</h2>";
        echo "<p>{$excerpt}</p>";
        echo "</div>";
    endwhile;
else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php

endif;

the_content();
get_footer();
