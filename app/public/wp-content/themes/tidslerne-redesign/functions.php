<?php
function enqueue_theme_assets() {
    wp_enqueue_style('styles', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_template_directory() . '/css/style.css'));

    if (is_singular('gallery')) {
        wp_enqueue_script('img-gallery', get_template_directory_uri() . '/js/imgGallery.js', array(), filemtime(get_template_directory() . '/js/imgGallery.js'), true);
    }

}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');