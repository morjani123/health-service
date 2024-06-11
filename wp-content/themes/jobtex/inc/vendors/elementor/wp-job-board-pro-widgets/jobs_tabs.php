<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_Job_Board_Pro_Jobs_Tabs extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_job_board_pro_jobs_tabs';
    }

	public function get_title() {
        return esc_html__( 'Apus Jobs Tabs', 'jobtex' );
    }
    
	public function get_categories() {
        return [ 'jobtex-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Jobs', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'jobtex' ),
            ]
        );

        $this->add_control(
            'des',
            [
                'label' => esc_html__( 'Description', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your description here', 'jobtex' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title', [
                'label' => esc_html__( 'Tab Title', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'category_slugs',
            [
                'label' => esc_html__( 'Categories Slug', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slugs spearate by comma(,)', 'jobtex' ),
            ]
        );

        $repeater->add_control(
            'type_slugs',
            [
                'label' => esc_html__( 'Types Slug', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slugs spearate by comma(,)', 'jobtex' ),
            ]
        );

        $repeater->add_control(
            'location_slugs',
            [
                'label' => esc_html__( 'Location Slug', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slugs spearate by comma(,)', 'jobtex' ),
            ]
        );

        $repeater->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order by', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'jobtex'),
                    'date' => esc_html__('Date', 'jobtex'),
                    'ID' => esc_html__('ID', 'jobtex'),
                    'author' => esc_html__('Author', 'jobtex'),
                    'title' => esc_html__('Title', 'jobtex'),
                    'modified' => esc_html__('Modified', 'jobtex'),
                    'rand' => esc_html__('Random', 'jobtex'),
                    'comment_count' => esc_html__('Comment count', 'jobtex'),
                    'menu_order' => esc_html__('Menu order', 'jobtex'),
                ),
                'default' => ''
            ]
        );

        $repeater->add_control(
            'order',
            [
                'label' => esc_html__( 'Sort order', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'jobtex'),
                    'ASC' => esc_html__('Ascending', 'jobtex'),
                    'DESC' => esc_html__('Descending', 'jobtex'),
                ),
                'default' => ''
            ]
        );

        $repeater->add_control(
            'get_jobs_by',
            [
                'label' => esc_html__( 'Get Jobs By', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'featured' => esc_html__('Featured Jobs', 'jobtex'),
                    'urgent' => esc_html__('Urgent Jobs', 'jobtex'),
                    'recent' => esc_html__('Recent Jobs', 'jobtex'),
                ),
                'default' => 'recent'
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__( 'Tabs', 'jobtex' ),
                'type' => Elementor\Controls_Manager::REPEATER,
                'placeholder' => esc_html__( 'Enter your job tabs here', 'jobtex' ),
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__( 'Limit', 'jobtex' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'number',
                'description' => esc_html__( 'Limit jobs to display', 'jobtex' ),
                'default' => 4
            ]
        );
        
        

        $this->add_control(
            'job_item_style',
            [
                'label' => esc_html__( 'Job Item Style', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'list' => esc_html__('List Default', 'jobtex'),
                    'list-v1' => esc_html__('List V1', 'jobtex'),
                    'list-v2' => esc_html__('List V2', 'jobtex'),                ),
                'default' => 'list'
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid', 'jobtex'),
                    'carousel' => esc_html__('Carousel', 'jobtex'),
                    'list' => esc_html__('List', 'jobtex'),
                ),
                'default' => 'list'
            ]
        );

        $columns = range( 1, 12 );
        $columns = array_combine( $columns, $columns );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $columns,
                'frontend_available' => true,
                'default' => 3,
            ]
        );

        $this->add_responsive_control(
            'slides_to_scroll',
            [
                'label' => esc_html__( 'Slides to Scroll', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'jobtex' ),
                'options' => $columns,
                'condition' => [
                    'columns!' => '1',
                    'layout_type' => 'carousel',
                ],
                'frontend_available' => true,
                'default' => 1,
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => esc_html__( 'Rows', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'number',
                'placeholder' => esc_html__( 'Enter your rows number here', 'jobtex' ),
                'default' => 1,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label'         => esc_html__( 'Show Navigation', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'jobtex' ),
                'label_off'     => esc_html__( 'Hide', 'jobtex' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'         => esc_html__( 'Show Pagination', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'jobtex' ),
                'label_off'     => esc_html__( 'Hide', 'jobtex' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__( 'Autoplay', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'jobtex' ),
                'label_off'     => esc_html__( 'No', 'jobtex' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'         => esc_html__( 'Infinite Loop', 'jobtex' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'jobtex' ),
                'label_off'     => esc_html__( 'No', 'jobtex' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
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
            'section_tab_style',
            [
                'label' => esc_html__( 'Tab', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('style_tabs');

                $this->start_controls_tab(
                    'style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'jobtex' ),
                    ]
                );

                $this->add_control(
                    'tab_color',
                    [
                        'label' => esc_html__( 'Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tabs-jobs > li > a' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'tab_bg',
                    [
                        'label' => esc_html__( 'Bg Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tabs-jobs > li > a' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );


                $this->add_group_control(
                    Elementor\Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'tab_box_shadow',
                        'selector' => '{{WRAPPER}} .tabs-jobs > li > a',
                    ]
                );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'jobtex' ),
                    ]
                );

                $this->add_control(
                    'tab_hv_color',
                    [
                        'label' => esc_html__( 'Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tabs-jobs > li > a:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .tabs-jobs > li > a:focus' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .tabs-jobs > li.active > a' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'tab_hv_bg',
                    [
                        'label' => esc_html__( 'Bg Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .tabs-jobs > li > a:hover' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} .tabs-jobs > li > a:focus' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} .tabs-jobs > li.active > a' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Elementor\Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'tab_hv_box_shadow',
                        'selector' => '{{WRAPPER}} .tabs-jobs > li > a:hover',
                        'selector' => '{{WRAPPER}} .tabs-jobs > li > a:focus',
                        'selector' => '{{WRAPPER}} .tabs-jobs > li.active > a',
                    ]
                );


                $this->add_control(
                    'tab_hover_border_color',
                    [
                        'label' => esc_html__( 'Border Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'condition' => [
                            'border_tab_border!' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .tabs-jobs > li.active > a' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .tabs-jobs > li > a:hover' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .tabs-jobs > li > a:focus' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );



                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_group_control(
                Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border_tab',
                    'label' => esc_html__( 'Border', 'jobtex' ),
                    'selector' => '{{WRAPPER}} .tabs-jobs > li > a',
                ]
            );

            $this->add_control(
                'border-radius-tab',
                [
                    'label' => esc_html__( 'Border Radius', 'jobtex' ),
                    'type' => Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .tabs-jobs > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Typography::get_type(),
                [
                    'label' => esc_html__( 'Typography', 'jobtex' ),
                    'name' => 'typography_tab',
                    'selector' => '{{WRAPPER}} .tabs-jobs > li > a',
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_item_style',
            [
                'label' => esc_html__( 'Item', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('style_items');

                $this->start_controls_tab(
                    'style_normal_item',
                    [
                        'label' => esc_html__( 'Normal', 'jobtex' ),
                    ]
                );

                $this->add_control(
                    'item_bg',
                    [
                        'label' => esc_html__( 'Bg Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .map-item' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Elementor\Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'item_box_shadow',
                        'selector' => '{{WRAPPER}} .map-item',
                    ]
                );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'style_hover_item',
                    [
                        'label' => esc_html__( 'Hover', 'jobtex' ),
                    ]
                );
                

                $this->add_control(
                    'item_hv_bg',
                    [
                        'label' => esc_html__( 'Bg Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .map-item:hover' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'item_hover_border_color',
                    [
                        'label' => esc_html__( 'Border Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'condition' => [
                            'border_item_border!' => '',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .map-item:hover' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Elementor\Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'item_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .map-item:hover',
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_group_control(
                Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border_item',
                    'label' => esc_html__( 'Border', 'jobtex' ),
                    'selector' => '{{WRAPPER}} .map-item',
                ]
            );

            $this->add_control(
                'border-radius-item',
                [
                    'label' => esc_html__( 'Border Radius', 'jobtex' ),
                    'type' => Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .map-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__( 'Button', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs('style_button');

                $this->start_controls_tab(
                    'style_normal_button',
                    [
                        'label' => esc_html__( 'Normal', 'jobtex' ),
                    ]
                );

                $this->add_control(
                    'button_color',
                    [
                        'label' => esc_html__( 'Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .map-item .btn-apply ' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'button_bg_color',
                    [
                        'label' => esc_html__( 'Bg Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .map-item .btn-apply ' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'button_br_color',
                    [
                        'label' => esc_html__( 'Border Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .map-item .btn-apply ' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'style_hover_button',
                    [
                        'label' => esc_html__( 'Hover', 'jobtex' ),
                    ]
                );

                $this->add_control(
                    'button_hv_color',
                    [
                        'label' => esc_html__( 'Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .map-item .btn-apply:hover ' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .map-item .btn-apply:focus ' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .map-item:hover .btn-apply ' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'button_hv_bg_color',
                    [
                        'label' => esc_html__( 'Bg Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .map-item .btn-apply:hover ' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} .map-item .btn-apply:focus ' => 'background-color: {{VALUE}};',
                            '{{WRAPPER}} .map-item:hover .btn-apply ' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'button_hv_br_color',
                    [
                        'label' => esc_html__( 'Border Color', 'jobtex' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .map-item .btn-apply:hover ' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .map-item .btn-apply:focus ' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .map-item:hover .btn-apply ' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        $_id = jobtex_random_key();

        $columns = !empty($columns) ? $columns : 3;
        $columns_tablet = !empty($columns_tablet) ? $columns_tablet : 2;
        $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 1;
        
        $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : $columns;
        $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : $slides_to_scroll;
        $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : 1;
        ?>
        <div class="widget-jobs-tabs <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($el_class); ?>">
            <div class="d-xl-flex align-items-end top-info">
                <?php if( !empty( $title) || !empty( $des) ){ ?>
                    <div class="top-info-inner">
                        <?php if ( $title ) { ?>
                            <h2 class="widget-title"><?php echo trim($title); ?></h2>
                        <?php } ?>
                        <?php if ( $des ) { ?>
                            <div class="des"><?php echo trim($des); ?></div>
                        <?php } ?>
                    </div>
                <?php } ?>
                <ul role="tablist" class="nav nav-tabs tabs-jobs justify-content-lg-center">
                    <?php $tab_count = 0; foreach ($tabs as $tab) : ?>
                        <li>
                            <a href="#tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($tab_count); ?>" class="<?php echo esc_attr($tab_count == 0 ? 'active' : '');?>" data-bs-toggle="tab">
                                <?php if ( !empty($tab['title']) ) { ?>
                                    <?php echo trim($tab['title']); ?>
                                <?php } ?>
                            </a>
                        </li>
                    <?php $tab_count++; endforeach; ?>
                </ul>
            </div>
            <div class="tab-content">
                <?php $tab_count = 0; foreach ($tabs as $tab) : ?>
                    <div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($tab_count); ?>" class="tab-pane <?php echo esc_attr($tab_count == 0 ? 'active' : ''); ?>">
                        <?php

                        $category_slugs = !empty($tab['category_slugs']) ? array_map('trim', explode(',', $tab['category_slugs'])) : array();
                        $type_slugs = !empty($tab['type_slugs']) ? array_map('trim', explode(',', $tab['type_slugs'])) : array();
                        $location_slugs = !empty($tab['location_slugs']) ? array_map('trim', explode(',', $tab['location_slugs'])) : array();

                        $args = array(
                            'limit' => $limit,
                            'get_jobs_by' => !empty($tab['get_jobs_by']) ? $tab['get_jobs_by'] : 'recent',
                            'orderby' => !empty($tab['orderby']) ? $tab['orderby'] : '',
                            'order' => !empty($tab['order']) ? $tab['order'] : '',
                            'categories' => $category_slugs,
                            'types' => $type_slugs,
                            'locations' => $location_slugs,
                        );
                        $loop = jobtex_get_jobs($args);
                        if ( $loop->have_posts() ) {
                            ?>
                            <?php if ( $layout_type == 'carousel' ): ?>
                                <div class="slick-carousel"
                                    data-items="<?php echo esc_attr($columns); ?>"
                                    data-large="<?php echo esc_attr( $columns_tablet ); ?>"
                                    data-medium="<?php echo esc_attr( $columns_tablet ); ?>"
                                    data-small="<?php echo esc_attr($columns_mobile); ?>"
                                    data-smallest="<?php echo esc_attr($columns_mobile); ?>"

                                    data-slidestoscroll="<?php echo esc_attr($slides_to_scroll); ?>"
                                    data-slidestoscroll_large="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
                                    data-slidestoscroll_medium="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
                                    data-slidestoscroll_small="<?php echo esc_attr($slides_to_scroll_mobile); ?>"
                                    data-slidestoscroll_smallest="<?php echo esc_attr($slides_to_scroll_mobile); ?>"

                                    data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>"
                                    data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>"
                                    data-rows="<?php echo esc_attr( $rows ); ?>"
                                    data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>"
                                    data-autoplay="<?php echo esc_attr( $autoplay ? 'true' : 'false' ); ?>">
                                    <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
                                        <div class="cl-inner">
                                            <?php get_template_part( 'template-jobs/jobs-styles/inner', $job_item_style); ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php elseif( $layout_type == 'grid' ): ?>
                                <?php
                                    $mdcol = 12/$columns;
                                    $smcol = 12/$columns_tablet;
                                    $xscol = 12/$columns_mobile;
                                ?>
                                <div class="row">
                                    <?php while ( $loop->have_posts() ) : $loop->the_post();
                                    ?>
                                        <div class="col-xl-<?php echo esc_attr($mdcol); ?> col-md-<?php echo esc_attr($smcol); ?> col-<?php echo esc_attr( $xscol ); ?> list-item">
                                            <?php get_template_part( 'template-jobs/jobs-styles/inner', $job_item_style ); ?>
                                        </div>
                                    <?php  endwhile; ?>
                                </div>
                            <?php else: ?>
                                <div class="row">
                                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                        <div class="col-12">
                                            <?php get_template_part( 'template-jobs/jobs-styles/inner', $job_item_style ); ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php } ?>
                    </div>
                <?php $tab_count++; endforeach; ?>
            </div>
        </div>
        <?php
    }
}

if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_Job_Board_Pro_Jobs_Tabs );
} else {
    Elementor\Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_Job_Board_Pro_Jobs_Tabs );
}