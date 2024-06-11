<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_List_icon extends Widget_Base {

    public function get_name() {
        return 'apus_element_list_icon';
    }

    public function get_title() {
        return esc_html__( 'Apus List Icon', 'jobtex' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
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
            'title', [
                'label' => esc_html__( 'Title', 'jobtex' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Title' , 'jobtex' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'des', [
                'label' => esc_html__( 'Description', 'jobtex' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_icon',
            [
                'label' => esc_html__( 'Icon', 'jobtex' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'label_block' => true,
                'default' => [
                    'value' => 'fab fa-facebook-f',
                    'library' => 'fa-brands',
                ],
                'recommended' => [
                    'fa-brands' => [
                        'android',
                        'apple',
                        'behance',
                        'bitbucket',
                        'codepen',
                        'delicious',
                        'deviantart',
                        'digg',
                        'dribbble',
                        'elementor',
                        'facebook',
                        'flickr',
                        'foursquare',
                        'free-code-camp',
                        'github',
                        'gitlab',
                        'globe',
                        'google-plus',
                        'houzz',
                        'instagram',
                        'jsfiddle',
                        'linkedin',
                        'medium',
                        'meetup',
                        'mixcloud',
                        'odnoklassniki',
                        'pinterest',
                        'product-hunt',
                        'reddit',
                        'shopping-cart',
                        'skype',
                        'slideshare',
                        'snapchat',
                        'soundcloud',
                        'spotify',
                        'stack-overflow',
                        'steam',
                        'stumbleupon',
                        'telegram',
                        'thumb-tack',
                        'tripadvisor',
                        'tumblr',
                        'twitch',
                        'twitter',
                        'viber',
                        'vimeo',
                        'vk',
                        'weibo',
                        'weixin',
                        'whatsapp',
                        'wordpress',
                        'xing',
                        'yelp',
                        'youtube',
                        '500px',
                    ],
                    'fa-solid' => [
                        'envelope',
                        'link',
                        'rss',
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'jobtex' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'is_external' => 'true',
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', 'jobtex' ),
            ]
        );

        $this->add_control(
            'list_icon_list',
            [
                'label' => esc_html__( 'Social Icons', 'jobtex' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_icon' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'list_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'list_icon' => [
                            'value' => 'fab fa-google-plus',
                            'library' => 'fa-brands',
                        ],
                    ],
                ],
                'title_field' => '<# var migrated = "undefined" !== typeof __fa4_migrated, icon = ( "undefined" === typeof icon ) ? false : icon; #>{{{ elementor.helpers.getSocialNetworkNameFromIcon( list_icon, icon, true, migrated, true ) }}}',
            ]
        );
        
        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'jobtex' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Normal', 'jobtex'),
                ),
                'default' => ''
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
                'label' => esc_html__( 'Title', 'jobtex' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Width', 'jobtex' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'range' => [
                    'px' => [
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .left-inner > *' => 'width: {{SIZE}}{{UNIT}} ; max-width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );


        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings();

        extract( $settings ); 
        $migration_allowed = Icons_Manager::is_migration_allowed();
        
        ?>

        <div class="widget-icons <?php echo esc_attr($el_class.' '.$style); ?>">
            <?php
            foreach ( $settings['list_icon_list'] as $index => $item ) {
                $migrated = isset( $item['__fa4_migrated']['list_icon'] );
                $is_new = empty( $item['icon'] ) && $migration_allowed;
                $icon = '';

                // add old default
                if ( empty( $item['icon'] ) && ! $migration_allowed ) {
                    $item['icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-wordpress';
                }

                if ( ! empty( $item['icon'] ) ) {
                    $icon = str_replace( 'fa fa-', '', $item['icon'] );
                }

                if ( ( $is_new || $migrated ) && 'svg' !== $item['list_icon']['library'] ) {
                    $icon = explode( ' ', $item['list_icon']['value'], 2 );
                    if ( empty( $icon[1] ) ) {
                        $icon = '';
                    } else {
                        $icon = str_replace( 'fa-', '', $icon[1] );
                    }
                }
                if ( 'svg' === $item['list_icon']['library'] ) {
                    $icon = '';
                }

                $link_key = 'link_' . $index;

                $this->add_render_attribute( $link_key, 'href', $item['link']['url'] );

                if ( $item['link']['is_external'] ) {
                    $this->add_render_attribute( $link_key, 'target', '_blank' );
                }

                if ( $item['link']['nofollow'] ) {
                    $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                }
                ?>
                <div class="list_icon">
                    <a <?php echo trim($this->get_render_attribute_string( $link_key )); ?>>
                        <div class="d-flex align-items-center">
                            <div class="left-inner flex-shrink-0">
                            <?php
                            if ( $is_new || $migrated ) {
                                Icons_Manager::render_icon( $item['list_icon'] );
                            } else { ?>
                                <i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
                            <?php } ?>
                            </div>
                            <div class="inner flex-grow-1">
                                <?php if( !empty($item['title'] ) ){ ?>
                                    <h4 class="text"><?php echo trim($item['title']); ?></h4>
                                <?php } ?>
                                <?php if( !empty($item['des'] ) ){ ?>
                                    <div class="des"><?php echo trim($item['des']); ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div> 
        <?php 
    }
    
    protected function _content_template() {
        ?>
        <# var iconsHTML = {}; #>
        <div class="widget-icons">
            <# _.each( settings.list_icon_list, function( item, index ) {
                var link = item.link ? item.link.url : '',
                    migrated = elementor.helpers.isIconMigrated( item, 'list_icon' );
                    icon = elementor.helpers.getSocialNetworkNameFromIcon( item.list_icon, item.icon, false, migrated );
                #>
                <div class="list_icon">
                    <a href="{{ link }}">
                        <span class="elementor-screen-only">{{{ icon }}}</span>
                        <#
                            iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.list_icon, {}, 'i', 'object' );
                            if ( ( ! item.icon || migrated ) && iconsHTML[ index ] && iconsHTML[ index ].rendered ) { #>
                                {{{ iconsHTML[ index ].value }}}
                            <# } else { #>
                                <i class="{{ item.icon }}"></i>
                            <# }
                        #>
                    </a>
                </div>
            <# } ); #>
        </div>
        <?php
    }
}

if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_List_icon );
} else {
    Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_List_icon );
}