<?php // Work details ?>
<?php get_header(); ?>

    <div class="work_detail_wrap work_brand_detail_wrap">
        <?php while (have_posts()) { the_post(); ?>
            <?php
                // $tile = simple_fields_fieldgroup('project_brand_tile');
                // $options = simple_fields_fieldgroup('project_options');

                $boxes = array(
                    0 => simple_fields_fieldgroup('project_brand_box1'),
                    1 => NULL,
                    2 => simple_fields_fieldgroup('project_brand_box3'),
                    3 => simple_fields_fieldgroup('project_brand_box4'),
                    4 => NULL,
                    5 => simple_fields_fieldgroup('project_brand_box6'),
                    6 => NULL,
                );

                // Layout box 1 will always be the at the top
                $boxes_position = array(0=>'1');

                // Get other layout boxes
                $boxes_position_options = simple_fields_fieldgroup('project_brand_layout');
                for ($i=2; $i<=7; $i++) {
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
                // if (!array_key_exists('project_options_archived', $options)) {
                //     $project_options_archived = $options;
                //     $options = array('project_options_archived'=>$project_options_archived);
                // }

                // Set to true as soon as the first video starts playing automatically
                $playing_video = false;

                function get_oembed_iframe($iframe) {
                    global $playing_video;
                    
                    // Use preg_match to find iframe src
                    preg_match('/src="(.+?)"/', $iframe, $matches);
                    $src = $matches[1];

                    // Add extra params to iframe src
                    $params = array(
                        'autohide' => 1,
                        'controls' => 1,
                        'hd' => 1,
                        'badge' => 0,
                        'byline' => 0,
                        'portrait' => 0,
                        'title' => 0
                    );

                    if (!$playing_video) {
                        $params['autoplay'] = 1;
                        $playing_video = true;
                    }

                    $new_src = add_query_arg($params, $src);
                    $iframe = str_replace($src, $new_src, $iframe);

                    // Add extra attributes to iframe HTML
                    // $attributes = 'frameborder="0"';
                    // $iframe = str_replace('></iframe>', ' '.$attributes.'></iframe>', $iframe);

                    return $iframe;
                }
            ?>

            <div class="work_row">
                <div class="work_brand_hero" style="background-image:url('<?php echo $boxes[0]['project_brand_box1_background']['url'] ?>');">
                    <?php if ($boxes[0]['project_brand_box1_logo']['url']) { ?>
                        <div class="table">
                            <div class="cell">
                                <img class="work_logo" src="<?php echo $boxes[0]['project_brand_box1_logo']['url'] ?>">
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <?php foreach ($boxes_position as $index) { ?>
                <?php switch ($index) {
                    case '2': ?>
                        <div class="work_row">
                            <div class="work_brand_r1 work_row_bg" style="background-color:<?php echo get_field('project_brand_box2_background') ?>;">
                                <div class="work_brand_wrapper">
                                    <div class="work_brand_content content_left">
                                        <div class="table">
                                            <div class="cell">
                                                <div class="work_brand_copy"><?php echo get_field('project_brand_box2_copy') ?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="work_brand_media">
                                        <div class="brand_media_wrapper">
                                            <?php
                                                $iframe = get_field('project_brand_box2_media');
                                                echo get_oembed_iframe($iframe);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php break; ?>

                    <?php case '3': ?>
                    <?php case '6': ?>
                        <div class="work_row work_brand_images_row">
                            <div class="work_brand_grid clearfix">
                                <?php foreach ($boxes[$index-1] as $images) { ?>
                                    <div class="brand_grid wc3">
                                        <div class="brand_grid_container" style="background-image:url('<?php echo $images['project_brand_box'.$index.'_image_hover']['url'] ?>')">
                                            <div class="brand_grid_background" style="background-image:url('<?php echo $images['project_brand_box'.$index.'_image']['url'] ?>');"></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php break; ?>

                    <?php case '4': ?>
                        <div class="work_row">
                            <div class="work_brand_full" style="background-image:url('<?php echo $boxes[$index-1]['url'] ?>');"></div>
                        </div>
                        <?php break; ?>

                    <?php case '5': ?>
                        <div class="work_row">
                            <div class="work_brand_r1 work_row_bg" style="background-color:<?php echo get_field('project_brand_box5_background') ?>;">
                                <div class="work_brand_wrapper">
                                    <div class="work_brand_content content_right">
                                        <div class="table">
                                            <div class="cell">
                                                <div class="work_brand_copy"><?php echo get_field('project_brand_box5_copy') ?></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="work_brand_media">
                                        <div class="brand_media_wrapper">
                                            <?php
                                                $iframe = get_field('project_brand_box5_media');
                                                echo get_oembed_iframe($iframe);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php break; ?>

                    <?php case '7': ?>
                        <div class="work_row">
                            <div class="work_brand_r1 work_row_bg" style="background-color:<?php echo get_field('project_brand_box7_background') ?>;">
                                <div class="work_brand_wrapper">
                                    <div class="work_brand_content content_right">
                                        <div class="table">
                                            <div class="cell">
                                                <div class="work_brand_copy"><?php echo get_field('project_brand_box7_copy') ?></div>
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
    </div>

    <?php include('footer-nav.php'); ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>