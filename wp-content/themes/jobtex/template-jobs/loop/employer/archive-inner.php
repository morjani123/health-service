<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$layout_type = jobtex_get_employers_layout_type();
if ( $layout_type == 'half-map' ) {
	remove_action( 'wp_job_board_pro_before_employer_archive', array( 'WP_Job_Board_Pro_Employer', 'display_employers_count_results' ), 10 );
}
add_action( 'wp_job_board_pro_before_employer_archive', 'jobtex_employer_display_filter_btn', 10 );
add_action( 'wp_job_board_pro_before_employer_archive', 'jobtex_employer_display_per_page_form', 26 );

$display_mode = jobtex_get_employers_display_mode();
$inner_style = jobtex_get_employers_inner_style();
$columns = jobtex_get_employers_columns();
$bcol = $columns ? 12/$columns : 4;
if($inner_style =='list' || $inner_style =='list-v1'){
	$addclass = 'col-lg-'.$bcol.' col-md-12 col-12';
} else {
	$addclass = 'col-lg-'.$bcol.' col-sm-6 col-12';
}
?>
<div class="employers-listing-wrapper main-items-wrapper layout-type-<?php echo esc_attr($display_mode); ?>" data-display_mode="<?php echo esc_attr($display_mode); ?>">
	<?php
	/**
	 * wp_job_board_pro_before_employer_archive
	 */
	do_action( 'wp_job_board_pro_before_employer_archive', $employers );
	?>
	<?php
	if ( !empty($employers) && !empty($employers->posts) ) {

		/**
		 * wp_job_board_pro_before_loop_employer
		 */
		do_action( 'wp_job_board_pro_before_loop_employer', $employers );
		?>

		<div class="employers-wrapper items-wrapper">
			<div class="row">
				<?php while ( $employers->have_posts() ) : $employers->the_post(); ?>
					<div class="<?php echo esc_attr($addclass); ?>">
						<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'employers-styles/inner-'.$inner_style ); ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>

		<?php
		/**
		 * wp_job_board_pro_after_loop_employer
		 */
		do_action( 'wp_job_board_pro_after_loop_employer', $employers );

		wp_reset_postdata();
	?>

	<?php } else { ?>
		<div class="not-found"><?php esc_html_e('No employer found.', 'jobtex'); ?></div>
	<?php } ?>

	<?php
	/**
	 * wp_job_board_pro_after_employer_archive
	 */
	do_action( 'wp_job_board_pro_after_employer_archive', $employers );
	?>
</div>