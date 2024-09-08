<?php
// Registering Custom Taxonomy for Staff
function create_staff_taxonomy() {
    $labels = array(
        'name'              => _x( 'Staff Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Staff Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Staff Categories' ),
        'all_items'         => __( 'All Staff Categories' ),
        'parent_item'       => __( 'Parent Staff Category' ),
        'parent_item_colon' => __( 'Parent Staff Category:' ),
        'edit_item'         => __( 'Edit Staff Category' ),
        'update_item'       => __( 'Update Staff Category' ),
        'add_new_item'      => __( 'Add New Staff Category' ),
        'new_item_name'     => __( 'New Staff Category Name' ),
        'menu_name'         => __( 'Staff Categories' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'staff-category' ),
    );

    register_taxonomy( 'staff_category', array( 'sch-staff' ), $args );

    if (!term_exists('Faculty', 'staff_category')) {
        wp_insert_term('Faculty', 'staff_category');
    }
    if (!term_exists('Administrative', 'staff_category')) {
        wp_insert_term('Administrative', 'staff_category');
    }
}
add_action( 'init', 'create_staff_taxonomy' );
