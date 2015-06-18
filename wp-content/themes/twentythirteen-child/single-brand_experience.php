<?php // Work details ?>
<?php get_header(); ?>

    <div class="work_detail_wrap">
        <?php while (have_posts()) { the_post(); ?>
            <?php
                // $tile = simple_fields_fieldgroup('project_brand_tile');
                // $options = simple_fields_fieldgroup('project_options');

                // Layout box 1 will always be the at the top
                $boxes = array(0=>simple_fields_fieldgroup('project_brand_box1'));
                $boxes_position = array(0=>'1');

                // Get other layout boxes
                $boxes_position_options = simple_fields_fieldgroup('project_brand_layout');
                for ($i=2; $i<=6; $i++) {
                    $boxes[$i] = simple_fields_fieldgroup('project_brand_box'.$i);

                    $selected_position = $boxes_position_options['project_brand_layout_box'.$i]['selected_value'];
                    if (strpos($selected_position,'Position ')!==FALSE) {
                        $position = str_replace('Position ', '', $selected_position);
                        if (!array_key_exists($position-1, $boxes_position)) {
                            $boxes_position[$position-1] = $i;
                        }
                    }
                }
                ksort($boxes_position);

                // BUG FIX: If there's only one option, the plugin doesn't create the related index in the array
                if (!array_key_exists('project_options_archived', $options)) {
                    $project_options_archived = $options;
                    $options = array('project_options_archived'=>$project_options_archived);
                }
            ?>

            <div class="work_row">
                <div class="work_brand_hero" style="background-image:url('<?php echo $boxes[0]['project_brand_box1_background']['url'] ?>');">
                    <div class="table">
                        <div class="cell">
                            <img class="work_logo" src="<?php echo $boxes[0]['project_brand_box1_logo']['url'] ?>">
                        </div>
                    </div>
                </div>
            </div>

            <?php foreach ($boxes_position as $index) { ?>
                <?php switch ($index) {
                    case '2': ?>
                        <div class="work_row">
                            <div class="work_brand_r1 work_row_bg" style="background-color:get_field('project_brand_box2_background');">
                                <div class="work_brand_wrapper">
                                    <div class="work_brand_content content_left">
                                        <div class="table">
                                            <div class="cell">
                                                <p class="work_brand_copy"><?php echo get_field('project_brand_box2_copy') ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="work_brand_media">
                                        <div class="brand_media_wrapper">
                                            <?php echo get_field('project_brand_box2_media') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php break; ?>

                    <?php case '3': ?>
                    <?php case '6': ?>
                        <div class="work_row">
                            <div class="work_brand_grid">
                                <?php foreach ($boxes[$index] as $image) { ?>
                                    <div class="brand_grid_item wc3"><img src="<?php echo $image['url'] ?>"></div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php break; ?>

                    <?php case '4': ?>
                        <div class="work_row">
                            <div class="work_brand_full" style="background-image:url('<?php echo $boxes[$index]['url'] ?>');"></div>
                        </div>
                        <?php break; ?>

                    <?php case '5': ?>
                        <div class="work_row">
                            <div class="work_brand_r1 work_row_bg" style="background-color:get_field('project_brand_box5_background');">
                                <div class="work_brand_wrapper">
                                    <div class="work_brand_content content_right">
                                        <div class="table">
                                            <div class="cell">
                                                <p class="work_brand_copy"><?php echo get_field('project_brand_box5_copy') ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="work_brand_media">
                                        <div class="brand_media_wrapper">
                                            <?php echo get_field('project_brand_box5_media') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php break; ?>

                    <?php case '7': ?>
                        <div class="work_row">
                            <div class="work_brand_r1 work_row_bg" style="background-color:get_field('project_brand_box7_background');">
                                <div class="work_brand_wrapper">
                                    <div class="work_brand_content content_right">
                                        <div class="table">
                                            <div class="cell">
                                                <p class="work_brand_copy"><?php echo get_field('project_brand_box7_copy') ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="work_brand_media">
                                        <div class="brand_media_img">
                                            <?php $image = get_field('project_brand_box7_image') ?>
                                            <img src="<?php echo $image['url'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php break; ?>
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <!-- ------------ -->

        <div id="masonry">
            <?php while (have_posts()) { the_post(); ?>
                <?php
                    $tile = simple_fields_fieldgroup('project_brand_tile');
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
    </div>

    <?php include('footer-nav.php'); ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>