<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
extract( $args );

global $post;
if ( empty($post->post_type) || $post->post_type != 'candidate' ) {
    return;
}
extract( $args );
extract( $instance );

echo trim($before_widget);
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}

$meta_obj = WP_Job_Board_Pro_Candidate_Meta::get_instance($post->ID);

$salary = WP_Job_Board_Pro_Candidate::get_salary_html($post->ID);

$experience_time = jobtex_candidate_display_meta($post, 'experience_time');
$gender = jobtex_candidate_display_meta($post, 'gender');
$age = jobtex_candidate_display_meta($post, 'age');
$qualification = jobtex_candidate_display_meta($post, 'qualification');
$languages = jobtex_candidate_display_meta($post, 'languages');


$email = jobtex_candidate_display_email($post, false, false);
$phone = jobtex_candidate_display_phone($post, false, false);

$website = jobtex_candidate_display_meta($post, 'website');
$marital_status = get_post_meta($post->ID, 'custom-select-4590441', true);
$$marital_status = get_post_meta($post->ID, 'custom-select-4590441', true);
$service= get_post_meta($post->ID, 'custom-text-63111645', true);


if ( $meta_obj->check_post_meta_exist('socials') && ($socials = $meta_obj->get_post_meta( 'socials' )) ) {
    $all_socials = WP_Job_Board_Pro_Mixes::get_socials_network();
}

if ( !WP_Job_Board_Pro_Candidate::check_restrict_view_contact_info($post) && wp_job_board_pro_get_option('restrict_contact_candidate_download_cv', 'on') == 'on' ) {
    $cv_attachment = '';
} else {
    $cv_attachment = WP_Job_Board_Pro_Candidate::get_display_cv_download( $post );
}

?>
<div class="job-detail-detail in-sidebar">
    <ul class="list">
        <?php if ( $gender ) { ?>
            <li>
                <div class="details">
                    <div class="text"><?php echo trim($meta_obj->get_post_meta_title('gender')); ?></div>
                    <div class="value"><?php echo trim($gender); ?></div>
                </div>
            </li>
        <?php } ?>

      
        <?php if ( $marital_status ) { ?>
            <li>
                <div class="details">
                    <div class="text"><label for="<?php echo trim($marital_status); ?>">Marital status</label></div>
                    <div class="value"><?php echo trim($marital_status); ?></div>
                </div>
            </li>
        <?php } ?>
        <?php if ( $service ) { ?>
            <li>
                <div class="details">
                    <div class="text"><label for="<?php echo trim($service); ?>">Service</label></div>
                    <div class="value"><?php echo trim($service); ?></div>
                </div>
            </li>
        <?php } ?>
        <?php if ( $qualification ) { ?>
            <li>
                <div class="details">
                    <div class="text"><?php echo trim($meta_obj->get_post_meta_title('qualification')); ?></div>
                    <div class="value"><?php echo trim($qualification); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $languages ) { ?>
            <li>
                <div class="details">
                    <div class="text"><?php echo trim($meta_obj->get_post_meta_title('languages')); ?></div>
                    <div class="value"><?php echo trim($languages); ?></div>
                </div>
            </li>
        <?php } ?>



        <?php if ( $email ) { ?>
            <li>
                <div class="details">
                    <div class="text"><?php echo trim($meta_obj->get_post_meta_title('email')); ?></div>
                    <div class="value"><?php echo trim($email); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $phone ) { ?>
            <li>
                <div class="details">
                    <div class="text"><?php echo trim($meta_obj->get_post_meta_title('phone')); ?></div>
                    <div class="value"><?php echo trim($phone); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php /*if ( $socials ) { ?>
            <li>
                <div class="details">
                    <div class="text"><?php esc_html_e('Socials', 'jobtex'); ?></div>
                    <div class="value social-employer">
                        <?php foreach ($socials as $social) { ?>
                            <?php if ( !empty($social['url']) && !empty($social['network']) ) {
                                $icon_class = !empty( $all_socials[$social['network']]['icon'] ) ? $all_socials[$social['network']]['icon'] : '';
                            ?>
                                <a href="<?php echo esc_html($social['url']); ?>">
                                    <i class="<?php echo esc_attr($icon_class); ?>"></i>
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </li>
        <?php } */?>    

        <?php do_action('wp-job-board-pro-single-candidate-details', $post); ?>

    </ul>
    
    <?php $download_base_url = WP_Job_Board_Pro_Ajax::get_endpoint('wp_job_board_pro_ajax_download_cv');
    if ( is_array($cv_attachment) ) { ?>
        <div id="candidate-cv" class="candidate-cv">
        <?php foreach ($cv_attachment as $id => $cv_url) {
            $file_info = pathinfo($cv_url);
            if ( $file_info ) {
                $check_download = WP_Job_Board_Pro_Candidate::check_user_can_download_cv($id);
                $classes = 'cannot-download-cv-btn';
                $download_url = 'javascript:void(0);';
                if ( $check_download ) {
                    $download_url = add_query_arg(array('file_id' => $id), $download_base_url);
                    $classes = '';
                }
            ?>
                <a href="<?php echo trim($download_url); ?>" class="candidate-detail-cv <?php echo esc_attr($classes); ?>" data-msg="<?php esc_attr_e('Please login as employer account to download CV', 'jobtex'); ?>">
                    <div class="d-flex align-items-center">
                        <div class="content">
                        <?php if ( !empty($file_info['filename']) ) { ?>
                            <div class="filename"><?php echo esc_html($file_info['filename']); ?></div>
                        <?php } ?>
                        <?php if ( !empty($file_info['extension']) ) { ?>
                            <div class="extension"><?php echo esc_html($file_info['extension']); ?></div>
                        <?php } ?>
                        </div>
                        <span class="icon_type ms-auto">
                            <i class="icon-file-pdf"></i>
                        </span>
                    </div>
                </a>
            <?php }
        }?>
        </div>
    <?php } ?>

    <?php
    if ( WP_Job_Board_Pro_Candidate::check_restrict_view_contact_info($post) || wp_job_board_pro_get_option('restrict_contact_candidate_download_cv', 'on') !== 'on' ) { ?>
        <div class="download">
            <?php WP_Job_Board_Pro_Candidate::display_download_cv_btn($post->ID); ?>
        </div>
    <?php } ?>

</div>
<?php echo trim($after_widget);