<?php
function enqueue_theme_assets() {
    wp_enqueue_style('styles', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_template_directory() . '/css/style.css'));
    wp_enqueue_script('menuScripts', get_template_directory_uri() . '/js/menuScripts.js', [], null, true);

    if (is_singular('gallery')) {
        wp_enqueue_script('img-gallery', get_template_directory_uri() . '/js/imgGallery.js', array(), filemtime(get_template_directory() . '/js/imgGallery.js'), true);
    }

    if (is_category() || is_page('category')) {
        wp_enqueue_script('category-filter', get_template_directory_uri() . '/js/categoryFilter.js', array(), filemtime(get_template_directory() . '/js/categoryFilter.js'), true);
    }

}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');