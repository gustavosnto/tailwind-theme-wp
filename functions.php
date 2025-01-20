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
    wp_enqueue_style('tailwind-theme-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
    wp_enqueue_script('tailwind-theme-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'tailwind_theme_scripts');