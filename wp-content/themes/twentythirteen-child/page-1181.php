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

                    <?php echo do_shortcode('[email-download download_id="1193" contact_form_id="1192"]'); ?>
                </div>
            </div>
        </div>

        <?php include('footer-nav.php'); ?>
    </div>

</div><!-- .wrapper -->

<script>
    $(window).load(function () {
        $('form').each(function () {
            $(this).find('input').keypress(function (e) {
                // Enter pressed?
                if (e.which == 10 || e.which == 13) {
                    this.form.submit();
                }
            });
        });
    });
</script>

<?php get_footer(); ?>