<?php /* THE TEAM */ ?>
<?php get_header(); ?>

    <div class="team_wrap">
        <div id="masonry">
            <?php while (have_posts()) { the_post(); ?>
                <?php
                    $members = simple_fields_fieldgroup('team_members');
                ?>

                <?php foreach ($members as $index=>$member) { ?>
                    <?php switch ($member['team_members_type']['selected_value']) {
                        case 'Director': ?>
                            <div class="grid_item c4 bandw">
                                <div class="item_wrap people_btn director pop-<?php echo $index+1 ?>">
                                    <div class="team-button">
                                        <span class="team-member-name"><?php echo $member['team_members_name'] ?></span>
                                        <span class="team-member-role"><?php echo $member['team_members_role'] ?></span>
                                    </div>
                                    <img src="<?php echo $member['team_members_image']['url'] ?>">
                                </div>
                            </div>
                            <?php break; ?>

                        <?php case 'Team member': ?>
                            <div class="grid_item c4 bandw">
                                <div class="item_wrap people_btn">
                                    <div class="team-button">
                                        <span class="team-member-name"><?php echo $member['team_members_name'] ?></span>
                                        <span class="team-member-role"><?php echo $member['team_members_role'] ?></span>
                                    </div>
                                    <img src="<?php echo $member['team_members_image']['url'] ?>">
                                </div>
                            </div>
                            <?php break; ?>

                        <?php case 'Orange box': ?>
                            <div class="grid_item c4 copy_box">
                                <div class="copy_box_inner">
                                    <img class="c1x1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_jon.jpg">
                                    <img class="c1x2" src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_11.jpg?v=2">
                                    <div class="c1x3">
                                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_jon.jpg">
                                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_14.jpg" style="margin-top:4px;">
                                    </div>

                                    <div class="item_wrap copy">
                                        <div class="team_copy_container">
                                            <span class="team_copy"><?php echo $member['team_members_about'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php break; ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

            <div class="grid_item c2 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_15.jpg?v=2"></div>
            <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_11.jpg?v=2"></div>
            <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_14.jpg"></div>
            <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_8.jpg"></div>
            <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_2.jpg"></div>
            <!-- <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_1.jpg"></div> -->
            <div class="grid_item c4 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_5.jpg"></div>
            <div class="grid_item c2 bandw"><img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/team/team_16.jpg?v=2"></div>
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

</div><!-- .wrapper -->

<?php foreach ($members as $index=>$member) { ?>
    <div class="pop-up_<?php echo $index+1 ?> pop-up_wraper no_pop-up">
        <div class="pop-up_container team_lighbox">
            <div class="pop-up_content clearfix">
                <a href="#" class="close_btn"></a>
                <div class="team_info_photo">
                    <img src="<?php echo $member['team_members_image']['url'] ?>">
                </div>
                <div class="team_info">
                    <div class="team_title">
                        <div class="team_info_name"><?php echo $member['team_members_name'] ?></div>
                        <div class="team_info_roll"><?php echo $member['team_members_role'] ?></div>
                    </div>
                    <div class="team_info_copy">
                        <p class="info_subtitle"><?php echo $member['team_members_about'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php get_footer(); ?>