<?php

use Timber\Timber;

function mytheme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
}

function mytheme_enqueue_assets()
{
    wp_register_script('navbar', get_template_directory_uri() . '/assets/js/navbar.js', [], null, [
        'strategy' => 'defer'
    ]);

    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('navbar');

    $translation_array = ['templateUrl' => get_stylesheet_directory_uri()];
    wp_localize_script('navbar', 'navbar_script', $translation_array);
}

function add_defer_attribute($tag, $handle)
{
    if ('navbar' !== $handle)
        return $tag;
    return str_replace(' src', ' defer src', $tag);
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
    register_nav_menu('navbar-products-submenu', 'Sous-menu navigation principale (header) - partie gauche');
    register_nav_menu('navbar-brands-submenu', 'Sous-menu navigation principale (header) - partie droite');
}

function mytheme_add_to_context($context)
{
    $context['main_pages_menu'] = Timber::get_menu('navbar-menu');
    $categories = Timber::get_menu('navbar-products-submenu');
    foreach ($categories->items as $item) {
        $image_id = get_term_meta($item->object_id, 'image_pour_categorie_de_produits', true);
        $item->image_src = $image_id ? wp_get_attachment_image_src($image_id, 'original')[0] : "";
    }
    $context['product_categories_menu'] = $categories;
    $context['brands_menu'] = Timber::get_menu('navbar-brands-submenu');
    return $context;
}

function mytheme_remove_dashboard_widgets()
{
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
}

function mytheme_add_file_types_to_upload($filetypes)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $filetypes = array_merge($filetypes, $new_filetypes);
    return $filetypes;
}

add_action('init', 'mytheme_init');
add_action('wp_dashboard_setup', 'mytheme_remove_dashboard_widgets');
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');
add_action('after_setup_theme', 'mytheme_supports');
add_action('after_setup_theme', 'mytheme_register_menus');

add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
add_filter('timber/context', 'mytheme_add_to_context');
add_filter('upload_mimes', 'mytheme_add_file_types_to_upload');
// add_filter('show_admin_bar', '__return_false');
