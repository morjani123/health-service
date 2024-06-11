<?php

function jobtex_job_customize_register( $wp_customize ) {
    global $wp_registered_sidebars;
    $sidebars = array();

    if ( is_admin() && !empty($wp_registered_sidebars) ) {
        foreach ($wp_registered_sidebars as $sidebar) {
            $sidebars[$sidebar['id']] = $sidebar['name'];
        }
    }
    $columns = array( '1' => esc_html__('1 Column', 'jobtex'),
        '2' => esc_html__('2 Columns', 'jobtex'),
        '3' => esc_html__('3 Columns', 'jobtex'),
        '4' => esc_html__('4 Columns', 'jobtex'),
        '5' => esc_html__('5 Columns', 'jobtex'),
        '6' => esc_html__('6 Columns', 'jobtex'),
        '7' => esc_html__('7 Columns', 'jobtex'),
        '8' => esc_html__('8 Columns', 'jobtex'),
    );
    
    // Shop Panel
    $wp_customize->add_panel( 'jobtex_settings_job', array(
        'title' => esc_html__( 'Jobs Settings', 'jobtex' ),
        'priority' => 4,
    ) );

    // General Section
    $wp_customize->add_section('jobtex_settings_job_general', array(
        'title'    => esc_html__('General', 'jobtex'),
        'priority' => 1,
        'panel' => 'jobtex_settings_job',
    ));

    // Breadcrumbs
    $wp_customize->add_setting('jobtex_theme_options[show_job_breadcrumbs]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_job_breadcrumbs', array(
        'settings' => 'jobtex_theme_options[show_job_breadcrumbs]',
        'label'    => esc_html__('Breadcrumbs', 'jobtex'),
        'section'  => 'jobtex_settings_job_general',
        'type'     => 'checkbox',
    ));

    // Breadcrumbs Background Color
    $wp_customize->add_setting('jobtex_theme_options[job_breadcrumb_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'job_breadcrumb_color', array(
        'label'    => esc_html__('Breadcrumbs Background Color', 'jobtex'),
        'section'  => 'jobtex_settings_job_general',
        'settings' => 'jobtex_theme_options[job_breadcrumb_color]',
    )));

    // Breadcrumbs Background
    $wp_customize->add_setting('jobtex_theme_options[job_breadcrumb_image]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'job_breadcrumb_image', array(
        'label'    => esc_html__('Breadcrumbs Background', 'jobtex'),
        'section'  => 'jobtex_settings_job_general',
        'settings' => 'jobtex_theme_options[job_breadcrumb_image]',
    )));

    
    // Job Archives
    $wp_customize->add_section('jobtex_settings_job_archive', array(
        'title'    => esc_html__('Job Archives', 'jobtex'),
        'priority' => 2,
        'panel' => 'jobtex_settings_job',
    ));

    // General Setting ?
    $wp_customize->add_setting('jobtex_theme_options[show_shop_general_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Jobtex_WP_Customize_Heading_Control($wp_customize, 'show_shop_general_setting', array(
        'label'    => esc_html__('General Settings', 'jobtex'),
        'section'  => 'jobtex_settings_job_archive',
        'settings' => 'jobtex_theme_options[show_shop_general_setting]',
    )));

    // Is Full Width
    $wp_customize->add_setting('jobtex_theme_options[job_archive_fullwidth]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_job_archive_fullwidth', array(
        'settings' => 'jobtex_theme_options[job_archive_fullwidth]',
        'label'    => esc_html__('Is Full Width', 'jobtex'),
        'section'  => 'jobtex_settings_job_archive',
        'type'     => 'checkbox',
    ));
    

    // Jobs Layout
    $wp_customize->add_setting( 'jobtex_theme_options[jobs_layout_type]', array(
        'default'        => 'default',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_job_archive_blog_archive', array(
        'label'   => esc_html__('Jobs Layout', 'jobtex'),
        'section' => 'jobtex_settings_job_archive',
        'type'    => 'select',
        'choices' => array(
            'default' => esc_html__('Default', 'jobtex'),
            'fullwidth' => esc_html__('Full Width', 'jobtex'),
            'half-map' => esc_html__('Half Map', 'jobtex'),
            'top-map' => esc_html__('Top Map', 'jobtex'),
            'half-job-details' => esc_html__('Half Job Details', 'jobtex'),
            'half-job-details-v2' => esc_html__('Half Job Details', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[jobs_layout_type]',
    ) );

    // layout
    $wp_customize->add_setting( 'jobtex_theme_options[jobs_layout_sidebar]', array(
        'default'        => 'main',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Jobtex_WP_Customize_Radio_Image_Control( 
        $wp_customize, 
        'jobtex_settings_jobs_layout_sidebar', 
        array(
            'label'   => esc_html__('Layout Type', 'jobtex'),
            'section' => 'jobtex_settings_job_archive',
            'type'    => 'select',
            'choices' => array(
                'main' => array(
                    'title' => esc_html__('Main Only', 'jobtex'),
                    'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                ),
                'left-main' => array(
                    'title' => esc_html__('Left - Main Sidebar', 'jobtex'),
                    'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                ),
                'main-right' => array(
                    'title' => esc_html__('Main - Right Sidebar', 'jobtex'),
                    'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                ),
            ),
            'settings' => 'jobtex_theme_options[jobs_layout_sidebar]',
            'description' => esc_html__('Select the variation you want to apply on your shop/archive page.', 'jobtex'),
        ) 
    ));

    $template_options = ['' => esc_html__('No', 'jobtex')];
    if ( did_action( 'elementor/loaded' ) ) {
        $ele_obj = \Elementor\Plugin::$instance;
        $templates = $ele_obj->templates_manager->get_source( 'local' )->get_items();
        
        if ( !empty( $templates ) ) {
            foreach ( $templates as $template ) {
                $template_options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            }
        }
    }
    // Show Top Content
    $wp_customize->add_setting( 'jobtex_theme_options[jobs_show_top_content]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_jobs_show_top_content', array(
        'label'   => esc_html__('Top Content', 'jobtex'),
        'section' => 'jobtex_settings_job_archive',
        'type'    => 'select',
        'choices' => $template_options,
        'settings' => 'jobtex_theme_options[jobs_show_top_content]',
    ) );

    // Show Offcanvas Filter
    $wp_customize->add_setting('jobtex_theme_options[jobs_show_offcanvas_filter]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'       => 0,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_jobs_show_offcanvas_filter', array(
        'settings' => 'jobtex_theme_options[jobs_show_offcanvas_filter]',
        'label'    => esc_html__('Show Offcanvas Filter', 'jobtex'),
        'section'  => 'jobtex_settings_job_archive',
        'type'     => 'checkbox',
    ));

    // List Style
    $wp_customize->add_setting( 'jobtex_theme_options[jobs_inner_list_style]', array(
        'default'        => 'list',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_jobs_inner_list_style', array(
        'label'   => esc_html__('Jobs list item style', 'jobtex'),
        'section' => 'jobtex_settings_job_archive',
        'type'    => 'select',
        'choices' => array(
            'list' => esc_html__('List Default', 'jobtex'),
            'list-v1' => esc_html__('List V1', 'jobtex'),
            'list-v2' => esc_html__('List V2', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[jobs_inner_list_style]',
    ) );

    // jobs Columns
    $wp_customize->add_setting( 'jobtex_theme_options[job_columns]', array(
        'default'        => '4',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_job_archive_job_columns', array(
        'label'   => esc_html__('Job Columns', 'jobtex'),
        'section' => 'jobtex_settings_job_archive',
        'type'    => 'select',
        'choices' => $columns,
        'settings' => 'jobtex_theme_options[job_columns]',
    ) );

    // Pagination Type
    $wp_customize->add_setting( 'jobtex_theme_options[jobs_pagination]', array(
        'default'        => 'default',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_jobs_pagination', array(
        'label'   => esc_html__('Pagination Type', 'jobtex'),
        'section' => 'jobtex_settings_job_archive',
        'type'    => 'select',
        'choices' => array(
            'default' => esc_html__('Default', 'jobtex'),
            'loadmore' => esc_html__('Load More Button', 'jobtex'),
            'infinite' => esc_html__('Infinite Scrolling', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[jobs_pagination]',
    ) );

    // Placeholder Image
    $wp_customize->add_setting('jobtex_theme_options[job_placeholder_image]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'job_placeholder_image', array(
        'label'    => esc_html__('Placeholder Image', 'jobtex'),
        'section'  => 'jobtex_settings_job_archive',
        'settings' => 'jobtex_theme_options[job_placeholder_image]',
    )));

    // Job Urgent Background Color
    $wp_customize->add_setting('jobtex_theme_options[job_urgent_background_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'job_urgent_background_color', array(
        'label'    => esc_html__('Job Urgent Background Color', 'jobtex'),
        'section'  => 'jobtex_settings_job_archive',
        'settings' => 'jobtex_theme_options[job_urgent_background_color]',
    )));

    // Job Featured Background Color
    $wp_customize->add_setting('jobtex_theme_options[job_featured_background_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'job_featured_background_color', array(
        'label'    => esc_html__('Job Featured Background Color', 'jobtex'),
        'section'  => 'jobtex_settings_job_archive',
        'settings' => 'jobtex_theme_options[job_featured_background_color]',
    )));






    // Single Job
    $wp_customize->add_section('jobtex_settings_job_single', array(
        'title'    => esc_html__('Single Job', 'jobtex'),
        'priority' => 3,
        'panel' => 'jobtex_settings_job',
    ));

    // General Setting ?
    $wp_customize->add_setting('jobtex_theme_options[show_shop_single_general_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Jobtex_WP_Customize_Heading_Control($wp_customize, 'show_shop_single_general_setting', array(
        'label'    => esc_html__('General Settings', 'jobtex'),
        'section'  => 'jobtex_settings_job_single',
        'settings' => 'jobtex_theme_options[show_shop_single_general_setting]',
    )));

    // Job Layout
    $wp_customize->add_setting( 'jobtex_theme_options[job_layout_type]', array(
        'default'        => 'v1',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_job_layout_type', array(
        'label'   => esc_html__('Job Layout', 'jobtex'),
        'section' => 'jobtex_settings_job_single',
        'type'    => 'select',
        'choices' => array(
            'v1' => esc_html__('Version 1', 'jobtex'),
            'v2' => esc_html__('Version 2', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[job_layout_type]',
    ) );


    // Header Background Image
    $wp_customize->add_setting('jobtex_theme_options[job_header_bg_image]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'job_header_bg_image', array(
        'label'    => esc_html__('Header Background Image', 'jobtex'),
        'section'  => 'jobtex_settings_job_single',
        'settings' => 'jobtex_theme_options[job_header_bg_image]',
    )));

    // Is Full Width
    $wp_customize->add_setting('jobtex_theme_options[job_fullwidth]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_job_fullwidth', array(
        'settings' => 'jobtex_theme_options[job_fullwidth]',
        'label'    => esc_html__('Is Full Width', 'jobtex'),
        'section'  => 'jobtex_settings_job_single',
        'type'     => 'checkbox',
    ));
    
    // Show Job Details
    $wp_customize->add_setting('jobtex_theme_options[show_job_detail]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_job_detail', array(
        'settings' => 'jobtex_theme_options[show_job_detail]',
        'label'    => esc_html__('Show Job Details', 'jobtex'),
        'section'  => 'jobtex_settings_job_single',
        'type'     => 'checkbox',
    ));

    // Show Job Description
    $wp_customize->add_setting('jobtex_theme_options[show_job_description]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_job_description', array(
        'settings' => 'jobtex_theme_options[show_job_description]',
        'label'    => esc_html__('Show Job Description', 'jobtex'),
        'section'  => 'jobtex_settings_job_single',
        'type'     => 'checkbox',
    ));

    // Show Job Social Share
    $wp_customize->add_setting('jobtex_theme_options[show_job_social_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_job_social_share', array(
        'settings' => 'jobtex_theme_options[show_job_social_share]',
        'label'    => esc_html__('Show Job Social Share', 'jobtex'),
        'section'  => 'jobtex_settings_job_single',
        'type'     => 'checkbox',
    ));

    // Show Job Photos
    $wp_customize->add_setting('jobtex_theme_options[show_job_photos]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_job_photos', array(
        'settings' => 'jobtex_theme_options[show_job_photos]',
        'label'    => esc_html__('Show Job Photos', 'jobtex'),
        'section'  => 'jobtex_settings_job_single',
        'type'     => 'checkbox',
    ));

    // Show Job Video
    $wp_customize->add_setting('jobtex_theme_options[show_job_video]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_job_video', array(
        'settings' => 'jobtex_theme_options[show_job_video]',
        'label'    => esc_html__('Show Job Video', 'jobtex'),
        'section'  => 'jobtex_settings_job_single',
        'type'     => 'checkbox',
    ));

    // Show Jobs Related
    $wp_customize->add_setting('jobtex_theme_options[show_job_related]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_job_related', array(
        'settings' => 'jobtex_theme_options[show_job_related]',
        'label'    => esc_html__('Show Jobs Related', 'jobtex'),
        'section'  => 'jobtex_settings_job_single',
        'type'     => 'checkbox',
    ));

    // Number related jobs
    $wp_customize->add_setting( 'jobtex_theme_options[number_job_related]', array(
        'default'        => '4',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_job_single_number_job_related', array(
        'label'   => esc_html__('Number related jobs', 'jobtex'),
        'section' => 'jobtex_settings_job_single',
        'type'    => 'number',
        'settings' => 'jobtex_theme_options[number_job_related]',
    ) );

    // Related Jobs Columns
    $wp_customize->add_setting( 'jobtex_theme_options[related_job_columns]', array(
        'default'        => '4',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_job_single_related_job_columns', array(
        'label'   => esc_html__('Related Jobs Columns', 'jobtex'),
        'section' => 'jobtex_settings_job_single',
        'type'    => 'select',
        'choices' => $columns,
        'settings' => 'jobtex_theme_options[related_job_columns]',
    ) );


    // Single Job Expired
    $wp_customize->add_section('jobtex_settings_job_expired', array(
        'title'    => esc_html__('Single Job Expired', 'jobtex'),
        'priority' => 4,
        'panel' => 'jobtex_settings_job',
    ));

    // Image Icon
    $wp_customize->add_setting('jobtex_theme_options[job_expired_icon_img]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'job_expired_icon_img', array(
        'label'    => esc_html__('Image Icon', 'jobtex'),
        'section'  => 'jobtex_settings_job_expired',
        'settings' => 'jobtex_theme_options[job_expired_icon_img]',
    )));

    // Title
    $wp_customize->add_setting('jobtex_theme_options[job_expired_title]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 'We\'re Sorry Opps! Job Expired',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_job_expired_title', array(
        'settings' => 'jobtex_theme_options[job_expired_title]',
        'label'    => esc_html__('Title', 'jobtex'),
        'section'  => 'jobtex_settings_job_expired',
        'type'     => 'text',
    ));

    // Description
    $wp_customize->add_setting('jobtex_theme_options[job_expired_description]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 'Unable to access the link. Job has been expired. Please contact the admin or who shared the link with you.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_job_expired_description', array(
        'settings' => 'jobtex_theme_options[job_expired_description]',
        'label'    => esc_html__('Description', 'jobtex'),
        'section'  => 'jobtex_settings_job_expired',
        'type'     => 'text',
    ));
}
add_action( 'customize_register', 'jobtex_job_customize_register', 15 );