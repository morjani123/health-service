<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_Banner_Account extends Widget_Base {

	public function get_name() {
        return 'apus_element_banner_account';
    }

	public function get_title() {
        return esc_html__( 'Apus Banner Create Account', 'jobtex' );
    }
    
	public function get_categories() {
        return [ 'jobtex-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Banner Account', 'jobtex' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'jobtex' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'content',
            [
                'label' => esc_html__( 'Description', 'jobtex' ),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'img_bg_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Image Background', 'jobtex' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Background Here', 'jobtex' ),
            ]
        );
        
        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'jobtex' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your button text here', 'jobtex' ),
            ]
        );

        $this->add_control(
            'btn_style',
            [
                'label' => esc_html__( 'Button Style', 'jobtex' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'btn-theme' => esc_html__('Theme Color', 'jobtex'),
                    'btn-theme btn-outline' => esc_html__('Theme Outline Color', 'jobtex'),
                    'btn-default' => esc_html__('Default ', 'jobtex'),
                    'btn-primary' => esc_html__('Primary ', 'jobtex'),
                    'btn-success' => esc_html__('Success ', 'jobtex'),
                    'btn-info' => esc_html__('Info ', 'jobtex'),
                    'btn-warning' => esc_html__('Warning ', 'jobtex'),
                    'btn-danger' => esc_html__('Danger ', 'jobtex'),
                    'btn-pink' => esc_html__('Pink ', 'jobtex'),
                    'btn-white' => esc_html__('White ', 'jobtex'),
                    'btn-red-outline' => esc_html__('Red Outline ', 'jobtex'),
                ),
                'default' => 'btn-default'
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'URL', 'jobtex' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your Button Link here', 'jobtex' ),
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

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'jobtex' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .title-account' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'jobtex' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title-account',
            ]
        );

        $this->add_control(
            'des_color',
            [
                'label' => esc_html__( 'Description Color', 'jobtex' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'jobtex' ),
                'name' => 'des_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $img_bg_src = ( isset( $img_bg_src['id'] ) && $img_bg_src['id'] != 0 ) ? wp_get_attachment_url( $img_bg_src['id'] ) : '';
        $style_bg = '';
        if ( !empty($img_bg_src) ) {
            $style_bg = 'style="background-image:url('.esc_url($img_bg_src).')"';
        }
        ?>
        <div class="widget-banner-account <?php echo esc_attr($el_class); ?>" >
            <?php if(!empty($style_bg)) { ?>
                <div class="image-account" <?php echo trim($style_bg); ?>></div>
            <?php } ?>
            <div class="inner">
                <?php if ( !empty($title) ) { ?>
                    <h2 class="title-account">
                        <?php echo trim($title); ?>
                    </h2>
                <?php } ?>
                <?php if ( !empty($content) ) { ?>
                    <div class="description"><?php echo trim($content); ?></div>
                <?php } ?>
                <?php if ( !empty($btn_text)  ) { ?>
                    <div class="link-bottom">
                        <a class="btn <?php echo esc_attr(!empty($btn_style) ? $btn_style : ''); ?>" href="<?php echo esc_url( ( !empty($link) ) ? $link :'#' ); ?>"><?php echo trim($btn_text); ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
}

if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_Banner_Account );
} else {
    Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_Banner_Account );
}