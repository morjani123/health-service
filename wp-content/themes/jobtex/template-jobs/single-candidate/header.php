<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

?>
<div class="member-detail-header v1">
    <div class="top-detail-job">
        <div class="container">
            <div class="job-detail-header-inner v-candidate">
                <div class="row d-md-flex align-items-center">
                    <div class="col-12 col-md-8">
                        <div class="candidate-top-wrapper d-md-flex align-items-center">
                            <?php if ( has_post_thumbnail() ) { ?>
                                <?php jobtex_candidate_display_logo($post, false); ?>
                            <?php } ?>
                            <div class="member-information flex-grow-1 info-detail-job">
                                <?php jobtex_candidate_display_job_title($post); ?>
                                <div class="title-wrapper">
                                    <?php
                                    $title = jobtex_candidate_name($post);
                                    ?>
                                    <h1 class="member-title">
                                        <?php echo trim($title) ?>
                                    </h1>
                                    <?php jobtex_candidate_display_featured_icon($post,'icon'); ?>
                                </div>
                                <div class="candidate-metas job-metas-detail">
                                    <?php jobtex_candidate_display_full_location($post, 'icon'); ?>
                                </div>
                                <div class="member-metas-bottom job-metas-detail-bottom">
                                    <?php jobtex_candidate_display_tags($post); ?>
                                    <?php jobtex_candidate_display_salary($post, 'icon'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="member-detail-buttons">
                            <div class="invite">
                                <?php jobtex_candidate_show_invite($post->ID); ?>
                            </div>
                            <?php WP_Job_Board_Pro_Candidate::display_shortlist_btn($post->ID); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>