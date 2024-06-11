<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jobtex_Elementor_Register_Form_Tabs extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_register_tabs';
    }

	public function get_title() {
        return esc_html__( 'Apus Register Form Tabs', 'jobtex' );
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

        if ( is_user_logged_in() ) {
            echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'misc/loged-in' );
        } else {
            $show_candidate = jobtex_get_config('register_form_enable_candidate', true);
            $show_employer = jobtex_get_config('register_form_enable_employer', true);
            if ( $show_candidate || $show_employer ) {
                $rand = jobtex_random_key();
        ?>
                <div class="register-form register-form-wrapper <?php echo esc_attr($el_class); ?>">

                    <?php if ( $show_candidate && $show_employer ) { ?>
                        <ul class="role-tabs nav nav-tabs">
                            <li class="active"><a data-bs-toggle="tab" href="#apus_register_form_candidate_<?php echo esc_attr($rand); ?>"><?php esc_html_e('Candidate', 'jobtex'); ?></a></li>
                            <li><a data-bs-toggle="tab" href="#apus_register_form_employer_<?php echo esc_attr($rand); ?>"><?php esc_html_e('Employer', 'jobtex'); ?></a></li>
                        </ul>
                    <?php } ?>

                    <div class="tab-content clearfix">
                        <?php if ( $show_candidate ) { ?>
                            <div class="tab-pane active" id="apus_register_form_candidate_<?php echo esc_attr($rand); ?>">
                                <?php echo do_shortcode( '[wp_job_board_pro_register_candidate]' ); ?>
                            </div>
                        <?php } ?>
                        <?php if ( $show_employer ) { ?>
                            <div class="tab-pane <?php echo esc_attr( !$show_candidate ? 'active' : '' ); ?>" id="apus_register_form_employer_<?php echo esc_attr($rand); ?>">
                                <?php echo do_shortcode( '[wp_job_board_pro_register_employer]' ); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php }
        }
    }
}

if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Jobtex_Elementor_Register_Form_Tabs );
} else {
    Elementor\Plugin::instance()->widgets_manager->register( new Jobtex_Elementor_Register_Form_Tabs );
}