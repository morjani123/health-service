<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

?>
<div class="member-detail-header v2_candidate">
    <div class="top-detail-job">
        <div class="container">
            <div class="job-detail-header-inner">
                <div class="candidate-top-wrapper d-md-flex align-items-center">
                    <?php if ( has_post_thumbnail() ) { ?>
                        <?php jobtex_candidate_display_logo($post, false); ?>
                    <?php } ?>
                    <div class="member-information flex-grow-1 info-detail-job">
                        <?php jobtex_candidate_display_job_title($post); ?>
                        <div class="title-wrapper">
                            <?php
                            $first_name = get_post_meta($post->ID, 'custom-text-45295407', true);
                            $last_name = get_post_meta($post->ID, 'custom-text-42310657', true);
                            ?>
                            <h1 class="member-title">
                                <?php echo trim($first_name) ?>   <?php echo trim($last_name) ?> 
                            </h1>
                            <?php jobtex_candidate_display_featured_icon($post,'icon'); ?>
                        </div>
                        <div class="candidate-metas job-metas-detail">
                            <?php //jobtex_candidate_display_full_location($post, 'icon'); ?>
                            <?php
                                $adresse = get_post_meta($post->ID, 'custom-text-47483678', true);
                                $post_code = get_post_meta($post->ID, 'custom-number-46378320', true);
                              //  $date_birth = get_post_meta($post->ID, 'custom-date-4811235', true);
                               // $formatted_date = date('F j, Y', strtotime($date_birthe));
                              // $candidate_id = get_the_ID();

                                $field_key = 'custom-date-4811235'; // Replace with your actual custom date field key
                                $custom_date_field_value = get_post_meta($post->ID, $field_key,true);

                                $custom_select_field_value = get_post_meta($post->ID,'custom-select-68772490',true);

                                
                                // Format the date (optional)
                                $formatted_date = date('j-F-Y', strtotime($custom_date_field_value));
                            ?>
                            <p class="member-adresse">
                                <?php echo trim($adresse) ?> : <?php echo trim($post_code) ?>
                            </p>
                    </br>
                            <p class="date-birth">
                            Date of birth : <?php echo esc_html($formatted_date); ?>
                            </p>
                            </br>
                            <p class="specialte">
                            specialite : <?php echo esc_html( $custom_select_field_value); ?>
                            </p>
                        </div>
                        <div class="member-metas-bottom job-metas-detail-bottom">
                            <?php jobtex_candidate_display_tags($post); ?>
                            <?php jobtex_candidate_display_salary($post, 'icon'); ?>
                        </div>
                    </div>
                </div>
                <!--<div class="member-detail-buttons d-flex align-items-start justify-content-center justify-content-md-start">
                    <div class="invite">
                        <?php //jobtex_candidate_show_invite($post->ID); ?>
                    </div>
                    <?php //WP_Job_Board_Pro_Candidate::display_shortlist_btn($post->ID); ?>
                </div>-->
            </div>
        </div>
    </div>
</div>