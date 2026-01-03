<?php

if ( ! defined( 'ABSPATH' ) ) exit;

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

/**
 * CPT Film
 */
function cecile_register_cpt_film() {

    $labels = array(
        'name'               => 'Films',
        'singular_name'      => 'Film',
        'menu_name'          => 'Films',
        'add_new_item'       => 'Ajouter un film',
        'edit_item'          => 'Modifier le film',
        'new_item'           => 'Nouveau film',
        'view_item'          => 'Voir le film',
        'search_items'       => 'Rechercher un film',
        'not_found'          => 'Aucun film trouvé',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => true,
        'show_in_rest'  => true,
        'menu_icon'     => 'dashicons-format-video',
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'films' ),
    );

    register_post_type( 'film', $args );
}
add_action( 'init', 'cecile_register_cpt_film' );



/**
 * Metabox — Informations film
 */
function cecile_film_add_meta_box() {
    add_meta_box(
        'cecile_film_details',
        'Informations film',
        'cecile_film_meta_box_callback',
        'film',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'cecile_film_add_meta_box' );


function cecile_film_meta_box_callback( $post ) {

    wp_nonce_field( 'cecile_film_save_meta', 'cecile_film_meta_nonce' );

    // Champs
    $fields = [
        'annee',
        'titre_original',
        'duree',
        'realisation',
        'scenario',
        'image',
        'son',
        'montage',
        'musique',
        'production',
        'coproduction',
        'diffuseur',
        'festivals',
        'prix',
        'vimeo_url'
    ];

    foreach ( $fields as $f ) {
        ${$f} = get_post_meta( $post->ID, "_cecile_film_$f", true );
    }
    ?>

    <p><label>Année</label><br>
    <input type="number" name="cecile_film_annee" value="<?php echo esc_attr($annee); ?>" style="width:100%"></p>

    <p><label>Titre original</label><br>
    <input type="text" name="cecile_film_titre_original" value="<?php echo esc_attr($titre_original); ?>" style="width:100%"></p>

    <p><label>Durée (minutes)</label><br>
    <input type="number" name="cecile_film_duree" value="<?php echo esc_attr($duree); ?>" style="width:100%"></p>

    <hr>

    <p><strong>Fiche technique</strong></p>

    <p><label>Réalisation</label><br>
    <input type="text" name="cecile_film_realisation" value="<?php echo esc_attr($realisation); ?>" style="width:100%"></p>

    <p><label>Scénario</label><br>
    <input type="text" name="cecile_film_scenario" value="<?php echo esc_attr($scenario); ?>" style="width:100%"></p>

    <p><label>Image</label><br>
    <input type="text" name="cecile_film_image" value="<?php echo esc_attr($image); ?>" style="width:100%"></p>

    <p><label>Son</label><br>
    <input type="text" name="cecile_film_son" value="<?php echo esc_attr($son); ?>" style="width:100%"></p>

    <p><label>Montage</label><br>
    <input type="text" name="cecile_film_montage" value="<?php echo esc_attr($montage); ?>" style="width:100%"></p>

    <p><label>Musique</label><br>
    <input type="text" name="cecile_film_musique" value="<?php echo esc_attr($musique); ?>" style="width:100%"></p>

    <p><label>Production</label><br>
    <input type="text" name="cecile_film_production" value="<?php echo esc_attr($production); ?>" style="width:100%"></p>

    <p><label>Coproduction</label><br>
    <input type="text" name="cecile_film_coproduction" value="<?php echo esc_attr($coproduction); ?>" style="width:100%"></p>

    <p><label>Diffuseur</label><br>
    <input type="text" name="cecile_film_diffuseur" value="<?php echo esc_attr($diffuseur); ?>" style="width:100%"></p>

    <hr>

    <p><label>Sélections / festivals</label><br>
    <textarea name="cecile_film_festivals" rows="3" style="width:100%"><?php echo esc_textarea($festivals); ?></textarea></p>

    <p><label>Prix</label><br>
    <textarea name="cecile_film_prix" rows="3" style="width:100%"><?php echo esc_textarea($prix); ?></textarea></p>

    <hr>

    <p><label>URL Vimeo (optionnel)</label><br>
    <input type="url" name="cecile_film_vimeo_url" value="<?php echo esc_attr($vimeo_url); ?>" style="width:100%" placeholder="https://vimeo.com/..."></p>

<?php
}



/**
 * Sauvegarde des métadonnées
 */
function cecile_film_save_meta( $post_id ) {

    if ( ! isset($_POST['cecile_film_meta_nonce']) ) return;
    if ( ! wp_verify_nonce($_POST['cecile_film_meta_nonce'], 'cecile_film_save_meta') ) return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
    if ( ! current_user_can('edit_post', $post_id) ) return;

    $map = [
        'annee'          => 'intval',
        'titre_original' => 'sanitize_text_field',
        'duree'          => 'intval',
        'realisation'    => 'sanitize_text_field',
        'scenario'       => 'sanitize_text_field',
        'image'          => 'sanitize_text_field',
        'son'            => 'sanitize_text_field',
        'montage'        => 'sanitize_text_field',
        'musique'        => 'sanitize_text_field',
        'production'     => 'sanitize_text_field',
        'coproduction'   => 'sanitize_text_field',
        'diffuseur'      => 'sanitize_text_field',
        'festivals'      => 'sanitize_textarea_field',
        'prix'           => 'sanitize_textarea_field',
        'vimeo_url'      => 'esc_url_raw',
    ];

    foreach ($map as $field => $callback) {
        $key = "cecile_film_$field";
        if ( isset($_POST[$key]) ) {
            $value = call_user_func($callback, $_POST[$key]);
            update_post_meta($post_id, "_cecile_film_$field", $value);
        }
    }
}
add_action( 'save_post', 'cecile_film_save_meta' );