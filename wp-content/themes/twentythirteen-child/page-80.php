<?php /* THE TEAM */ ?>
<?php get_header(); ?>

    <?php while (have_posts()) { the_post(); ?>
        <div class="team_wrap">
            <div id="masonry">
                <div class="grid_item c4 bandw">
                    <div class="item_wrap people_btn pop-1">
                        <div class="team-button">
                            <span class="team-member-name">Jon Dover</span>
                            <span class="team-member-role">Managing Director</span>
                        </div>
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_jon.jpg?v=2">
                    </div>
                </div>

                <div class="grid_item c4 bandw">
                    <div class="item_wrap people_btn pop-3">
                        <div class="team-button">
                            <span class="team-member-name">George Georgiou</span>
                            <span class="team-member-role">Creative Director</span>
                        </div>
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_george.jpg?v=2">
                    </div>
                </div>

                <div class="grid_item c4 bandw">
                    <div class="item_wrap people_btn pop-2">
                        <div class="team-button">
                            <span class="team-member-name">David McDougall</span>
                            <span class="team-member-role">Executive Director</span>
                        </div>
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_david.jpg?v=2">
                    </div>
                </div>

                <div class="grid_item c4 copy_box">
                    <div class="copy_box_inner">
                        <img class="c1x1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_jon.jpg">
                        <img class="c1x2" src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_11.jpg">
                        <div class="c1x3">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_jon.jpg">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_14.jpg">
                        </div>
                        
                        <div class="item_wrap copy">
                            <div class="team_copy_container">
                                <span class="team_copy">We enjoy working with our designers, building enthusiastic teams and making the most out of our balance of ideas and experience. It is this, combined with clear communication and quality information, that produces great results for our clients.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid_item c2 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_15.jpg?v=2"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_11.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_14.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_8.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_2.jpg"></div>
                <!-- <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_1.jpg"></div> -->
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_5.jpg"></div>
                <div class="grid_item c2 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_16.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_4.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_7.jpg"></div>
                <!-- <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_3.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_6.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_9.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_10.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_12.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_13.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_17.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_18.jpg"></div>
                <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_19.jpg"></div> -->
            </div>
        </div>

        <?php include('footer-nav.php'); ?>

    <?php } ?>

</div><!-- .wrapper -->

<div class="pop-up_1 pop-up_wraper no_pop-up">
    <div class="table">
        <div class="cell">
            <div class="pop-up_container team_lighbox">
                <div class="pop-up_content">
                    <a href="#" class="close_btn"></a>
                    <div class="team_info_photo">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_jon.jpg">
                    </div>
                    <div class="team_info">
                        <div class="team_title">
                            <div class="team_info_name">Jon Dover</div>
                            <div class="team_info_roll">Managing Director</div>
                        </div>
                        <div class="team_info_copy">
                            <p class="info_subtitle">With a successful career spanning four decades Jon Dover has become a respected name in the Leisure and Hospitality sector. His philosophy of delivering strong, well thought out, design solutions that answer the brief has been the foundation that dover Design is built on.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
</div>

<div class="pop-up_2 pop-up_wraper no_pop-up">
    <div class="table">
        <div class="cell">
            <div class="pop-up_container team_lighbox">
                <div class="pop-up_content">
                    <a href="#" class="close_btn"></a>
                    <div class="team_info_photo">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_david.jpg">
                    </div>
                    <div class="team_info">
                        <div class="team_title">
                            <div class="team_info_name">David McDougall</div>
                            <div class="team_info_roll">Executive Director</div>
                        </div>
                        <div class="team_info_copy">
                            <p class="info_subtitle">David has been with Dover Design for over 10 years, being invited to become a director in 2007. Previously freelance with small niche consultancies specialising in POS, graphics, retail and hospital interiors. He still enjoys the challenge of restaurant design and delivery with some of London's leading entrepreneurs and operators.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
</div>

<div class="pop-up_3 pop-up_wraper no_pop-up">
    <div class="table">
        <div class="cell">
            <div class="pop-up_container team_lighbox">
                <div class="pop-up_content">
                    <a href="#" class="close_btn"></a>
                    <div class="team_info_photo">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_george.jpg">
                    </div>
                    <div class="team_info">
                        <div class="team_title">
                            <div class="team_info_name">George Georgiou</div>
                            <div class="team_info_roll">Creative Director</div>
                        </div>
                        <div class="team_info_copy">
                            <p class="info_subtitle">George joined Dover Design in 2011 having gained experience through working for a number of design agencies. He has worked across most areas of interior design including retail, exhibition and residential and has extensive knowledge of the leisure sector.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
</div>

<?php get_footer(); ?>