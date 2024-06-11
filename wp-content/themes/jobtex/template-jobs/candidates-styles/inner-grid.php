<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;

?>
<?php do_action( 'wp_job_board_pro_before_candidate_content', $post->ID ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('map-item candidate-card'); ?> <?php jobtex_candidate_item_map_meta($post); ?>>
    <div class="candidate-grid candidate-archive-layout">
        <?php WP_Job_Board_Pro_Candidate::display_shortlist_btn($post->ID); ?>
        <?php jobtex_candidate_display_featured_icon($post); ?>

        <?php jobtex_candidate_display_logo($post); ?>
        <?php
        $title = jobtex_candidate_name($post);
        ?>
        <?php jobtex_candidate_display_job_title($post); ?>
        <h2 class="candidate-title">
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php echo trim($title) ?>
            </a>
        </h2>
        <div class="candidate-info">
            <div class="job-metas">
                <?php jobtex_candidate_display_short_location($post, 'icon'); ?>
                <?php jobtex_candidate_display_salary($post, 'icon'); ?>
            </div>
            <?php jobtex_candidate_display_tags_version2($post); ?>
        </div>
        <div class="candidate-link">
	        <a href="<?php the_permalink(); ?>" class="btn w-100 btn-theme btn-outline btn-inside"><?php esc_html_e('View Profile', 'jobtex'); ?></a>
    	</div>
    </div>
</article><!-- #post-## -->
<?php do_action( 'wp_job_board_pro_after_candidate_content', $post->ID ); ?>