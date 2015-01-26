<?php // Work details ?>
<?php get_header(); ?>

    <div class="work_detail_wrap">
        <div id="masonry">
            <?php while (have_posts()) { the_post(); ?>
                <?php
                    $details = simple_fields_fieldgroup('project_details');
                    $testimonial = simple_fields_fieldgroup('project_testimonial');
                    $testimonial_added = false;
                    $tiles = simple_fields_fieldgroup('project_tiles');
                    $options = simple_fields_fieldgroup('project_options');

                    // BUG FIX: If there's only one option, the plugin doesn't create the related index in the array
                    if (!array_key_exists('project_options_archived', $options)) {
                        $project_options_archived = $options;
                        $options = array('project_options_archived'=>$project_options_archived);
                    }
                ?>

                <?php foreach ($tiles as $tile) { ?>
                    <?php if ($tile['project_tiles_image']['is_image'] && !empty($tile['project_tiles_type']['selected_value'])) { ?>
                        <div class="grid_item c4">
                            <?php if ($tile['project_tiles_type']['selected_value']=='Picture') { ?>
                                <div class="item_wrap">
                                    <img src="<?php echo $tile['project_tiles_image']['url'] ?>">
                                </div>

                            <?php } elseif ($tile['project_tiles_type']['selected_value']=='Testimonial' && !$testimonial_added) { ?>
                                <div class="item_wrap quote" style="color:#<?php echo ltrim($testimonial['project_testimonial_colour'], '#') ?>;background-image:url('<?php echo $tile['project_tiles_image']['url'] ?>');">
                                    <span class="client_quote"><?php echo $testimonial['project_testimonial_text'] ?></span>
                                    <span class="client_roll">
                                        <?php echo $testimonial['project_testimonial_author'] ?><?php echo (!empty($testimonial['project_testimonial_role']) ? ', '.$testimonial['project_testimonial_role'] : '') ?>.<?php echo (!empty($testimonial['project_details_client']) ? ', '.$testimonial['project_details_client'] : '') ?>
                                    </span>
                                </div>
                                <?php $testimonial_added = true ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>

        <a href="#" class="case-study_btn"><span>Case study</span></a>
    </div>

    <?php include('footer-nav.php'); ?>

</div><!-- .wrapper -->

<div class="work_pop-up_wraper no_pop-up">
    <div class="table">
        <div class="cell">
            <div class="pop-up_container work_lightbox">
                <div class="pop-up_content">
                    <a href="#" class="close_btn"></a>

                    <div class="client_info">
                        <div class="client_info_name">
                            <h3 class="info_title">Client:</h3>
                            <p class="info_subtitle"><?php echo $details['project_details_client'] ?></p>
                        </div>
                        <div class="client_info_location">
                            <h3 class="info_title">Location:</h3>
                            <p class="info_subtitle"><?php echo $details['project_details_location'] ?></p>
                        </div>
                    </div>

                    <div class="client_info_copy">
                        <!-- <h3 class="info_title">The challenge</h3> -->
                        <p class="info_subtitle"><?php echo $details['project_details_challenges'] ?></p>
                    </div>

                    <div class="client_info_copy">
                        <!-- <h3 class="info_title">The solution</h3> -->
                        <p class="info_subtitle"><?php echo $details['project_details_solution'] ?></p>
                    </div>

                    <div class="download_btn_container">
                        <a class="download_btn" href="<?php echo($details['project_details_attachment']['url']) ?>" target="_blank"><span>Download PDF</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
</div>

<?php get_footer(); ?>