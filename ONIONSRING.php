<?php
/*
 * Plugin Name: ONIONS RING
 */
/* 
 if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
}

 // Stop if ACF PRO is active
 if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
    return;
 }

 // Define ACF path constants if not already defined
 if ( ! defined( 'MY_ACF_PATH' ) ) {
    define( 'MY_ACF_PATH', __DIR__ . '/vendor/acf/' );
    define( 'MY_ACF_URL', plugin_dir_url( __FILE__ ) . 'vendor/acf/' );
}

// Include ACF plugin
include_once( MY_ACF_PATH . 'acf.php' );

// Fix asset URLs
add_filter('acf/settings/url', function( $url ) {
    return MY_ACF_URL;
});

// Check if free ACF is active
if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {

    // Admin notice
    add_action( 'admin_notices', function () {
        ?>
        <div class="updated" style="border-left: 4px solid #ffba00; padding: 10px;">
            <p>The ACF plugin has been deactivated because this plugin includes its own ACF version. Please keep ACF installed to retain your data.</p>
        </div>
        <?php
    }, 99 );

    // Deactivate free ACF plugin
    deactivate_plugins( 'advanced-custom-fields/acf.php' );
}

// Load main plugin model
include_once(__DIR__ . "/model/ONIONSRING-model.php");
?>

*/
function sections_endpoint($request_data) {
    $args = array(
        'post_type'      => 'boss',
        'posts_per_page' => -1,
        'numberposts'    => -1,
    );

    $posts = get_posts($args);
    $data = array();

    foreach ($posts as $post) {
        $data_post = array();
        $data_post['post_title'] = $post->post_title;
        $data_fields = get_fields($post->ID);

        if (!empty($data_fields['image_boss']['url'])) {
            // Utiliser l'URL complète
            $data_post['image_boss'] = $data_fields['image_boss']['url'];
        } else {
            $data_post['image_boss'] = null;
        }

        $data_post['pv_boss'] = isset($data_fields['pv_boss']) ? $data_fields['pv_boss'] : null;
        $data_post['faiblesses'] = isset($data_fields['faiblesses']) ? $data_fields['faiblesses'] : null;
        $data_post['resistance'] = isset($data_fields['resistance']) ? $data_fields['resistance'] : null;
        $data_post['lore'] = isset($data_fields['lore']) ? $data_fields['lore'] : null;
        $data_post['categorie_boss'] = isset($data_fields['categorie_boss']) ? $data_fields['categorie_boss'] : null;

        $data[] = $data_post;
    }

    return $data;
}

add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/boss', array(
        'methods'  => 'GET',
        'callback' => 'sections_endpoint',
    ));
});

function armes_endpoint($request_data) {
    $args = array(
        'post_type'      => 'arme',
        'posts_per_page' => -1,
        'numberposts'    => -1,
    );

    $posts = get_posts($args);
    $data = array();

    foreach ($posts as $post) {
        $data_post = array();
        $data_post['post_title'] = $post->post_title;
        $data_fields = get_fields($post->ID);

        if (!empty($data_fields['image_arme']['url'])) {
            $data_post['image_arme'] = $data_fields['image_arme']['url']; // URL complète ici
        } else {
            $data_post['image_arme'] = null;
        }

        $data_post['degats_physiques'] = isset($data_fields['degats_physiques']) ? $data_fields['degats_physiques'] : null;
        $data_post['degats_feu'] = isset($data_fields['degats_feu']) ? $data_fields['degats_feu'] : null;
        $data_post['degats_foudre'] = isset($data_fields['degats_foudre']) ? $data_fields['degats_foudre'] : null;
        $data_post['degats_foi'] = isset($data_fields['degats_foi']) ? $data_fields['degats_foi'] : null;
        $data_post['critique'] = isset($data_fields['critique']) ? $data_fields['critique'] : null;

        $data_post['type_arme'] = isset($data_fields['type_arme']) ? $data_fields['type_arme'] : null;
        $data_post['lore_arme'] = isset($data_fields['lore_arme']) ? $data_fields['lore_arme'] : null;
        $data[] = $data_post;
    }

    return $data;
}

add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/armes', array(
        'methods'  => 'GET',
        'callback' => 'armes_endpoint',
    ));
});




if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
}

// Si ACF PRO est déjà actif, ne rien faire
if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
    return;
}

// Définir le chemin local de ACF s’il n’est pas encore défini
if ( ! defined( 'MY_ACF_PATH' ) ) {
    define( 'MY_ACF_PATH', __DIR__ . '/vendor/acf/' );
    define( 'MY_ACF_URL', plugin_dir_url( __FILE__ ) . 'vendor/acf/' );
}

// Inclure ACF embarqué
include_once( MY_ACF_PATH . 'acf.php' );

// Corriger les URLs des assets ACF (CSS/JS)
add_filter('acf/settings/url', function( $url ) {
    return MY_ACF_URL;
});

// Si ACF Free est activé, le désactiver
if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {

    add_action( 'admin_notices', function () {
        echo '<div class="updated" style="border-left: 4px solid #ffba00; padding: 10px;">
                <p>Le plugin ACF a été désactivé car ce plugin inclut sa propre version. Gardez ACF installé pour ne pas perdre vos données.</p>
              </div>';
    }, 99 );

    deactivate_plugins( 'advanced-custom-fields/acf.php' );
}

// Charger le modèle de contenu principal (CPT, taxo)
include_once(__DIR__ . "/model/ONIONSRING-model.php");

?>