<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_Job_Board_Pro_Candidate_Search_Form extends Elementor\Widget_Base {

    public function get_name() {
        return 'apus_element_job_board_pro_candidate_search_form';
    }

    public function get_title() {
        return esc_html__( 'Apus Candidate Search Form', 'jobtex' );
    }
    
    public function get_categories() {
        return [ 'jobtex-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Search Form', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'jobtex' ),
            ]
        );

        $this->add_control(
            'des',
            [
                'label' => esc_html__( 'Content', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your content here', 'jobtex' ),
            ]
        );

        $fields = apply_filters( 'wp-job-board-pro-default-candidate-filter-fields', array() );
        $search_fields = array( '' => esc_html__('Choose a field', 'jobtex') );
        foreach ($fields as $key => $field) {
            $name = $field['name'];
            if ( empty($field['name']) ) {
                $name = $key;
            }
            $search_fields[$key] = $name;
        }

        $repeater = new Elementor\Repeater();

        $repeater->add_control(
            'filter_field',
            [
                'label' => esc_html__( 'Filter field', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $search_fields
            ]
        );
        
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
            ]
        );

        $repeater->add_control(
            'placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
            ]
        );


        $repeater->add_control(
            'filter_layout_tax',
            [
                'label' => esc_html__( 'Filter Layout', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'select' => esc_html__('Select', 'jobtex'),
                    'select_search' => esc_html__('Select Search', 'jobtex'),
                    'radio' => esc_html__('Radio Button', 'jobtex'),
                    'check_list' => esc_html__('Check Box', 'jobtex'),
                ),
                'default' => 'select',
                'condition' => [
                    'filter_field' => ['category', 'location'],
                ],
            ]
        );

        $repeater->add_control(
            'filter_layout',
            [
                'label' => esc_html__( 'Filter Layout', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'select' => esc_html__('Select', 'jobtex'),
                    'radio' => esc_html__('Radio Button', 'jobtex'),
                    'check_list' => esc_html__('Check Box', 'jobtex'),
                ),
                'default' => 'select',
                'condition' => [
                    'filter_field' => ['experience_time', 'gender', 'age', 'qualification', 'languages'],
                ],
            ]
        );

        $columns = array();
        for ($i=1; $i <= 12 ; $i++) { 
            $columns[$i] = sprintf(esc_html__('%d Columns', 'jobtex'), $i);
        }
        $repeater->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $columns,
                'default' => 1
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'jobtex' ),
                'type' => Elementor\Controls_Manager::ICON
            ]
        );

        $repeater->add_control(
            'toggle',
            [
                'label' => esc_html__( 'Toggle', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Enable', 'jobtex' ),
                'label_off' => esc_html__( 'Disable', 'jobtex' ),
            ]
        );

        $repeater->add_control(
            'toggle_hide_content',
            [
                'label' => esc_html__( 'Hide Content', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Enable', 'jobtex' ),
                'label_off' => esc_html__( 'Disable', 'jobtex' ),
            ]
        );

        $this->add_control(
            'search_fields',
            [
                'label' => esc_html__( 'Search Fields', 'jobtex' ),
                'type' => Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'filter_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Find Candidates',
            ]
        );

        $this->add_responsive_control(
            'btn_columns',
            [
                'label' => esc_html__( 'Button Columns', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $columns,
                'default' => 1
            ]
        );

        $this->add_control(
            'show_advance_search',
            [
                'label'         => esc_html__( 'Show Advanced Search', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'jobtex' ),
                'label_off'     => esc_html__( 'Hide', 'jobtex' ),
                'return_value'  => true,
                'default'       => false,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'advance_search_fields',
            [
                'label' => esc_html__( 'Advanced Search Fields', 'jobtex' ),
                'type' => Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'advanced_btn_text',
            [
                'label' => esc_html__( 'Advanced Button Text', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Advanced',
            ]
        );

        $this->add_control(
            'advanced_btn_icon',
            [
                'label' => esc_html__( 'Advanced Button Icon', 'jobtex' ),
                'type' => Elementor\Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $this->add_control(
            'popular_searches_title',
            [
                'label' => esc_html__( 'Popular Searches Title', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Popular Searches',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'popular_searches_keywords',
            [
                'label' => esc_html__( 'Popular Searches Keywords', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter id spearate by comma(,)', 'jobtex' ),
            ]
        );
        
        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'horizontal' => esc_html__('Horizontal Normal', 'jobtex'),
                    'horizontal st1' => esc_html__('Horizontal (no advance)', 'jobtex'),
                    'horizontal st_dark' => esc_html__('Horizontal (dark)', 'jobtex'),
                    'vertical' => esc_html__('Vertical', 'jobtex'),
                ),
                'default' => 'horizontal'
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
                'label' => esc_html__( 'Title', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'jobtex' ),
                'name' => 'typography_title',
                'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .widget-title',
            ]
        );

        $this->add_control(
            'color_title',
            [
                'label' => esc_html__( 'Title Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_widgettitle',
            [
                'label' => esc_html__( 'Title Margin', 'jobtex' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .widget-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'jobtex' ),
                'name' => 'typography_des',
                'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .des',
            ]
        );

        $this->add_control(
            'des_title',
            [
                'label' => esc_html__( 'Description Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .des' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_des',
            [
                'label' => esc_html__( 'Description Margin', 'jobtex' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );        

        $this->end_controls_section();


        $this->start_controls_section(
            'section_border_style',
            [
                'label' => esc_html__( 'Box Style', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_box',
            [
                'label' => esc_html__( 'Background Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .filter-listing-form' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_box',
            [
                'label' => esc_html__( 'Padding', 'jobtex' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .filter-listing-form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'jobtex' ),
                'selector' => '{{WRAPPER}} .filter-listing-form',
            ]
        );

        $this->add_responsive_control(
            'border-radius',
            [
                'label' => esc_html__( 'Border Radius', 'jobtex' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .filter-listing-form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'jobtex' ),
                'selector' => '{{WRAPPER}} .filter-listing-form',
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
                'button_color',
                [
                    'label' => esc_html__( 'Button Color', 'jobtex' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .btn-submit' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_button',
                    'label' => esc_html__( 'Background', 'jobtex' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .btn-submit',
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border_button',
                    'label' => esc_html__( 'Border', 'jobtex' ),
                    'selector' => '{{WRAPPER}} .btn-submit',
                ]
            );

            $this->end_controls_tab();

            // tab hover
            $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => esc_html__( 'Hover', 'jobtex' ),
                ]
            );

            $this->add_control(
                'button_hover_color',
                [
                    'label' => esc_html__( 'Button Color', 'jobtex' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .btn-submit:hover, {{WRAPPER}} .btn-submit:focus' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_button_hover',
                    'label' => esc_html__( 'Background', 'jobtex' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .btn-submit:hover, {{WRAPPER}} .btn-submit:focus',
                ]
            );

            $this->add_control(
                'button_hover_border_color',
                [
                    'label' => esc_html__( 'Border Color', 'jobtex' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'condition' => [
                        'border_button_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .btn-submit:hover, {{WRAPPER}} .btn-submit:focus' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        // end tab 

        $this->add_control(
            'btn-border-radius',
            [
                'label' => esc_html__( 'Border Radius', 'jobtex' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_typography_style',
            [
                'label' => esc_html__( 'Input Style', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_input_color',
            [
                'label' => esc_html__( 'Color Input', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-control' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .form-control::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .form-control:-ms-input-placeholder ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .form-control::placeholder ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .select2-selection--single .select2-selection__rendered' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .select2-selection--single .select2-selection__placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .form-group-inner > i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .select2-selection__arrow b' => 'border-color: {{VALUE}} transparent transparent transparent;',
                    '{{WRAPPER}} .select2-container--open .select2-selection__arrow b' => 'border-color: transparent transparent {{VALUE}}  transparent;',
                ],
            ]
        );

        $this->add_control(
            'bg_input',
            [
                'label' => esc_html__( 'Background Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .form-control' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .select2-selection--single' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'border_space',
            [
                'label' => esc_html__( 'Border Space Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .has-border' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_keywords_style',
            [
                'label' => esc_html__( 'Searches Keywords', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'titleserach_color',
            [
                'label' => esc_html__( 'Title Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trending-keywords .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'search_color',
            [
                'label' => esc_html__( 'Link Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trending-keywords a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trending-keywords' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'serach_hv_color',
            [
                'label' => esc_html__( 'Link Hover Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trending-keywords a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .trending-keywords a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_keywords',
            [
                'label' => esc_html__( 'Alignment', 'jobtex' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'jobtex' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'jobtex' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'jobtex' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'jobtex' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .trending-keywords' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        
        $search_page_url = WP_Job_Board_Pro_Mixes::get_candidates_page_url();

        jobtex_load_select2();

        $filter_fields = apply_filters( 'wp-job-board-pro-default-candidate-filter-fields', array() );
        $instance = array();
        $widget_id = jobtex_random_key();
        $args = array( 'widget_id' => $widget_id );

        $btn_columns = !empty($btn_columns) ? $btn_columns : 3;
        $btn_columns_tablet = !empty($btn_columns_tablet) ? $btn_columns_tablet : 3;
        $btn_columns_mobile = !empty($btn_columns_mobile) ? $btn_columns_mobile : 12;

        ?>
        <div class="widget-job-search-form <?php echo esc_attr($el_class); ?>">
            
            <?php if ( $title ) { ?>
                <h2 class="widget-title"><?php echo trim($title); ?></h2>
            <?php } ?>

            <?php if ( $des ) { ?>
                <div class="des"><?php echo trim($des); ?></div>
            <?php } ?>
            
            <form action="<?php echo esc_url($search_page_url); ?>" class="form-search filter-listing-form-wrapper" method="GET">

                <?php if ( ! get_option('permalink_structure') ) {
                    $candidates_page_id = wp_job_board_pro_get_option('candidates_page_id');
                    $candidates_page_id = WP_Job_Board_Pro_Mixes::get_lang_post_id( $candidates_page_id, 'page');
                    if ( !empty($candidates_page_id) ) {
                        echo '<input type="hidden" name="p" value="' . $candidates_page_id . '">';
                    }
                } ?>
                
                <div class="filter-listing-form <?php echo esc_attr($style); ?>">
                    <div class="main-inner clearfix">
                        <div class="content-main-inner">
                            <div class="row">
                                <?php
                                    $this->form_fields_display($search_fields, $filter_fields, $instance, $args);
                                ?>
                                <?php if ( $style != 'vertical' && ( !empty($filter_btn_text) || ($show_advance_search && !empty($advance_search_fields)) ) ) { ?>
                                    <div class="wrapper-submit d-flex align-items-center justify-content-md-end col-<?php echo esc_attr($btn_columns_mobile); ?> col-xl-<?php echo esc_attr($btn_columns); ?> col-md-<?php echo esc_attr($btn_columns_tablet); ?>">

                                        <?php if ( $show_advance_search && !empty($advance_search_fields) ) { ?>
                                            <div class="advance-link">
                                                <a href="javascript:void(0);" class="advance-search-btn">
                                                    <?php
                                                        if ( !empty($advanced_btn_icon) ) {
                                                            ?>
                                                            <i class="<?php echo esc_attr($advanced_btn_icon); ?>"></i>
                                                            <?php
                                                        }
                                                        if ( !empty($advanced_btn_text) ) {
                                                            echo esc_html($advanced_btn_text);
                                                        }
                                                    ?>
                                                </a>
                                            </div>
                                        <?php } ?>

                                        <button class="btn-submit btn btn-theme btn-inverse w-100" type="submit">
                                            <?php echo trim($filter_btn_text); ?>
                                        </button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php if ( $show_advance_search && !empty($advance_search_fields) ) { ?>
                        <div class="advance-search-wrapper">
                            <div class="advance-search-wrapper-fields">
                                <div class="row">
                                    <?php
                                        $this->form_fields_display($advance_search_fields, $filter_fields, $instance, $args, 'advance');
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ( $style == 'vertical' && ( $filter_btn_text || ($show_advance_search && !empty($advance_search_fields)) ) ) { ?>
                        <div class="row">
                            <div class="wrapper-submit d-flex align-items-center col-<?php echo esc_attr($btn_columns_mobile); ?> col-xl-<?php echo esc_attr($btn_columns); ?> col-md-<?php echo esc_attr($btn_columns_tablet); ?>">
                                
                                <?php if ( $show_advance_search && !empty($advance_search_fields) ) { ?>
                                    <div class="advance-link">
                                        <a href="javascript:void(0);" class="advance-search-btn">
                                            <?php
                                                if ( !empty($advanced_btn_icon) ) {
                                                    ?>
                                                    <i class="<?php echo esc_attr($advanced_btn_icon); ?>"></i>
                                                    <?php
                                                }
                                                if ( !empty($advanced_btn_text) ) {
                                                    echo esc_html($advanced_btn_text);
                                                }
                                            ?>
                                        </a>
                                    </div>
                                <?php } ?>

                                <button class="btn-submit btn btn-theme btn-inverse w-100" type="submit">
                                    <?php echo trim($filter_btn_text); ?>
                                </button>
                                
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <?php
                    $keywords = !empty($popular_searches_keywords) ? array_map('trim', explode(',', $popular_searches_keywords)) : array();
                    if ( !empty($keywords) ) {
                ?>
                    <div class="content-trending">
                        <ul class="trending-keywords">
                            <?php if ( $popular_searches_title ) { ?>
                                <li class="title"><?php echo esc_html($popular_searches_title); ?></li>
                            <?php } ?>
                            <?php foreach ($keywords as $keyword) {
                                $link = add_query_arg( 'filter-title', $keyword, remove_query_arg( 'filter-title', $search_page_url ) );
                            ?>
                                <li class="item"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($keyword); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </form>
        </div>
        <?php
    }

    public function form_fields_display($search_fields, $filter_fields, $instance, $args, $main ='') {
        $i = 1;
        if ( !empty($search_fields) ) {
            foreach ($search_fields as $item) {
                if ( empty($filter_fields[$item['filter_field']]['field_call_back']) ) {
                    continue;
                }
                $filter_field = $filter_fields[$item['filter_field']];

                if ( isset($item['icon']) ) {
                    $filter_field['icon'] = $item['icon'];
                }
                
                if ( isset($item['placeholder']) ) {
                    $filter_field['placeholder'] = $item['placeholder'];
                }

                if ( !empty($item['title']) ) {
                    $filter_field['name'] = $item['title'];
                    $filter_field['show_title'] = true;

                    if ( $item['toggle'] ) {
                        $filter_field['toggle'] = true;

                        if ( $item['toggle_hide_content'] ) {
                            $filter_field['hide_field_content'] = true;
                        }
                    }
                } else {
                    $filter_field['name'] = '';
                    $filter_field['show_title'] = false;
                }

                
                $filter_layout_tax = $item['filter_layout_tax'];
                

                if ( $filter_layout_tax && in_array($item['filter_field'], array('category', 'location')) ) {
                    switch ($filter_layout_tax) {
                        case 'radio':
                            $filter_field['field_call_back'] = array( 'WP_Job_Board_Pro_Abstract_Filter', 'filter_field_taxonomy_hierarchical_radio_list');
                            break;
                        case 'check_list':
                            $filter_field['field_call_back'] = array( 'WP_Job_Board_Pro_Abstract_Filter', 'filter_field_taxonomy_hierarchical_check_list');
                            break;
                        case 'select_search':
                            if ( $item['filter_field'] == 'location' ) {
                                $filter_field['field_call_back'] = array( 'WP_Job_Board_Pro_Abstract_Filter', 'filter_field_location_select_search');
                            } else {
                                $filter_field['field_call_back'] = array( 'WP_Job_Board_Pro_Abstract_Filter', 'filter_field_taxonomy_select_search');
                            }
                            break;
                        default:
                            if ( $item['filter_field'] == 'location' ) {
                                $filter_field['field_call_back'] = array( 'WP_Job_Board_Pro_Abstract_Filter', 'filter_field_location_select');
                            } else {
                                $filter_field['field_call_back'] = array( 'WP_Job_Board_Pro_Abstract_Filter', 'filter_field_taxonomy_hierarchical_select');
                            }
                            break;
                    }
                }

                if ( $item['filter_layout'] && in_array($item['filter_field'], array('experience_time', 'gender', 'age', 'qualification', 'languages')) ) {
                    switch ($item['filter_layout']) {
                        case 'radio':
                            $filter_field['field_call_back'] = array( 'WP_Job_Board_Pro_Abstract_Filter', 'filter_field_radio_list');
                            break;
                        case 'check_list':
                            $filter_field['field_call_back'] = array( 'WP_Job_Board_Pro_Abstract_Filter', 'filter_field_check_list');
                            break;
                        default:
                            $filter_field['field_call_back'] = array( 'WP_Job_Board_Pro_Abstract_Filter', 'filter_field_select');
                            break;
                    }
                }

                $columns = !empty($item['columns']) ? $item['columns'] : 3;
                $columns_tablet = !empty($item['columns_tablet']) ? $item['columns_tablet'] : 3;
                $columns_mobile = !empty($item['columns_mobile']) ? $item['columns_mobile'] : 12;
                
                ?>
                <div class="col-xl-<?php echo esc_attr($columns); ?> col-md-<?php echo esc_attr($columns_tablet); ?> <?php echo esc_attr(( $main == 'advance' )?'col-6 mb-mobile-20':'col-'.$columns_mobile); ?> <?php echo esc_attr( (count($search_fields) == $i)?'item-last':'' ); ?>">
                    <?php call_user_func( $filter_field['field_call_back'], $instance, $args, $item['filter_field'], $filter_field ); ?>
                </div>
                <?php $i++;
            }
        }
    }
}

if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_Job_Board_Pro_Candidate_Search_Form );
} else {
    Elementor\Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_Job_Board_Pro_Candidate_Search_Form );
}