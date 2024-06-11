<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

?>

<?php do_action( 'wp_job_board_pro_before_employer_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('map-item employer-card'); ?> <?php jobtex_employer_item_map_meta($post); ?>>
    <div class="employer-list layout-employer">
        <div class="d-md-flex align-items-center">
            <div class="inner-left d-flex align-items-center">
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="flex-shrink-0 wrapper-logo">
                        <?php jobtex_employer_display_logo($post); ?>
                    </div>
                <?php } ?>
                <div class="info-employer flex-grow-1">
                    <?php jobtex_employer_display_category_first($post); ?>
                    <div class="title-wrapper d-md-flex align-items-center flex-wrap">    
                        <?php
                        $title = jobtex_employer_name($post);
                        ?>
                        <h2 class="employer-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                <?php echo trim($title); ?>
                            </a>
                        </h2>
                        <?php jobtex_employer_display_featured_icon($post, 'icon'); ?>
                    </div>
                    <div class="employer-metas">
                        <?php jobtex_employer_display_full_location($post,'icon'); ?>
                    </div>
                </div>
            </div>
            <div class="ms-auto">
                <div class="d-flex align-items-center flex-wrap right-inner">
                    <?php jobtex_employer_display_follow_btn($post->ID); ?>
                    <?php jobtex_employer_display_open_position($post, true); ?>
                </div>
            </div>
        </div>
    </div>
</article><!-- #post-## -->
<?php do_action( 'wp_job_board_pro_after_employer_content', $post->ID ); ?>