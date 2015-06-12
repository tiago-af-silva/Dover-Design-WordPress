<?php // Work details ?>
<?php get_header(); ?>

    <div class="work_detail_wrap">
        <div class="work_row">
            <div class=" work_brand_hero">
                <div class="table">
                    <div class="cell">
                        <img class="work_logo" src="/assets/img/dover-logo.svg">
                    </div>
                </div>
            </div>
        </div>

        <div class="work_row">
            <div class="work_brand_r1 work_row_bg">
                <div class="work_brand_wrapper">
                    <div class="work_brand_content content_left">
                        <div class="table">
                            <div class="cell">
                                <p class="work_brand_copy">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla consectetur ac lacus in viverra. Sed a aliquam dui. Cras efficitur vel ex id sagittis. Etiam laoreet, nisl vel bibendum semper, purus mauris cursus lacus, malesuada ullamcorper urna metus sed est. Nunc sagittis risus maximus gravida maximus. Nulla facilisi. Aliquam ultricies, tortor viverra tincidunt feugiat, nunc purus ullamcorper sapien, ac dapibus augue erat ut dui. Ut scelerisque blandit tortor at tristique. Aenean ultrices tincidunt sem, vitae sodales dui hendrerit id.
                                </br>
                                </br>
                                Nunc sagittis risus maximus gravida maximus. Nulla facilisi. Aliquam ultricies, tortor viverra tincidunt feugiat, nunc purus ullamcorper sapien, ac dapibus augue erat ut dui. Ut scelerisque blandit tortor at tristique. Aenean ultrices tincidunt sem, vitae sodales dui hendrerit id.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="work_brand_media">
                        <div class="brand_media_wrapper">
                            <iframe src="//player.vimeo.com/video/117395227?title=0&amp;byline=0&amp;portrait=0" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="work_row">
            <div class="work_brand_grid">
                <div class="brand_grid_item wc3"><img src="assets/content/work_detail/portrait.jpg"></div>
                <div class="brand_grid_item wc3"><img src="assets/content/work_detail/portrait.jpg"></div>
                <div class="brand_grid_item wc3"><img src="assets/content/work_detail/portrait.jpg"></div>
            </div>
        </div>

        <div class="work_row">
            <div class="work_brand_full">
               <!--  <div class="brand_grid_item c3"><img src="assets/content/work_detail/portrait.jpg"></div> -->
            </div>
        </div>


        <div class="work_row">
            <div class="work_brand_r1 work_row_bg">
                <div class="work_brand_wrapper">
                    <div class="work_brand_content content_right">
                        <div class="table">
                            <div class="cell">
                                <p class="work_brand_copy">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla consectetur ac lacus in viverra. Sed a aliquam dui. Cras efficitur vel ex id sagittis. Etiam laoreet, nisl vel bibendum semper, purus mauris cursus lacus, malesuada ullamcorper urna metus sed est. Nunc sagittis risus maximus gravida maximus. Nulla facilisi. Aliquam ultricies, tortor viverra tincidunt feugiat, nunc purus ullamcorper sapien, ac dapibus augue erat ut dui. Ut scelerisque blandit tortor at tristique. Aenean ultrices tincidunt sem, vitae sodales dui hendrerit id.
                                </br>
                                </br>
                                Nunc sagittis risus maximus gravida maximus. Nulla facilisi. Aliquam ultricies, tortor viverra tincidunt feugiat, nunc purus ullamcorper sapien, ac dapibus augue erat ut dui. Ut scelerisque blandit tortor at tristique. Aenean ultrices tincidunt sem, vitae sodales dui hendrerit id.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="work_brand_media">
                        <div class="brand_media_img">
                            <img src="assets/content/team/team_16.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="work_row">
            <div class="work_brand_grid">
                <div class="brand_grid_item wc3"><img src="assets/content/work_detail/portrait.jpg"></div>
                <div class="brand_grid_item wc3"><img src="assets/content/work_detail/portrait.jpg"></div>
                <div class="brand_grid_item wc3"><img src="assets/content/work_detail/portrait.jpg"></div>
            </div>
        </div>

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