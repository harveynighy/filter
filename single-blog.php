<?php
if (!defined('ABSPATH')) exit;
get_header();
$biography = get_field('product_bio') ?: null;
?>
<h1><?= the_title(); ?></h1>
<p><?= get_the_date(); ?></p>
<p><?= get_the_excerpt(); ?></p>
<h2><?= $biography; ?></h2>

<div style="width: 10rem;">
    <?= get_the_post_thumbnail(); ?>
</div>

<?php
get_footer();
