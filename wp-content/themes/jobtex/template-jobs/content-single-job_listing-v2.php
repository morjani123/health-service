<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;

$style = '';
if (has_post_thumbnail()) {
    $img_bg_src = wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), '1900x420' );
    $style = 'style=background-image:url('.esc_url($img_bg_src).')';
} elseif ( jobtex_get_config('job_header_bg_image') ) {
	$style = 'style=background-image:url('.esc_url(jobtex_get_config('job_header_bg_image')).')';
}
?>
<?php do_action( 'wp_job_board_pro_before_job_detail', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('job-single-v2'); ?>>
	<div class="top-img-detail" <?php echo esc_attr($style); ?>></div>
	<div class="job-content-area <?php echo apply_filters('jobtex_job_content_class', 'container');?>">
		<!-- Main content -->
		<div class="row content-job-detail">

			<div class="list-content-job col-12 col-lg-<?php echo esc_attr( is_active_sidebar( 'job-single-sidebar' ) ? 8 : 12); ?>">
				<?php do_action( 'wp_job_board_pro_before_job_content', $post->ID ); ?>
				<!-- heading -->
				<?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'single-job_listing/header-v2' ); ?>

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
			
			<?php if ( is_active_sidebar( 'job-single-sidebar' ) ): ?>
				<div class="col-lg-4 col-12">
					<div class="sidebar-job sticky-top">
				   		<?php dynamic_sidebar( 'job-single-sidebar' ); ?>
				   	</div>
			   	</div>
		   	<?php endif; ?>
		   	
		</div>
	</div>

</article><!-- #post-## -->

<?php do_action( 'wp_job_board_pro_after_job_detail', $post->ID ); ?>