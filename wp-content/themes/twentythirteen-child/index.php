<?php /* OUR WORK */ ?>
<?php get_header(); ?>

    <div class="work_wrap">
        <div class="work__row">
            <?php $previous_btn_added = false; ?>
            <?php while (have_posts()) { the_post(); ?>
                <?php
                    $details = simple_fields_fieldgroup('project_details');
                    $tiles = simple_fields_fieldgroup('project_tiles');
                    $options = simple_fields_fieldgroup('project_options');

                    // BUG FIX: If there's only one option, the plugin doesn't create the related index in the array
                    if (!array_key_exists('project_options_archived', $options)) {
                        $project_options_archived = $options;
                        $options = array('project_options_archived'=>$project_options_archived);
                    }
                ?>

                <?php if ($options['project_options_archived']['selected_value']=='Yes' && !$previous_btn_added) { ?>
                    <div class="load_more">
                        <div class="archive_btn more"><span>Previous projects</span></div>
                        <div class="archive_btn less no_btn"><span>Hide previous projects</span></div>
                    </div>
                    <?php $previous_btn_added = true; ?>
                <?php } ?>

                <a href="<?php echo get_the_permalink(); ?>" class="work__cell <?php echo ($options['project_options_archived']['selected_value']=='Yes' ? 'more_proj archived' : '') ?>">
                    <div class="work__cell__container">
                        <span class="new-work"></span>
                        <div class="work__title">
                            <span class="client_name"><?php echo $details['project_details_client'] ?></span>
                            <span class="project_location"><?php echo $details['project_details_location'] ?></span>
                        </div>

                        <?php // Look for first picture available (not testimonial) ?>
                        <?php foreach ($tiles as $tile) { ?>
                            <?php if ($tile['project_tiles_image']['is_image'] && !empty($tile['project_tiles_type']) && $tile['project_tiles_type']['selected_value']=='Picture') { ?>
                                <div class="work__background" style="background-image:url('<?php echo $tile['project_tiles_image']['url'] ?>');"></div>
                                <?php break; ?>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>

    <?php include('footer-nav.php'); ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>