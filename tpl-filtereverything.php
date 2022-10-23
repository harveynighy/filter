<?php /* Template Name: Everything Filter */

if (!defined('ABSPATH')) exit;
get_header();
?>
<h1>Filter Everything</h1>
<?php
$terms = (get_terms([
    'taxonomy' => 'type',
    'hide_empty' => false
]));

global $_GET;
?>

<form action="" method="GET">

    <!-- First Select Option -->
    <select name="type[]">
        <option value="">All</option>
        <?php foreach ($terms as $term) : ?>

            <option <?php if ($_GET["type"][0] == $term->slug) {
                        echo "selected";
                    } else {
                        echo "";
                    } ?> value="<?= $term->slug ?>">
                <?= $term->name; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Submit Button -->
    <button type="submit">Submit</button>
</form>

<?php
$args = [
    'post_type' => 'product',
    'tax_query' => array(
        'relation' => 'AND',
    ),
];

// Push the arguments of Types Select Form to WP_Query $args
if (!empty($_GET["type"][0])) {
    foreach ($_GET["type"] as $type) {
        array_push($args['tax_query'], query_to_append("type", $type));
    }
}

// The Query
$the_query = new WP_Query($args);

// The Loop
if ($the_query->have_posts()) {
    echo '<div class="blog__archive">';
    while ($the_query->have_posts()) {

        // Wordpress Default
        $the_query->the_post();
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        $thumbnail = get_the_post_thumbnail();
        $permalink = get_the_permalink();

        // ACF Customizations
        $biography = get_field('product_bio') ?: null;


        echo "<div class=\"blog__archive__card\">";
        echo "<div class=\"blog__archive__card--thumbnail\">{$thumbnail}</div>";
        echo "<h2>{$title}</h2>";
        echo "<p>{$excerpt}</p>";
        echo "<h4>{$biography}</h4>";
        echo "<a href=\"{$permalink}\">{$title}</a>";
        echo "</div>";
    }
    echo '</div>';
} else {
    // no posts found
}
/* Restore original Post Data */
wp_reset_postdata();
get_footer();
?>