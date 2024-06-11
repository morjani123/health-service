<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

remove_action( 'wp_job_board_pro_before_candidate_archive', array( 'WP_Job_Board_Pro_Candidate', 'display_candidates_count_results' ), 10 );
remove_action( 'wp_job_board_pro_before_candidate_archive', array( 'WP_Job_Board_Pro_Candidate', 'display_candidates_alert_form' ), 20 );

$layout_type = jobtex_get_candidates_layout_type();
if ( $layout_type !== 'half-map' ) {
	add_action( 'wp_job_board_pro_before_candidate_archive', array( 'WP_Job_Board_Pro_Candidate', 'display_candidates_count_results' ), 20 );
}

add_action( 'wp_job_board_pro_before_candidate_archive', 'jobtex_candidate_display_filter_btn', 20 );
add_action( 'wp_job_board_pro_before_candidate_archive', 'jobtex_candidate_display_per_page_form', 26 );


$display_mode = jobtex_get_candidates_display_mode();
$inner_style = jobtex_get_candidates_inner_style();
$columns = jobtex_get_candidates_columns();
$bcol = $columns ? 12/$columns : 4;
?>
<div class="candidates-listing-wrapper main-items-wrapper layout-type-<?php echo esc_attr($display_mode); ?>" data-display_mode="<?php echo esc_attr($display_mode); ?>">
	<?php
	/**
	 * wp_job_board_pro_before_candidate_archive
	 */
	do_action( 'wp_job_board_pro_before_candidate_archive', $candidates );
	?>
	<?php
	if ( !empty($candidates) && !empty($candidates->posts) ) {

		/**
		 * wp_job_board_pro_before_loop_candidate
		 */
		do_action( 'wp_job_board_pro_before_loop_candidate', $candidates );
		?>

		<div class="candidates-wrapper items-wrapper">
			<?php if ( $display_mode == 'grid' ) {
			?>
				<div class="row">
					<?php while ( $candidates->have_posts() ) : $candidates->the_post(); ?>
						<div class="col-12 col-sm-6 col-lg-<?php echo esc_attr($bcol); ?>">
							<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'candidates-styles/inner-'.$inner_style ); ?>
						</div>
					<?php endwhile; ?>
				</div>
			<?php } else { ?>
				<div class="row">
					<?php while ( $candidates->have_posts() ) : $candidates->the_post(); ?>
						<div class="col-12 col-lg-<?php echo esc_attr($bcol); ?>">
							<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'candidates-styles/inner-'.$inner_style ); ?>
						</div>
					<?php endwhile; ?>
				</div>
			<?php } ?>
		</div>

		<?php
		/**
		 * wp_job_board_pro_after_loop_candidate
		 */
		do_action( 'wp_job_board_pro_after_loop_candidate', $candidates );

		wp_reset_postdata();
	?>

	<?php } else { ?>
		<div class="not-found"><?php esc_html_e('No candidate found.', 'jobtex'); ?></div>
	<?php } ?>

	<?php
	/**
	 * wp_job_board_pro_after_candidate_archive
	 */
	do_action( 'wp_job_board_pro_after_candidate_archive', $candidates );
	?>
</div>