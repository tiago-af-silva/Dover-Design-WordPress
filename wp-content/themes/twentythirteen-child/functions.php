<?php

// Prevent editors from deleting pages
// **** We only have to run this once ****
// $role = get_role('editor');
// $role->add_cap('delete_pages');
// $role->add_cap('delete_others_pages');
// $role->add_cap('delete_published_pages');

// Get post IDs of a few pages
function get_post_id_for($slug) {
    $post_ids = array(
        'home'  => '63',
        'about' => '67',
        'work' => '70',
        'team' => '80',
    );

    return (array_key_exists($slug, $post_ids) ? $post_ids[$slug] : null);
}

// Remove post formats support
add_action('after_setup_theme', 'remove_post_formats', 11);
function remove_post_formats() {
    remove_theme_support('post-formats');
}

// Brand Experience post type
add_action('init', 'create_posttype');
function create_posttype() {
    register_post_type('brand_experience', array(
        'labels' => array(
            'name' => __('Posts'),
            'singular_name' => __('Post'),
            'all_items' => __('All Posts'),
        ),
        'public' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'rewrite' => array('slug' => 'brand-experience', 'with_front' => true),
        'query_var' => false,
        'delete_with_user' => true,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats'),
    ));

    register_taxonomy_for_object_type('category', 'brand_experience');
    register_taxonomy_for_object_type('post_tag', 'brand_experience');
}

// Show Brand Experience projects on the "Our work" page
add_action('pre_get_posts', 'work_search_filter');
function work_search_filter($query) {
    global $wp_query;

    if ($query->is_main_query() && $wp_query->queried_object_id == get_post_id_for('work')) {
        $query->set('post_type', array('post', 'brand_experience'));
        $query->set('orderby', 'post_date');
        $query->set('order', 'DESC');
    }
}

// Modify CMS menu
add_action('admin_menu', 'rewrite_menu_items');
function rewrite_menu_items() {
    global $menu;
    
    if (!current_user_can('manage_options')) {
        // Hide dashboard
        remove_menu_page('index.php');

        // Remove separator after dashboard
        unset($menu[4]);

        // Hide comments
        remove_menu_page('edit-comments.php');

        // Remove more menu links
        remove_menu_page('upload.php');
        remove_menu_page('link-manager.php');
        remove_menu_page('themes.php');
        remove_menu_page('plugins.php');
    }

    // Move menu items
    $menu[6] = $menu[26];
    unset($menu[26]);

    // Rename menu items
    $menu[5][0] = 'Interior Design';
    $menu[6][0] = 'Brand Experience';

    // Add separators
    $menu[7] = array('', 'read', 'separator1', '', 'wp-menu-separator');
}

// Redirect to "Our work" after logging in
add_filter('login_redirect', 'redirect_after_login', 10, 3);
function redirect_after_login($redirect_to, $request, $user) {
    global $user;

    if (isset($user->roles) && is_array($user->roles)) {
        // Check for admins
        if (in_array('administrator', $user->roles)) {
            return $redirect_to;
        } else {
            return home_url().'/wp-admin/edit.php';
        }
    } else {
        return $redirect_to;
    }
}

// Modify menu locations
add_action('after_setup_theme', 'register_my_menu', 20);
function register_my_menu() {
    unregister_nav_menu('primary');
    
    register_nav_menu('header', __('Header', 'twentythirteen'));
    register_nav_menu('footer', __('Footer', 'twentythirteen'));
}

if (!current_user_can('manage_options')) {
    // Hide a few things
    add_action('init', 'unregister_taxonomies');
    function unregister_taxonomies() {
        // Disable categories and tags
        register_taxonomy('category', array());
        register_taxonomy('post_tag', array());

        // Remove content textarea for all pages
        if (isset($_GET['post']) && get_post_type($_GET['post']) == 'page') {
            remove_post_type_support('page', 'editor');
        }

        // Remove content textarea on the projects section
        remove_post_type_support('post', 'editor');
        remove_post_type_support('brand_experience', 'editor');
    }

    // Customise admin bar
    add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');
    function remove_admin_bar_links() {
        global $wp_admin_bar;

        // Remove dashboard under site title
        $wp_admin_bar->remove_node('dashboard');

        // Modify site title link to go to the "Our work" section
        $site_name = (array) $wp_admin_bar->get_node('site-name');
        $site_name['href'] = admin_url('edit.php');
        $wp_admin_bar->add_node($site_name);
    }

    // Don't show "Our work" page in the admin area
    add_filter('parse_query', 'exclude_pages_from_admin');
    function exclude_pages_from_admin($query) {
        global $pagenow, $post_type;

        if ($pagenow == 'edit.php' && $post_type == 'page') {
            $query->query_vars['post__not_in'] = array('70');
        }
    }

    // Hide Featured Image meta box for posts and pages
    add_action('admin_menu' , 'remove_post_thumb_meta_box');
    function remove_post_thumb_meta_box() {
        global $pagenow, $_wp_theme_features;

        if (in_array($pagenow, array('post.php', 'post-new.php'))) {
            unset($_wp_theme_features['post-thumbnails']);
        }

        if (isset($_GET['post']) && $_GET['post'] == get_post_id_for('home')) {
            remove_meta_box('simple_fields_connector_5', 'page', 'normal');
        }
    }

    add_action('admin_head', 'custom_admin_styles');
    function custom_admin_styles() {
        // Only show slideshow fields when editing the homepage
        if (!isset($_GET['post']) || $_GET['post'] != get_post_id_for('home')) {
            echo '<style>
                #simple_fields_connector_5 { display:none; }
            </style>';
        }

        // Only show clients fields when editing the about page
        if (!isset($_GET['post']) || $_GET['post'] != get_post_id_for('about')) {
            echo '<style>
                #simple_fields_connector_6 { display:none; }
            </style>';
        }

        // Only show clients fields when editing the about page
        if (!isset($_GET['post']) || $_GET['post'] != get_post_id_for('team')) {
            echo '<style>
                #simple_fields_connector_15 { display:none; }
            </style>';
        }
    }

    // Hide Simple Fields meta box
    add_filter('simple_fields_add_post_edit_side_field_settings', 'remove_simple_fields_meta_box', 10, 2);
    function remove_simple_fields_meta_box($bool_add, $post) {
        return false;
    }

    // Hide more meta boxes
    add_action('add_meta_boxes', 'remove_post_meta_boxes');
    function remove_post_meta_boxes() {
        remove_meta_box('pageparentdiv', 'page', 'side');
    }
}
