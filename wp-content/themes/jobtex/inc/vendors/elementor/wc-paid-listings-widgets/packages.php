<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_Jobs_Packages extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_jobs_packages';
    }

	public function get_title() {
        return esc_html__( 'Apus Packages', 'jobtex' );
    }
    
	public function get_categories() {
        return [ 'jobtex-elements' ];
    }

	protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'jobtex' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $options = array(
            'job_package' => esc_html__('Job Package', 'jobtex'),
            'cv_package' => esc_html__('CV Package', 'jobtex'),
            'contact_package' => esc_html__('Contact Package', 'jobtex'),
            'candidate_package' => esc_html__('Canidate Package', 'jobtex'),
            'resume_package' => esc_html__('Resume Package', 'jobtex'),
        );

        if ( class_exists( 'WC_Subscriptions' ) ) {
            $options['job_package_subscription'] = esc_html__( 'Job Package Subscription', 'jobtex' );
            $options['cv_package_subscription'] = esc_html__( 'CV Package Subscription', 'jobtex' );
            $options['contact_package_subscription'] = esc_html__( 'Contact Package Subscription', 'jobtex' );
            $options['candidate_package_subscription'] = esc_html__( 'Candidate Package Subscription', 'jobtex' );
            $options['resume_package_subscription'] = esc_html__( 'Resume Package Subscription', 'jobtex' );
        }

        $this->add_control(
            'package_type',
            [
                'label' => esc_html__( 'Packages Type', 'jobtex' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $options,
                'default' => 'job_package'
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
            'number',
            [
                'label' => esc_html__( 'Number Product', 'jobtex' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'number',
                'description' => esc_html__( 'Number Product to display', 'jobtex' ),
                'default' => 3
            ]
        );
        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'jobtex' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'number',
                'default' => 3,
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
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        $loop = jobtex_get_products( array(
            'product_type' => $package_type,
            'post_per_page' => $number,
            'orderby' => $orderby,
            'order' => $order
        ));
        ?>
        <div class="widget m-0 woocommerce widget-subwoo <?php echo esc_attr($el_class); ?>">
            <?php if ($loop->have_posts()): ?>
                <div class="row">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;
                    ?>
                        <div class="col-12 col-sm-6 col-lg-<?php echo esc_attr(12/$columns); ?>">
                            <div class="subwoo-inner <?php echo esc_attr( $product->is_featured() ? ' is_featured' : '' ); ?>">
                                <div class="item">
                                    <div class="header-sub">
                                        <div class="icon-wrapper">
                                            <?php
                                            $icon_class = get_post_meta($product->get_id(), '_jobs_icon_class', true);
                                            if ( $icon_class ) {
                                                ?>
                                                <span class="<?php echo esc_attr($icon_class); ?>"></span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="top-info d-flex align-items-center">
                                            <h3 class="title"><?php the_title(); ?></h3>
                                            <?php if($product->is_featured()){ ?>
                                                <div class="recommended ms-auto">
                                                    <?php echo esc_html__('Popular','jobtex'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="bottom-sub">
                                        <div class="price"><?php echo (!empty($product->get_price())) ? $product->get_price_html() : esc_html__('Free','jobtex'); ?></div>
                                        <?php if ( has_excerpt() ) { ?>
                                            <div class="short-des"><?php the_excerpt(); ?></div>
                                        <?php } ?>
                                        <div class="button-action"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    <?php endwhile; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        <?php
    }
}


if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_Jobs_Packages );
} else {
    Elementor\Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_Jobs_Packages );
}