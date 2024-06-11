<?php

function jobtex_register_form_customize_register( $wp_customize ) {

    // General Section
    $wp_customize->add_section('jobtex_settings_register_form_general', array(
        'title'    => esc_html__('Register Form', 'jobtex'),
        'priority' => 5,
    ));


    $wp_customize->add_setting('jobtex_theme_options[register_form_enable_candidate]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => true
    ));

    $wp_customize->add_control('jobtex_theme_options_register_form_enable_candidate', array(
        'settings' => 'jobtex_theme_options[register_form_enable_candidate]',
        'label'    => esc_html__('Enable Register Candidate', 'jobtex'),
        'section'  => 'jobtex_settings_register_form_general',
        'type'     => 'checkbox',
    ));


    $wp_customize->add_setting('jobtex_theme_options[register_form_enable_employer]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => true
    ));

    $wp_customize->add_control('jobtex_theme_options_register_form_enable_employer', array(
        'settings' => 'jobtex_theme_options[register_form_enable_employer]',
        'label'    => esc_html__('Enable Register Employer', 'jobtex'),
        'section'  => 'jobtex_settings_register_form_general',
        'type'     => 'checkbox',
    ));
}
add_action( 'customize_register', 'jobtex_register_form_customize_register', 15 );