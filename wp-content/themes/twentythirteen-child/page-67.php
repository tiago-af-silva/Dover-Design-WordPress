<?php /* SERVICES */ ?>
<?php
    $page_permalink = get_permalink();
    $services = simple_fields_fieldgroup('services_details');
    
    // Get service slug (if any)
    $service_selected_slug = strtolower(get_query_var('service'));

    // If slug is empty, redirect to the page of the first service on the database
    if (empty($service_selected_slug) && !empty($services)) {
        wp_redirect($page_permalink.$services[0]['services_details_slug']);
        exit;
    }

    // Get service object by slug
    $service_selected = null;
    foreach ($services as $service) {
        if (strtolower($service['services_details_slug']) == $service_selected_slug) {
            $service_selected = $service;
            break;
        }
    }

    // Display a 404 if service doesn't exist (or there are no services)
    if (empty($service_selected)) {
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit;
    }
?>
<?php get_header(); ?>

    <?php while (have_posts()) { the_post(); ?>
        <div class="services_wrap">
            <div class="filter_nav">
                <?php foreach ($services as $service) { ?>
                    <?php if (!empty($service['services_details_title'])) { ?>
                        <a class="button filter_nav_item <?php echo strtolower($service['services_details_slug']) == $service_selected_slug ? 'is-checked' : '' ?>" href="<?php echo $page_permalink.$service['services_details_slug'] ?>">
                            <div class="filter_btn">
                                <span><?php echo $service['services_details_title'] ?></span>
                            </div>
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>

            <div class="services_wrap_inside" <?php echo $service_selected['services_details_bg']['is_image'] ? 'style="background-image: url(\''.$service_selected['services_details_bg']['url'].'\')"' : '' ?>>
                <h1><?php echo $service_selected['services_details_title'] ?></h1>
                <p><?php echo nl2br($service_selected['services_details_description']) ?></p>
            </div>

            <div class="services_wrap_inside">
                <div class="clients_secion">
                    <div class="services_title">
                        <hr class="services_line">
                        <h4 class="services_title_text h4">Our Clients</h4>
                        <hr class="services_line">
                    </div>

                    <ul>
                        <?php $clients = simple_fields_fieldgroup('services_clients') ?>
                        
                        <?php foreach ($clients as $client) { ?>
                            <?php if (!empty($client['services_clients_image']['url'])) { ?>
                                <li class="clients_item">
                                    <?php if (!empty($client['services_clients_link'])) { ?>
                                        <a href="<?php echo $client['services_clients_link'] ?>">
                                            <img src="<?php echo $client['services_clients_image']['url'] ?>">
                                        </a>
                                    <?php } else { ?>
                                        <img src="<?php echo $client['services_clients_image']['url'] ?>">
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <?php include('footer-nav.php'); ?>
        </div>
    <?php } ?>

</div><!-- .wrapper -->

<?php get_footer(); ?>