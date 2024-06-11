<?php

global $post;

$author_id = jobtex_get_post_author($post->ID);
$employer_id = WP_Job_Board_Pro_User::get_employer_by_user_id($author_id);
$img = '';
if ( has_post_thumbnail($employer_id) ) {
	$img = get_the_post_thumbnail_url($employer_id, 'full');
}

?>
<div class="apus-social-share share-listing position-relative">
		<span class="icon-share"><i class="icon-share2"></i></span>
		<div class="bo-social-icons">
		<?php if ( jobtex_get_config('facebook_share', 1) ): ?>
 
			<a class="facebook" data-toggle="tooltip" data-original-title="Facebook" href="http://www.facebook.com/sharer.php?s=100&u=<?php the_permalink(); ?>&i=<?php echo urlencode($img); ?>" target="_blank" title="<?php echo esc_html__('Share on facebook', 'jobtex'); ?>">
				<i class="fab fa-facebook-f"></i>
			</a>
 
		<?php endif; ?>
		<?php if ( jobtex_get_config('twitter_share', 1) ): ?>
			<a class="twitter" data-toggle="tooltip" data-original-title="Twitter" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank" title="<?php echo esc_html__('Share on Twitter', 'jobtex'); ?>">
				<i class="fab fa-twitter"></i>
			</a>
 
		<?php endif; ?>
		<?php if ( jobtex_get_config('linkedin_share', 1) ): ?>
 
			<a class="linkedin"  data-toggle="tooltip" data-original-title="LinkedIn" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" title="<?php echo esc_html__('Share on LinkedIn', 'jobtex'); ?>">
				<i class="fab fa-linkedin-in"></i>
			</a>
 
		<?php endif; ?>

		<?php if ( jobtex_get_config('pinterest_share', 1) ): ?>
 
			<a class="pinterest" data-toggle="tooltip" data-original-title="Pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;media=<?php echo urlencode($img); ?>" target="_blank" title="<?php echo esc_html__('Share on Pinterest', 'jobtex'); ?>">
				<i class="fab fa-pinterest-p"></i>
			</a>
 
		<?php endif; ?>
		</div>
</div>