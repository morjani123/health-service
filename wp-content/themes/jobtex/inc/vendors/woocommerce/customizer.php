<?php

function jobtex_woo_customize_register( $wp_customize ) {
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
    $wp_customize->add_panel( 'jobtex_settings_shop', array(
        'title' => esc_html__( 'Shop Settings', 'jobtex' ),
        'priority' => 4,
    ) );

    // General Section
    $wp_customize->add_section('jobtex_settings_shop_general', array(
        'title'    => esc_html__('General', 'jobtex'),
        'priority' => 1,
        'panel' => 'jobtex_settings_shop',
    ));

    // Breadcrumbs
    $wp_customize->add_setting('jobtex_theme_options[show_product_breadcrumbs]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_product_breadcrumbs', array(
        'settings' => 'jobtex_theme_options[show_product_breadcrumbs]',
        'label'    => esc_html__('Breadcrumbs', 'jobtex'),
        'section'  => 'jobtex_settings_shop_general',
        'type'     => 'checkbox',
    ));

    // Breadcrumbs Background Color
    $wp_customize->add_setting('jobtex_theme_options[woo_breadcrumb_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'woo_breadcrumb_color', array(
        'label'    => esc_html__('Breadcrumbs Background Color', 'jobtex'),
        'section'  => 'jobtex_settings_shop_general',
        'settings' => 'jobtex_theme_options[woo_breadcrumb_color]',
    )));

    // Breadcrumbs Background
    $wp_customize->add_setting('jobtex_theme_options[woo_breadcrumb_image]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'woo_breadcrumb_image', array(
        'label'    => esc_html__('Breadcrumbs Background', 'jobtex'),
        'section'  => 'jobtex_settings_shop_general',
        'settings' => 'jobtex_theme_options[woo_breadcrumb_image]',
    )));


    // Product Archives
    $wp_customize->add_section('jobtex_settings_shop_archive', array(
        'title'    => esc_html__('Product Archives', 'jobtex'),
        'priority' => 2,
        'panel' => 'jobtex_settings_shop',
    ));

    // General Setting ?
    $wp_customize->add_setting('jobtex_theme_options[show_shop_general_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Jobtex_WP_Customize_Heading_Control($wp_customize, 'show_shop_general_setting', array(
        'label'    => esc_html__('General Settings', 'jobtex'),
        'section'  => 'jobtex_settings_shop_archive',
        'settings' => 'jobtex_theme_options[show_shop_general_setting]',
    )));


    // Show Shop/Category Title ?
    $wp_customize->add_setting('jobtex_theme_options[show_shop_cat_title]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_shop_cat_title', array(
        'settings' => 'jobtex_theme_options[show_shop_cat_title]',
        'label'    => esc_html__('Show Shop/Category Title ?', 'jobtex'),
        'section'  => 'jobtex_settings_shop_archive',
        'type'     => 'checkbox',
    ));

    // Display Mode
    $wp_customize->add_setting( 'jobtex_theme_options[product_display_mode]', array(
        'default'        => 'grid',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_archive_blog_archive', array(
        'label'   => esc_html__('Display Mode', 'jobtex'),
        'section' => 'jobtex_settings_shop_archive',
        'type'    => 'select',
        'choices' => array(
            'grid' => esc_html__('Grid', 'jobtex'),
            'list' => esc_html__('List', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[product_display_mode]',
    ) );

    // products Columns
    $wp_customize->add_setting( 'jobtex_theme_options[product_columns]', array(
        'default'        => '4',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_archive_product_columns', array(
        'label'   => esc_html__('Product Columns', 'jobtex'),
        'section' => 'jobtex_settings_shop_archive',
        'type'    => 'select',
        'choices' => $columns,
        'settings' => 'jobtex_theme_options[product_columns]',
    ) );

    // Number of Products Per Page
    $wp_customize->add_setting( 'jobtex_theme_options[number_products_per_page]', array(
        'default'        => '12',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_archive_number_products_per_page', array(
        'label'   => esc_html__('Number of Products Per Page', 'jobtex'),
        'section' => 'jobtex_settings_shop_archive',
        'type'    => 'number',
        'settings' => 'jobtex_theme_options[number_products_per_page]',
    ) );

    // Enable Swap Image
    $wp_customize->add_setting('jobtex_theme_options[enable_swap_image]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'       => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_enable_swap_image', array(
        'settings' => 'jobtex_theme_options[enable_swap_image]',
        'label'    => esc_html__('Enable Swap Image', 'jobtex'),
        'section'  => 'jobtex_settings_shop_archive',
        'type'     => 'checkbox',
    ));

    // Sidebar Setting ?
    $wp_customize->add_setting('jobtex_theme_options[show_shop_sidebar_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Jobtex_WP_Customize_Heading_Control($wp_customize, 'show_shop_sidebar_setting', array(
        'label'    => esc_html__('Sidebar Settings', 'jobtex'),
        'section'  => 'jobtex_settings_shop_archive',
        'settings' => 'jobtex_theme_options[show_shop_sidebar_setting]',
    )));

    // layout
    $wp_customize->add_setting( 'jobtex_theme_options[product_archive_layout]', array(
        'default'        => 'main',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Jobtex_WP_Customize_Radio_Image_Control( 
        $wp_customize, 
        'jobtex_settings_shop_archive_layout', 
        array(
            'label'   => esc_html__('Layout Type', 'jobtex'),
            'section' => 'jobtex_settings_shop_archive',
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
            'settings' => 'jobtex_theme_options[product_archive_layout]',
            'description' => esc_html__('Select the variation you want to apply on your shop/archive page.', 'jobtex'),
        ) 
    ));

    // Is Full Width
    $wp_customize->add_setting('jobtex_theme_options[product_archive_fullwidth]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_product_archive_fullwidth', array(
        'settings' => 'jobtex_theme_options[product_archive_fullwidth]',
        'label'    => esc_html__('Is Full Width', 'jobtex'),
        'section'  => 'jobtex_settings_shop_archive',
        'type'     => 'checkbox',
    ));

    

    // Left Sidebar
    $wp_customize->add_setting( 'jobtex_theme_options[product_archive_left_sidebar]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_archive_left_sidebar', array(
        'label'   => esc_html__('Archive Left Sidebar', 'jobtex'),
        'section' => 'jobtex_settings_shop_archive',
        'type'    => 'select',
        'choices' => $sidebars,
        'settings' => 'jobtex_theme_options[product_archive_left_sidebar]',
        'description' => esc_html__('Choose a sidebar for left sidebar', 'jobtex'),
    ) );

    // Right Sidebar
    $wp_customize->add_setting( 'jobtex_theme_options[product_archive_right_sidebar]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_archive_right_sidebar', array(
        'label'   => esc_html__('Archive Right Sidebar', 'jobtex'),
        'section' => 'jobtex_settings_shop_archive',
        'type'    => 'select',
        'choices' => $sidebars,
        'settings' => 'jobtex_theme_options[product_archive_right_sidebar]',
        'description' => esc_html__('Choose a sidebar for right sidebar', 'jobtex'),
    ) );




    // Single Product
    $wp_customize->add_section('jobtex_settings_shop_single', array(
        'title'    => esc_html__('Single Product', 'jobtex'),
        'priority' => 3,
        'panel' => 'jobtex_settings_shop',
    ));

    // General Setting ?
    $wp_customize->add_setting('jobtex_theme_options[show_shop_single_general_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Jobtex_WP_Customize_Heading_Control($wp_customize, 'show_shop_single_general_setting', array(
        'label'    => esc_html__('General Settings', 'jobtex'),
        'section'  => 'jobtex_settings_shop_single',
        'settings' => 'jobtex_theme_options[show_shop_single_general_setting]',
    )));

    // Thumbnails Position
    $wp_customize->add_setting( 'jobtex_theme_options[product_thumbs_position]', array(
        'default'        => 'thumbnails-bottom',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_single_thumbs_position', array(
        'label'   => esc_html__('Thumbnails Position', 'jobtex'),
        'section' => 'jobtex_settings_shop_single',
        'type'    => 'select',
        'choices' => array(
            'thumbnails-left' => esc_html__('Thumbnails Left', 'jobtex'),
            'thumbnails-right' => esc_html__('Thumbnails Right', 'jobtex'),
            'thumbnails-bottom' => esc_html__('Thumbnails Bottom', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[product_thumbs_position]',
    ) );

    // Number Thumbnails Per Row
    $wp_customize->add_setting( 'jobtex_theme_options[number_product_thumbs]', array(
        'default'        => '5',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_single_number_product_thumbs', array(
        'label'   => esc_html__('Number Thumbnails Per Row', 'jobtex'),
        'section' => 'jobtex_settings_shop_single',
        'type'    => 'number',
        'settings' => 'jobtex_theme_options[number_product_thumbs]',
    ) );

    // Show Social Share
    $wp_customize->add_setting('jobtex_theme_options[show_product_social_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_product_social_share', array(
        'settings' => 'jobtex_theme_options[show_product_social_share]',
        'label'    => esc_html__('Show Social Share', 'jobtex'),
        'section'  => 'jobtex_settings_shop_single',
        'type'     => 'checkbox',
    ));

    // Show Product Review Tab
    $wp_customize->add_setting('jobtex_theme_options[show_product_review_tab]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_product_review_tab', array(
        'settings' => 'jobtex_theme_options[show_product_review_tab]',
        'label'    => esc_html__('Show Product Review Tab', 'jobtex'),
        'section'  => 'jobtex_settings_shop_single',
        'type'     => 'checkbox',
    ));

    // Sidebar Setting ?
    $wp_customize->add_setting('jobtex_theme_options[show_shop_single_sidebar_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Jobtex_WP_Customize_Heading_Control($wp_customize, 'show_shop_single_sidebar_setting', array(
        'label'    => esc_html__('Sidebar Settings', 'jobtex'),
        'section'  => 'jobtex_settings_shop_single',
        'settings' => 'jobtex_theme_options[show_shop_single_sidebar_setting]',
    )));

    // layout
    $wp_customize->add_setting( 'jobtex_theme_options[product_single_layout]', array(
        'default'        => 'left-main',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_single_layout', array(
        'label'   => esc_html__('Layout Type', 'jobtex'),
        'section' => 'jobtex_settings_shop_single',
        'type'    => 'select',
        'choices' => array(
            'main' => esc_html__('Main Only', 'jobtex'),
            'left-main' => esc_html__('Left - Main Sidebar', 'jobtex'),
            'main-right' => esc_html__('Main - Right Sidebar', 'jobtex'),
        ),
        'settings' => 'jobtex_theme_options[product_single_layout]',
        'description' => esc_html__('Select the variation you want to apply on your blog.', 'jobtex'),
    ) );

    // Is Full Width
    $wp_customize->add_setting('jobtex_theme_options[product_single_fullwidth]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_product_single_fullwidth', array(
        'settings' => 'jobtex_theme_options[product_single_fullwidth]',
        'label'    => esc_html__('Is Full Width', 'jobtex'),
        'section'  => 'jobtex_settings_shop_single',
        'type'     => 'checkbox',
    ));

    // Left Sidebar
    $wp_customize->add_setting( 'jobtex_theme_options[product_single_left_sidebar]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_single_left_sidebar', array(
        'label'   => esc_html__('Single Left Sidebar', 'jobtex'),
        'section' => 'jobtex_settings_shop_single',
        'type'    => 'select',
        'choices' => $sidebars,
        'settings' => 'jobtex_theme_options[product_single_left_sidebar]',
        'description' => esc_html__('Choose a sidebar for left sidebar', 'jobtex'),
    ) );

    // Right Sidebar
    $wp_customize->add_setting( 'jobtex_theme_options[product_single_right_sidebar]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_single_right_sidebar', array(
        'label'   => esc_html__('Single Right Sidebar', 'jobtex'),
        'section' => 'jobtex_settings_shop_single',
        'type'    => 'select',
        'choices' => $sidebars,
        'settings' => 'jobtex_theme_options[product_single_right_sidebar]',
        'description' => esc_html__('Choose a sidebar for right sidebar', 'jobtex'),
    ) );

    // Product Block Setting ?
    $wp_customize->add_setting('jobtex_theme_options[show_shop_single_product_block_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Jobtex_WP_Customize_Heading_Control($wp_customize, 'show_shop_single_product_block_setting', array(
        'label'    => esc_html__('Product Block Settings', 'jobtex'),
        'section'  => 'jobtex_settings_shop_single',
        'settings' => 'jobtex_theme_options[show_shop_single_product_block_setting]',
    )));

    // Show Products Related
    $wp_customize->add_setting('jobtex_theme_options[show_product_related]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_product_related', array(
        'settings' => 'jobtex_theme_options[show_product_related]',
        'label'    => esc_html__('Show Products Related', 'jobtex'),
        'section'  => 'jobtex_settings_shop_single',
        'type'     => 'checkbox',
    ));

    // Number related products
    $wp_customize->add_setting( 'jobtex_theme_options[number_product_related]', array(
        'default'        => '4',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_single_number_product_related', array(
        'label'   => esc_html__('Number related products', 'jobtex'),
        'section' => 'jobtex_settings_shop_single',
        'type'    => 'number',
        'settings' => 'jobtex_theme_options[number_product_related]',
    ) );

    // Related Products Columns
    $wp_customize->add_setting( 'jobtex_theme_options[related_product_columns]', array(
        'default'        => '4',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_single_related_product_columns', array(
        'label'   => esc_html__('Related Products Columns', 'jobtex'),
        'section' => 'jobtex_settings_shop_single',
        'type'    => 'select',
        'choices' => $columns,
        'settings' => 'jobtex_theme_options[related_product_columns]',
    ) );

    // Show Products upsells
    $wp_customize->add_setting('jobtex_theme_options[show_product_upsells]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('jobtex_theme_options_show_product_upsells', array(
        'settings' => 'jobtex_theme_options[show_product_upsells]',
        'label'    => esc_html__('Show Products upsells', 'jobtex'),
        'section'  => 'jobtex_settings_shop_single',
        'type'     => 'checkbox',
    ));

    // Upsells Products Columns
    $wp_customize->add_setting( 'jobtex_theme_options[upsells_product_columns]', array(
        'default'        => '4',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'jobtex_settings_shop_single_upsells_product_columns', array(
        'label'   => esc_html__('Upsells Products Columns', 'jobtex'),
        'section' => 'jobtex_settings_shop_single',
        'type'    => 'select',
        'choices' => $columns,
        'settings' => 'jobtex_theme_options[upsells_product_columns]',
    ) );
}
add_action( 'customize_register', 'jobtex_woo_customize_register', 15 );