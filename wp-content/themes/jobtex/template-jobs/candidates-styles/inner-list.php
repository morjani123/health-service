<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

$rating_avg = WP_Job_Board_Pro_Review::get_ratings_average($post->ID);
$tags = get_the_terms( $post->ID, 'candidate_tag' );
$salary = WP_Job_Board_Pro_Candidate::get_salary_html($post->ID);
?>

<?php do_action( 'wp_job_board_pro_before_candidate_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('map-item candidate-card'); ?> <?php jobtex_candidate_item_map_meta($post); ?>>
    <div class="candidate-list candidate-archive-layout">
        <div class="d-md-flex align-items-center">
            <div class="candidate-info">
                <div class="d-flex align-items-center">
                    <?php jobtex_candidate_display_logo($post); ?>
                    <div class="candidate-info-content">
                        <?php jobtex_candidate_display_job_title($post); ?>
                        <div class="title-wrapper">
                            <?php
                            $title = jobtex_candidate_name($post);
                            ?>
                            <h2 class="candidate-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php echo trim($title) ?>
                                </a>
                            </h2>

                            <?php jobtex_candidate_display_featured_icon($post,'icon'); ?>
                        </div>
                        <div class="candidate-metas">
                            <?php jobtex_candidate_display_full_location($post, 'icon'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ms-auto mt-2 mt-md-0">
                <div class="d-flex flex-md-column align-items-md-end align-items-center">
                    <?php WP_Job_Board_Pro_Candidate::display_shortlist_btn($post->ID); ?>
                    <a href="<?php the_permalink(); ?>" class="btn btn-theme btn-outline btn-inside"><?php esc_html_e('View Profile', 'jobtex'); ?></a>
                </div>
            </div>
        </div>
        <?php if($tags || $salary) {?>
            <div class="d-flex align-items-center bottom-info">
                <?php jobtex_candidate_display_tags_version2($post); ?>
                <div class="ms-auto candidate-metas">
                    <?php jobtex_candidate_display_salary($post, 'icon'); ?>
                </div>
            </div>
        <?php } ?>
    </div>
</article><!-- #post# -->
<?php do_action( 'wp_job_board_pro_after_candidate_content', $post->ID ); ?>