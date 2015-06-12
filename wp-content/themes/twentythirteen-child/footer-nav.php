<div class="footer">
    <p class="copyright">&copy; <?php echo date('Y') ?> Dover Design</p>
    <ul class="footer_nav">
        <?php
            if (($locations = get_nav_menu_locations()) && isset($locations['footer'])) {
                $footer_menu = wp_get_nav_menu_object($locations['footer']);
                $footer_menu_items = wp_get_nav_menu_items($footer_menu->term_id);
            } else {
                $footer_menu_items = array();
            }
        ?>
        <?php foreach($footer_menu_items as $footer_menu_item){ ?>
            <li class="footer_item <?php echo ($footer_menu_item->object_id==get_queried_object_id() ? 'active' : '') ?>">
                <a class="footer_link" href="<?php echo $footer_menu_item->url ?>"><span><?php echo $footer_menu_item->title ?></span></a>
            </li>
        <?php } ?>

        <li class="footer_item"><a class="social_btn linkedin" href="http://uk.linkedin.com/pub/dover-design-restaurant-designers/2a/a31/234" target="_blank">-<div class="linkedin_logo"></div></a></li>
        <li class="footer_item"><a class="social_btn facebook" href="https://www.facebook.com/DoverDesignAssociates" target="_blank">-<div class="facebook_logo"></div></a></li>
        <li class="footer_item"><a class="social_btn twitter" href="https://twitter.com/doverdesign" target="_blank">-<div class="twitter_logo"></div></a></li>
        <li class="footer_item"><a class="social_btn instagram" href="http://instagram.com/doverdesign" target="_blank">-<div class="instagram_logo"></div></a></li>
    </ul>
</div>
