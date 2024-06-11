<?php

if ( !function_exists('jobtex_get_products') ) {
    function jobtex_get_products( $args = array() ) {
        global $woocommerce, $wp_query;

        $args = wp_parse_args( $args, array(
            'categories' => array(),
            'product_type' => 'recent_product',
            'paged' => 1,
            'post_per_page' => -1,
            'orderby' => '',
            'order' => '',
            'includes' => array(),
            'excludes' => array(),
            'author' => '',
            'search' => '',
        ));
        extract($args);
        
        $query_args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'paged' => $paged,
            'orderby'   => $orderby,
            'order' => $order
        );

        if ( isset( $query_args['orderby'] ) ) {
            if ( 'price' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_price',
                    'orderby'   => 'meta_value_num'
                ) );
            }
            if ( 'featured' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_featured',
                    'orderby'   => 'meta_value'
                ) );
            }
            if ( 'sku' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_sku',
                    'orderby'   => 'meta_value'
                ) );
            }
        }
        switch ($product_type) {
            case 'job_package':
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => array( 'job_package', 'job_package_subscription' )
                );
                break;
            case 'cv_package':
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => array( 'cv_package', 'cv_package_subscription' )
                );
                break;
            case 'contact_package':
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => array( 'contact_package', 'contact_package_subscription' )
                );
                break;
            case 'candidate_package':
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => array( 'candidate_package', 'candidate_package_subscription' )
                );
                break;
            case 'resume_package':
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_type',
                    'field'    => 'slug',
                    'terms'    => array( 'resume_package', 'resume_package_subscription' )
                );
            break;
        }

        if ( !empty($categories) && is_array($categories) ) {
            $query_args['tax_query'][] = array(
                'taxonomy'      => 'product_cat',
                'field'         => 'slug',
                'terms'         => implode(",", $categories ),
                'operator'      => 'IN'
            );
        }

        if (!empty($includes) && is_array($includes)) {
            $query_args['post__in'] = $includes;
        }
        
        if ( !empty($excludes) && is_array($excludes) ) {
            $query_args['post__not_in'] = $excludes;
        }

        if ( !empty($author) ) {
            $query_args['author'] = $author;
        }

        if ( !empty($search) ) {
            $query_args['search'] = "*{$search}*";
        }

        return new WP_Query($query_args);
    }
}


// hooks
function jobtex_woocommerce_enqueue_styles() {
    if( is_rtl() ){
        wp_enqueue_style( 'jobtex-woocommerce-rtl', get_template_directory_uri() .'/css/woocommerce.rtl.css' , 'jobtex-woocommerce-front' , '1.0.0', 'all' );
    } else {
        wp_enqueue_style( 'jobtex-woocommerce', get_template_directory_uri() .'/css/woocommerce.css' , 'jobtex-woocommerce-front' , '1.0.0', 'all' );
    }
}
add_action( 'wp_enqueue_scripts', 'jobtex_woocommerce_enqueue_styles', 99 );

function jobtex_woocommerce_enqueue_scripts() {
    wp_enqueue_script( 'jobtex-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery', 'jquery-unveil', 'slick' ), '20150330', true );
}
add_action( 'wp_enqueue_scripts', 'jobtex_woocommerce_enqueue_scripts', 10 );

