<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_Job_Board_Pro_Job_City_Banner extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_job_board_pro_job_city_banner';
    }

	public function get_title() {
        return esc_html__( 'Apus Job City Banner', 'jobtex' );
    }
    
	public function get_categories() {
        return [ 'jobtex-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'City Banner', 'jobtex' ),
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
            'slug',
            [
                'label' => esc_html__( 'Location Slug', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your Location Slug here', 'jobtex' ),
            ]
        );

        $this->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Image', 'jobtex' ),
                'type' => Elementor\Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Here', 'jobtex' ),
            ]
        );

        $this->add_control(
            'show_nb_jobs',
            [
                'label' => esc_html__( 'Show Number Jobs', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'jobtex' ),
                'label_off' => esc_html__( 'Show', 'jobtex' ),
            ]
        );

        $this->add_control(
            'custom_url',
            [
                'label' => esc_html__( 'Custom URL', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your custom url here', 'jobtex' ),
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
            'section_icon_style',
            [
                'label' => esc_html__( 'Style', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__( 'Padding', 'jobtex' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__( 'Heading Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Heading Typography', 'jobtex' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => esc_html__( 'Number Color', 'jobtex' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Number Typography', 'jobtex' ),
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .number',
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget-job-city-banner <?php echo esc_attr($el_class); ?>">
            
            <?php
            $term = get_term_by( 'slug', $slug, 'job_listing_location' );
            $link = $custom_url;
            if ($term) {
                if ( empty($link) ) {
                    $link = get_term_link( $term, 'job_listing_location' );
                }
                if ( empty($title) ) {
                    $title = $term->name;
                }
            }
            ?>

            <?php
            
                $img_src = ( isset( $img_src['id'] ) && $img_src['id'] != 0 ) ? wp_get_attachment_url( $img_src['id'] ) : '';
                $style_bg = '';
                if ( !empty($img_src) ) {
                    $style_bg = 'style="background-image:url('.esc_url($img_src).')"';
                }
            ?>
                <a href="<?php echo esc_url($link); ?>">
                    <div class="city-banner-inner">
                        <?php if(!empty($img_src)){ ?>
                            <img src="<?php echo trim($img_src); ?>">
                        <?php } ?>
                        <div class="inner">
                            <?php if ( !empty($title) ) { ?>
                                <h4 class="title">
                                    <?php echo trim($title); ?>
                                </h4>
                            <?php } ?>

                            <?php if ( $show_nb_jobs ) {
                                    $args = array(
                                        'fields' => 'ids',
                                        'locations' => array($slug),
                                        'limit' => 1
                                    );
                                    $query = jobtex_get_jobs($args);
                                    $number_jobs = $count = $query->found_posts;
                                    $number_jobs = $number_jobs ? WP_Job_Board_Pro_Mixes::format_number($number_jobs) : 0;
                            ?>
                                <div class="number"><?php echo sprintf(_n('Open Job <span>(%d)</span>', 'Open Jobs <span>(%d)</span>', $count, 'jobtex'), $number_jobs); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </a>

        </div>
        <?php
    }
}

if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_Job_Board_Pro_Job_City_Banner );
} else {
    Elementor\Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_Job_Board_Pro_Job_City_Banner );
}