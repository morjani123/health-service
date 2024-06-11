<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Jobtex
 * @since Jobtex 1.0
 */
/*
*Template Name: 404 Page
*/
get_header();
$icon = jobtex_get_config('404_icon_img');

$img_url = get_template_directory_uri().'/images/error.jpg';
if ( !empty($icon) ) {
	$img_url = $icon;
}
?>
<section class="page-404">
	<div id="main-container" class="inner">
		<div id="main-content" class="main-page">
			<section class="error-404 not-found clearfix">
				<div class="container">
					<div class="clearfix text-center">
						<div class="top-image">
							<img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
						</div>
						<div class="slogan">
							<h4 class="title-big">
								<?php
								$title = jobtex_get_config('404_title');
								if ( !empty($title) ) {
									echo esc_html($title);
								} else {
									esc_html_e('Oops! That page can&rsquo;t be found.', 'jobtex');
								}
								?>
							</h4>
						</div>
						<div class="page-content">
							<div class="description">
								<?php
								$description = jobtex_get_config('404_description');
								if ( !empty($description) ) {
									echo esc_html($description);
								} else {
									esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'jobtex');
								}
								?>
							</div>
							<div class="return">
								<a class="btn-theme btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<?php
									$btn_text = jobtex_get_config('404_btn_text');
									if ( !empty($btn_text) ) {
										echo esc_html($btn_text);
									} else {
										esc_html_e('Go To Home Page', 'jobtex');
									}
									?>	
								</a>
							</div>
						</div><!-- .page-content -->
					</div>
				</div>
			</section><!-- .error-404 -->
		</div><!-- .content-area -->
	</div>
</section>
<?php get_footer(); ?>