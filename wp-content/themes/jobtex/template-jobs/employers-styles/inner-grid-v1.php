<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

?>

<?php do_action( 'wp_job_board_pro_before_employer_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('map-item employer-card'); ?> <?php jobtex_employer_item_map_meta($post); ?>>
    <div class="employer-grid v1 layout-employer">
        <?php jobtex_employer_display_follow_btn($post->ID); ?>
        <?php jobtex_employer_display_logo($post); ?>
        <?php
        $title = jobtex_employer_name($post);
        ?>
        <div class="employer-information">
            <?php jobtex_employer_display_category_first($post); ?>
            <div class="title-wrapper d-md-flex align-items-center flex-wrap justify-content-center">
                <h2 class="employer-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                        <?php echo trim($title); ?>
                    </a>
                </h2>
                <?php jobtex_employer_display_featured_icon($post, 'icon'); ?>
            </div>
            <div class="employer-metas">
                <?php jobtex_employer_display_full_location($post, 'icon'); ?>
            </div>
            <?php jobtex_employer_display_open_position($post, true); ?>
        </div>
    </div>
</article><!-- #post-## -->

<?php do_action( 'wp_job_board_pro_after_employer_content', $post->ID ); ?>