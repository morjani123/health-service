<?php

global $post;

$img = '';
if ( has_post_thumbnail($post->ID) ) {
	$img = get_the_post_thumbnail_url($post->ID, 'full');
}
?>
<div class="apus-social-share share-blog">
		<h3 class="title"><?php echo esc_html__('Share this post: ','jobtex'); ?> </h3>
		
		<?php if ( jobtex_get_config('facebook_share', 1) ): ?>
 
			<a class="facebook" data-bs-toggle="tooltip" title="Facebook" href="http://www.facebook.com/sharer.php?s=100&u=<?php the_permalink(); ?>&i=<?php echo urlencode($img); ?>" target="_blank" title="<?php echo esc_html__('Share on facebook', 'jobtex'); ?>">
				<i class="fab fa-facebook-f"></i>
			</a>
 
		<?php endif; ?>
		<?php if ( jobtex_get_config('twitter_share', 1) ): ?>
			<a class="twitter" data-bs-toggle="tooltip" title="Twitter" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" title="<?php echo esc_html__('Share on Twitter', 'jobtex'); ?>">
				<i class="fab fa-twitter"></i>
			</a>
 
		<?php endif; ?>
		<?php if ( jobtex_get_config('linkedin_share', 1) ): ?>
 
			<a class="linkedin"  data-bs-toggle="tooltip" title="LinkedIn" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="<?php echo esc_html__('Share on LinkedIn', 'jobtex'); ?>">
				<i class="fab fa-linkedin-in"></i>
			</a>
 
		<?php endif; ?>

		<?php if ( jobtex_get_config('pinterest_share', 1) ): ?>
 
			<a class="pinterest" data-bs-toggle="tooltip" title="Pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;media=<?php echo urlencode($img); ?>" target="_blank" title="<?php echo esc_html__('Share on Pinterest', 'jobtex'); ?>">
				<i class="fab fa-pinterest-p"></i>
			</a>
 
		<?php endif; ?>
</div>