<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_Job_Board_Pro_Jobs_Maps extends Elementor\Widget_Base {

	public function get_name() {
        return 'jobtex_job_board_pro_jobs_maps';
    }

	public function get_title() {
        return esc_html__( 'Apus Jobs Maps', 'jobtex' );
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
            'category_slugs',
            [
                'label' => esc_html__( 'Categories Slug', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter id spearate by comma(,)', 'jobtex' ),
            ]
        );

        $this->add_control(
            'type_slugs',
            [
                'label' => esc_html__( 'Types Slug', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter id spearate by comma(,)', 'jobtex' ),
            ]
        );

        $this->add_control(
            'location_slugs',
            [
                'label' => esc_html__( 'Location Slug', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter id spearate by comma(,)', 'jobtex' ),
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

        $this->add_control(
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

        $this->add_control(
            'get_jobs_by',
            [
                'label' => esc_html__( 'Get Jobs By', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'jobtex'),
                    'featured' => esc_html__('Featured Jobs', 'jobtex'),
                    'urgent' => esc_html__('Urgent Jobs', 'jobtex'),
                    'recent' => esc_html__('Recent Jobs', 'jobtex'),
                ),
                'default' => ''
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
                'label' => esc_html__( 'Tyles', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1440,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #jobs-google-maps' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget-jobs-maps <?php echo esc_attr($el_class); ?>">
            <?php if ( $title ) { ?>
                <h2 class="widget-title text-center"><?php echo esc_html($title); ?></h2>
            <?php } ?>
            <div class="widget-content">
                <div id="jobs-google-maps" class="jobs-google-maps" data-settings="<?php echo esc_attr(json_encode( $settings )); ?>"></div>
                <div class="hidden main-items-wrapper jobs-listing-wrapper no-filter"></div>
            </div>
        </div>
        <?php
    }
}

if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_Job_Board_Pro_Jobs_Maps );
} else {
    Elementor\Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_Job_Board_Pro_Jobs_Maps );
}