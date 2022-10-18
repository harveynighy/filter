<?php /* Template Name: Everything Filter */

if (!defined('ABSPATH')) exit;
get_header();
?>
<h1>Filter Everything</h1>
<?php
$terms = (get_terms([
    'taxonomy' => 'language',
    'hide_empty' => false
]));

$brands_terms = (get_terms([
    'taxonomy' => 'brands',
    'hide_empty' => true,
    'order' => 'ASC',
    'get' => 'all'
]));

global $_GET;
?>

<form action="" method="GET">

    <!-- First Select Option -->
    <select name="language[]">
        <option value="">All</option>
        <?php foreach ($terms as $term) : ?>

            <option <?php if ($_GET["language"][0] == $term->slug) {
                        echo "selected";
                    } else {
                        echo "";
                    } ?> value="<?= $term->slug ?>">
                <?= $term->name; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Submit Button -->
    <select name="brands[]" id="brand">
        <option value="">All</option>
        <?php foreach ($brands_terms as $term) : ?>
            <option <?php if ($_GET["brands"][0] == $term->slug) {
                        echo "selected";
                    } else {
                        echo "";
                    } ?> <?php echo $result = $_GET["brand"][0] == $term->slug; ?> value="<?= $term->slug ?>"><?= $term->name; ?></option>
        <?php endforeach; ?>
    </select>
    <!-- Submit Button -->
    <button type="submit">Submit</button>
</form>

<?php

$args = [
    'post_type' => 'blog',
    'tax_query' => array(
        'relation' => 'AND',
    ),
];

// Push the arguments of Machines Select Form to WP_Query $args
if (!empty($_GET["language"][0])) {
    foreach ($_GET["language"] as $language) {
        array_push($args['tax_query'], query_to_append("language", $language));
    }
}

// Push the arguments of Brands Select Form to WP_Query $args
if (!empty($_GET["brands"][0])) {
    foreach ($_GET["brands"] as $brand) {
        array_push($args['tax_query'], query_to_append("brands", $brand));
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
get_footer(); ?>