<?php
        // Get Data
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        $thumbnail = get_the_post_thumbnail();

        echo "<div class=\"blog__archive__card\">";
        echo "<div class=\"blog__archive__card--thumbnail\">{$thumbnail}</div>";
        echo "<h2>{$title}</h2>";
        echo "<p>{$excerpt}</p>";
        echo "</div>";
