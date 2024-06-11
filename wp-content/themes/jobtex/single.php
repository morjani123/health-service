<?php
get_header();

$sidebar_configs = jobtex_get_blog_layout_configs();
$checksidebar = (!empty(jobtex_get_config('blog_single_layout'))) ? jobtex_get_config('blog_single_layout'):'';
$single_style = jobtex_get_config('blog_single_style');

$get_style = '';
if ( defined('JOBTEX_DEMO_MODE') && JOBTEX_DEMO_MODE ) {
    if (!empty($_GET['style']) && ($_GET['style'] =='nosidebar') ){
        $sidebar_configs['main'] = array( 'class' => 'col-12' );
        $sidebar_configs['right']['class'] = $sidebar_configs['left']['class'] = 'd-none';
        $checksidebar = 'main';
    } elseif(!empty($_GET['style']) && ($_GET['style'] =='style1')) {
    	$single_style ="v1";
    	$sidebar_configs['main'] = array( 'class' => 'col-12' );
        $sidebar_configs['right']['class'] = $sidebar_configs['left']['class'] = 'd-none';
        $checksidebar = 'main';
    } else {
        $_GET['style']="";
    }
}
if ( isset($_GET['style']) ) {
    $get_style = $_GET['style'];
}

?>
<?php if($single_style == 'v1'){ ?>
    <?php get_template_part( 'template-posts/single/header-v1' ); ?>
<?php } ?>
<section id="main-container" class="wrapper-single-post main-content <?php echo apply_filters( 'jobtex_blog_content_class', 'container' ); ?> inner <?php echo trim($checksidebar); ?>">
	<?php jobtex_before_content( $sidebar_configs ); ?>
	<div class="row">
		<?php jobtex_display_sidebar_left( $sidebar_configs ); ?>
		<div id="main-content" class="<?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<div id="primary" class="content-area">
				<div id="content" class="site-content detail-post" role="main">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'template-posts/single/content', null, array('single_style' => $single_style) );
							
			                
						// End the loop.
						endwhile;
					?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>	
		<?php jobtex_display_sidebar_right( $sidebar_configs ); ?>
	</div>
	<?php 
        if ( jobtex_get_config('show_blog_related', false) ) {
            get_template_part( 'template-posts/single/posts-related' );
        }
    ?>
</section>
<?php get_footer(); ?>