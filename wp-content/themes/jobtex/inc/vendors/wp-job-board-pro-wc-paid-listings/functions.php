<?php

function jobtex_job_paid_listing_template_folder_name($folder) {
	$folder = 'template-paid-listings';
	return $folder;
}
add_filter( 'wp-job-board-pro-wc-paid-listings-theme-folder-name', 'jobtex_job_paid_listing_template_folder_name', 10 );


add_action( 'wp_job_board_pro_wc_paid_listings_package_options_product_tab_content', 'jobtex_product_package_options' );
function jobtex_product_package_options() {
	woocommerce_wp_text_input( array(
		'id'			=> '_jobs_icon_class',
		'label'			=> esc_html__( 'Package icon class', 'jobtex' ),
		'desc_tip'		=> 'true',
		'description'	=> esc_html__( 'Enter icon class for this package', 'jobtex' ),
		'type' 			=> 'text',
	) );
}

function jobtex_save_package_option_field( $post_id ) {
	
	if ( isset( $_POST['_jobs_icon_class'] ) ) {
		update_post_meta( $post_id, '_jobs_icon_class', sanitize_text_field( $_POST['_jobs_icon_class'] ) );
	}
}
add_action( 'woocommerce_process_product_meta_job_package', 'jobtex_save_package_option_field'  );