<?php

use Timber\Timber;

function mytheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
}

function mytheme_enqueue_scripts()
{
    wp_enqueue_style('style', get_stylesheet_uri());
}

function mytheme_init()
{
    register_post_type('product', [
        'label' => 'Product',
        'labels' => [
            'name' => 'Produits',
            'singular_name' => 'Produit',
            'add_new' => 'Ajouter un produit',
            'add_new_item' => 'Ajouter un produit',
            'new_item' => 'Nouveau produit',
            'edit_item' => 'Modifier le produit',
            'view_item' => 'Voir le produit',
            'view_items' => 'Voir les produits',
            'all_items' => 'Tous les produits',
            'archives' => 'Liste des produits',
            'item_published' => 'Produit publié',
            'item_published_privately' => 'Produit publié en mode privé',
            'item_reverted_to_draft' => 'Produit basculé en mode brouillon',
            'item_trashed' => 'Produit mis à la corbeille',
            'item_scheduled' => 'Produit planifié pour une publication',
            'item_updated' => 'Produit mis à jour',
            'item_link' => 'Lien du produit'
        ],
        'public' => true,
        'supports' => ['title', 'thumbnail']
    ]);

    register_taxonomy('brand', 'product', [
        'public' => true,
        'show_admin_column' => true,
        'meta_box_cb' => false,
        'show_in_quick_edit' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'query_var' => true,
        'labels' => [
            'name' => 'Marques',
            'singular_name' => 'Marque',
            'add_new_item' => 'Ajouter une marque',
            'new_item_name' => 'Nouveau nom de marque',
        ]
    ]);

    register_taxonomy('product-category', 'product', [
        'public' => true,
        'show_admin_column' => true,
        'show_in_quick_edit' => true,
        'hierarchical' => true,
        'meta_box_cb' => false,
        'labels' => [
            'name' => 'Catégories',
            'singular_name' => 'Catégorie',
            'add_new_item' => 'Ajouter une catégorie de produits',
            'new_item_name' => 'Nouvelle catégorie de produits',
        ]
    ]);
}

function mytheme_register_menus()
{
    register_nav_menu('navbar-menu', 'Navigation principale (header)');
    register_nav_menu('navbar-products-submenu', 'Sous-menu navigation principale (header)');
}

function mytheme_add_to_context($context)
{
    $context['main_pages_menu'] = Timber::get_menu('Pages principales');
    $context['product_categories_menu'] = Timber::get_menu('Navigation catégories de produits');
    return $context;
}

function mytheme_remove_dashboard_widgets()
{
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
}

add_action('init', 'mytheme_init');
add_action('wp_dashboard_setup', 'mytheme_remove_dashboard_widgets');
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');
add_action('after_setup_theme', 'mytheme_supports');
add_action('after_setup_theme', 'mytheme_register_menus');
add_filter('timber/context', 'mytheme_add_to_context');
