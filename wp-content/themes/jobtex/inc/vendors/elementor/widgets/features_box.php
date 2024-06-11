<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_Features_Box extends Widget_Base {

	public function get_name() {
        return 'apus_element_features_box';
    }

	public function get_title() {
        return esc_html__( 'Apus Features Box', 'jobtex' );
    }

	public function get_icon() {
        return 'eicon-image-box';
    }

	public function get_categories() {
        return [ 'jobtex-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Features Box', 'jobtex' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image_icon',
            [
                'label' => esc_html__( 'Image or Icon', 'jobtex' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'icon' => esc_html__('Icon', 'jobtex'),
                    'image' => esc_html__('Image', 'jobtex'),
                ),
                'default' => 'image'
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'jobtex' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
                'condition' => [
                    'image_icon' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'jobtex' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'image_icon' => 'image',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
                'condition' => [
                    'image_icon' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'sub_title_text',
            [
                'label' => esc_html__( 'Sub Title', 'jobtex' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Enter your Sub title', 'jobtex' ),
            ]
        );

        $repeater->add_control(
            'title_text',
            [
                'label' => esc_html__( 'Title', 'jobtex' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'This is the heading', 'jobtex' ),
                'placeholder' => esc_html__( 'Enter your title', 'jobtex' ),
            ]
        );

        $repeater->add_control(
            'description_text',
            [
                'label' => esc_html__( 'Content', 'jobtex' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'jobtex' ),
                'placeholder' => esc_html__( 'Enter your description', 'jobtex' ),
                'separator' => 'none',
                'rows' => 10,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link to', 'jobtex' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'jobtex' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => esc_html__( 'Features Box', 'jobtex' ),
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
                    'style3' => esc_html__('Style 3', 'jobtex'),
                    'style4' => esc_html__('Style 4', 'jobtex'),
                ),
                'default' => 'style1'
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Layout', 'jobtex' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'carousel' => esc_html__('Carousel', 'jobtex'),
                    'grid' => esc_html__('Grid', 'jobtex'),
                ),
                'default' => 'carousel',
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
                'condition' => [
                    'layout' => 'carousel',
                ],
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
                'condition' => [
                    'layout' => 'carousel',
                ],
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
                'label' => esc_html__( 'Style', 'jobtex' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // tab normal and hover

        $this->start_controls_tabs( 'tabs_info_style' );

            $this->start_controls_tab(
                'tab_info_normal',
                [
                    'label' => esc_html__( 'Normal', 'jobtex' ),
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Title Color', 'jobtex' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .title' => 'color: {{VALUE}};',
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
                'desc_color',
                [
                    'label' => esc_html__( 'Description Color', 'jobtex' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => esc_html__( 'Description Typography', 'jobtex' ),
                    'name' => 'desc_typography',
                    'selector' => '{{WRAPPER}} .description',
                ]
            );

            $this->end_controls_tab();

            // tab hover
            $this->start_controls_tab(
                'tab_info_hover',
                [
                    'label' => esc_html__( 'Hover', 'jobtex' ),
                ]
            );

            $this->add_control(
                'title_hv_color',
                [
                    'label' => esc_html__( 'Title Color', 'jobtex' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .item-inner:hover .title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => esc_html__( 'Title Typography', 'jobtex' ),
                    'name' => 'title_hv_typography',
                    'selector' => '{{WRAPPER}} .item-inner:hover .title',
                ]
            );

            $this->add_control(
                'desc_hv_color',
                [
                    'label' => esc_html__( 'Description Color', 'jobtex' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .item-inner:hover .description' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => esc_html__( 'Description Typography', 'jobtex' ),
                    'name' => 'desc_hv_typography',
                    'selector' => '{{WRAPPER}} .item-inner:hover .description',
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        // end tab normal and hover

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => esc_html__( 'Icon Style', 'jobtex' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'tabs_icon_style' );

            $this->start_controls_tab(
                'tab_icon_normal',
                [
                    'label' => esc_html__( 'Normal', 'jobtex' ),
                ]
            );

            $this->add_control(
                'icon_color',
                [
                    'label' => esc_html__( 'Icon Color', 'jobtex' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .features-box-image' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'icon_bg_color',
                [
                    'label' => esc_html__( 'Icon BG Color', 'jobtex' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .features-box-image' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            $this->end_controls_tab();

            // tab hover
            $this->start_controls_tab(
                'tab_icon_hover',
                [
                    'label' => esc_html__( 'Hover', 'jobtex' ),
                ]
            );

            $this->add_control(
                'icon_hv_color',
                [
                    'label' => esc_html__( 'Icon Color', 'jobtex' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .item-inner:hover .features-box-image' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'icon_hv_bg_color',
                [
                    'label' => esc_html__( 'Icon BG Color', 'jobtex' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .item-inner:hover .features-box-image' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();
            // end tab normal and hover

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($features) ) {

            $columns = !empty($columns) ? $columns : 3;
            $columns_tablet = !empty($columns_tablet) ? $columns_tablet : 2;
            $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 1;
            
            $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : $columns;
            $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : $slides_to_scroll;
            $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : 1;

            ?>
            <div class="widget-features-box <?php echo esc_attr($el_class.' '.$style); ?>">
                <?php if($layout == 'carousel') {?>
                    <div class="slick-carousel <?php echo esc_attr($columns < count($features) ?'':'hidden-dots'); ?>" 
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
                    >
                        <?php foreach ($features as $item): ?>
                            <div class="item">
                                <div class="item-inner">
                                    <div class="top-inner">
                                        <?php if(!empty($item['number'])) {?>
                                            <div class="number">
                                                <?php echo (int)$item['number']; ?>
                                            </div>
                                        <?php } ?>
                                        <?php
                                        $has_content = ! empty( $item['title_text'] ) || ! empty( $item['description_text'] );
                                        $html = '';

                                        if ( $item['image_icon'] == 'image' ) {
                                            if ( ! empty( $item['image']['url'] ) ) {
                                                $this->add_render_attribute( 'image', 'src', $item['image']['url'] );
                                                $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $item['image'] ) );
                                                $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $item['image'] ) );


                                                $image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' );

                                                if ( ! empty( $item['link']['url'] ) ) {
                                                    $image_html = '<a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>' . $image_html . '</a>';
                                                }

                                                $html .= '<div class="features-box-image img">' . $image_html . '</div>';
                                            }
                                        } elseif ( $item['image_icon'] == 'icon' && !empty($item['icon'])) {
                                            $html .= '<div class="features-box-image icon"><i class="'.$item['icon'].'"></i></div>';
                                        }
                                    $html .= '</div>';
                                    if ( $has_content ) {
                                        $html .= '<div class="features-box-content">';
                                        if ( ! empty( $item['sub_title_text'] ) ) {
                                            $html .= sprintf( '<div class="sub_title_text">%1$s</div>', $item['sub_title_text'] );
                                        }
                                        if ( ! empty( $item['title_text'] ) ) {
                                            
                                            $title_html = $item['title_text'];

                                            if ( ! empty( $item['link']['url'] ) ) {
                                                $html .= '<a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'><h3 class="title">'.$title_html.'</h3></a>';
                                            } else {
                                                $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_html );
                                            }
                                        }

                                        if ( ! empty( $item['description_text'] ) ) {
                                            $html .= sprintf( '<div class="description">%1$s</div>', $item['description_text'] );
                                        }

                                        $html .= '</div>';
                                    }

                                    echo trim($html);
                                    ?>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php }elseif($layout == 'grid'){  
                    $mdcol = 12/$columns;
                    $smcol = 12/$columns_tablet;
                    $xscol = 12/$columns_mobile;
                ?>
                    <div class="row">
                        <?php foreach ($features as $item): ?>
                            <div class="col-lg-<?php echo esc_attr($mdcol); ?> col-md-<?php echo esc_attr($smcol); ?> col-<?php echo esc_attr($xscol); ?>">
                                <div class="item">
                                    <div class="item-inner">
                                         <div class="top-inner">
                                            <?php
                                            $has_content = ! empty( $item['title_text'] ) || ! empty( $item['description_text'] );
                                            $html = '';
                                            if ( $item['image_icon'] == 'image' ) {
                                                if ( ! empty( $item['image']['url'] ) ) {
                                                    $this->add_render_attribute( 'image', 'src', $item['image']['url'] );
                                                    $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $item['image'] ) );
                                                    $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $item['image'] ) );


                                                    $image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' );

                                                    if ( ! empty( $item['link']['url'] ) ) {
                                                        $image_html = '<a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'>' . $image_html . '</a>';
                                                    }

                                                    $html .= '<div class="features-box-image img">' . $image_html . '</div>';
                                                }
                                            } elseif ( $item['image_icon'] == 'icon' && !empty($item['icon'])) {
                                                $html .= '<div class="features-box-image icon"><i class="'.$item['icon'].'"></i></div>';
                                            }
                                        $html .= '</div>';
                                        if ( $has_content ) {
                                            $html .= '<div class="features-box-content">';
                                            if ( ! empty( $item['sub_title_text'] ) ) {
                                                $html .= sprintf( '<div class="sub_title_text">%1$s</div>', $item['sub_title_text'] );
                                            }
                                            if ( ! empty( $item['title_text'] ) ) {
                                                
                                                $title_html = $item['title_text'];

                                                if ( ! empty( $item['link']['url'] ) ) {
                                                    $html .= '<a href="'.esc_url($item['link']['url']).'" target="'.esc_attr($item['link']['is_external'] ? '_blank' : '_self').'" '.($item['link']['nofollow'] ? 'rel="nofollow"' : '').'><h3 class="title">'.$title_html.'</h3></a>';
                                                } else {
                                                    $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_html );
                                                }
                                            }

                                            if ( ! empty( $item['description_text'] ) ) {
                                                $html .= sprintf( '<div class="description">%1$s</div>', $item['description_text'] );
                                            }

                                            $html .= '</div>';
                                        }

                                        echo trim($html);
                                        ?>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
    }

}

if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_Features_Box );
} else {
    Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_Features_Box );
}