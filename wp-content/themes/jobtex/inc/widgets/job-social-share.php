<?php

class Jobtex_Widget_Job_Social_Share extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'apus_job_social_share',
            esc_html__('Job Detail:: Social Share', 'jobtex'),
            array( 'description' => esc_html__( 'Show job social share', 'jobtex' ), )
        );
        $this->widgetName = 'job_social_share';
    }

    public function widget( $args, $instance ) {
        get_template_part('widgets/job-social-share', '', array('args' => $args, 'instance' => $instance));
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'Social Share',
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


call_user_func( implode('_', array('register', 'widget') ), 'Jobtex_Widget_Job_Social_Share' );