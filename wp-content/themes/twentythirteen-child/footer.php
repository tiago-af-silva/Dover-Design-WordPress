        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/plugins.js?v=20150630"></script>
        <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/global.js?v=20150612"></script>
        <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/slick.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/isotope-docs.min.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/masonry.pkgd.min.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/masonry_grid.js"></script>

        <?php if (ENVIRONMENT == 'live') { ?>
            <?php /*
            <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
            <script>
                (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
                function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
                e=o.createElement(i);r=o.getElementsByTagName(i)[0];
                e.src='//www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
                ga('create','UA-XXXXX-X');ga('send','pageview');
            </script>
            */ ?>
            <script type="text/javascript">
                var _ss = _ss || [];
                _ss.push(['_setDomain', 'https://koi-VWLYX0.sharpspring.com/net']);
                _ss.push(['_setAccount', 'KOI-10IB2IG']);
                _ss.push(['_trackPageView']);
                (function() {
                    var ss = document.createElement('script');
                    ss.type = 'text/javascript'; ss.async = true;
                    ss.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'koi-VWLYX0.sharpspring.com/client/ss.js?ver=1.1.1';
                    var scr = document.getElementsByTagName('script')[0];
                    scr.parentNode.insertBefore(ss, scr);
                })();
            </script>
        <?php } ?>

        <?php if (get_the_ID() == get_post_id_for('home')) { ?>
            <script>
                $(window).load(function () {
                    // Show loading animation
                    $('.loader').fadeOut('slow');
                })
            </script>

        <?php } elseif (get_the_ID() == get_post_id_for('alchemy')) { ?>
            <script>
                $(window).load(function () {
                    if ($('.wpcf7-mail-sent-ok').length > 0) {
                        $('.alchemy_form').remove();
                        $('.alchemy_download').show();

                    } else {
                        $('#alchemy-form-name, #alchemy-form-email').keypress(function (e) {
                            // Enter pressed?
                            if (e.which == 10 || e.which == 13) {
                                this.form.submit();
                            }
                        });
                    }
                });
            </script>
        <?php } ?>
    </body>
</html>