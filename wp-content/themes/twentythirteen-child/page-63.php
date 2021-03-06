<?php /* HOMEPAGE */ ?>
<?php get_header(); ?>

    <?php while (have_posts()) { the_post(); ?>
        <?php
            $slideshow_first = simple_fields_fieldgroup('homepage_slideshow_first');
            $slideshow = simple_fields_fieldgroup('homepage_slideshow');
        ?>

        <div class="content">
            <div class="home">
                <div class="slideshow">
                    <div class="slide">
                        <div class="image" style='background-image:url(<?php echo $slideshow_first['homepage_slideshow_first_background']['url'] ?>)'></div>
                        <div class="table">
                            <div class="cell">
                                <div class="once_slide">
                                    <div class="table">
                                        <div class="cell">
                                            <h1 class="once_slide_title"><?php echo strip_tags($slideshow_first['homepage_slideshow_first_text'], '<strong><em><del><a><br>') ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php // Show the first 4 entries only ?>
                    <?php for ($i=0; $i<4; $i++) { ?>
                        <?php if (!empty($slideshow[$i])) { ?>
                            <div class="slide slide_delayed">
                                <div class="image" style="background-image:url('<?php echo $slideshow[$i]['homepage_slideshow_image']['url'] ?>')"></div>

                                <?php if (!empty($slideshow[$i]['homepage_slideshow_testimonial'])) { ?>
                                    <div class="table">
                                        <div class="cell">
                                            <div class="slide_title">
                                                <div class="content_quote"><?php echo $slideshow[$i]['homepage_slideshow_testimonial'] ?></div>
                                                <div class="content_author"><?php echo $slideshow[$i]['homepage_slideshow_author'] ?></div>
                                            </div>
                                            <a href="<?php echo $slideshow[$i]['homepage_slideshow_link'] ?>" class="find_more_btn"><span>Find out more</span></a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <?php include('footer-nav.php'); ?>
        </div>
    <?php } ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>