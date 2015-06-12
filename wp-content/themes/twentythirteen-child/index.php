<?php /* OUR WORK */ ?>
<?php get_header(); ?>

    <?php
        $live_projects = array();
        $archived_projects = array();

        while (have_posts()) { the_post();
            $post_type = get_post_type();
            $project = FALSE;

            switch ($post_type) {
                case 'post':
                    $details = simple_fields_fieldgroup('project_details');
                    $tiles = simple_fields_fieldgroup('project_tiles');

                    // Look for first picture available (not testimonial)
                    $image = array('url' => '');
                    foreach ($tiles as $tile) {
                        if ($tile['project_tiles_image']['is_image'] && !empty($tile['project_tiles_type']) && $tile['project_tiles_type']['selected_value']=='Picture') {
                            $image = $tile['project_tiles_image'];
                            break;
                        }
                    }

                    $project = (object) array(
                        'client' => $details['project_details_client'],
                        'location' => $details['project_details_location'],
                        'image' => $image['url'],
                        'link' => get_the_permalink(),
                        'class' => $post_type,
                    );

                    break;

                case 'brand_experience':
                    $tile = simple_fields_fieldgroup('project_brand_tile');

                    $project = (object) array(
                        'client' => $tile['project_brand_tile_client'],
                        'location' => $tile['project_brand_tile_location'],
                        'image' => $tile['project_brand_tile_image']['url'],
                        'link' => get_the_permalink(),
                        'class' => $post_type,
                    );

                    break;
            }

            if (!empty($project)) {
                $options = simple_fields_fieldgroup('project_options');

                // BUG FIX: If there's only one option, the plugin doesn't create the related index in the array
                if (!array_key_exists('project_options_archived', $options)) {
                    $project_options_archived = $options;
                    $options = array('project_options_archived'=>$project_options_archived);
                }

                if ($options['project_options_archived']['selected_value']=='Yes') {
                    $archived_projects[] = $project;
                } else {
                    $live_projects[] = $project;
                }
            }
        }
    ?>

    <div class="work_wrap">
        <div class="work__row">
            <?php foreach ($live_projects as $live_project) { ?>
                <a href="<?php echo $live_project->link ?>" class="work__cell <?php echo $live_project->class ?>">
                    <div class="work__cell__container">
                        <span class="new-work"></span>
                        
                        <div class="work__title">
                            <span class="client_name"><?php echo $live_project->client ?></span>
                            <span class="project_location"><?php echo $live_project->location ?></span>
                        </div>

                        <div class="work__background" style="background-image:url('<?php echo $live_project->image ?>');"></div>
                    </div>
                </a>
            <?php } ?>
        </div>

        <div class="load_more">
            <div class="archive_btn more"><span>Previous projects</span></div>
            <div class="archive_btn less no_btn"><span>Hide previous projects</span></div>
        </div>

        <div class="work__row">
            <?php foreach ($archived_projects as $archived_project) { ?>
                <a href="<?php echo $archived_project->link ?>" class="work__cell <?php echo $archived_project->class ?> more_proj archived">
                    <div class="work__cell__container">
                        <span class="new-work"></span>

                        <div class="work__title">
                            <span class="client_name"><?php echo $archived_project->client ?></span>
                            <span class="project_location"><?php echo $archived_project->location ?></span>
                        </div>

                        <div class="work__background" style="background-image:url('<?php echo $archived_project->image ?>');"></div>
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>

    <?php include('footer-nav.php'); ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>