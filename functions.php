<?php
/**
 * Theme Functions
 *
 * @package TailwindTheme
 */

if (!defined('ABSPATH')) exit;

function tailwind_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'tailwind-theme'),
        'footer' => __('Footer Menu', 'tailwind-theme'),
    ));
}
add_action('after_setup_theme', 'tailwind_theme_setup');

function tailwind_theme_scripts() {
    // Enqueue compiled CSS
    wp_enqueue_style('tailwind-theme-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_style('tailwind-theme-plugins', get_template_directory_uri() . '/assets/css/plugins.css', array(), '1.0.0');
    
    // Enqueue compiled JavaScript
    wp_enqueue_script('tailwind-theme-plugins', get_template_directory_uri() . '/assets/js/plugins.js', array(), '1.0.0', true);
    wp_enqueue_script('tailwind-theme-script', get_template_directory_uri() . '/assets/js/all.js', array('tailwind-theme-plugins'), '1.0.0', true);
    
    // Localize script for AJAX
    wp_localize_script('tailwind-theme-script', 'theme_ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('theme_nonce')
    ));
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'tailwind_theme_scripts');

// Widget areas
function tailwind_theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'tailwind-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'tailwind-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'tailwind_theme_widgets_init');

// Custom image sizes
add_image_size('custom-large', 1200, 800, true);
add_image_size('custom-medium', 800, 600, true);
add_image_size('custom-small', 400, 300, true);

// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Clean up wp_head
function tailwind_theme_head_cleanup() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'tailwind_theme_head_cleanup');