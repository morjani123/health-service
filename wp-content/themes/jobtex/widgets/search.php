<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
extract( $args );

extract( $args );
extract( $instance );

echo trim($before_widget);
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  .trim( $title ) . $after_title;
}

?>
<div class="widget-search">
    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
    	<div class="position-relative">
			<input type="text" placeholder="<?php esc_attr_e( 'keywords', 'jobtex' ); ?>" name="s" class="apus-search form-control"/>
			<button type="submit" class="btn btn-search"><i class="icon-search1"></i></button>
			<?php if ( isset($post_type) && $post_type ): ?>
				<input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>" class="post_type" />
			<?php endif; ?>
		</div>
	</form>
</div>
<?php echo trim($after_widget);