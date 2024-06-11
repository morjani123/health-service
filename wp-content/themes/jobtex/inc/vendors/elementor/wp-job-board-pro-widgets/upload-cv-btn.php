<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_Upload_CV_Btn extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_upload_cv_btn';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Upload CV Button', 'jobtex' );
    }
    
	public function get_categories() {
        return [ 'jobtex-header-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'jobtex' ),
                'default' => 'Upload Your CV',
            ]
        );

        $this->add_control(
            'show_add_listing',
            [
                'label' => esc_html__( 'Show Upload CV Button', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('No', 'jobtex'),
                    'always' => esc_html__('Always', 'jobtex'),
                    'show_logedin' => esc_html__('Candidate Loged in', 'jobtex'),
                    'none-register-candidate' => esc_html__('None Register and Candidate', 'jobtex'),
                ],
                'default' => 'always',
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobtex' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'jobtex' ),
            ]
        );

        $this->add_control(
                'btn_color',
                [
                    'label' => esc_html__( 'Color', 'jobtex' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    
                    'selectors' => [
                        '{{WRAPPER}} .btn' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'btn_bg_color',
                [
                    'label' => esc_html__( 'Background', 'jobtex' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    
                    'selectors' => [
                        '{{WRAPPER}} .btn' => 'background: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'btn_border',
                    'label' => esc_html__( 'Border', 'jobtex' ),
                    'selector' => '{{WRAPPER}} .btn',
                ]
            );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'jobtex' ),
            ]
        );

        $this->add_control(
            'btn_hover_color',
            [
                'label' => esc_html__( 'Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .btn:hover, {{WRAPPER}} .btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hover_bg_color',
            [
                'label' => esc_html__( 'Background', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .btn:hover, {{WRAPPER}} .btn:focus' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_br_color',
            [
                'label' => esc_html__( 'Border Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn:hover, {{WRAPPER}} .btn:focus' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'btn_border_border!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'padding_btn',
            [
                'label' => esc_html__( 'Padding', 'jobtex' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( Elementor\Plugin::$instance->editor->is_edit_mode() ) {
            ?>
            <div class="widget-submit-btn <?php echo esc_attr($el_class); ?>">
                <a class="btn btn-theme" href="javascript:void(0);">
                    <?php echo trim($button_text); ?>
                </a>
            </div>
            <?php
        } elseif ( $show_add_listing == 'always' || ($show_add_listing == 'show_logedin' && is_user_logged_in() && WP_Job_Board_Pro_User::is_candidate(get_current_user_id()) ) || ($show_add_listing == 'none-register-candidate' && (!is_user_logged_in() || WP_Job_Board_Pro_User::is_candidate(get_current_user_id())) )  ) {
            $page_id = wp_job_board_pro_get_option('my_resume_page_id');
            $page_id = WP_Job_Board_Pro_Mixes::get_lang_post_id($page_id);
            $classes = '';
            if ( ($show_add_listing == 'always' || $show_add_listing == 'none-register-candidate') && !is_user_logged_in() ) {
                $classes = 'user-login-form';
            }
            ?>
            <div class="widget-submit-btn <?php echo esc_attr($el_class); ?>">
                <a class="btn btn-theme <?php echo esc_attr($classes); ?>" href="<?php echo esc_url( get_permalink( $page_id ) ); ?>">
                    <?php echo trim($button_text); ?>
                </a>
            </div>
            <?php
        }
    }
}

if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_Upload_CV_Btn );
} else {
    Elementor\Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_Upload_CV_Btn );
}