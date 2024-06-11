<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
?>

<?php do_action( 'wp_job_board_pro_before_job_detail', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('job-single-v1'); ?>>

	<!-- heading -->
	<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-job_listing/header-v2' ); ?>

	<div class="job-content-area">
		<!-- Main content -->
		<div class="content-job-detail">
			<div class="list-content-job">

				<?php do_action( 'wp_job_board_pro_before_job_content', $post->ID ); ?>
				
				<!-- job description -->
				<?php
				if ( jobtex_get_config('show_job_description', true) ) {
					echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-job_listing/description' );
				}
				?>

				<!-- job social -->
				<?php if ( jobtex_get_config('show_job_social_share', true) ) { ?>
					<div class="sharebox-job">
	        			<?php get_template_part( 'template-parts/sharebox' );  ?>
	        		</div>
	            <?php } ?>

				<?php
				if ( jobtex_get_config('show_job_photos', true) ) {
					echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-job_listing/photos' );
				}
				?>

				<?php
				if ( jobtex_get_config('show_job_video', true) ) {
					echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-job_listing/video' );
				}
				?>

	            <!-- job related -->
	            <?php
		            if ( jobtex_get_config('show_job_related', true) ) {
		            	echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-job_listing/related' );
		            }
	            ?>

				<?php do_action( 'wp_job_board_pro_after_job_content', $post->ID ); ?>
			</div>
			
		</div>
	</div>

</article><!-- #post-## -->

<?php do_action( 'wp_job_board_pro_after_job_detail', $post->ID ); ?>