<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
$author_id = jobtex_get_post_author($post->ID);
?>
<div class="top-detail-job">
    <div class="job-detail-header-inner">
        <div class="row d-md-flex">
            <div class="col-md-7 col-12">
                <div class="d-md-flex align-items-center">
                    <?php
                        jobtex_job_display_employer_logo($post, true, true);
                    ?>
                    <div class="info-detail-job flex-grow-1">
                        <?php jobtex_job_display_employer_title($post); ?>
                        <div class="title-wrapper d-md-flex align-items-center">
                            <?php the_title( '<h1 class="job-detail-title">', '</h1>' ); ?>
                            <?php jobtex_job_display_featured_icon($post); ?>
                            <?php jobtex_job_display_filled_label($post); ?>
                        </div>
                        <div class="job-metas-detail">
                            <?php jobtex_job_display_full_location($post, 'icon'); ?>
                            <?php jobtex_job_display_postdate($post, 'icon'); ?>
                            
                        </div>
                        <div class="job-metas-detail-bottom">
                            <?php jobtex_job_display_job_type($post); ?>
                            <?php jobtex_job_display_urgent_icon($post); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="job-detail-buttons col-md-5 col-12">
                <div class="action">
                    <!-- job social -->
                    <?php if ( jobtex_get_config('show_job_social_share', true) ) { ?>
                            <?php get_template_part( 'template-parts/sharebox-job' );  ?>
                    <?php } ?>
                    <?php WP_Job_Board_Pro_Job_Listing::display_shortlist_btn($post->ID); ?>
                    <?php WP_Job_Board_Pro_Job_Listing::display_apply_job_btn($post->ID); ?>
                    <?php jobtex_job_display_deadline($post, 'title'); ?>
                </div>
                <?php jobtex_job_display_salary($post, 'icon'); ?>
            </div>
        </div>
    </div> 
</div>