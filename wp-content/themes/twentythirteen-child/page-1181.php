<?php /* ALCHEMY FOR RESTAURATEURS */ ?>
<?php get_header(); ?>

    <div class="alchemy_wrap">
        <div class="table">
            <div class="cell">
                <div class="alchemy_wrap_content">
                    <h1>
                        Sign up for your free copy of
                        <br>
                        &lsquo;Alchemy for Restaurateurs&rsquo;
                    </h1>

                    <div class="alchemy_form">
                        <?php echo do_shortcode('[email-download download_id="1193" contact_form_id="1192"]'); ?>
                    </div>

                    <div class="alchemy_download">
                        <?php echo do_shortcode('[download id="1193" template="alchemy"]'); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php include('footer-nav.php'); ?>
    </div>

</div><!-- .wrapper -->

<?php get_footer(); ?>