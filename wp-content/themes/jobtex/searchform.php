<?php
/**
 *
 * Search form.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
?>
<div class="widget-search">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="position-relative">
			<button type="submit" class="btn btn-search"><i class="icon-search1"></i></button>
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'jobtex' ); ?>" name="s" class="form-control"/>
			<input type="hidden" name="post_type" value="post" class="post_type" />
		</div>
	</form>
</div>