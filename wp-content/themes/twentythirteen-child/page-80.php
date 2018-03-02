<?php /* ABOUT */ ?>
<?php get_header(); ?>

    <div class="about_wrap">
        <div id="masonry">
            <?php while (have_posts()) { the_post(); ?>
                <?php
                    $members = simple_fields_fieldgroup('about_team_members');
                ?>

                <?php foreach ($members as $index=>$member) { ?>
                    <?php switch ($member['about_team_members_type']['selected_value']) {
                        case 'Director': ?>
                            <div class="grid_item c4 bandw">
                                <div class="item_wrap people_btn director pop-<?php echo $index+1 ?>">
                                    <div class="team-button">
                                        <span class="team-member-name"><?php echo $member['about_team_members_name'] ?></span>
                                        <span class="team-member-role"><?php echo $member['about_team_members_role'] ?></span>
                                    </div>
                                    <img src="<?php echo $member['about_team_members_image']['url'] ?>">
                                </div>
                            </div>
                            <?php break; ?>

                        <?php case 'Team member': ?>
                            <div class="grid_item c4 bandw">
                                <div class="item_wrap people_btn">
                                    <div class="team-button">
                                        <span class="team-member-name"><?php echo $member['about_team_members_name'] ?></span>
                                        <span class="team-member-role"><?php echo $member['about_team_members_role'] ?></span>
                                    </div>
                                    <img src="<?php echo $member['about_team_members_image']['url'] ?>">
                                </div>
                            </div>
                            <?php break; ?>

                        <?php case 'Orange box': ?>
                            <div class="grid_item c4 copy_box">
                                <div class="copy_box_inner">
                                    <img class="c1x1" src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/about/team_jon.jpg">
                                    <img class="c1x2" src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/about/team_11.jpg">
                                    <div class="c1x3">
                                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/about/team_jon.jpg">
                                        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/about/team_14.jpg" style="margin-top:4px;">
                                    </div>

                                    <div class="item_wrap copy">
                                        <div class="about_copy_container">
                                            <span class="about_copy"><?php echo $member['about_team_members_about'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php break; ?>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

    <?php include('footer-nav.php'); ?>

</div><!-- .wrapper -->

<?php foreach ($members as $index=>$member) { ?>
    <div class="pop-up_<?php echo $index+1 ?> pop-up_wraper no_pop-up">
        <div class="pop-up_container about_lightbox">
            <div class="pop-up_content clearfix">
                <a href="#" class="close_btn"></a>
                <div class="about_info_photo">
                    <img src="<?php echo $member['about_team_members_image']['url'] ?>">
                </div>
                <div class="about_info">
                    <div class="about_title">
                        <div class="about_info_name"><?php echo $member['about_team_members_name'] ?></div>
                        <div class="about_info_roll"><?php echo $member['about_team_members_role'] ?></div>
                    </div>
                    <div class="about_info_copy">
                        <p class="info_subtitle"><?php echo $member['about_team_members_about'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php get_footer(); ?>