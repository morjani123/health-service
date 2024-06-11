<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_User_Info extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_user_info';
    }

	public function get_title() {
        return esc_html__( 'Apus Header User Info', 'jobtex' );
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
            'layout_type',
            [
                'label' => esc_html__( 'Layout Type', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'popup' => esc_html__('Popup', 'jobtex'),
                    'page' => esc_html__('Page', 'jobtex'),
                ),
                'default' => 'popup'
            ]
        );

        $this->add_control(
            'login_register_text',
            [
                'label'         => esc_html__( 'Login Register Text', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'       => 'Login / Register',
                'placeholder'   => esc_html__( 'Login / Register', 'jobtex' ),
                'condition' => [
                    'layout_type' => 'page',
                ],
            ]
        );

        $this->add_control(
            'login_text',
            [
                'label'         => esc_html__( 'Login Text', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'       => 'Login',
                'placeholder'   => esc_html__( 'Login', 'jobtex' ),
                'condition' => [
                    'layout_type' => 'popup',
                ],
            ]
        );

        $this->add_control(
            'register_text',
            [
                'label'         => esc_html__( 'Register Text', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'       => 'Register',
                'placeholder'   => esc_html__( 'Register', 'jobtex' ),
                'condition' => [
                    'layout_type' => 'popup',
                ],
            ]
        );

        $this->add_control(
            'login_title',
            [
                'label'         => esc_html__( 'Login Popup Title', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'       => 'Login to jobtex',
                'placeholder'   => esc_html__( 'Login to jobtex', 'jobtex' ),
                'condition' => [
                    'layout_type' => 'popup',
                ],
            ]
        );

        $this->add_control(
            'register_title',
            [
                'label'         => esc_html__( 'Register Popup Title', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'       => 'Create a free jobtex account',
                'placeholder'   => esc_html__( 'Create a free jobtex account', 'jobtex' ),
                'condition' => [
                    'layout_type' => 'popup',
                ],
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
            'section_title_style',
            [
                'label' => esc_html__( 'Name Account', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .name-acount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Typography', 'jobtex' ),
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .name-acount',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button', 'jobtex' ),
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
                    'name' => 'btn_user_border',
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
                        'btn_user_border_border!' => '',
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

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Typography', 'jobtex' ),
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .btn',
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( is_user_logged_in() ) {
            $user_id = get_current_user_id();
            $userdata = get_userdata($user_id);
            $user_name = $userdata->display_name;
            if ( WP_Job_Board_Pro_User::is_employer($user_id) || WP_Job_Board_Pro_User::is_candidate($user_id) || ( method_exists('WP_Job_Board_Pro_User', 'is_employee') && WP_Job_Board_Pro_User::is_employee($user_id) ) ) {
                if ( WP_Job_Board_Pro_User::is_employer($user_id) ) {
                    $menu_nav = 'employer-menu';
                    $employer_id = WP_Job_Board_Pro_User::get_employer_by_user_id($user_id);
                    $user_name = get_post_field('post_title', $employer_id);
                    $avatar = get_the_post_thumbnail( $employer_id, 'thumbnail' );
                } elseif ( method_exists('WP_Job_Board_Pro_User', 'is_employee') && WP_Job_Board_Pro_User::is_employee($user_id) ) {
                    $user_id = WP_Job_Board_Pro_User::get_user_id();
                    
                    $menu_nav = 'employee-menu';
                    $employer_id = WP_Job_Board_Pro_User::get_employer_by_user_id($user_id);
                    $user_name = get_post_field('post_title', $employer_id);
                    $avatar = get_the_post_thumbnail( $employer_id, 'thumbnail' );
                } else {
                    $menu_nav = 'candidate-menu';
                    $candidate_id = WP_Job_Board_Pro_User::get_candidate_by_user_id($user_id);
                    $user_name = get_post_field('post_title', $candidate_id);
                    $avatar = get_the_post_thumbnail( $candidate_id, 'thumbnail' );
                }
            }
            ?>
            <div class="top-wrapper-menu <?php echo esc_attr($el_class); ?> pull-right">
                <a class="drop-dow" href="javascript:void(0);">
                    <div class="infor-account d-flex align-items-center">
                        <div class="avatar-wrapper">
                            <?php if ( !empty($avatar)) {
                                echo trim($avatar);
                            } else {
                                echo get_avatar($user_id, 54);
                            } ?>
                        </div>
                        <div class="name-acount"><?php echo esc_html($user_name); ?> 
                            <?php if ( !empty($menu_nav) && has_nav_menu( $menu_nav ) ) { ?>
                                <i class="ti-angle-down" aria-hidden="true"></i>
                            <?php } ?>
                        </div>
                    </div>
                </a>
                <?php
                    if ( !empty($menu_nav) && has_nav_menu( $menu_nav ) ) {
                        $args = array(
                            'theme_location' => $menu_nav,
                            'container_class' => 'inner-top-menu',
                            'menu_class' => 'nav navbar-nav topmenu-menu',
                            'fallback_cb' => '',
                            'menu_id' => '',
                            'walker' => new Jobtex_Nav_Menu()
                        );
                        wp_nav_menu($args);
                    }
                ?>
            </div>
        <?php } else {
            $show_candidate = jobtex_get_config('register_form_enable_candidate', true);
            $show_employer = jobtex_get_config('register_form_enable_employer', true);
            

            $login_register_page_id = wp_job_board_pro_get_option('login_register_page_id');
            ?>
                <div class="top-wrapper-menu <?php echo esc_attr($el_class); ?>">

                    <?php if ( $layout_type == 'page' ) { ?>
                        <a class="btn btn-login login" href="<?php echo esc_url( get_permalink( $login_register_page_id ) ); ?>" title="<?php esc_attr_e('Sign in','jobtex'); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <?php echo trim($login_register_text); ?>
                        </a>
                    <?php } else { ?>
                        <div class="login-register-btn">
                            <a class="apus-user-login btn btn-login" href="#apus_login_forgot_form">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                  <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                  <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span><?php echo trim($login_text); ?></span>
                                <?php
                                if ( $show_candidate || $show_employer ) {
                                    ?>
                                    <span class="separate">/</span>
                                    <span><?php echo trim($register_text); ?></span>
                                <?php } ?>
                            </a>
                        </div>

                        <div id="apus_login_forgot_form" class="apus_login_register_form mfp-hide" data-effect="fadeIn">
                            <div class="form-login-register-inner">
                                <div class="title-wrapper d-flex align-items-center">
                                    <?php if ( !empty($login_title) ) { ?>
                                        <h3 class="title"><?php echo trim($login_title); ?></h3>
                                    <?php } ?>

                                    <a href="javascript:void(0);" class="close-magnific-popup ms-auto"><i class="ti-close"></i></a>
                                </div>
                                <?php echo do_shortcode( '[wp_job_board_pro_login popup="true"]' ); ?>
                            </div>
                        </div>
                        <?php if ( $show_candidate || $show_employer ) { ?>
                            <div id="apus_register_form" class="apus_login_register_form mfp-hide" data-effect="fadeIn">
                                <div class="form-login-register-inner">
                                    <div class="title-wrapper d-flex align-items-center">
                                        <?php if ( !empty($register_title) ) { ?>
                                            <h3 class="title"><?php echo trim($register_title); ?></h3>
                                        <?php } ?>

                                        <a href="javascript:void(0);" class="close-magnific-popup ms-auto"><i class="ti-close"></i></a>
                                    </div>
                                    
                                    <?php echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'template-jobs/misc/register', array('popup' => true) ); ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>
            <?php
        }
    }
}

if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_User_Info );
} else {
    Elementor\Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_User_Info );
}