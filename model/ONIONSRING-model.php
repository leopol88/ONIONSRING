
<?php
/*
add_action('init', function () {

    // CPT : Arme
    register_post_type('arme', [
        'labels' => [
            'name' => 'Armes',
            'singular_name' => 'Arme',
            'menu_name' => 'Armes',
            'all_items' => 'Toutes les armes',
            'add_new' => 'Ajouter une arme',
            'add_new_item' => 'Ajouter une nouvelle arme',
            'edit_item' => 'Modifier l\'arme',
            'new_item' => 'Nouvelle arme',
            'view_item' => 'Voir l\'arme',
            'search_items' => 'Rechercher une arme',
            'not_found' => 'Aucune arme trouvée',
            'not_found_in_trash' => 'Aucune arme dans la corbeille',
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_position' => 5,
        'menu_icon' => 'dashicons-hammer',
        'rewrite' => ['slug' => 'armes'],
    ]);

    // CPT : Boss
    register_post_type('boss', [
        'labels' => [
            'name' => 'Boss',
            'singular_name' => 'Boss',
            'menu_name' => 'Boss',
            'all_items' => 'Tous les boss',
            'add_new' => 'Ajouter un boss',
            'add_new_item' => 'Ajouter un nouveau boss',
            'edit_item' => 'Modifier le boss',
            'new_item' => 'Nouveau boss',
            'view_item' => 'Voir le boss',
            'search_items' => 'Rechercher un boss',
            'not_found' => 'Aucun boss trouvé',
            'not_found_in_trash' => 'Aucun boss dans la corbeille',
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_position' => 6,
        'menu_icon' => 'dashicons-drums',
        'rewrite' => ['slug' => 'boss'],
    ]);

    // Taxonomie pour Arme
    register_taxonomy('type_arme', ['arme'], [
        'labels' => [
            'name' => 'Types d\'arme',
            'singular_name' => 'Type d\'arme',
            'search_items' => 'Rechercher un type',
            'all_items' => 'Tous les types',
            'edit_item' => 'Modifier le type',
            'add_new_item' => 'Ajouter un type',
            'menu_name' => 'Types d\'arme',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'public' => true,
    ]);

    // Taxonomie pour Boss
    register_taxonomy('categorie_boss', ['boss'], [
        'labels' => [
            'name' => 'Catégories de boss',
            'singular_name' => 'Catégorie de boss',
            'search_items' => 'Rechercher une catégorie',
            'all_items' => 'Toutes les catégories',
            'edit_item' => 'Modifier la catégorie',
            'add_new_item' => 'Ajouter une catégorie',
            'menu_name' => 'Catégories de boss',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'public' => true,
    ]);
});
*/
add_action('init', function () {

    // CPT : Arme
    register_post_type('arme', [
        'labels' => [
            'name' => 'Armes',
            'singular_name' => 'Arme',
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_position' => 5,
        'menu_icon' => 'dashicons-hammer',
        'rewrite' => ['slug' => 'armes'],
    ]);

    // CPT : Boss
    register_post_type('boss', [
        'labels' => [
            'name' => 'Boss',
            'singular_name' => 'Boss',
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_position' => 6,
        'menu_icon' => 'dashicons-drums',
        'rewrite' => ['slug' => 'boss'],
    ]);

    // Taxonomie : Type d'Arme
    register_taxonomy('type_arme', ['arme'], [
        'labels' => [
            'name' => 'Types d\'arme',
            'singular_name' => 'Type d\'arme',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'public' => true,
    ]);

    // Taxonomie : Catégorie de Boss
    register_taxonomy('categorie_boss', ['boss'], [
        'labels' => [
            'name' => 'Catégories de boss',
            'singular_name' => 'Catégorie de boss',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'public' => true,
    ]);
});


?>

