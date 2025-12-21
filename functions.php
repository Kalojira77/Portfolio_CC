<?php
// =====================================================
// Assets (Parent + Child styles)
// =====================================================
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'astra-parent',
        get_template_directory_uri() . '/style.css',
        [],
        filemtime(get_template_directory() . '/style.css')
    );

    wp_enqueue_style(
        'astra-child',
        get_stylesheet_directory_uri() . '/style.css',
        ['astra-parent'],
        filemtime(get_stylesheet_directory() . '/style.css')
    );
}, 20);

// =====================================================
// Theme setup (menus, logo, supports)
// =====================================================
add_action('after_setup_theme', function () {

    // Laisse WP gérer le <title> automatiquement
    add_theme_support('title-tag');

    // Images mises en avant (utile blog + futur portfolio)
    add_theme_support('post-thumbnails');

    // HTML5 propre pour certains éléments natifs
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Logo (Apparence > Personnaliser)
    add_theme_support('custom-logo', [
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // Menus (Apparence > Menus)
    register_nav_menus([
        'primary' => 'Menu principal',
        'footer'  => 'Menu footer',
        'legal'   => 'Menu légal',
    ]);
});

// =====================================================
// Sécurité / nettoyage (tes règles actuelles)
// =====================================================

// Sécurité : masquer la version WordPress
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

// Désactiver XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Nettoyage du head WordPress
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
