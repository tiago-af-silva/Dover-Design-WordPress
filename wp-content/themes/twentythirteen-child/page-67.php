<?php /* ABOUT */ ?>
<?php get_header(); ?>

    <?php while (have_posts()) { the_post(); ?>
        <div class="about_wrap">
            <div class="about_wrap_inside">
                <div class="video_wrap">
                    <iframe src="//player.vimeo.com/video/91875184?title=0&amp;byline=0&amp;portrait=0" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>

                <div class="about_content">
                    <?php the_content(); ?>
                </div>

                <div class="clients_secion">
                    <div class="about_title">
                        <hr class="about_line">
                        <h4 class="about_title_text h4">Our Clients</h4>
                        <hr class="about_line">
                    </div>

                    <ul>
                        <?php $clients = simple_fields_fieldgroup('about_clients') ?>
                        
                        <?php foreach ($clients as $client) { ?>
                            <?php if (!empty($client['about_clients_image']['url'])) { ?>
                                <li class="clients_item">
                                    <?php if (!empty($client['about_clients_link'])) { ?>
                                        <a href="<?php echo $client['about_clients_link'] ?>">
                                            <img src="<?php echo $client['about_clients_image']['url'] ?>">
                                        </a>
                                    <?php } else { ?>
                                        <img src="<?php echo $client['about_clients_image']['url'] ?>">
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <?php include('footer-nav.php'); ?>
        </div>
    <?php } ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>