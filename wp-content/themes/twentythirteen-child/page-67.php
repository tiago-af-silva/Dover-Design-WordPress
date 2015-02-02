<?php /* ABOUT */ ?>
<?php get_header(); ?>

    <?php while (have_posts()) { the_post(); ?>
        <div class="about_wrap">
            <div class="about_wrap_inside">
                <div class="video_wrap">
                    <iframe src="//player.vimeo.com/video/117395227?title=0&amp;byline=0&amp;portrait=0" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>

                <div class="about_content">Founded in 1995, we are London based design agency with a broad range of experience in building and developing brands predominantly in the restaurant sector. Every project receives the personal attention of a design director working with a team of experienced designers and technicians. We thrive on working out creative solutions and developing the concept with the client. Creating the design and building the interior that delivers the brief, is what we do best. We hold the vision of the finished product throughout while respecting, integrating and coordinating all the other disciplines and services that make up the project.</div>

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