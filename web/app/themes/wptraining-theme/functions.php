<?php

use Timber\Timber;

function mytheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
}

function mytheme_init()
{
    register_post_type('product', [
        'label' => 'Product',
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail']
    ]);
}

function mytheme_register_menus()
{
    register_nav_menu('navbar-menu', 'Menu principal (header)');
}

function mytheme_add_to_context($context)
{
    $context['navbar_menu'] = Timber::get_menu('navbar-menu');
    return $context;
}

add_action('init', 'mytheme_init');
add_action('after_setup_theme', 'mytheme_supports');
add_action('after_setup_theme', 'mytheme_register_menus');
add_filter('timber/context', 'mytheme_add_to_context');
