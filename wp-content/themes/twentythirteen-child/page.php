<?php /* OTHER PAGES */ ?>
<?php get_header(); ?>

    <?php while (have_posts()) { the_post(); ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    <?php } ?>

    <?php include('footer-nav.php'); ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>