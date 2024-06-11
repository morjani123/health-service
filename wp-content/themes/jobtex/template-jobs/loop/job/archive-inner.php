<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
remove_action('wp_job_board_pro_before_job_archive', array( 'WP_Job_Board_Pro_Job_Listing', 'display_jobs_count_results'), 10 );
$layout_type = jobtex_get_jobs_layout_type();
if ( $layout_type !== 'half-map' && $layout_type !== 'half-job-details' && $layout_type !== 'half-job-details-v2' ) {
	add_action('wp_job_board_pro_before_job_archive', array( 'WP_Job_Board_Pro_Job_Listing', 'display_jobs_count_results'), 20 );
}

remove_action( 'wp_job_board_pro_before_job_archive', array( 'WP_Job_Board_Pro_Job_Listing', 'display_job_feed' ), 22 );
remove_action( 'wp_job_board_pro_before_job_archive', array( 'WP_Job_Board_Pro_Job_Listing', 'display_jobs_alert_form' ), 20 );

add_action( 'wp_job_board_pro_before_job_archive', 'jobtex_job_display_filter_btn', 19 );
add_action( 'wp_job_board_pro_before_job_archive', 'jobtex_job_display_per_page_form', 26 );

jobtex_job_display_topbar_sidebar();
jobtex_job_display_topbar_sidebar_v2();
?>
<div class="jobs-listing-wrapper main-items-wrapper" data-display_mode="<?php echo esc_attr($jobs_display_mode); ?>">
	<?php
	/**
	 * wp_job_board_pro_before_job_archive
	 */
	do_action( 'wp_job_board_pro_before_job_archive', $jobs );
	?>

	<?php if ( !empty($jobs) && !empty($jobs->posts) ) : ?>

		<?php
		if ( $layout_type !== 'half-job-details' && $layout_type !== 'half-job-details-v2' ) {
			/**
			 * wp_job_board_pro_before_loop_job
			 */
			do_action( 'wp_job_board_pro_before_loop_job', $jobs );
			?>
			
			<div class="jobs-wrapper items-wrapper">
				<?php 
					$columns = jobtex_get_jobs_columns();
					$bcol = $columns ? 12/$columns : 4;
				?>
				<div class="row row-items items-wrapper-<?php echo esc_attr($job_inner_style); ?>">
					<?php while ( $jobs->have_posts() ) : $jobs->the_post(); ?>
						<div class="item-job <?php echo esc_attr($columns > 1 ? 'col-sm-6' : ''); ?> col-lg-<?php echo esc_attr($bcol); ?> col-12">
							<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'jobs-styles/inner-'.$job_inner_style ); ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>

			<?php
			/**
			 * wp_job_board_pro_after_loop_job
			 */
			do_action( 'wp_job_board_pro_after_loop_job', $jobs );
			
			wp_reset_postdata();
			
		} else {
			?>
			<div class="wrapper-half-detail">
				<div class="row">
					<div class="col-12 col-lg-5">
						
						<?php
						/**
						 * wp_job_board_pro_before_loop_job
						 */
						do_action( 'wp_job_board_pro_before_loop_job', $jobs );
						?>
						
						<div class="jobs-wrapper items-wrapper">
							<?php 
								$columns = jobtex_get_jobs_columns();
								$bcol = $columns ? 12/$columns : 4;
							?>
							<div class="row row-items items-wrapper-<?php echo esc_attr($job_inner_style); ?>">
								<?php $i=0; while ( $jobs->have_posts() ) : $jobs->the_post();
									global $post;
									$classes = '';
									if ( $i == 0 ) {
										$classes = 'active';
									}
								?>
									<div class="item-job <?php echo esc_attr($classes); ?> <?php echo esc_attr($columns > 1 ? 'col-sm-6' : ''); ?> col-lg-<?php echo esc_attr($bcol); ?> col-12" data-job_id="<?php echo esc_attr($post->ID); ?>">
										<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'jobs-styles/inner-'.$job_inner_style ); ?>
									</div>
								<?php $i++; endwhile; ?>
							</div>
						</div>

						<?php
						/**
						 * wp_job_board_pro_after_loop_job
						 */
						do_action( 'wp_job_board_pro_after_loop_job', $jobs );
						
						wp_reset_postdata();

						echo WP_Job_Board_Pro_Template_Loader::get_template_part('loop/job/pagination', array('jobs' => $jobs));
						?>

					</div><!-- .content-area -->
					<div class="col-lg-7">
						<div id="job-details-wrapper" class="d-none d-lg-block sticky-top">
							<?php
								$job = $jobs->posts[0];
								setup_postdata( $GLOBALS['post'] =& $job );

								echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'content-single-archive-job_listing' );

								wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>

	<?php else : ?>
		<div class="not-found"><?php esc_html_e('No job found.', 'jobtex'); ?></div>
	<?php endif; ?>

	<?php
	/**
	 * wp_job_board_pro_after_job_archive
	 */
	do_action( 'wp_job_board_pro_after_job_archive', $jobs );
	?>
</div>