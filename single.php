<?php
if (!defined('ABSPATH')) exit;
get_header();
the_post();
?>

<h1><?php echo the_title(); ?></h1>
<p><?php echo the_excerpt(); ?></p>
<?php
get_footer();
