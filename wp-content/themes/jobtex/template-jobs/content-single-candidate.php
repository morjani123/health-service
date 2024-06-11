<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
?>
<?php do_action( 'wp_job_board_pro_before_job_detail', get_the_ID() ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('candidate-single-v1'); ?>>
	
	<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-candidate/header' ); ?>

	<div class="candidate-content-area <?php echo apply_filters('jobtex_candidate_content_class', 'container');?>">
		<!-- Main content -->
		<div class="row content-single-candidate">
			<div class="col-12 list-content-candidate col-lg-<?php echo esc_attr( is_active_sidebar( 'candidate-single-sidebar' ) ? 8 : 12); ?>">

				<?php do_action( 'wp_job_board_pro_before_job_content', get_the_ID() ); ?>
				
				<!-- job description -->
				<?php if ( jobtex_get_config('show_candidate_description', true) ) { ?>
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-candidate/description' ); ?>
				<?php } ?>

				<?php if ( jobtex_get_config('show_candidate_education', true) ) { ?>
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-candidate/education' ); ?>
				<?php } ?>

				<?php if ( jobtex_get_config('show_candidate_experience', true) ) { ?>
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-candidate/experience' ); ?>
				<?php } ?>

				<?php if ( jobtex_get_config('show_candidate_skill', true) ) { ?>
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-candidate/skill' ); ?>
				<?php } ?>

				<?php if ( jobtex_get_config('show_candidate_award', true) ) { ?>
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-candidate/award' ); ?>
				<?php } ?>

				<?php if ( jobtex_get_config('show_candidate_video', true) ) { ?>
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-candidate/video' ); ?>
				<?php } ?>

				<?php if ( jobtex_get_config('show_candidate_portfolios', true) ) { ?>
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-candidate/portfolios' ); ?>
				<?php } ?>

				<?php if ( jobtex_get_config('show_candidate_map_location', false) ) { ?>
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-candidate/map-location' ); ?>
				<?php } ?>

				<?php
					if ( jobtex_get_config('show_candidate_related', true) ) {
						echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-candidate/related' );
					}
				?>

				<?php if ( jobtex_check_employer_candidate_review($post) ) : ?>
					<!-- Review -->
					<?php comments_template(); ?>
				<?php endif; ?>

				<?php do_action( 'wp_job_board_pro_after_job_content', get_the_ID() ); ?>
			</div>
			<?php if ( is_active_sidebar( 'candidate-single-sidebar' ) ): ?>
				<div class="col-12 col-lg-4 sidebar-job">
			   		<?php dynamic_sidebar( 'candidate-single-sidebar' ); ?>
			   	</div>
		   	<?php endif; ?>

		</div>
	</div>
</article><!-- #post-## -->

<?php do_action( 'wp_job_board_pro_after_job_detail', get_the_ID() ); ?>