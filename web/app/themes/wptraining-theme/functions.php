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
        'labels' => [
            'name' => 'Produits',
            'singular_name' => 'Produit',
            'add_new' => 'Ajouter un produit',
            'add_new_item' => 'Ajouter un produit'
        ],
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail']
    ]);

    register_taxonomy('brand', 'product', [
        'public' => true,
        'show_admin_column' => true,
        'show_in_quick_edit' => true,
        'meta_box_cb' => false,
        'hierarchical' => true,
        'labels' => [
            'name' => 'Marques',
            'singular_name' => 'Marque',
            'search_items' => 'Chercher des marques',
            'popular_items' => 'Marques populaires',
            'all_items' => 'Toutes les marques',
            'edit_item' => 'Éditer la marque',
            'view_item' => 'Voir la marque',
            'update_item' => 'Mettre à jour la marque',
            'add_new_item' => 'Ajouter une marque',
            'new_item_name' => 'Nouveau nom de marque',
            'separate_items_with_commas' => 'Séparez les marques avec des virgules',
            'choose_from_most_used' => 'Choisissez parmi les plus utilisées',
            'not_found' => 'Aucune marque trouvée.',
        ]
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
