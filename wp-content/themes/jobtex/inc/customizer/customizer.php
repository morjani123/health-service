<?php
/**
 * Jobtex Customizer functionality
 *
 * @package WordPress
 * @subpackage Jobtex
 * @since Jobtex 1.0
 */

function jobtex_customize_register( $wp_customize ) {

	$wp_customize->add_section('apus_settings_general', array(
        'title'    => esc_html__('General', 'jobtex'),
        'priority' => 1,
    ));

	// preload
    $wp_customize->add_setting('jobtex_theme_options[preload]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_preload', array(
        'settings' => 'jobtex_theme_options[preload]',
        'label'    => esc_html__('Preload Website', 'jobtex'),
        'section'  => 'apus_settings_general',
        'type'     => 'checkbox',
    ));

    // preload icon
    $wp_customize->add_setting('jobtex_theme_options[media-preload-icon]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'media-preload-icon', array(
        'label'    => esc_html__('Preload Icon', 'jobtex'),
        'section'  => 'apus_settings_general',
        'settings' => 'jobtex_theme_options[media-preload-icon]',
    )));

    // Image Lazy Loading
    $wp_customize->add_setting('jobtex_theme_options[image_lazy_loading]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_image_lazy_loading', array(
        'settings' => 'jobtex_theme_options[image_lazy_loading]',
        'label'    => esc_html__('Image Lazy Loading', 'jobtex'),
        'section'  => 'apus_settings_general',
        'type'     => 'checkbox',
    ));


    // Header Section
    $wp_customize->add_section('apus_settings_header', array(
        'title'    => esc_html__('Header', 'jobtex'),
        'priority' => 2,
    ));

    // header layout
    $wp_customize->add_setting( 'jobtex_theme_options[header_type]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_header_header_type', array(
        'label'   => esc_html__('Header Layout Type', 'jobtex'),
        'section' => 'apus_settings_header',
        'type'    => 'select',
        'choices' => jobtex_get_header_layouts(),
        'settings' => 'jobtex_theme_options[header_type]',
        'description' => sprintf(wp_kses(__('You can add or edit a header in <a href="%s" target="_blank">Headers Builder</a>', 'jobtex'), array('a' => array('href' => array())) ), admin_url( 'edit.php?post_type=apus_header') ),
    ) );

    // Sticky Header
    $wp_customize->add_setting('jobtex_theme_options[keep_header]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_keep_header', array(
        'settings' => 'jobtex_theme_options[keep_header]',
        'label'    => esc_html__('Sticky Header', 'jobtex'),
        'section'  => 'apus_settings_header',
        'type'     => 'checkbox',
    ));

    // Header Mobile
    $wp_customize->add_setting('jobtex_theme_options[header_mobile_settings]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Jobtex_WP_Customize_Heading_Control($wp_customize, 'header_mobile_settings', array(
        'label'    => esc_html__('Header mobile Settings', 'jobtex'),
        'section'  => 'apus_settings_header',
        'settings' => 'jobtex_theme_options[header_mobile_settings]',
    )));

    // Separate Header Mobile
    $wp_customize->add_setting('jobtex_theme_options[separate_header_mobile]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_separate_header_mobile', array(
        'settings' => 'jobtex_theme_options[separate_header_mobile]',
        'label'    => esc_html__('Use Separate Header Mobile', 'jobtex'),
        'section'  => 'apus_settings_header',
        'type'     => 'checkbox',
    ));

    // Mobile Logo
    $wp_customize->add_setting('jobtex_theme_options[media-mobile-logo]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'media-mobile-logo', array(
        'label'    => esc_html__('Mobile Logo Upload', 'jobtex'),
        'section'  => 'apus_settings_header',
        'settings' => 'jobtex_theme_options[media-mobile-logo]',
    )));

    // Enable Header Mobile Menu
    $wp_customize->add_setting('jobtex_theme_options[header_mobile_menu]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_header_mobile_menu', array(
        'settings' => 'jobtex_theme_options[header_mobile_menu]',
        'label'    => esc_html__('Enable Header Mobile Menu', 'jobtex'),
        'section'  => 'apus_settings_header',
        'type'     => 'checkbox',
    ));

    // Enable Header Mobile Login
    $wp_customize->add_setting('jobtex_theme_options[header_mobile_login]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_header_mobile_login', array(
        'settings' => 'jobtex_theme_options[header_mobile_login]',
        'label'    => esc_html__('Enable Header Mobile Login', 'jobtex'),
        'section'  => 'apus_settings_header',
        'type'     => 'checkbox',
    ));

    // Enable Header add job button
    $wp_customize->add_setting('jobtex_theme_options[show_add_job_btn]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_add_job_btn', array(
        'settings' => 'jobtex_theme_options[show_add_job_btn]',
        'label'    => esc_html__('Enable Mobile Add Job Button', 'jobtex'),
        'section'  => 'apus_settings_header',
        'type'     => 'checkbox',
    ));

    // Footer Section
    $wp_customize->add_section('apus_settings_footer', array(
        'title'    => esc_html__('Footer', 'jobtex'),
        'priority' => 2,
    ));

    // header layout
    $wp_customize->add_setting( 'jobtex_theme_options[footer_type]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_footer_layout_type', array(
        'label'   => esc_html__('Footer Layout Type', 'jobtex'),
        'section' => 'apus_settings_footer',
        'type'    => 'select',
        'choices' => jobtex_get_footer_layouts(),
        'settings' => 'jobtex_theme_options[footer_type]',
        'description' => sprintf(wp_kses(__('You can add or edit a header in <a href="%s" target="_blank">Footers Builder</a>', 'jobtex'), array('a' => array('href' => array())) ), admin_url( 'edit.php?post_type=apus_footer') ),
    ) );

    // Back To Top Button
    $wp_customize->add_setting('jobtex_theme_options[back_to_top]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_back_to_top', array(
        'settings' => 'jobtex_theme_options[back_to_top]',
        'label'    => esc_html__('Back To Top Button', 'jobtex'),
        'section'  => 'apus_settings_footer',
        'type'     => 'checkbox',
    ));


    // Blog Panel
    $wp_customize->add_panel( 'apus_settings_blog', array(
		'title' => esc_html__( 'Blog', 'jobtex' ),
		'priority' => 3,
	) );

    // General Section
    $wp_customize->add_section('apus_settings_blog_general', array(
        'title'    => esc_html__('General', 'jobtex'),
        'priority' => 1,
        'panel' => 'apus_settings_blog',
    ));

    // Breadcrumbs
    $wp_customize->add_setting('jobtex_theme_options[show_blog_breadcrumbs]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_blog_breadcrumbs', array(
        'settings' => 'jobtex_theme_options[show_blog_breadcrumbs]',
        'label'    => esc_html__('Breadcrumbs', 'jobtex'),
        'section'  => 'apus_settings_blog_general',
        'type'     => 'checkbox',
    ));

    // Breadcrumbs Background Color
    $wp_customize->add_setting('jobtex_theme_options[blog_breadcrumb_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_breadcrumb_color', array(
        'label'    => esc_html__('Breadcrumbs Background Color', 'jobtex'),
        'section'  => 'apus_settings_blog_general',
        'settings' => 'jobtex_theme_options[blog_breadcrumb_color]',
    )));

    // Breadcrumbs Background
    $wp_customize->add_setting('jobtex_theme_options[blog_breadcrumb_image]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_breadcrumb_image', array(
        'label'    => esc_html__('Breadcrumbs Background', 'jobtex'),
        'section'  => 'apus_settings_blog_general',
        'settings' => 'jobtex_theme_options[blog_breadcrumb_image]',
    )));


    // Blog & Post Archives Section
    $wp_customize->add_section('apus_settings_blog_archive', array(
        'title'    => esc_html__('Blog & Post Archives', 'jobtex'),
        'priority' => 2,
        'panel' => 'apus_settings_blog',
    ));

    // layout
    $wp_customize->add_setting( 'jobtex_theme_options[blog_archive_layout]', array(
        'default'        => 'left-main',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Jobtex_WP_Customize_Radio_Image_Control( 
		$wp_customize, 
		'apus_settings_blog_archive_layout', 
		array(
			'label'   => esc_html__('Layout Type', 'jobtex'),
	        'section' => 'apus_settings_blog_archive',
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
	        'settings' => 'jobtex_theme_options[blog_archive_layout]',
	        'description' => esc_html__('Select the variation you want to apply on your blog.', 'jobtex'),
		) 
	));

    // Is Full Width
    $wp_customize->add_setting('jobtex_theme_options[blog_archive_fullwidth]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_blog_archive_fullwidth', array(
        'settings' => 'jobtex_theme_options[blog_archive_fullwidth]',
        'label'    => esc_html__('Is Full Width', 'jobtex'),
        'section'  => 'apus_settings_blog_archive',
        'type'     => 'checkbox',
    ));

    // Top Categories
    $wp_customize->add_setting('jobtex_theme_options[blog_archive_top_categories]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 0,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_blog_archive_top_categories', array(
        'settings' => 'jobtex_theme_options[blog_archive_top_categories]',
        'label'    => esc_html__('Show Top Categories', 'jobtex'),
        'section'  => 'apus_settings_blog_archive',
        'type'     => 'checkbox',
    ));

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

    // Left Sidebar
    $wp_customize->add_setting( 'jobtex_theme_options[blog_archive_left_sidebar]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_blog_archive_left_sidebar', array(
        'label'   => esc_html__('Archive Left Sidebar', 'jobtex'),
        'section' => 'apus_settings_blog_archive',
        'type'    => 'select',
        'choices' => $sidebars,
        'settings' => 'jobtex_theme_options[blog_archive_left_sidebar]',
        'description' => esc_html__('Choose a sidebar for left sidebar', 'jobtex'),
    ) );

    // Right Sidebar
    $wp_customize->add_setting( 'jobtex_theme_options[blog_archive_right_sidebar]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_blog_archive_right_sidebar', array(
        'label'   => esc_html__('Archive Right Sidebar', 'jobtex'),
        'section' => 'apus_settings_blog_archive',
        'type'    => 'select',
        'choices' => $sidebars,
        'settings' => 'jobtex_theme_options[blog_archive_right_sidebar]',
        'description' => esc_html__('Choose a sidebar for right sidebar', 'jobtex'),
    ) );

    // Display Mode
    $wp_customize->add_setting( 'jobtex_theme_options[blog_display_mode]', array(
        'default'        => 'list',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_blog_archive_blog_archive', array(
        'label'   => esc_html__('Display Mode', 'jobtex'),
        'section' => 'apus_settings_blog_archive',
        'type'    => 'select',
        'choices' => array(
        	'grid' => esc_html__('Grid', 'jobtex'),
            'list' => esc_html__('List', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[blog_display_mode]',
    ) );

    // Blog Columns
    $wp_customize->add_setting( 'jobtex_theme_options[blog_columns]', array(
        'default'        => '1',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_blog_archive_blog_columns', array(
        'label'   => esc_html__('Blog Columns', 'jobtex'),
        'section' => 'apus_settings_blog_archive',
        'type'    => 'select',
        'choices' => $columns,
        'settings' => 'jobtex_theme_options[blog_columns]',
    ) );

    // Thumbnail Size
    $wp_customize->add_setting( 'jobtex_theme_options[blog_item_thumbsize]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_blog_archive_blog_item_thumbsize', array(
        'label'   => esc_html__('Thumbnail Size', 'jobtex'),
        'section' => 'apus_settings_blog_archive',
        'type'    => 'text',
        'settings' => 'jobtex_theme_options[blog_item_thumbsize]',
        'description' => esc_html__('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) .', 'jobtex'),
    ) );


    // Blog Single
    $wp_customize->add_section('apus_settings_blog_single', array(
        'title'    => esc_html__('Blog Single', 'jobtex'),
        'priority' => 3,
        'panel' => 'apus_settings_blog',
    ));

    // layout
    $wp_customize->add_setting( 'jobtex_theme_options[blog_single_layout]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Jobtex_WP_Customize_Radio_Image_Control( 
		$wp_customize, 
		'apus_settings_blog_single_layout', 
		array(
			'label'   => esc_html__('Layout Type', 'jobtex'),
	        'section' => 'apus_settings_blog_single',
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
	        'settings' => 'jobtex_theme_options[blog_single_layout]',
	        'description' => esc_html__('Select the variation you want to apply on your blog single.', 'jobtex'),
		) 
	));

    // Is Full Width
    $wp_customize->add_setting('jobtex_theme_options[blog_single_fullwidth]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_blog_single_fullwidth', array(
        'settings' => 'jobtex_theme_options[blog_single_fullwidth]',
        'label'    => esc_html__('Is Full Width', 'jobtex'),
        'section'  => 'apus_settings_blog_single',
        'type'     => 'checkbox',
    ));

    // Detail Style
    $wp_customize->add_setting( 'jobtex_theme_options[blog_single_style]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_blog_single_style', array(
        'label'   => esc_html__('Style Version', 'jobtex'),
        'section' => 'apus_settings_blog_single',
        'type'    => 'select',
        'choices' => array(
            '' => esc_html__('Default', 'jobtex'),
            'v1' => esc_html__('Style 1', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[blog_single_style]',
    ) );

    // Left Sidebar
    $wp_customize->add_setting( 'jobtex_theme_options[blog_single_left_sidebar]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_blog_single_left_sidebar', array(
        'label'   => esc_html__('Archive Left Sidebar', 'jobtex'),
        'section' => 'apus_settings_blog_single',
        'type'    => 'select',
        'choices' => $sidebars,
        'settings' => 'jobtex_theme_options[blog_single_left_sidebar]',
        'description' => esc_html__('Choose a sidebar for left sidebar', 'jobtex'),
    ) );

    // Right Sidebar
    $wp_customize->add_setting( 'jobtex_theme_options[blog_single_right_sidebar]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_blog_single_right_sidebar', array(
        'label'   => esc_html__('Archive Right Sidebar', 'jobtex'),
        'section' => 'apus_settings_blog_single',
        'type'    => 'select',
        'choices' => $sidebars,
        'settings' => 'jobtex_theme_options[blog_single_right_sidebar]',
        'description' => esc_html__('Choose a sidebar for right sidebar', 'jobtex'),
    ) );

    // Show Social Share
    $wp_customize->add_setting('jobtex_theme_options[show_blog_social_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 0,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_blog_social_share', array(
        'settings' => 'jobtex_theme_options[show_blog_social_share]',
        'label'    => esc_html__('Show Social Share', 'jobtex'),
        'section'  => 'apus_settings_blog_single',
        'type'     => 'checkbox',
    ));

    // Show Related Posts
    $wp_customize->add_setting('jobtex_theme_options[show_blog_related]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_blog_related', array(
        'settings' => 'jobtex_theme_options[show_blog_related]',
        'label'    => esc_html__('Show Related Posts', 'jobtex'),
        'section'  => 'apus_settings_blog_single',
        'type'     => 'checkbox',
    ));

    // Number related posts
    $wp_customize->add_setting('jobtex_theme_options[number_blog_related]', array(
        'capability' => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_number_blog_related', array(
        'settings' => 'jobtex_theme_options[number_blog_related]',
        'label'    => esc_html__('Number related posts', 'jobtex'),
        'section'  => 'apus_settings_blog_single',
        'type'     => 'number',
    ));

    // Related Blogs Columns
    $wp_customize->add_setting( 'jobtex_theme_options[related_blog_columns]', array(
        'default'        => '1',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_blog_archive_related_blog_columns', array(
        'label'   => esc_html__('Related Blogs Columns', 'jobtex'),
        'section' => 'apus_settings_blog_single',
        'type'    => 'select',
        'choices' => $columns,
        'settings' => 'jobtex_theme_options[related_blog_columns]',
    ) );



    // 404 Settings
    $wp_customize->add_section('apus_settings_404_page', array(
        'title'    => esc_html__('404 Page', 'jobtex'),
        'priority' => 5,
    ));


    // 404 Image
    $wp_customize->add_setting('jobtex_theme_options[404_icon_img]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, '404_icon_img', array(
        'label'    => esc_html__('404 Image', 'jobtex'),
        'section'  => 'apus_settings_404_page',
        'settings' => 'jobtex_theme_options[404_icon_img]',
    )));

    // Title
    $wp_customize->add_setting('jobtex_theme_options[404_title]', array(
        'default'           => 'Oops! That page can\'t be found.',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_404_title', array(
        'settings' => 'jobtex_theme_options[404_title]',
        'label'    => esc_html__('Title', 'jobtex'),
        'section'  => 'apus_settings_404_page',
        'type'     => 'text',
    ));


    // des
    $wp_customize->add_setting('jobtex_theme_options[404_description]', array(
        'default'           => 'It looks like nothing was found at this location. Maybe try a search?',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_404_description', array(
        'settings' => 'jobtex_theme_options[404_description]',
        'label'    => esc_html__('Description', 'jobtex'),
        'section'  => 'apus_settings_404_page',
        'type'     => 'textarea',
    ));

    // Button Text
    $wp_customize->add_setting('jobtex_theme_options[404_btn_text]', array(
        'default'           => 'Go To Home Page',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_404_btn_text', array(
        'settings' => 'jobtex_theme_options[404_btn_text]',
        'label'    => esc_html__('Button Text', 'jobtex'),
        'section'  => 'apus_settings_404_page',
        'type'     => 'text',
    ));


    // Custom Style
    $wp_customize->add_section('apus_settings_custom_style', array(
        'title'    => esc_html__('Theme Color', 'jobtex'),
        'priority' => 6,
    ));

    // Main Theme Color
    $wp_customize->add_setting('jobtex_theme_options[main_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'main_color', array(
        'label'    => esc_html__('Main Theme Color', 'jobtex'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'jobtex_theme_options[main_color]',
    )));

    // Main Theme Hover Color
    $wp_customize->add_setting('jobtex_theme_options[main_hover_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'main_hover_color', array(
        'label'    => esc_html__('Main Theme Hover Color', 'jobtex'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'jobtex_theme_options[main_hover_color]',
    )));

    // Text Color
    $wp_customize->add_setting('jobtex_theme_options[text_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_color', array(
        'label'    => esc_html__('Text Color', 'jobtex'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'jobtex_theme_options[text_color]',
    )));

    // Link Color
    $wp_customize->add_setting('jobtex_theme_options[link_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label'    => esc_html__('Link Color', 'jobtex'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'jobtex_theme_options[link_color]',
    )));

    // Link Hover Color
    $wp_customize->add_setting('jobtex_theme_options[link_hover_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
        'label'    => esc_html__('Link Hover Color', 'jobtex'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'jobtex_theme_options[link_hover_color]',
    )));

    // Heading Color
    $wp_customize->add_setting('jobtex_theme_options[heading_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'heading_color', array(
        'label'    => esc_html__('Heading Color', 'jobtex'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'jobtex_theme_options[heading_color]',
    )));

    // Header Mobile Color
    $wp_customize->add_setting('jobtex_theme_options[header_mobile_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_mobile_color', array(
        'label'    => esc_html__('Header Mobile Color', 'jobtex'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'jobtex_theme_options[header_mobile_color]',
    )));


    // Typography
    
    $wp_customize->add_section('apus_settings_custom_typography', array(
        'title'    => esc_html__('Typography', 'jobtex'),
        'priority' => 6.5,
    ));

    $wp_customize->add_setting( 'jobtex_theme_options[main-font]',
        array(
            'default' => '',
            'sanitize_callback' => 'jobtex_google_font_sanitization',
            'type'           => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( new Jobtex_Google_Font_Select_Custom_Control( $wp_customize, 'main-font',
        array(
            'label' => esc_html__( 'Main Font Face', 'jobtex'),
            'description' => esc_html__( 'Pick the Main Font for your site', 'jobtex'),
            'section' => 'apus_settings_custom_typography',
            'settings' => 'jobtex_theme_options[main-font]',
        )
    ) );

    // Font Size
    $wp_customize->add_setting('jobtex_theme_options[main-font-size]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_main-font-size', array(
        'settings' => 'jobtex_theme_options[main-font-size]',
        'label'    => esc_html__('Main Font Size', 'jobtex'),
        'section'  => 'apus_settings_custom_typography',
        'type'     => 'number',
        'description'     => esc_html__('Set a font size (px)', 'jobtex'),
    ));


    $wp_customize->add_setting( 'jobtex_theme_options[heading-font]',
        array(
            'default' => '',
            'sanitize_callback' => 'jobtex_google_font_sanitization',
            'type'           => 'option',
        )
    );
    $wp_customize->add_control( new Jobtex_Google_Font_Select_Custom_Control( $wp_customize, 'heading-font',
        array(
            'label' => esc_html__( 'Heading Font Face', 'jobtex'),
            'description' => esc_html__( 'Pick the Heading Font for your site', 'jobtex'),
            'section' => 'apus_settings_custom_typography',
            'settings' => 'jobtex_theme_options[heading-font]',
        )
    ) );

    


    // Social Media
    $wp_customize->add_section('apus_settings_social_media', array(
        'title'    => esc_html__('Social Media', 'jobtex'),
        'priority' => 7,
    ));

    // Enable Facebook Share
    $wp_customize->add_setting('jobtex_theme_options[facebook_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_facebook_share', array(
        'settings' => 'jobtex_theme_options[facebook_share]',
        'label'    => esc_html__('Enable Facebook Share', 'jobtex'),
        'section'  => 'apus_settings_social_media',
        'type'     => 'checkbox',
    ));

    // Enable twitter Share
    $wp_customize->add_setting('jobtex_theme_options[twitter_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_twitter_share', array(
        'settings' => 'jobtex_theme_options[twitter_share]',
        'label'    => esc_html__('Enable twitter Share', 'jobtex'),
        'section'  => 'apus_settings_social_media',
        'type'     => 'checkbox',
    ));

    // Enable linkedin Share
    $wp_customize->add_setting('jobtex_theme_options[linkedin_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_linkedin_share', array(
        'settings' => 'jobtex_theme_options[linkedin_share]',
        'label'    => esc_html__('Enable linkedin Share', 'jobtex'),
        'section'  => 'apus_settings_social_media',
        'type'     => 'checkbox',
    ));

    // Enable pinterest Share
    $wp_customize->add_setting('jobtex_theme_options[pinterest_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_pinterest_share', array(
        'settings' => 'jobtex_theme_options[pinterest_share]',
        'label'    => esc_html__('Enable pinterest Share', 'jobtex'),
        'section'  => 'apus_settings_social_media',
        'type'     => 'checkbox',
    ));
    


    $wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
}
add_action( 'customize_register', 'jobtex_customize_register', 10 );


/**
 * Register color schemes for Jobtex.
 *
 * Can be filtered with {@see 'jobtex_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Sidebar Background Color.
 * 3. Box Background Color.
 * 4. Main Text and Link Color.
 * 5. Sidebar Text and Link Color.
 * 6. Meta Box Background Color.
 *
 * @since Jobtex 1.0
 *
 * @return array An associative array of color scheme options.
 */
function jobtex_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Jobtex.
	 *
	 * The default schemes include 'default', 'dark', 'yellow', 'pink', 'purple', and 'blue'.
	 *
	 * @since Jobtex 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, sidebar
	 *                              background, box background, main text and link, sidebar text and link,
	 *                              meta box background.
	 *     }
	 * }
	 */
	return apply_filters( 'jobtex_color_schemes', array(
		'default' => array(
			'label'  => esc_html__( 'Default', 'jobtex' ),
			'colors' => array(
				'#f1f1f1',
				'#ffffff',
				'#ffffff',
				'#333333',
				'#333333',
				'#f7f7f7',
			),
		),
		'dark'    => array(
			'label'  => esc_html__( 'Dark', 'jobtex' ),
			'colors' => array(
				'#111111',
				'#202020',
				'#202020',
				'#bebebe',
				'#bebebe',
				'#1b1b1b',
			),
		),
		'yellow'  => array(
			'label'  => esc_html__( 'Yellow', 'jobtex' ),
			'colors' => array(
				'#f4ca16',
				'#ffdf00',
				'#ffffff',
				'#111111',
				'#111111',
				'#f1f1f1',
			),
		),
		'pink'    => array(
			'label'  => esc_html__( 'Pink', 'jobtex' ),
			'colors' => array(
				'#ffe5d1',
				'#e53b51',
				'#ffffff',
				'#352712',
				'#ffffff',
				'#f1f1f1',
			),
		),
		'purple'  => array(
			'label'  => esc_html__( 'Purple', 'jobtex' ),
			'colors' => array(
				'#674970',
				'#2e2256',
				'#ffffff',
				'#2e2256',
				'#ffffff',
				'#f1f1f1',
			),
		),
		'blue'   => array(
			'label'  => esc_html__( 'Blue', 'jobtex' ),
			'colors' => array(
				'#e9f2f9',
				'#55c3dc',
				'#ffffff',
				'#22313f',
				'#ffffff',
				'#f1f1f1',
			),
		),
	) );
}

if ( ! function_exists( 'jobtex_get_color_scheme' ) ) :
/**
 * Get the current Jobtex color scheme.
 *
 * @since Jobtex 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function jobtex_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = jobtex_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // jobtex_get_color_scheme

if ( ! function_exists( 'jobtex_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for Jobtex.
 *
 * @since Jobtex 1.0
 *
 * @return array Array of color schemes.
 */
function jobtex_get_color_scheme_choices() {
	$color_schemes                = jobtex_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // jobtex_get_color_scheme_choices

if ( ! function_exists( 'jobtex_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since Jobtex 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function jobtex_sanitize_color_scheme( $value ) {
	$color_schemes = jobtex_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default';
	}

	return $value;
}
endif; // jobtex_sanitize_color_scheme
