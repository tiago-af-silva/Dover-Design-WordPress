<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php wp_title('-', true, 'right'); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" type="image/ico" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon-precomposed.png" />

        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ?>/assets/style/style.css?v=20160925" />

        <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        
        <?php if (get_the_ID() == get_post_id_for('home')) { ?>
            <div class="loader">
                <div class="table">
                    <div class="cell">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/loader.gif?v=2">
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="wrapper">
            <div class="header">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="header_logo">Logo</a>

                <div class="header_menu">
                    <div class="wrap_menu_button">
                        <div class="menu_button">
                            <div class="menu_button_item menu_button_item_top"></div>
                            <div class="menu_button_item menu_button_item_middle"></div>
                            <div class="menu_button_item menu_button_item_bottom"></div>
                        </div>
                    </div>

                    <div class="wrap_nav">
                        <ul class="header_nav">
                            <?php
                                if (($locations = get_nav_menu_locations()) && isset($locations['header'])) {
                                    $header_menu = wp_get_nav_menu_object($locations['header']);
                                    $header_menu_items = wp_get_nav_menu_items($header_menu->term_id);
                                } else {
                                    $header_menu_items = array();
                                }
                            ?>
                            <?php foreach($header_menu_items as $header_menu_item){ ?>
                                <?php
                                    if ($header_menu_item->object_id==$post->ID) {
                                        $class_name = 'active';
                                    } elseif ($header_menu_item->object_id==get_post_id_for('work') && ($post->post_type=='post' || $post->post_type=='brand_experience' || $post->post_type=='visuals')) {
                                        $class_name = 'active';
                                    } else {
                                        $class_name = '';
                                    }
                                ?>
                                <li class="nav_item <?php echo $class_name ?>">
                                    <a href="<?php echo $header_menu_item->url ?>"><span><?php echo $header_menu_item->title ?></span></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>