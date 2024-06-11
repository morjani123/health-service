<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

?>
<?php do_action( 'wp_job_board_pro_before_job_content', $post->ID ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('map-item layout-job job-list v1'); ?> <?php jobtex_job_item_map_meta($post); ?>>
    <div class="d-flex">
        <div class="flex-shrink-0">
            <?php jobtex_job_display_employer_logo($post); ?>
        </div>
        <div class="job-list-content flex-grow-1">
            <div class="d-flex">
                <div class="inner flex-grow-1">
                    <?php jobtex_job_display_job_first_category($post,'no-icon'); ?>
                    <div class="title-wrapper d-md-flex align-items-center flex-wrap">
                        <?php the_title( sprintf( '<h2 class="job-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                        <?php jobtex_job_display_featured_icon($post,'icon'); ?>
                        <?php
                            $status_label = isset($status_label) ? $status_label : '';
                            echo trim($status_label);
                        ?>
                        <?php jobtex_job_display_filled_label($post); ?>
                    </div>
                </div>
                <div class="ms-auto right-action d-none d-sm-block">
                    <div class="d-flex align-items-center">
                        <?php WP_Job_Board_Pro_Job_Listing::display_shortlist_btn($post->ID); ?>
                        <a class="btn btn-theme" href="<?php echo esc_url( get_permalink()); ?>"><?php echo esc_html__('Apply','jobtex') ?></a>
                    </div>
                </div>
            </div>
            <div class="job-metas">
                <?php jobtex_job_display_full_location($post, 'icon'); ?>
                <?php jobtex_job_display_postdate($post, 'icon'); ?>
            </div>
        </div>
    </div>
    <div class="job-metas-bottom">
        <?php jobtex_job_display_job_type($post); ?>
        <?php jobtex_job_display_urgent_icon($post); ?>
    </div>
    <div class="right-action d-block d-sm-none">
        <div class="d-flex align-items-center">
            <?php WP_Job_Board_Pro_Job_Listing::display_shortlist_btn($post->ID); ?>
            <a class="btn btn-theme" href="<?php echo esc_url( get_permalink()); ?>"><?php echo esc_html__('Apply','jobtex') ?></a>
        </div>
    </div>
    <div class="info-bottom d-flex align-items-center flex-wrap">
        <?php jobtex_job_display_salary($post, 'icon'); ?>
        <div class="ms-auto">
            <?php jobtex_job_display_deadline($post); ?>
        </div>
    </div>
</article><!-- #post-## -->
<?php do_action( 'wp_job_board_pro_after_job_content', $post->ID ); ?>