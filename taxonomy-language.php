<?php
if (!defined('ABSPATH')) exit;
get_header();
the_post();
$tm = get_queried_object();
$page_name = $tm->name
?>

<h1><?= $page_name; ?> Page</h1>

<?php
$term_name = get_queried_object()->name;
$args = array('category_name' => $term_name, 'posts_per_page' => 5);
$myposts = get_posts($args);

foreach ($myposts as $post) : setup_postdata($post);
?>
    <li>
        <?php the_title(); ?>
    </li>
<?php endforeach; ?>
<?php
$terms = get_terms(array(
    'taxonomy' => 'language',
    'hide_empty' => false,
    'posts_per_page' => -1,
));

have_posts();
?>

<form method="GET">
    <?php
    foreach ($terms as $term) :
        if ($term->parent == $tm->term_id) : ?>
            <label>
                <input type="radio" name="language[]" value="<?php echo $term->slug;  ?>">
                <?= $term->name; ?>
                </input>
            </label>
        <?php endif; ?>
    <?php endforeach; ?>
    <!-- <button type="submit">Apply</button> -->
</form>

<?php if (have_posts()) :
    echo "<section class=\"blog\">";
    echo "<div class=\"blog__archive\">";
    while (have_posts()) : the_post();

        // Get Data
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        $thumbnail = get_the_post_thumbnail();
        $permalink = get_the_permalink();

        echo "<div class=\"blog__archive__card\">";
        echo "<div class=\"blog__archive__card--thumbnail\">{$thumbnail}</div>";
        echo "<h2>{$title}</h2>";
        echo "<p>{$excerpt}</p>";
        echo "<a href=\"{$permalink}\">{$title}</a>";
        echo "</div>";
    endwhile;
else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php

endif;

the_content();
get_footer();
