<?php

class Jobtex_Widget_Candidate_Socials extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'apus_candidate_socials',
            esc_html__('Candidate Detail:: Candidate Socials', 'jobtex'),
            array( 'description' => esc_html__( 'Show candidate Socials', 'jobtex' ), )
        );
        $this->widgetName = 'candidate_socials';
    }

    public function widget( $args, $instance ) {
        get_template_part('widgets/candidate-socials', '', array('args' => $args, 'instance' => $instance));
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => '',
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'jobtex' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
    <?php
    }

    public function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
}

call_user_func( implode('_', array('register', 'widget') ), 'Jobtex_Widget_Candidate_Socials' );