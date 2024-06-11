<div id="apus-mobile-menu" class="apus-offcanvas d-block d-xl-none"> 
    <div class="apus-offcanvas-body">

        <div class="header-offcanvas">
            <div class="container">
                <div class="d-flex align-items-center">
                    
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

                    <div class="ms-auto">
                        <a class="btn-toggle-canvas" data-toggle="offcanvas">
                            <i class="ti-close"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <div class="offcanvas-content flex-column d-flex">
            <div class="middle-offcanvas">

                <nav id="menu-main-menu-navbar" class="navbar navbar-offcanvas" role="navigation">
                    <?php
                        $mobile_menu = 'primary';
                        $menus = get_nav_menu_locations();
                        if( !empty($menus['mobile-primary']) && wp_get_nav_menu_items($menus['mobile-primary'])) {
                            $mobile_menu = 'mobile-primary';
                        }
                        $args = array(
                            'theme_location' => $mobile_menu,
                            'container_class' => '',
                            'menu_class' => '',
                            'fallback_cb' => '',
                            'menu_id' => '',
                            'container' => 'div',
                            'container_id' => 'mobile-menu-container',
                            'walker' => new Jobtex_Mobile_Menu()
                        );
                        wp_nav_menu($args);

                    ?>
                </nav>
            </div>
        
            <?php if ( is_active_sidebar( 'header-mobile-bottom' ) || jobtex_is_wp_job_board_pro_activated() ) { ?>
                
                <div class="header-mobile-bottom">

                    <?php if ( jobtex_is_wp_job_board_pro_activated() && jobtex_get_config('show_add_job_btn', true) ) { ?>
                        <?php $submit_job_form_page_id = wp_job_board_pro_get_option('submit_job_form_page_id'); ?>
                        <div class="submit-job">
                            <a class="btn btn-theme w-100" href="<?php echo esc_url( get_permalink( $submit_job_form_page_id ) ); ?>"><?php esc_html_e('Post Job','jobtex') ?></a>
                        </div>
                    <?php } ?>

                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="over-dark"></div>