// cart
if ( !function_exists('jobtex_woocommerce_header_add_to_cart_fragment') ) {
    function jobtex_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['.cart .count'] =  ' <span class="count"> '. $woocommerce->cart->cart_contents_count .' </span> ';
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'jobtex_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('jobtex_woocommerce_breadcrumb_defaults') ) {
    function jobtex_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = jobtex_get_config('woo_breadcrumb_image');
        $breadcrumb_color = jobtex_get_config('woo_breadcrumb_color');
        $style = array();
        $show_breadcrumbs = jobtex_get_config('show_product_breadcrumbs',1);
        
        if ( !$show_breadcrumbs ) {
            $style[] = 'display:none';
        }
        if( $breadcrumb_color  ){
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        if ( !empty($breadcrumb_img) ) {
            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img).'\')';
        }
        $estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

        $full_width = apply_filters('jobtex_woocommerce_content_class', 'container');

        // check woo
        if(is_product()) {
            $title = '<h3 class="bread-title">'.esc_html__( 'Shop', 'jobtex' ).'</h3>';
        } elseif ( is_product_taxonomy() ) {
            global $wp_query;
            $term = $wp_query->queried_object;
            $title = '<h3 class="bread-title">'.esc_html__( 'Shop', 'jobtex' ).'</h3>';
            if ( isset( $term->name) ) {
                $title = $term->name;
            }
        } else {
            $title = '<h3 class="bread-title">'.esc_html__( 'Shop', 'jobtex' ).'</h3>';
        }

        
        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb"'.$estyle.'><div class="apus-inner-bread"><div class="wrapper-breads"><div class="'.$full_width.'"><div class="breadscrumb-inner"><ol class="apus-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
        $args['wrap_after'] = '</ol></div></div></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'jobtex_woocommerce_breadcrumb_defaults' );
add_action( 'jobtex_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );


if(!function_exists('jobtex_filter_before')){
    function jobtex_filter_before(){
        echo '<div class="wrapper-fillter"><div class="apus-filter d-flex align-items-center">';
    }
}
if(!function_exists('jobtex_filter_after')){
    function jobtex_filter_after(){
        echo '</div></div>';
    }
}
add_action( 'woocommerce_before_shop_loop', 'jobtex_filter_before' , 1 );
add_action( 'woocommerce_before_shop_loop', 'jobtex_filter_after' , 40 );


// Number of products per page
if ( !function_exists('jobtex_woocommerce_shop_per_page') ) {
    function jobtex_woocommerce_shop_per_page($number) {
        $value = jobtex_get_config('number_products_per_page', 12);
        return intval( $value );

    }
}
add_filter( 'loop_shop_per_page', 'jobtex_woocommerce_shop_per_page', 30 );

// Number of products per row
if ( !function_exists('jobtex_woocommerce_shop_columns') ) {
    function jobtex_woocommerce_shop_columns($number) {
        $value = jobtex_get_config('product_columns', 3);
        if ( in_array( $value, array(1, 2, 3, 4, 5, 6) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'jobtex_woocommerce_shop_columns' );

// share box
if ( !function_exists('jobtex_woocommerce_share_box') ) {
    function jobtex_woocommerce_share_box() {
        if ( jobtex_get_config('show_product_social_share') ) {
            get_template_part( 'template-parts/sharebox' );
        }
    }
}
//add_filter( 'woocommerce_single_product_summary', 'jobtex_woocommerce_share_box', 100 );

// swap effect
if ( !function_exists('jobtex_swap_images') ) {
    function jobtex_swap_images() {
        ?>
        <a title="<?php echo esc_attr(get_the_title()); ?>" href="<?php the_permalink(); ?>" class="product-image">
            <?php jobtex_product_get_image('woocommerce_thumbnail'); ?>
        </a>
        <?php
    }
}
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'jobtex_swap_images', 10);

if ( !function_exists('jobtex_product_image') ) {
    function jobtex_product_image($thumb = 'shop_thumbnail') {
        ?>
        <a title="<?php echo esc_attr(get_the_title()); ?>" href="<?php the_permalink(); ?>" class="product-image">
            <?php jobtex_product_get_image($thumb); ?>
        </a>
        <?php
    }
}
// get image
if ( !function_exists('jobtex_product_get_image') ) {
    function jobtex_product_get_image($thumb = 'woocommerce_thumbnail') {
        global $post, $product, $woocommerce;
        
        $output = '';
        $class = "attachment-$thumb size-$thumb image-no-effect";
        if (has_post_thumbnail()) {
            $output .= jobtex_get_attachment_thumbnail( get_post_thumbnail_id(), $thumb , false, array('class' => $class), false);
        } else {
            $output .= '<img src="'.esc_url(wc_placeholder_img_src()).'" alt="'.esc_attr__('Placeholder' , 'jobtex').'" class="'.$class.'" />';
        }
        echo trim($output);
    }
}

// layout class for woo page
if ( !function_exists('jobtex_woocommerce_content_class') ) {
    function jobtex_woocommerce_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        if( jobtex_get_config('product_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'jobtex_woocommerce_content_class', 'jobtex_woocommerce_content_class' );

// get layout configs
if ( !function_exists('jobtex_get_woocommerce_layout_configs') ) {
    function jobtex_get_woocommerce_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        // lg and md for fullwidth
        $left = jobtex_get_config('product_'.$page.'_left_sidebar');
        $right = jobtex_get_config('product_'.$page.'_right_sidebar');

        switch ( jobtex_get_config('product_'.$page.'_layout') ) {
            case 'left-main':
                if ( is_active_sidebar( $left ) ) {
                    $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-4 col-sm-12 col-12 '  );
                    $configs['main'] = array( 'class' => 'col-md-8 col-12 col-sm-12 col-12' );
                }
                break;
            case 'main-right':
                if ( is_active_sidebar( $right ) ) {
                    $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-4 col-sm-12 col-12 ' ); 
                    $configs['main'] = array( 'class' => 'col-md-8 col-12 col-sm-12 col-12' );
                }
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-12' );
                break;
            default:
                if (is_active_sidebar( 'sidebar-default' ) && !is_shop() && !is_single() ) {
                    $configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-4 col-sm-12 col-12' ); 
                    $configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-12' );
                } else {
                    $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-12' );
                }
                break;
        }
        if ( empty($configs) ) {
            if (is_active_sidebar( 'sidebar-default' ) && !is_shop() && !is_single() ) {
                $configs['right'] = array( 'sidebar' => 'sidebar-default',  'class' => 'col-md-4 col-sm-12 col-12' ); 
                $configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-12' );
            } else {
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-12' );
            }
        }
        
        return $configs; 
    }
}

if ( !function_exists( 'jobtex_product_review_tab' ) ) {
    function jobtex_product_review_tab($tabs) {
        global $post;
        if ( !jobtex_get_config('show_product_review_tab', true) && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        }
        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'jobtex_product_review_tab', 90 );

function jobtex_woo_after_shop_loop_before() {
    ?>
    <div class="apus-after-loop-shop clearfix">
    <?php
}
function jobtex_woo_after_shop_loop_after() {
    ?>
    </div>
    <?php
}
add_action( 'woocommerce_after_shop_loop', 'jobtex_woo_after_shop_loop_before', 1 );
add_action( 'woocommerce_after_shop_loop', 'jobtex_woo_after_shop_loop_after', 99999 );
// remove </a> in add to cart
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );