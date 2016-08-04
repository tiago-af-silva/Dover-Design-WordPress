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
                        'category' => 'interior',
                    );

                    break;

                case 'brand_experience':
                    $tile = simple_fields_fieldgroup('project_brand_tile');

                    $project = (object) array(
                        'client' => $tile['project_brand_tile_client'],
                        'location' => $tile['project_brand_tile_location'],
                        'image' => $tile['project_brand_tile_image']['url'],
                        'link' => get_the_permalink(),
                        'category' => 'brand',
                    );

                    break;

                case 'visuals':
                    $tile = simple_fields_fieldgroup('project_visuals_tile');

                    $project = (object) array(
                        'client' => $tile['project_visuals_tile_client'],
                        'location' => $tile['project_visuals_tile_location'],
                        'image' => $tile['project_visuals_tile_image']['url'],
                        'link' => get_the_permalink(),
                        'category' => 'visuals',
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

    <div class="work_wrap" data-js-module="filtering-demo">
        <div class="filter-button-group js-radio-button-group filter_nav">
            <button class="button filter_nav_item is-checked" data-filter="*">
                <div class="filter_btn"><span>All</span></div>
            </button>
            <button class="button filter_nav_item" data-filter=".interior">
                <div class="filter_btn"><span>Interior Design</span></div>
            </button>
            <button class="button filter_nav_item" data-filter=".brand">
                <div class="filter_btn"><span>Brand Experience</span></div>
            </button>
        </div>

        <div class="grid_wrapper">
            <div class="grid work__row">
                <?php foreach ($live_projects as $live_project) { ?>
                    <a href="<?php echo $live_project->link ?>" class="element-item work__cell <?php echo $live_project->category ?>" data-category="<?php echo $live_project->category ?>">
                        <div class="work__cell__container">
                            <div class="work_wrapper">
                                <span class="new-work"></span>

                                <div class="work__title">
                                    <span class="client_name"><?php echo $live_project->client ?></span>
                                    <span class="project_location"><?php echo $live_project->location ?></span>
                                </div>

                                <div class="work__background" style="background-image:url('<?php echo $live_project->image ?>');"></div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>

            <div class="load_more">
                <button class="archive_btn more">
                    <span>Previous projects</span>
                </button>
                <button class="archive_btn less no_btn">
                    <span>Hide previous projects</span>
                </button>
            </div>

            <div class="grid grid-archived work__row">
                <?php foreach ($archived_projects as $archived_project) { ?>
                    <a href="<?php echo $archived_project->link ?>" class="element-item work__cell more_proj archived <?php echo $archived_project->category ?>" data-category="<?php echo $archived_project->category ?>">
                        <div class="work__cell__container">
                            <div class="work_wrapper">
                                <span class="new-work"></span>

                                <div class="work__title">
                                    <span class="client_name"><?php echo $archived_project->client ?></span>
                                    <span class="project_location"><?php echo $archived_project->location ?></span>
                                </div>

                                <div class="work__background" style="background-image:url('<?php echo $archived_project->image ?>');"></div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>

    <?php include('footer-nav.php'); ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>