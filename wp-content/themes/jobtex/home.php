<?php
get_header();
$sidebar_configs = jobtex_get_blog_layout_configs();
$layout = jobtex_get_config( 'blog_display_mode', 'list' );

jobtex_render_breadcrumbs();

$columns = jobtex_get_config('blog_columns', 1);
$thumbsize = !isset($thumbsize) ? jobtex_get_config( 'blog_item_thumbsize', '450x290' ) : $thumbsize;

$get_style = '';
if ( defined('JOBTEX_DEMO_MODE') && JOBTEX_DEMO_MODE ) {
	if (!empty($_GET['style']) && ($_GET['style'] =='gridfull') ){
		$columns = 3;
	    $layout = 'grid';
	    $sidebar_configs['main'] = array( 'class' => 'col-12' );
	    $sidebar_configs['right']['class'] = $sidebar_configs['left']['class'] = 'd-none';
	    $thumbsize = '450x300';
	} else {
		$_GET['style']="";
	}
}
if ( isset($_GET['style']) ) {
	$get_style = $_GET['style'];
}
?>
<section id="main-container" class="page-blog home-page-default <?php echo apply_filters('jobtex_blog_content_class', 'container');?> inner">
	<?php ( (empty($sidebar_configs['left']) && empty($sidebar_configs['right'])) || ($get_style =='gridfull') )?'': jobtex_before_content( $sidebar_configs ); ?>
	<div class="row">
		<?php jobtex_display_sidebar_left( $sidebar_configs ); ?>

		<div id="main-content" class="<?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<div id="main" class="site-main layout-blog" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header d-none">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				get_template_part( 'template-posts/layouts/'.$layout, null, array('columns' => $columns, 'thumbsize' => $thumbsize) );

				// Previous/next page navigation.
				jobtex_paging_nav();

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-posts/content', 'none' );

			endif;
			?>

			</div><!-- .site-main -->
		</div><!-- .content-area -->
		
		<?php jobtex_display_sidebar_right( $sidebar_configs ); ?>
		
	</div>
</section>
<?php get_footer(); ?>