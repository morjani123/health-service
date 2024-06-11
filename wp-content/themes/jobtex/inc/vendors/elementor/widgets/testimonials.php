<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_Testimonials extends Widget_Base {

    public function get_name() {
        return 'apus_element_testimonials';
    }

    public function get_title() {
        return esc_html__( 'Apus Testimonials', 'jobtex' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_categories() {
        return [ 'jobtex-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'jobtex' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'jobtex' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'content', [
                'label' => esc_html__( 'Content', 'jobtex' ),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $repeater->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Choose Image', 'jobtex' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Brand Image', 'jobtex' ),
            ]
        );
        $repeater->add_control(
            'name',
            [
                'label' => esc_html__( 'Name', 'jobtex' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'job',
            [
                'label' => esc_html__( 'Job', 'jobtex' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'star',
            [
                'label' => esc_html__( 'Star Scores', 'jobtex' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '1' => esc_html__('1 Star', 'jobtex'),
                    '2' => esc_html__('2 Star', 'jobtex'),
                    '3' => esc_html__('3 Star', 'jobtex'),
                    '4' => esc_html__('4 Star', 'jobtex'),
                    '5' => esc_html__('5 Star', 'jobtex'),
                ),
                'default' => '5',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link To', 'jobtex' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'Enter your social link here', 'jobtex' ),
                'placeholder' => esc_html__( 'https://your-link.com', 'jobtex' ),
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__( 'Testimonials', 'jobtex' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );
        
        $columns = range( 1, 12 );
        $columns = array_combine( $columns, $columns );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'jobtex' ),
                'type' => Controls_Manager::SELECT,
                'options' => $columns,
                'frontend_available' => true,
                'default' => 3,
            ]
        );
        
        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'jobtex' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'jobtex'),
                    'style2' => esc_html__('Style 2', 'jobtex'),
                ),
                'default' => 'style1'
            ]
        );
        $this->add_control(
            'show_nav',
            [
                'label' => esc_html__( 'Show Nav', 'jobtex' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'jobtex' ),
                'label_off' => esc_html__( 'Show', 'jobtex' ),
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => esc_html__( 'Show Pagination', 'jobtex' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'jobtex' ),
                'label_off' => esc_html__( 'Show', 'jobtex' ),
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'         => esc_html__( 'Infinite Loop', 'jobtex' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'jobtex' ),
                'label_off'     => esc_html__( 'No', 'jobtex' ),
                'return_value'  => true,
                'default'       => true,
            ]
        );

        $this->add_control(
            'fullscreen',
            [
                'label'         => esc_html__( 'Full Screen', 'jobtex' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'jobtex' ),
                'label_off'     => esc_html__( 'No', 'jobtex' ),
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'jobtex' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'jobtex' ),
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Tyles', 'jobtex' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'jobtex' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'jobtex' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'test_title_color',
            [
                'label' => esc_html__( 'Testimonial Name Color', 'jobtex' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .name-client a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .name-client' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Testimonial Name Typography', 'jobtex' ),
                'name' => 'test_title_typography',
                'selector' => '{{WRAPPER}} .name-client',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'jobtex' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Content Typography', 'jobtex' ),
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_control(
            'job_color',
            [
                'label' => esc_html__( 'Job Color', 'jobtex' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Job Typography', 'jobtex' ),
                'name' => 'job_typography',
                'selector' => '{{WRAPPER}} .job',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($testimonials) ) {

            $columns = !empty($columns) ? $columns : 3;
            $columns_tablet = !empty($columns_tablet) ? $columns_tablet : 2;
            $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 1;
            
            $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : $columns;
            $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : $slides_to_scroll;
            $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : 1;

            ?>
            <div class="widget-testimonials <?php echo esc_attr($el_class.' '.$style); ?> <?php echo esc_attr( $fullscreen ? 'fullscreen' : 'nofullscreen' ); ?>">
                
                <div class="slick-carousel testimonial-main <?php echo esc_attr($columns < count($testimonials)?'':'hidden-dots'); ?>" 
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

                    data-pagination="<?php echo esc_attr($show_pagination ? 'true' : 'false'); ?>" 
                    data-nav="<?php echo esc_attr($show_nav ? 'true' : 'false'); ?>"
                    data-infinite="<?php echo esc_attr($infinite_loop ? 'true' : 'false'); ?>"
                    <?php if($fullscreen){ ?>
                        data-centermode="true"
                        data-centerpadding="0px"
                    <?php } ?>
                    >
                    <?php foreach ($testimonials as $item) { ?>
                    <?php $img_src = ( isset( $item['img_src']['id'] ) && $item['img_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_src']['id'] ) : ''; ?>
                    <div class="item">
                            
                                <?php if( $style == 'style1' ) { ?>
                                    <div class="testimonials-item">
                                        <?php if ( !empty($item['title']) ) { ?>
                                            <h3 class="title"><?php echo trim($item['title']); ?></h3>
                                        <?php } ?>

                                        <?php if ( !empty($item['content']) ) { ?>
                                            <div class="description"><?php echo trim($item['content']); ?></div>
                                        <?php } ?>

                                        <div class="bottom-info d-flex align-items-center">
                                            <?php if ( $img_src ) { ?>
                                                <div class="avarta flex-shrink-0">
                                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                                </div>
                                            <?php } ?>
                                            <div class="info-testimonials flex-grow-1">

                                                <?php if ( !empty($item['name']) ) {

                                                    $title = '<h3 class="name-client">'.$item['name'].'</h3>';
                                                    if ( ! empty( $item['link']['url'] ) ) {
                                                        $title = sprintf( '<h3 class="name-client"><a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>%1$s</a></h3>', $item['name'] );
                                                    }
                                                    echo trim($title);
                                                ?>
                                                <?php } ?>

                                                <?php if ( !empty($item['job']) ) { ?>
                                                    <div class="job text-theme"><?php echo trim($item['job']); ?></div>
                                                <?php } ?>

                                                <?php if ( !empty($item['star']) ) { ?>
                                                    <div class="star d-flex align-items-center">
                                                        <span class="text d-none"><?php echo number_format($item['star'], 1, '.', ''); ?> </span>
                                                        <div class="inner">
                                                            <div class="w-percent" style="width: <?php echo trim($item['star']*20)?>%;"></div>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="testimonials-item-v2">
                                        <div class="d-flex align-items-center">
                                            <?php if ( $img_src ) { ?>
                                                <div class="avarta flex-shrink-0">
                                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                                </div>
                                            <?php } ?>
                                            <div class="inner flex-grow-1">
                                                <?php if ( !empty($item['star']) ) { ?>
                                                    <div class="star d-flex align-items-center">
                                                        <span class="text d-none"><?php echo number_format($item['star'], 1, '.', ''); ?> </span>
                                                        <div class="inner">
                                                            <div class="w-percent" style="width: <?php echo trim($item['star']*20)?>%;"></div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php if ( !empty($item['title']) ) { ?>
                                                    <h3 class="title text-theme"><?php echo trim($item['title']); ?></h3>
                                                <?php } ?>
                                                <?php if ( !empty($item['content']) ) { ?>
                                                    <div class="description"><?php echo trim($item['content']); ?></div>
                                                <?php } ?>
                                                <div class="info-testimonials">

                                                    <?php if ( !empty($item['name']) ) {

                                                        $title = '<h3 class="name-client">'.$item['name'].'</h3>';
                                                        if ( ! empty( $item['link']['url'] ) ) {
                                                            $title = sprintf( '<h3 class="name-client"><a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>%1$s</a></h3>', $item['name'] );
                                                        }
                                                        echo trim($title);
                                                    ?>
                                                    <?php } ?>

                                                    <?php if ( !empty($item['job']) ) { ?>
                                                        <div class="job"><?php echo trim($item['job']); ?></div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                    </div>
                    <?php } ?>
                </div>

            </div>
            <?php
        }
    }
}
if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_Testimonials );
} else {
    Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_Testimonials );
}