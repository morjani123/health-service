<div id="apus-header-mobile" class="header-mobile d-block d-xl-none">    
    <div class="container">
        <div class="row">
            <div class="d-flex align-items-center">
                <div class="col-6">
                    
                    <?php
                        $logo_url = jobtex_get_config('media-mobile-logo');
                    ?>
                    <?php if( !empty($logo_url) ): ?>
                        <div class="logo">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="logo logo-theme">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <img src="<?php echo esc_url( get_template_directory_uri().'/images/logo.svg'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center justify-content-end">
                        <?php
                            if ( jobtex_get_config('show_login_register' , true) && jobtex_is_wp_job_board_pro_activated() ) {
                                if ( is_user_logged_in() ) {
                                    $user_id = get_current_user_id();
                                    $userdata = get_userdata($user_id);
                                    $user_name = $userdata->display_name;
                                    if ( WP_Job_Board_Pro_User::is_employer($user_id) || WP_Job_Board_Pro_User::is_candidate($user_id) || ( method_exists('WP_Job_Board_Pro_User', 'is_employee') && WP_Job_Board_Pro_User::is_employee($user_id) ) ) {
                                        if ( WP_Job_Board_Pro_User::is_employer($user_id) ) {
                                            $menu_nav = 'employer-menu';
                                            $employer_id = WP_Job_Board_Pro_User::get_employer_by_user_id($user_id);
                                            $user_name = get_post_field('post_title', $employer_id);
                                        } elseif (( method_exists('WP_Job_Board_Pro_User', 'is_employee') && WP_Job_Board_Pro_User::is_employee($user_id) ) ) {
                                            $user_id = WP_Job_Board_Pro_User::get_user_id();
                                            $menu_nav = 'employee-menu';
                                            $employer_id = WP_Job_Board_Pro_User::get_employer_by_user_id($user_id);
                                            $user_name = get_post_field('post_title', $employer_id);
                                        } else {
                                            $menu_nav = 'candidate-menu';
                                            $candidate_id = WP_Job_Board_Pro_User::get_candidate_by_user_id($user_id);
                                            $user_name = get_post_field('post_title', $candidate_id);
                                        }
                                    }
                                    if ( !empty($menu_nav) && has_nav_menu( $menu_nav ) ) {
                                    ?>
                                        <div class="top-wrapper-menu pull-right d-flex align-items-center">
                                            <a class="drop-dow btn-menu-account" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                  <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                  <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                            <?php
                                                
                                                    $args = array(
                                                        'theme_location' => $menu_nav,
                                                        'container_class' => 'inner-top-menu',
                                                        'menu_class' => 'nav navbar-nav topmenu-menu',
                                                        'fallback_cb' => '',
                                                        'menu_id' => '',
                                                        'walker' => new Jobtex_Nav_Menu()
                                                    );
                                                    wp_nav_menu($args);
                                                
                                            ?>
                                        </div>
                                        <?php } ?>
                            <?php } else {
                                $login_register_page_id = wp_job_board_pro_get_option('login_register_page_id');
                            ?>
                                    <div class="top-wrapper-menu d-flex align-items-center">
                                        <a class="drop-dow btn-menu-account" href="<?php echo esc_url( get_permalink( $login_register_page_id ) ); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                              <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                              <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </div>
                            <?php }
                        }

                        if ( jobtex_get_config('show_notification' , true) && jobtex_is_wp_job_board_pro_activated() ) {
                            if ( is_user_logged_in() ) {
                                $user_id = WP_Job_Board_Pro_User::get_user_id();
                                if ( WP_Job_Board_Pro_User::is_employer($user_id) ) {
                                    $user_post_id = WP_Job_Board_Pro_User::get_employer_by_user_id($user_id);
                                    $post_type = 'employer';
                                } elseif ( method_exists('WP_Job_Board_Pro_User', 'is_employee') && WP_Job_Board_Pro_User::is_employee($user_id) ) {
                                    $user_id = WP_Job_Board_Pro_User::get_user_id();
                                    $user_post_id = WP_Job_Board_Pro_User::get_employer_by_user_id($user_id);
                                    $post_type = 'employer';
                                } elseif ( WP_Job_Board_Pro_User::is_candidate($user_id) ) {
                                    $user_post_id = WP_Job_Board_Pro_User::get_candidate_by_user_id($user_id);
                                    $post_type = 'candidate';
                                }
                            }

                            if ( !empty($user_post_id) && !empty($post_type) ) {
                                $notifications = WP_Job_Board_Pro_User_Notification::get_not_seen_notifications($user_post_id, $post_type);
                            }

                            ?>
                            <div class="message-top">
                                <a class="message-notification" href="javascript:void(0);">
                                    <i class="ti-bell"></i>
                                    <?php if ( !empty($notifications) ) { ?>
                                        <span class="unread-count bg-warning"><?php echo count($notifications); ?></span>
                                    <?php } ?>
                                </a>
                                <?php if ( !empty($notifications) ) { ?>
                                    <div class="notifications-wrapper right">
                                        <ul>
                                            <?php foreach ($notifications as $key => $notify) {
                                                $type = !empty($notify['type']) ? $notify['type'] : '';
                                                if ( $type ) {
                                            ?>
                                                    <li>
                                                        <!-- display notify content -->
                                                        <i class="time">
                                                            <?php
                                                                $time = $notify['time'];
                                                                echo human_time_diff( $time, current_time( 'timestamp' ) ).' '.esc_html__( 'ago', 'jobtex' );
                                                            ?>
                                                        </i>
                                                        <p>
                                                            <?php echo trim(WP_Job_Board_Pro_User_Notification::display_notify($notify)); ?>
                                                            <a href="javascript:void(0);" class="remove-notify-btn" data-id="<?php echo esc_attr($notify['unique_id']); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-pro-remove-notify-nonce' )); ?>"><i class="ti-close"></i></a>
                                                        </p>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>      
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>

                        <a href="#navbar-offcanvas" class="btn-showmenu flex-column d-flex">
                            <span class="inner1"></span>
                            <span class="inner2"></span>
                            <span class="inner3"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>