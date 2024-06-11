<?php

function jobtex_candidate_customize_register( $wp_customize ) {
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
    $wp_customize->add_panel( 'jobtex_settings_candidate', array(
        'title' => esc_html__( 'Candidates Settings', 'jobtex' ),
        'priority' => 4,
    ) );

    // General Section
    $wp_customize->add_section('jobtex_settings_candidate_general', array(
        'title'    => esc_html__('General', 'jobtex'),
        'priority' => 1,
        'panel' => 'jobtex_settings_candidate',
    ));

    // Breadcrumbs
    $wp_customize->add_setting('jobtex_theme_options[show_candidate_breadcrumbs]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_candidate_breadcrumbs', array(
        'settings' => 'jobtex_theme_options[show_candidate_breadcrumbs]',
        'label'    => esc_html__('Breadcrumbs', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_general',
        'type'     => 'checkbox',
    ));

    // Breadcrumbs Background Color
    $wp_customize->add_setting('jobtex_theme_options[candidate_breadcrumb_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'candidate_breadcrumb_color', array(
        'label'    => esc_html__('Breadcrumbs Background Color', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_general',
        'settings' => 'jobtex_theme_options[candidate_breadcrumb_color]',
    )));

    // Breadcrumbs Background
    $wp_customize->add_setting('jobtex_theme_options[candidate_breadcrumb_image]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'candidate_breadcrumb_image', array(
        'label'    => esc_html__('Breadcrumbs Background', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_general',
        'settings' => 'jobtex_theme_options[candidate_breadcrumb_image]',
    )));


    // Candidate Archives
    $wp_customize->add_section('jobtex_settings_candidate_archive', array(
        'title'    => esc_html__('Candidate Archives', 'jobtex'),
        'priority' => 2,
        'panel' => 'jobtex_settings_candidate',
    ));

    // General Setting ?
    $wp_customize->add_setting('jobtex_theme_options[show_shop_general_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Jobtex_WP_Customize_Heading_Control($wp_customize, 'show_shop_general_setting', array(
        'label'    => esc_html__('General Settings', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_archive',
        'settings' => 'jobtex_theme_options[show_shop_general_setting]',
    )));

    // Is Full Width
    $wp_customize->add_setting('jobtex_theme_options[candidates_archive_fullwidth]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_candidates_archive_fullwidth', array(
        'settings' => 'jobtex_theme_options[candidates_archive_fullwidth]',
        'label'    => esc_html__('Is Full Width', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_archive',
        'type'     => 'checkbox',
    ));

    // layout
    $wp_customize->add_setting( 'jobtex_theme_options[candidates_archive_layout]', array(
        'default'        => 'main',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Jobtex_WP_Customize_Radio_Image_Control( 
        $wp_customize, 
        'jobtex_settings_candidates_archive_layout', 
        array(
            'label'   => esc_html__('Layout Type', 'jobtex'),
            'section' => 'jobtex_settings_candidate_archive',
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
            'settings' => 'jobtex_theme_options[candidates_archive_layout]',
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
    
    // Display Mode
    $wp_customize->add_setting( 'jobtex_theme_options[candidates_display_mode]', array(
        'default'        => 'grid',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_candidates_display_mode', array(
        'label'   => esc_html__('Display Mode', 'jobtex'),
        'section' => 'jobtex_settings_candidate_archive',
        'type'    => 'select',
        'choices' => array(
            'grid' => esc_html__('Grid', 'jobtex'),
            'list' => esc_html__('List', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[candidates_display_mode]',
    ) );


    // candidates Columns
    $wp_customize->add_setting( 'jobtex_theme_options[candidates_columns]', array(
        'default'        => '4',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_candidate_archive_candidates_columns', array(
        'label'   => esc_html__('Candidate Columns', 'jobtex'),
        'section' => 'jobtex_settings_candidate_archive',
        'type'    => 'select',
        'choices' => $columns,
        'settings' => 'jobtex_theme_options[candidates_columns]',
    ) );

    // Pagination Type
    $wp_customize->add_setting( 'jobtex_theme_options[candidates_pagination]', array(
        'default'        => 'default',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_candidates_pagination', array(
        'label'   => esc_html__('Pagination Type', 'jobtex'),
        'section' => 'jobtex_settings_candidate_archive',
        'type'    => 'select',
        'choices' => array(
            'default' => esc_html__('Default', 'jobtex'),
            'loadmore' => esc_html__('Load More Button', 'jobtex'),
            'infinite' => esc_html__('Infinite Scrolling', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[candidates_pagination]',
    ) );




    // Single Candidate
    $wp_customize->add_section('jobtex_settings_candidate_single', array(
        'title'    => esc_html__('Single Candidate', 'jobtex'),
        'priority' => 3,
        'panel' => 'jobtex_settings_candidate',
    ));

    // General Setting ?
    $wp_customize->add_setting('jobtex_theme_options[show_shop_single_general_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Jobtex_WP_Customize_Heading_Control($wp_customize, 'show_shop_single_general_setting', array(
        'label'    => esc_html__('General Settings', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_single',
        'settings' => 'jobtex_theme_options[show_shop_single_general_setting]',
    )));
    
    // Layout Type
    $wp_customize->add_setting( 'jobtex_theme_options[candidate_layout_type]', array(
        'default'        => 'v1',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_candidate_layout_type', array(
        'label'   => esc_html__('Layout Type', 'jobtex'),
        'section' => 'jobtex_settings_candidate_single',
        'type'    => 'select',
        'choices' => array(
            'v1' => esc_html__('Version 1', 'jobtex'),
            'v2' => esc_html__('Version 2', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[candidate_layout_type]',
    ) );

    // Header Background Image
    $wp_customize->add_setting('jobtex_theme_options[candidate_header_bg_image]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'candidate_header_bg_image', array(
        'label'    => esc_html__('Header Background Image', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_single',
        'settings' => 'jobtex_theme_options[candidate_header_bg_image]',
    )));

    // Show Candidate Description
    $wp_customize->add_setting('jobtex_theme_options[show_candidate_description]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_candidate_description', array(
        'settings' => 'jobtex_theme_options[show_candidate_description]',
        'label'    => esc_html__('Show Candidate Description', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_single',
        'type'     => 'checkbox',
    ));

    // Show Candidate Gallery
    $wp_customize->add_setting('jobtex_theme_options[show_candidate_portfolios]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_candidate_portfolios', array(
        'settings' => 'jobtex_theme_options[show_candidate_portfolios]',
        'label'    => esc_html__('Show Candidate Gallery', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_single',
        'type'     => 'checkbox',
    ));

    // Show Candidate Video
    $wp_customize->add_setting('jobtex_theme_options[show_candidate_video]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_candidate_video', array(
        'settings' => 'jobtex_theme_options[show_candidate_video]',
        'label'    => esc_html__('Show Candidate Video', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_single',
        'type'     => 'checkbox',
    ));

    // Show Candidate Education
    $wp_customize->add_setting('jobtex_theme_options[show_candidate_education]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_candidate_education', array(
        'settings' => 'jobtex_theme_options[show_candidate_education]',
        'label'    => esc_html__('Show Candidate Education', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_single',
        'type'     => 'checkbox',
    ));

    // Show Candidate Experience
    $wp_customize->add_setting('jobtex_theme_options[show_candidate_experience]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_candidate_experience', array(
        'settings' => 'jobtex_theme_options[show_candidate_experience]',
        'label'    => esc_html__('Show Candidate Experience', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_single',
        'type'     => 'checkbox',
    ));

    // Show Candidate Skill
    $wp_customize->add_setting('jobtex_theme_options[show_candidate_skill]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_candidate_skill', array(
        'settings' => 'jobtex_theme_options[show_candidate_skill]',
        'label'    => esc_html__('Show Candidate Skill', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_single',
        'type'     => 'checkbox',
    ));

    // Show Candidate Award
    $wp_customize->add_setting('jobtex_theme_options[show_candidate_award]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_candidate_award', array(
        'settings' => 'jobtex_theme_options[show_candidate_award]',
        'label'    => esc_html__('Show Candidate Award', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_single',
        'type'     => 'checkbox',
    ));

    // Show Candidates Related
    $wp_customize->add_setting('jobtex_theme_options[show_candidate_related]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_candidate_related', array(
        'settings' => 'jobtex_theme_options[show_candidate_related]',
        'label'    => esc_html__('Show Candidates Related', 'jobtex'),
        'section'  => 'jobtex_settings_candidate_single',
        'type'     => 'checkbox',
    ));

    // Number related candidates
    $wp_customize->add_setting( 'jobtex_theme_options[number_candidate_related]', array(
        'default'        => '4',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_candidate_single_number_candidate_related', array(
        'label'   => esc_html__('Number related candidates', 'jobtex'),
        'section' => 'jobtex_settings_candidate_single',
        'type'    => 'number',
        'settings' => 'jobtex_theme_options[number_candidate_related]',
    ) );

    // Related Candidates Columns
    $wp_customize->add_setting( 'jobtex_theme_options[related_candidate_columns]', array(
        'default'        => '4',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_candidate_single_related_candidate_columns', array(
        'label'   => esc_html__('Related Candidates Columns', 'jobtex'),
        'section' => 'jobtex_settings_candidate_single',
        'type'    => 'select',
        'choices' => $columns,
        'settings' => 'jobtex_theme_options[related_candidate_columns]',
    ) );
}
add_action( 'customize_register', 'jobtex_candidate_customize_register', 15 );