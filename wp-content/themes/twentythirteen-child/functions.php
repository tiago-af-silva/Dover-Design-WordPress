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
        'alchemy' => '1181',
        'news' => '1213',
    );

    return (array_key_exists($slug, $post_ids) ? $post_ids[$slug] : null);
}

// Super admin account ID
// This is the only user account with access to everything in the CMS
$superadmin_id = 3;

// Get current user object
$current_user = wp_get_current_user();

// Remove post formats support
add_action('after_setup_theme', 'remove_post_formats', 11);
function remove_post_formats() {
    remove_theme_support('post-formats');
}

// Custom post types
add_action('init', 'create_posttype');
function create_posttype() {
    // Branding
    register_post_type('brand_experience', array(
        'labels' => array(
            'name' => __('Posts'),
            'singular_name' => __('Post'),
            'all_items' => __('All Posts'),
        ),
        'public' => true,
        'menu_position' => 6,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'rewrite' => array('slug' => 'branding', 'with_front' => true),
        'query_var' => false,
        'delete_with_user' => true,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats'),
    ));

    register_taxonomy_for_object_type('category', 'brand_experience');
    register_taxonomy_for_object_type('post_tag', 'brand_experience');

    // Visuals
    register_post_type('visuals', array(
        'labels' => array(
            'name' => __('Posts'),
            'singular_name' => __('Post'),
            'all_items' => __('All Posts'),
        ),
        'public' => true,
        'menu_position' => 7,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'rewrite' => array('slug' => 'visuals', 'with_front' => true),
        'query_var' => false,
        'delete_with_user' => true,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'post-formats'),
    ));

    register_taxonomy_for_object_type('category', 'visuals');
    register_taxonomy_for_object_type('post_tag', 'visuals');

    // Newsletter post type - used by Zapier
    register_post_type('newsletter', array(
        'labels' => array(
            'name' => __('Posts'),
            'singular_name' => __('Post'),
            'all_items' => __('All Posts'),
        ),
        'public' => false,
        'menu_position' => 9,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'query_var' => false,
        'delete_with_user' => false,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'revisions'),
    ));
}

// Show custom type posts on the "Our work" page
add_action('pre_get_posts', 'work_search_filter');
function work_search_filter($query) {
    global $wp_query;

    if ($query->is_main_query() && $wp_query->queried_object_id == get_post_id_for('work')) {
        $query->set('post_type', array('post', 'brand_experience', 'visuals'));
        $query->set('orderby', 'post_date');
        $query->set('order', 'DESC');
    }
}

// Modify CMS menu
add_action('admin_menu', 'rewrite_menu_items');
function rewrite_menu_items() {
    global $menu;

    if ($current_user->ID != $superadmin_id) {
        // Hide dashboard
        remove_menu_page('index.php');

        // Remove separator after dashboard
        // unset($menu[4]);

        // Hide comments
        remove_menu_page('edit-comments.php');

        // Remove more menu links
        remove_menu_page('upload.php');
        remove_menu_page('link-manager.php');
        remove_menu_page('themes.php');
        remove_menu_page('plugins.php');
    }

    // Rename custom post menu items
    $menu[5][0] = 'Interior Design';
    $menu[6][0] = 'Branding';
    $menu[7][0] = 'Visuals';
    $menu[8] = array('', 'read', 'separator1', '', 'wp-menu-separator');
    $menu[9][0] = 'News';

    // Add another separator
    $menu[11] = $menu[10]; // Move "Media" one index down before
    $menu[10] = array('', 'read', 'separator1', '', 'wp-menu-separator');
}

// Tweak TinyMCE buttons
add_filter('tiny_mce_before_init', 'custom_tiny_mce_init');
function custom_tiny_mce_init($init) {
    $init['forced_root_block'] = false;
    // $init['toolbar2'] = 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv';
    $init['toolbar1'] = 'bold,italic,strikethrough,link,unlink';
    // $init['toolbar2'] = 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help';
    $init['toolbar2'] = '';
    return $init;
}
add_filter('quicktags_settings', 'custom_quicktags_settings');
function custom_quicktags_settings($init) {
    // $init['buttons'] = 'strong,em,link,block,del,ins,img,ul,ol,li,code,more,close';
    $init['buttons'] = 'strong,em,del,link';
    return $init;
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

add_action('admin_head', 'custom_admin_styles');
function custom_admin_styles() {
    // Only show slideshow fields when editing the homepage
    if (!isset($_GET['post']) || $_GET['post'] != get_post_id_for('home')) {
        echo '<style>
            #simple_fields_connector_5 { display:none; }
            #simple_fields_connector_17 { display:none; }
        </style>';
    }

    if ($_GET['post'] == get_post_id_for('home')) {
        echo '<style>
            #simple_fields_connector_17 .add_media { display:none; }
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

// if (!current_user_can('manage_options')) {
if ($current_user->ID != $superadmin_id) {
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
        remove_post_type_support('visuals', 'editor');
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

// Stop version update checks for this theme
function stop_theme_version_check($r, $url) {
    if (0 !== strpos( $url, 'http://api.wordpress.org/themes/update-check')) {
        return $r; // Not a theme update request. Bail immediately.
    }

    $themes = unserialize($r['body']['themes']);
    unset($themes[get_option('template')]);
    unset($themes[get_option('stylesheet')]);
    $r['body']['themes'] = serialize($themes);
    return $r;
}
add_filter('http_request_args', 'stop_theme_version_check', 5, 2);
