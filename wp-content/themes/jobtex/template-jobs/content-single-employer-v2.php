<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
$meta_obj = WP_Job_Board_Pro_Employer_Meta::get_instance($post->ID);
$cover_photo_url = $meta_obj->get_post_meta('cover_photo');
$style = '';
if ( !empty($cover_photo_url) ) {
    $style = 'style=background-image:url('.$cover_photo_url.');';
} elseif ( jobtex_get_config('employer_header_bg_image') ) {
    $style = 'style=background-image:url('.esc_url(jobtex_get_config('employer_header_bg_image')).')';
}
?>

<?php do_action( 'wp_job_board_pro_before_job_detail', $post->ID ); ?>

<article id="post-<?php echo esc_attr($post->ID); ?>" <?php post_class('employer-single-v2'); ?>>
	<div class="top-img-detail"<?php echo esc_attr($style); ?>></div>
	<div class="employer-content-area <?php echo apply_filters('jobtex_employer_content_class', 'container');?>">
		<!-- Main content -->
		<div class="row content-single-candidate">
			<div class="col-12 list-content-candidate col-lg-<?php echo esc_attr( is_active_sidebar( 'employer-single-sidebar' ) ? 8 : 12); ?>">

				<?php do_action( 'wp_job_board_pro_before_employer_content', $post->ID ); ?>

				<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-employer/header-v2' ); ?>

				<!-- employer description -->
				<?php if ( jobtex_get_config('show_employer_description', true) ) { ?>
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-employer/description' ); ?>
				<?php } ?>
				
				<?php if ( jobtex_get_config('show_employer_socials', true) ) { ?>
					<!-- Socials -->
					<div class="sharebox-job">
						<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-employer/socials' ); ?>
					</div>
				<?php } ?>

				<?php if ( jobtex_get_config('show_employer_video', true) ) { ?>
					<!-- Video -->
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-employer/video' ); ?>
				<?php } ?>

				<?php if ( jobtex_get_config('show_employer_photos', true) ) { ?>
					<!-- profile photos -->
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-employer/profile-photos' ); ?>
				<?php } ?>
				
				<?php if ( jobtex_get_config('show_employer_open_jobs', true) ) { ?>
					<!-- employer related -->
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-employer/open-jobs' ); ?>
				<?php } ?>

				<?php if ( jobtex_get_config('show_employer_members', true) ) { ?>
					<!-- team member -->
					<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-employer/members' ); ?>
				<?php } ?>

				<?php if ( jobtex_check_employer_candidate_review($post) ) : ?>
					<!-- Review -->
					<?php comments_template(); ?>
				<?php endif; ?>

				<?php do_action( 'wp_job_board_pro_after_employer_content', $post->ID ); ?>
			</div>
			<?php if ( is_active_sidebar( 'employer-single-sidebar' ) ): ?>
				<div class="col-lg-4 col-12 sidebar-job">
		   			<?php dynamic_sidebar( 'employer-single-sidebar' ); ?>
		   		</div>
	   		<?php endif; ?>
		</div>
	</div>

</article><!-- #post-## -->

<?php do_action( 'wp_job_board_pro_after_job_detail', $post->ID ); ?>