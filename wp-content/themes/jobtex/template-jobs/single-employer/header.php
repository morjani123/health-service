<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$meta_obj = WP_Job_Board_Pro_Employer_Meta::get_instance($post->ID);
$cover_photo_url = $meta_obj->get_post_meta('cover_photo');
$style = '';
if ( !empty($cover_photo_url) ) {
    $style = 'style=background-image:url('.$cover_photo_url.');';
} elseif ( jobtex_get_config('employer_header_bg_image') ) {
    $style = 'style=background-image:url('.esc_url(jobtex_get_config('employer_header_bg_image')).')';
}
?>
<div class="member-detail-header job-detail-header v1">
    <div class="top-img-detail" <?php echo esc_attr($style); ?>></div>
    <div class="top-detail-job position-relative">
        <div class="container">
            <div class="job-detail-header-inner">
                <div class="d-md-flex row">
                    <div class="col-md-8 col-12">  
                        <div class="d-md-flex align-items-center">
                            <?php if ( has_post_thumbnail() ) { ?>
                                <?php jobtex_employer_display_logo($post, false); ?>
                            <?php } ?>

                            <div class="member-information flex-grow-1 info-detail-job">
                                <div class="title-wrapper">
                                    <?php
                                    $title = jobtex_employer_name($post);
                                    ?>
                                    <h1 class="member-title">
                                        <?php echo trim($title); ?>
                                    </h1>
                                    <?php jobtex_employer_display_featured_icon($post,'icon'); ?>
                                </div>

                                <div class="candidate-metas job-metas-detail">
                                    <?php jobtex_employer_display_full_location($post, 'icon'); ?>
                                </div>

                                <div class="member-metas-bottom job-metas-detail-bottom">
                                    <?php jobtex_employer_display_follow_btn($post->ID, 'text'); ?>
                                    <?php jobtex_employer_display_nb_jobs($post); ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="member-detail-buttons">
                            <?php
                                if ( jobtex_is_wp_private_message() ) {
                                    $user_id = WP_Job_Board_Pro_User::get_user_by_employer_id($post->ID);
                                    jobtex_private_message_form($post, $user_id);
                                }
                                if ( jobtex_check_employer_candidate_review($post) ) {
                            ?>
                                    <a class="btn btn-theme btn-outline btn-link-review" href="#review_form_wrapper"><?php echo esc_html__('Write a review','jobtex'); ?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>