<?php /* NEWS */ ?>
<?php get_header(); ?>

    <?php
        $args = array(
            'numberposts' => '5',
            'post_type' => 'newsletter',
        );

        $recent_posts = wp_get_recent_posts($args);

        while (have_posts()) { the_post();
    ?>
        <div class="about_wrap">
            <div class="about_wrap_inside">
                <?php if (count($recent_posts) > 0) { ?>
                    <div class="mailchimp-latest">
                        <iframe src="<?php echo trim($recent_posts[0]['post_content']) ?>"></iframe>
                    </div>
                <?php } ?>

                <?php
                    array_shift($recent_posts);

                    if (count($recent_posts) > 0) {
                ?>
                    <div class="mailchimp-archive">
                        <ul>
                            <?php foreach ($recent_posts as $recent_post) { ?>
                                <li>
                                    <a href="<?php echo trim($recent_post['post_content']) ?>" target="_blank"><?php echo $recent_post['post_title'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>

            <?php include('footer-nav.php'); ?>
        </div>
    <?php } ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>
