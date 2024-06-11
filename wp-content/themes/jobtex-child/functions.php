<?php

function jobtex_child_enqueue_styles() {
	wp_enqueue_style( 'jobtex-child-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'jobtex_child_enqueue_styles', 200 );




// Ensure shortcodes are executed in nav menu items
add_filter('wp_nav_menu_items', 'do_shortcode');

// Define the shortcode to generate the dynamic URL
add_shortcode('somePrefix_author_url', function() { 
    // Get the author's posts URL
    $author_link = get_author_posts_url(get_current_user_id());

    // Replace the 'author' segment with 'condidate'
    $condidate_link = str_replace('/author/', '/condidate/', $author_link);

    // Return the modified URL without protocol
    $without_protocol = trim(str_replace(array('http://', 'https://'), '', $condidate_link), '/');
    return $without_protocol;
});