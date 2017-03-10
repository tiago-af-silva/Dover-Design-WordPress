<?php /* NEWSLETTER */ ?>
<?php get_header(); ?>

    <?php while (have_posts()) { the_post(); ?>
        <div class="about_wrap">
            <div class="about_wrap_inside">
                <div class="mailchimp-archive">
                    <script language="javascript" src="//tiagosilva.us15.list-manage.com/generate-js/?u=2d95da91c5f6cc8eb8806c245&fid=1165&show=10" type="text/javascript"></script>
                </div>

                <div class="about_content">Founded in 1995, we are London based design agency with a broad range of experience in building and developing brands predominantly in the restaurant sector. Every project receives the personal attention of a design director working with a team of experienced designers and technicians. We thrive on working out creative solutions and developing the concept with the client. Creating the design and building the interior that delivers the brief, is what we do best. We hold the vision of the finished product throughout while respecting, integrating and coordinating all the other disciplines and services that make up the project.</div>
            </div>

            <?php include('footer-nav.php'); ?>
        </div>
    <?php } ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>
