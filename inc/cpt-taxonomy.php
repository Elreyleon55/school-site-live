<?php
//here is where we are putting the custom post types

function fwd_register_custom_post_types() {
  // registering students custom post type
  $labels = array(
      'name'               => _x( 'Students', 'post type general name' ),
      'singular_name'      => _x( 'Student', 'post type singular name'),
      'menu_name'          => _x( 'Students', 'admin menu' ),
      'name_admin_bar'     => _x( 'Student', 'add new on admin bar' ),
      'add_new'            => _x( 'Add New', 'Student' ),
      'add_new_item'       => __( 'Add New Student' ),
      'new_item'           => __( 'New Student' ),
      'edit_item'          => __( 'Edit Student' ),
      'view_item'          => __( 'View Student' ),
      'all_items'          => __( 'All Students' ),
      'search_items'       => __( 'Search Students' ),
      'parent_item_colon'  => __( 'Parent Students:' ),
      'not_found'          => __( 'No Students found.' ),
      'not_found_in_trash' => __( 'No Students found in Trash.' ),
      'archives'           => __( 'Student Archives'),
      'insert_into_item'   => __( 'Insert into Student'),
      'uploaded_to_this_item' => __( 'Uploaded to this Student'),
      'filter_item_list'   => __( 'Filter Students list'),
      'items_list_navigation' => __( 'Students list navigation'),
      'items_list'         => __( 'Students list'),
      'featured_image'     => __( 'Student featured image'),
      'set_featured_image' => __( 'Set Student featured image'),
      'remove_featured_image' => __( 'Remove Student featured image'),
      'use_featured_image' => __( 'Use as featured image'),
  );

  $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => true,
      'show_in_admin_bar'  => true,
      'show_in_rest'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'students' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 5,
      'menu_icon'          => 'dashicons-archive',
      'supports'           => array( 'title', 'thumbnail', 'editor' ),
  );
  register_post_type( 'sch-student', $args );

  //regesting staff custom post types

  $labels = array(
      'name'               => _x( 'Staffs', 'post type general name' ),
      'singular_name'      => _x( 'Staff', 'post type singular name'),
      'menu_name'          => _x( 'Staffs', 'admin menu' ),
      'name_admin_bar'     => _x( 'Staff', 'add new on admin bar' ),
      'add_new'            => _x( 'Add New', 'Staff' ),
      'add_new_item'       => __( 'Add New Staff' ),
      'new_item'           => __( 'New Staff' ),
      'edit_item'          => __( 'Edit Staff' ),
      'view_item'          => __( 'View Staff' ),
      'all_items'          => __( 'All Staffs' ),
      'search_items'       => __( 'Search Staffs' ),
      'parent_item_colon'  => __( 'Parent Staffs:' ),
      'not_found'          => __( 'No Staffs found.' ),
      'not_found_in_trash' => __( 'No Staffs found in Trash.' ),
      'archives'           => __( 'Staff Archives'),
      'insert_into_item'   => __( 'Insert into Staff'),
      'uploaded_to_this_item' => __( 'Uploaded to this Staff'),
      'filter_item_list'   => __( 'Filter Staffs list'),
      'items_list_navigation' => __( 'Staffs list navigation'),
      'items_list'         => __( 'Staffs list'),
      'featured_image'     => __( 'Staff featured image'),
      'set_featured_image' => __( 'Set Staff featured image'),
      'remove_featured_image' => __( 'Remove Staff featured image'),
      'use_featured_image' => __( 'Use as featured image'),
  );

  $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'show_in_nav_menus'  => true,
      'show_in_admin_bar'  => true,
      'show_in_rest'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'staffs' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 5,
      'menu_icon'          => 'dashicons-archive',
      'supports'           => array( 'title'),
  );
  register_post_type( 'sch-staff', $args );
  
}
add_action( 'init', 'fwd_register_custom_post_types' );

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
      'hierarchical'      => true, // دسته‌بندی‌ها به صورت سلسله‌مراتبی (مثل دسته‌بندی و زیرمجموعه)
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'staff-category' ),
  );

  register_taxonomy( 'staff_category', array( 'sch-staff' ), $args );

  // اضافه کردن ترم‌ها (Faculty و Administrative)
  if (!term_exists('Faculty', 'staff_category')) {
      wp_insert_term('Faculty', 'staff_category');
  }
  if (!term_exists('Administrative', 'staff_category')) {
      wp_insert_term('Administrative', 'staff_category');
  }
}
add_action( 'init', 'create_staff_taxonomy' );


// here is where I will register cutom taxonomies

function fwd_register_taxonomies() {
  // Add Work Category taxonomy
  $labels = array(
      'name'              => _x( 'Student Categories', 'taxonomy general name' ),
      'singular_name'     => _x( 'Student Category', 'taxonomy singular name' ),
      'search_items'      => __( 'Search Student Categories' ),
      'all_items'         => __( 'All Student Category' ),
      'parent_item'       => __( 'Parent Student Category' ),
      'parent_item_colon' => __( 'Parent Student Category:' ),
      'edit_item'         => __( 'Edit Student Category' ),
      'view_item'         => __( 'Vview Student Category' ),
      'update_item'       => __( 'Update Student Category' ),
      'add_new_item'      => __( 'Add New Student Category' ),
      'new_item_name'     => __( 'New Student Category Name' ),
      'menu_name'         => __( 'Student Category' ),
  );

  $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_in_menu'      => true,
      'show_in_nav_menu'  => true,
      'show_in_rest'      => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'student-categories' ),
  );
  register_taxonomy( 'sch-student-category', array( 'sch-student' ), $args );

  // Labels for the taxonomy
  $labels = array(
    'name'              => _x( 'Staff Types', 'taxonomy general name' ),
    'singular_name'     => _x( 'Staff Type', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Staff Types' ),
    'all_items'         => __( 'All Staff Types' ),
    'parent_item'       => __( 'Parent Staff Type' ),
    'parent_item_colon' => __( 'Parent Staff Type:' ),
    'edit_item'         => __( 'Edit Staff Type' ),
    'update_item'       => __( 'Update Staff Type' ),
    'add_new_item'      => __( 'Add New Staff Type' ),
    'new_item_name'     => __( 'New Staff Type Name' ),
    'menu_name'         => __( 'Staff Type' ),
  );

  $args = array(
          'hierarchical'      => true,  // Set to false for non-hierarchical (like tags)
          'labels'            => $labels,
          'show_ui'           => true,
          'show_admin_column' => true,
          'query_var'         => true,
          'rewrite'           => array( 'slug' => 'staff-type' ),
  );

register_taxonomy( 'sch-staff-type', array( 'sch-staff' ), $args );


}
add_action( 'init', 'fwd_register_taxonomies');



