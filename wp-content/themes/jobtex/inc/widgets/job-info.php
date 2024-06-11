<?php

class Jobtex_Widget_Job_Information extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'apus_job_info',
            esc_html__('Job Detail:: Information', 'jobtex'),
            array( 'description' => esc_html__( 'Show job information', 'jobtex' ), )
        );
        $this->widgetName = 'job_info';
    }
    
    public function widget( $args, $instance ) {
        get_template_part('widgets/job-info', '', array('args' => $args, 'instance' => $instance));
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

call_user_func( implode('_', array('register', 'widget') ), 'Jobtex_Widget_Job_Information' );