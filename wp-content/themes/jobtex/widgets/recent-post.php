<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
extract( $args );

extract( $args );
extract( $instance );

echo trim($before_widget);
global $post;
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}
$args = array(
	'post_type' => 'post',
	'posts_per_page' => $number_post
);
$query = new WP_Query($args);
if($query->have_posts()):
?>
<div class="post-widget">
<ul class="posts-list">
<?php
	while($query->have_posts()):$query->the_post();
?>
	<li>
		<article class="post post-list">
		    <div class="d-flex align-items-center">
		    	<?php
					if(has_post_thumbnail()){
				?>
					<div class="image-left flex-shrink-0">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'thumbnail' ); ?>
						</a>
					</div>
				<?php } ?>
				<div class="content-info flex-grow-1">
					<?php jobtex_post_categories_first($post); ?>
			        <?php
			              if (get_the_title()) {
			              ?>
			                  <h4 class="entry-title">
			                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			                  </h4>
			              <?php
			          }
			        ?>
			    </div>
		    </div>
		</article>
	</li>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</ul>
</div>
<?php endif; ?>

<?php echo trim($after_widget);