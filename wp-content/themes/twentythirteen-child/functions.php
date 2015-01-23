<?php

$homepage_post_id = '63';
$about_post_id = '67';

// Prevent editors from deleting pages
// **** We only have to run this once ****
// $role = get_role('editor');
// $role->add_cap('delete_pages');
// $role->add_cap('delete_others_pages');
// $role->add_cap('delete_published_pages');

// Remove post formats support
add_action('after_setup_theme', 'remove_post_formats', 11);
function remove_post_formats() {
    remove_theme_support('post-formats');
}

// Change CMS menu
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

    // Rename "Posts" to "Our work"
    $menu[5][0] = 'Our work';
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
    add_action('init', 'unregister_taxonomies');
    function unregister_taxonomies() {
        global $homepage_post_id;

        // Disable categories and tags
        register_taxonomy('category', array());
        register_taxonomy('post_tag', array());

        // Remove content textarea for the homepage
        if (isset($_GET['post']) && $_GET['post'] == $homepage_post_id) {
            remove_post_type_support('page', 'editor');
        }

        // Remove content textarea on the whole "Our work" section
        remove_post_type_support('post', 'editor');
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
        global $pagenow, $_wp_theme_features, $homepage_post_id;

        if (in_array($pagenow, array('post.php', 'post-new.php'))) {
            unset($_wp_theme_features['post-thumbnails']);
        }

        if (isset($_GET['post']) && $_GET['post'] == $homepage_post_id) {
            remove_meta_box('simple_fields_connector_5', 'page', 'normal');
        }
    }

    add_action('admin_head', 'custom_admin_styles');
    function custom_admin_styles() {
        global $homepage_post_id, $about_post_id;

        if (!isset($_GET['post']) || $_GET['post'] != $homepage_post_id) {
            // Only show slideshow fields when editing the homepage
            echo '<style>
                #simple_fields_connector_5 { display:none; }
            </style>';
        }

        if (!isset($_GET['post']) || $_GET['post'] != $about_post_id) {
            // Only show clients fields when editing the about page
            echo '<style>
                #simple_fields_connector_6 { display:none; }
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
