<a class="download-link" title="<?php if ( $dlm_download->has_version_number() ) {
    printf( __( 'Version %s', 'download-monitor' ), $dlm_download->get_the_version_number() );
} ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
    <span class="download-link-icon">
        <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/content/alchemy/arrow-down.png">
    </span>
    click to download
</a>