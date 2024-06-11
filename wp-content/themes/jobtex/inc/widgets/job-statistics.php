<?php

class Jobtex_Widget_Job_Statistics extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'apus_job_statistics',
            esc_html__('Job Detail:: Statistics', 'jobtex'),
            array( 'description' => esc_html__( 'Show job statistics', 'jobtex' ), )
        );
        $this->widgetName = 'job_statistics';
    }

    public function widget( $args, $instance ) {
        get_template_part('widgets/job-statistics', '', array('args' => $args, 'instance' => $instance));
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => '',
            'show_post_date' => 1,
            'show_views' => 1,
            'show_applicants' => 1,
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'jobtex' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_post_date'], 1 ); ?> id="<?php echo esc_attr( 'show_post_date' ); ?>" name="<?php echo esc_attr($this->get_field_name('show_post_date')); ?>" value="1" />
            <label for="<?php echo esc_attr($this->get_field_name('show_post_date') ); ?>">
                <?php esc_html_e('Show post date', 'jobtex'); ?>
            </label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_views'], 1 ); ?> id="<?php echo esc_attr( 'show_views' ); ?>" name="<?php echo esc_attr($this->get_field_name('show_views')); ?>" value="1" />
            <label for="<?php echo esc_attr($this->get_field_name('show_views') ); ?>">
                <?php esc_html_e('Show Views', 'jobtex'); ?>
            </label>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_applicants'], 1 ); ?> id="<?php echo esc_attr( 'show_applicants' ); ?>" name="<?php echo esc_attr($this->get_field_name('show_applicants')); ?>" value="1" />
            <label for="<?php echo esc_attr($this->get_field_name('show_applicants') ); ?>">
                <?php esc_html_e('Show Applicants', 'jobtex'); ?>
            </label>
        </p>

<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? $new_instance['title'] : '';
        $instance['show_post_date'] = ( ! empty( $new_instance['show_post_date'] ) ) ? $new_instance['show_post_date'] : '';
        $instance['show_views'] = ( ! empty( $new_instance['show_views'] ) ) ? $new_instance['show_views'] : '';
        $instance['show_applicants'] = ( ! empty( $new_instance['show_applicants'] ) ) ? $new_instance['show_applicants'] : '';

        return $instance;
    }
}

call_user_func( implode('_', array('register', 'widget') ), 'Jobtex_Widget_Job_Statistics' );