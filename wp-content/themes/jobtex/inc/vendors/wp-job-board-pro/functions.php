<?php

function jobtex_get_jobs( $params = array() ) {
	$params = wp_parse_args( $params, array(
		'limit' => -1,
		'post_status' => 'publish',
		'get_jobs_by' => 'recent',
		'orderby' => '',
		'order' => '',
		'post__in' => array(),
		'fields' => null, // ids
		'author' => null,
		'categories' => array(),
		'types' => array(),
		'locations' => array(),
	));
	extract($params);

	$query_args = array(
		'post_type'         => 'job_listing',
		'posts_per_page'    => $limit,
		'post_status'       => $post_status,
		'orderby'       => $orderby,
		'order'       => $order,
	);

	$meta_query = array();
	switch ($get_jobs_by) {
		case 'recent':
			$query_args['orderby'] = 'date';
			$query_args['order'] = 'DESC';
			break;
		case 'featured':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_PRO_JOB_LISTING_PREFIX.'featured',
	           	'value' => 'on',
	           	'compare' => '=',
			);
			break;
		case 'urgent':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_PRO_JOB_LISTING_PREFIX.'urgent',
	           	'value' => 'on',
	           	'compare' => '=',
			);
			break;
	}

	if ( !empty($post__in) ) {
    	$query_args['post__in'] = $post__in;
    }

    if ( !empty($fields) ) {
    	$query_args['fields'] = $fields;
    }

    if ( !empty($author) ) {
    	$query_args['author'] = $author;
    }

    $tax_query = array();
    if ( !empty($categories) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'job_listing_category',
            'field'         => 'slug',
            'terms'         => $categories,
            'operator'      => 'IN'
        );
    }
    if ( !empty($types) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'job_listing_type',
            'field'         => 'slug',
            'terms'         => $types,
            'operator'      => 'IN'
        );
    }
    if ( !empty($locations) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'job_listing_location',
            'field'         => 'slug',
            'terms'         => $locations,
            'operator'      => 'IN'
        );
    }

    if ( !empty($tax_query) ) {
    	$query_args['tax_query'] = $tax_query;
    }
    
    if ( !empty($meta_query) ) {
    	$query_args['meta_query'] = $meta_query;
    }

    if ( method_exists('WP_Job_Board_Pro_Job_Listing', 'job_restrict_listing_query_args') ) {
	    $query_args = WP_Job_Board_Pro_Job_Listing::job_restrict_listing_query_args($query_args, null);
	}
	
	return new WP_Query( $query_args );
}

if ( !function_exists('jobtex_job_content_class') ) {
	function jobtex_job_content_class( $class ) {
		$prefix = 'jobs';
		if ( is_singular( 'job_listing' ) ) {
            $prefix = 'job';
        }
		if ( jobtex_get_config($prefix.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'jobtex_job_content_class', 'jobtex_job_content_class', 1 , 1  );

if ( !function_exists('jobtex_get_jobs_layout_configs') ) {
	function jobtex_get_jobs_layout_configs() {
		$layout_sidebar = jobtex_get_jobs_layout_sidebar();

		$sidebar = jobtex_get_jobs_filter_sidebar();
		switch ( $layout_sidebar ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => $sidebar, 'class' => 'col-lg-4 col-12'  );
		 		$configs['main'] = array( 'class' => 'col-lg-8 col-12' );
		 		break;
		 	case 'main-right':
		 	default:
		 		$configs['right'] = array( 'sidebar' => $sidebar,  'class' => 'col-lg-4 col-12' ); 
		 		$configs['main'] = array( 'class' => 'col-lg-8 col-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-lg-12 col-12' );
	 			break;
		}
		return $configs; 
	}
}

function jobtex_get_jobs_layout_sidebar() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$layout_type = get_post_meta( $post->ID, 'apus_page_layout', true );
	}
	if ( empty($layout_type) ) {
		$layout_type = jobtex_get_config('jobs_layout_sidebar', 'main-right');
	}
	return apply_filters( 'jobtex_get_jobs_layout_sidebar', $layout_type );
}

function jobtex_get_jobs_layout_type() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$layout_type = get_post_meta( $post->ID, 'apus_page_layout_type', true );
	}
	if ( empty($layout_type) ) {
		$layout_type = jobtex_get_config('jobs_layout_type', 'main-right');
	}
	return apply_filters( 'jobtex_get_jobs_layout_type', $layout_type );
}

function jobtex_get_jobs_display_mode() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$display_mode = get_post_meta( $post->ID, 'apus_page_display_mode', true );
	}
	if ( empty($display_mode) ) {
		$display_mode = jobtex_get_config('jobs_display_mode', 'list');
	}
	return apply_filters( 'jobtex_get_jobs_display_mode', $display_mode );
}

function jobtex_get_jobs_inner_style() {
	global $post;
	$display_mode = jobtex_get_jobs_display_mode();
	if ( $display_mode == 'list' ) {
		if ( is_page() && is_object($post) ) {
			$inner_style = get_post_meta( $post->ID, 'apus_page_inner_list_style', true );
		}
		if ( empty($inner_style) ) {
			$inner_style = jobtex_get_config('jobs_inner_list_style', 'list');
		}
	} else {
		if ( is_page() && is_object($post) ) {
			$inner_style = get_post_meta( $post->ID, 'apus_page_inner_grid_style', true );
		}
		if ( empty($inner_style) ) {
			$inner_style = jobtex_get_config('jobs_inner_grid_style', 'grid');
		}
	}
	return apply_filters( 'jobtex_get_jobs_inner_style', $inner_style );
}

function jobtex_get_jobs_columns() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$columns = get_post_meta( $post->ID, 'apus_page_jobs_columns', true );
	}
	if ( empty($columns) ) {
		$columns = jobtex_get_config('job_columns', 3);
	}
	return apply_filters( 'jobtex_get_jobs_columns', $columns );
}

function jobtex_get_job_layout_type() {
	global $post;
	$layout_type = get_post_meta($post->ID, WP_JOB_BOARD_PRO_JOB_LISTING_PREFIX.'layout_type', true);
	
	if ( empty($layout_type) ) {
		$layout_type = jobtex_get_config('job_layout_type', 'v1');
	}
	return apply_filters( 'jobtex_get_job_layout_type', $layout_type );
}

function jobtex_get_jobs_pagination() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$pagination = get_post_meta( $post->ID, 'apus_page_jobs_pagination', true );
	}
	if ( empty($pagination) ) {
		$pagination = jobtex_get_config('jobs_pagination', 'default');
	}
	return apply_filters( 'jobtex_get_jobs_pagination', $pagination );
}


function jobtex_get_jobs_show_filter_top() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$show_filter_top = get_post_meta( $post->ID, 'apus_page_jobs_show_filter_top', true );
	}
	if ( empty($show_filter_top) ) {
		$show_filter_top = jobtex_get_config('jobs_show_filter_top');
	} else {
		if ( $show_filter_top == 'yes' ) {
			$show_filter_top = true;
		} else {
			$show_filter_top = false;
		}
	}
	return apply_filters( 'jobtex_get_jobs_show_filter_top', $show_filter_top );
}

function jobtex_get_jobs_show_offcanvas_filter() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$show_offcanvas_filter = get_post_meta( $post->ID, 'apus_page_jobs_show_offcanvas_filter', true );
	}
	if ( empty($show_offcanvas_filter) ) {
		$show_offcanvas_filter = jobtex_get_config('jobs_show_offcanvas_filter');
	} else {
		if ( $show_offcanvas_filter == 'yes' ) {
			$show_offcanvas_filter = true;
		} else {
			$show_offcanvas_filter = false;
		}
	}
	return apply_filters( 'jobtex_get_jobs_show_offcanvas_filter', $show_offcanvas_filter );
}

function jobtex_get_jobs_filter_sidebar() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$jobs_filter_sidebar = get_post_meta( $post->ID, 'apus_page_jobs_filter_sidebar', true );
	}
	if ( empty($jobs_filter_sidebar) ) {
		$jobs_filter_sidebar = jobtex_get_config('jobs_filter_sidebar', 'jobs-filter-sidebar');
	}
	return apply_filters( 'jobtex_get_jobs_filter_sidebar', $jobs_filter_sidebar );
}

function jobtex_get_jobs_filter_top_sidebar() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$jobs_filter_top_sidebar = get_post_meta( $post->ID, 'apus_page_jobs_filter_top_sidebar', true );
	}
	if ( empty($jobs_filter_top_sidebar) ) {
		$jobs_filter_top_sidebar = jobtex_get_config('jobs_filter_top_sidebar', 'jobs-filter-top-sidebar');
	}
	return apply_filters( 'jobtex_get_jobs_filter_top_sidebar', $jobs_filter_top_sidebar );
}


function jobtex_job_scripts() {
	
	wp_enqueue_style( 'leaflet' );
	wp_enqueue_script( 'jquery-highlight' );
    wp_enqueue_script( 'leaflet' );
    
    wp_enqueue_script( 'control-geocoder' );
    wp_enqueue_script( 'leaflet-markercluster' );
    wp_enqueue_script( 'leaflet-HtmlIcon' );

    if ( wp_job_board_pro_get_option('map_service') == 'google-map' ) {
	    wp_enqueue_script( 'leaflet-GoogleMutant' );
	}

	$locale = get_locale();
	$locale = explode('_', $locale);
	$locale_code = !empty($locale[0]) ? $locale[0] : '';

	wp_register_script( 'jobtex-job', get_template_directory_uri() . '/js/job.js', array( 'jquery', 'wp-job-board-pro-main' ), '20150330', true );
	wp_localize_script( 'jobtex-job', 'jobtex_job_opts', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'empty_msg' => apply_filters( 'jobtex_autocompleate_search_empty_msg', esc_html__( 'Unable to find any listing that match the currenty query', 'jobtex' ) ),
        'show' => __( 'Show', 'jobtex' ),
		'hide' => __( 'Hide', 'jobtex' ),
		'lang_code' => $locale_code,
	));
	wp_enqueue_script( 'jobtex-job' );

	$here_map_api_key = '';
	$here_style = '';
	$mapbox_token = '';
	$mapbox_style = '';
	$custom_style = '';
	$map_service = wp_job_board_pro_get_option('map_service', '');
	if ( $map_service == 'mapbox' ) {
		$mapbox_token = wp_job_board_pro_get_option('mapbox_token', '');
		$mapbox_style = wp_job_board_pro_get_option('mapbox_style', 'streets-v11');
	} elseif ( $map_service == 'here' ) {
		$here_map_api_key = wp_job_board_pro_get_option('here_map_api_key', '');
		$here_style = wp_job_board_pro_get_option('here_map_style', 'normal.day');
	} else {
		$custom_style = wp_job_board_pro_get_option('google_map_style', '');
	}

	wp_register_script( 'jobtex-job-map', get_template_directory_uri() . '/js/job-map.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'jobtex-job-map', 'jobtex_job_map_opts', array(
		'map_service' => $map_service,
		'mapbox_token' => $mapbox_token,
		'mapbox_style' => $mapbox_style,
		'here_map_api_key' => $here_map_api_key,
		'here_style' => $here_style,
		'custom_style' => $custom_style,
		'default_latitude' => wp_job_board_pro_get_option('default_maps_location_latitude', '43.6568'),
		'default_longitude' => wp_job_board_pro_get_option('default_maps_location_longitude', '-79.4512'),
		'default_pin' => wp_job_board_pro_get_option('default_maps_pin', ''),
	));
	wp_enqueue_script( 'jobtex-job-map' );
}
add_action( 'wp_enqueue_scripts', 'jobtex_job_scripts', 10 );

function jobtex_job_create_resume_pdf_styles() {
	return array(
		get_template_directory() . '/css/all-awesome.css',
		get_template_directory() . '/css/icon-font.css',
		get_template_directory() . '/css/themify-icons.css',
		get_template_directory() . '/css/resume-pdf.css'
	);
}
add_filter( 'wp-job-board-pro-style-pdf', 'jobtex_job_create_resume_pdf_styles', 10 );


add_filter('wp-job-board-pro-job_listing-admin-custom-fields', 'jobtex_job_metaboxes_fields', 10);
function jobtex_job_metaboxes_fields($fields) {
	$prefix = WP_JOB_BOARD_PRO_JOB_LISTING_PREFIX;
	$layout_key = 'tab-heading-job_layout'.rand(100,1000);
	$fields[$layout_key] = array(
		'id' => $layout_key,
		'icon' => 'dashicons-admin-appearance',
		'title'  => esc_html__( 'Layout Type', 'jobtex' ),
		'fields' => array(
			array(
				'name'              => esc_html__( 'Layout Type', 'jobtex' ),
				'id'                => $prefix . 'layout_type',
				'type'              => 'select',
				'options'			=> array(
	                '' => esc_html__('Global Settings', 'jobtex'),
	                'v1' => esc_html__('Version 1', 'jobtex'),
	                'v2' => esc_html__('Version 2', 'jobtex'),
	            ),
			)
		),
	);

	return $fields;
}


function jobtex_job_template_folder_name($folder) {
	$folder = 'template-jobs';
	return $folder;
}
add_filter( 'wp-job-board-pro-theme-folder-name', 'jobtex_job_template_folder_name', 10 );



// post per page
add_filter('wp-job-board-pro-job_listing-filter-query', 'jobtex_job_filter_query', 10, 2);
function jobtex_job_filter_query( $query, $params) {
	$query_vars = &$query->query_vars;
	$query_vars['posts_per_page'] = jobtex_job_get_limit_number();
	$query->query_vars = $query_vars;
	
	return $query;
}

add_filter( 'wp-job-board-pro-job_listing-query-args', 'jobtex_job_filter_query_args', 10, 2 );
function jobtex_job_filter_query_args($query_args, $params) {
	$query_args['posts_per_page'] = jobtex_job_get_limit_number();
	return $query_args;
}

function jobtex_job_get_limit_number() {
	if ( isset( $_REQUEST['jobs_ppp'] ) ) {
        $number = intval( $_REQUEST['jobs_ppp'] );
    } elseif ( !empty($_COOKIE['jobs_per_page']) ) {
        $number = intval( $_COOKIE['jobs_per_page'] );
    } else {
        $value = wp_job_board_pro_get_option('number_jobs_per_page', 10);
        $number = intval( $value );
    }
    return $number;
}

add_action('init', 'jobtex_job_save_ppp');
function jobtex_job_save_ppp() {
	if ( !empty( $_REQUEST['jobs_ppp'] ) ) {
        $number = intval( $_REQUEST['jobs_ppp'] );
        setcookie('jobs_per_page', $number, time() + 864000);
        $_COOKIE['jobs_per_page'] = $number;
    }
}

function jobtex_check_employer_candidate_review($post) {
	if ( (comments_open($post) || get_comments_number($post)) ) {
		if ( $post->post_type == 'employer' ) {
			if ( method_exists('WP_Job_Board_Pro_Employer', 'check_restrict_review') ) {
				if ( WP_Job_Board_Pro_Employer::check_restrict_review($post) ) {
					return true;
				} else {
					return false;
				}
			}
		} elseif ( $post->post_type == 'candidate' ) {
			if ( method_exists('WP_Job_Board_Pro_Candidate', 'check_restrict_review') ) {
				if ( WP_Job_Board_Pro_Candidate::check_restrict_review($post) ) {
					return true;
				} else {
					return false;
				}
			}
		}
		return true;
	}
	return false;
}

function jobtex_placeholder_img_src( $size = 'thumbnail' ) {
	$src               = get_template_directory_uri() . '/images/placeholder.png';
	$placeholder_image = jobtex_get_config('job_placeholder_image');
	if ( !empty($placeholder_image['id']) ) {
        if ( is_numeric( $placeholder_image['id'] ) ) {
			$image = wp_get_attachment_image_src( $placeholder_image['id'], $size );

			if ( ! empty( $image[0] ) ) {
				$src = $image[0];
			}
		} else {
			$src = $placeholder_image;
		}
    }

	return apply_filters( 'jobtex_job_placeholder_img_src', $src );
}

function jobtex_locations_walk( $terms, $id_parent, &$dropdown ) {
    foreach ( $terms as $key => $term ) {
        if ( $term->parent == $id_parent ) {
            $dropdown = array_merge( $dropdown, array( $term ) );
            unset($terms[$key]);
            jobtex_locations_walk( $terms, $term->term_id,  $dropdown );
        }
    }
}

function jobtex_display_phone( $phone, $icon = '', $force_show_phone = false ) {
	if ( empty($phone) ) {
		return;
	}
	$show_full = jobtex_get_config('job_show_full_phone', false);
	$hide_phone = !$show_full ? true : false;
	if ( $force_show_phone ) {
		$hide_phone = false;
	}
	$hide_phone = apply_filters('jobtex_phone_hide_number', $hide_phone);

	$add_class = '';
    if ( $hide_phone ) {
        $add_class = 'phone-hide';
    }
	?>
	<div class="phone-wrapper <?php echo esc_attr($add_class); ?>">
		<?php if ( $icon ) { ?>
			<i class="<?php echo esc_attr($icon); ?>"></i>
		<?php } ?>
		<a class="phone" href="tel:<?php echo trim($phone); ?>"><?php echo trim($phone); ?></a>
        <?php if ( $hide_phone ) {
            $dispnum = substr($phone, 0, (strlen($phone)-3) ) . str_repeat("*", 3);
        ?>
            <span class="phone-show" onclick="this.parentNode.classList.add('show');"><?php echo trim($dispnum); ?> <span class="bg-theme"><?php esc_html_e('show', 'jobtex'); ?></span></span>
        <?php } ?>
	</div>
	<?php
}

function jobtex_is_jobs_page() {
	if ( is_page() ) {
		$page_name = basename(get_page_template());
		if ( $page_name == 'page-jobs.php' ) {
			return true;
		}
	} elseif( is_post_type_archive('job_listing') || is_tax('job_listing_category') || is_tax('job_listing_location') || is_tax('job_listing_tag') || is_tax('job_listing_type') ) {
		return true;
	}
	return false;
}


add_filter( 'wp-job-board-pro-get-salary-type-html', 'jobtex_jobs_salary_type_html', 10, 3 );
function jobtex_jobs_salary_type_html($salary_type_html, $salary_type, $post_id) {
	switch ($salary_type) {
		case 'yearly':
			$salary_type_html = esc_html__(' / year', 'jobtex');
			break;
		case 'monthly':
			$salary_type_html = esc_html__(' / month', 'jobtex');
			break;
		case 'weekly':
			$salary_type_html = esc_html__(' / week', 'jobtex');
			break;
		case 'hourly':
			$salary_type_html = esc_html__(' / hour', 'jobtex');
			break;
		case 'daily':
			$salary_type_html = esc_html__(' / day', 'jobtex');
			break;
		default:
			$types = WP_Job_Board_Pro_Mixes::get_default_salary_types();
			if ( !empty($types[$salary_type]) ) {
				$salary_type_html = ' / '.$types[$salary_type];
			}
			break;
	}
	return $salary_type_html;
}

function jobtex_jobs_get_custom_fields_display_hooks($hooks, $prefix) {
	if ( $prefix == WP_JOB_BOARD_PRO_JOB_LISTING_PREFIX ) {
		$hooks['wp-job-board-pro-single-job-employer-info'] = esc_html__('Single Job - Employer Info', 'jobtex');
	}
	return $hooks;
}
add_filter( 'wp-job-board-pro-get-custom-fields-display-hooks', 'jobtex_jobs_get_custom_fields_display_hooks', 10, 2 );


function jobtex_jobs_display_custom_fields_display_hooks($html, $custom_field, $post, $field_name, $output_value, $current_hook) {
	if ( $current_hook === 'wp-job-board-pro-single-job-details' ) {
		$icon = !empty($custom_field['icon']) ? $custom_field['icon'] : '';
		ob_start();
        ?>
        <li>
            <div class="icon">
                <?php if ( !empty($icon) ) { ?>
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                <?php } ?>
            </div>
            <div class="details">
                <?php if ( $field_name ) { ?>
                    <div class="text"><?php echo trim($field_name); ?></div>
                <?php } ?>
                <div class="value"><?php echo trim($output_value); ?></div>
            </div>
        </li>
        <?php
        $html = ob_get_clean();
    } elseif ( $current_hook === 'wp-job-board-pro-single-job-employer-info' || $current_hook === 'wp-job-board-pro-single-employer-details' ) {
    	ob_start();
    	?>
    	<div class="job-meta">
            <h3 class="title"><?php echo trim($field_name); ?>:</h3>
            <div class="value">
                <?php echo trim($output_value); ?>
            </div>
        </div>
    	<?php
    	$html = ob_get_clean();
    } elseif ( $current_hook === 'wp-job-board-pro-single-candidate-details' ) {
		$icon = !empty($custom_field['icon']) ? $custom_field['icon'] : '';
		ob_start();
        ?>
        <li>
            <div class="icon">
                <?php if ( !empty($icon) ) { ?>
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                <?php } ?>
            </div>
            <div class="details">
                <?php if ( $field_name ) { ?>
                    <div class="text"><?php echo trim($field_name); ?></div>
                <?php } ?>
                <div class="value"><?php echo trim($output_value); ?></div>
            </div>
        </li>
        <?php
        $html = ob_get_clean();
    }

    return $html;
}
add_filter( 'wp_job_board_pro_display_field_data', 'jobtex_jobs_display_custom_fields_display_hooks', 10, 6 );


function jobtex_get_post_author($post_id) {
	if ( method_exists('WP_Job_Board_Pro_Job_Listing', 'get_author_id') ) {
		return WP_Job_Board_Pro_Job_Listing::get_author_id($post_id);
	}

	return get_post_field( 'post_author', $post_id );
}

function jobtex_load_select2(){
	wp_enqueue_script('wpjbp-select2');
	wp_enqueue_style('wpjbp-select2');
}


add_action( 'wjbp_ajax_jobtex_get_job_chart', 'jobtex_job_get_chart_data' );
add_action( 'wp_ajax_jobtex_get_job_chart', 'jobtex_job_get_chart_data' );
add_action( 'wp_ajax_nopriv_jobtex_get_job_chart', 'jobtex_job_get_chart_data' );

function jobtex_job_get_chart_data() {
	$return = array();
	if ( !isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'jobtex-job-chart-nonce' ) ) {
		$return = array( 'status' => false, 'msg' => esc_html__('Your nonce did not verify.', 'jobtex') );
	   	echo wp_json_encode($return);
	   	exit;
	}
	if ( empty($_REQUEST['job_id']) ) {
		$return = array( 'status' => 'error', 'html' => esc_html__('Job not found', 'jobtex') );
		echo wp_json_encode($return);
	   	exit;
	}

	if ( jobtex_get_config('main_color') != "" ) {
		$main_color = jobtex_get_config('main_color');
	} else {
		$main_color = '#1967D2';
	}

	$job_id = $_REQUEST['job_id'];

	// datas
	$nb_days = !empty($_REQUEST['nb_days']) ? $_REQUEST['nb_days'] : 15;
    $number_days = apply_filters('jobtex-get-traffic-data-nb-days', $nb_days);
    if( empty($number_days) ) {
        $number_days = 15;
    }
    $number_days--;

    // labels
    $array_labels = array();
	for ($i=$number_days; $i >= 0; $i--) { 
		$date = strtotime(date("Y-m-d", strtotime("-".$i." day")));
		$array_labels[] = date_i18n(get_option('date_format'), $date);
	}

	// values
	$views_by_date = get_post_meta( $job_id, '_views_by_date', true );
    if ( !is_array( $views_by_date ) ) {
        $views_by_date = array();
    }

    $array_values = array();
	for ($i=$number_days; $i >= 0; $i--) { 
		$date = date("Y-m-d", strtotime("-".$i." day"));
		if ( isset($views_by_date[$date]) ) {
			$array_values[] = $views_by_date[$date];
		} else {
			$array_values[] = 0;
		}
	}

	$return = array(
		'stats_labels' => $array_labels,
		'stats_values' => $array_values,
		'stats_view' => esc_html__('Views', 'jobtex'),
		'chart_type' => apply_filters('jobtex-job-stats-type', 'line'),
		'bg_color' => apply_filters('jobtex-job-stats-bg-color', $main_color),
        'border_color' => apply_filters('jobtex-job-stats-border-color', $main_color),
	);
	echo json_encode($return);
	die();
}


add_filter('post_class', 'jobtex_set_post_class', 10, 3);
function jobtex_set_post_class($classes, $class, $post_id){
    if ( is_admin() ) {
        return $classes;
    }
    $post_type = get_post_type($post_id);

    switch ($post_type) {
    	case 'job_listing':
    		$obj_meta = WP_Job_Board_Pro_Job_Listing_Meta::get_instance($post_id);
    		$featured = $obj_meta->get_post_meta( 'featured' );
    		$urgent = $obj_meta->get_post_meta( 'urgent' );
    		if ( $featured ) {
    			$classes[] = 'is-featured';
    		}

    		if ( $urgent ) {
    			$classes[] = 'is-urgent';
    		}

    		break;
    	case 'candidate':
    		$obj_meta = WP_Job_Board_Pro_Candidate_Meta::get_instance($post_id);
    		$featured = $obj_meta->get_post_meta( 'featured' );
    		$urgent = $obj_meta->get_post_meta( 'urgent' );

    		if ( $featured ) {
    			$classes[] = 'is-featured';
    		}

    		if ( $urgent ) {
    			$classes[] = 'is-urgent';
    		}

    		break;
		case 'employer':

			$obj_meta = WP_Job_Board_Pro_Employer_Meta::get_instance($post_id);
			$featured = $obj_meta->get_post_meta( 'featured' );
    		if ( $featured ) {
    			$classes[] = 'is-featured';
    		}

    		break;
    }

    return $classes;
}



// autocomplete search jobs
add_action( 'wjbp_ajax_jobtex_autocomplete_search_jobs', 'jobtex_autocomplete_search_jobs' );
function jobtex_autocomplete_search_jobs() {
    // Query for suggestions
    $suggestions = array();
    $args = array(
		'post_type' => 'job_listing',
		'post_per_page' => 10,
		'fields' => 'ids'
	);
    $filter_params = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;

	$jobs = WP_Job_Board_Pro_Query::get_posts( $args, $filter_params );

	if ( !empty($jobs->posts) ) {
		foreach ($jobs->posts as $post_id) {
			$post = get_post($post_id);
			
			$suggestion['title'] = get_the_title($post_id);
			$suggestion['url'] = get_permalink($post_id);

			$obj_job_meta = WP_Job_Board_Pro_Job_Listing_Meta::get_instance($post_id);

			$image = '';
		 	if ( $obj_job_meta->check_post_meta_exist('logo') && ($logo_url = $obj_job_meta->get_post_meta( 'logo' )) ) {
    			$logo_id = WP_Job_Board_Pro_Job_Listing::get_post_meta($post_id, 'logo_id', true);
    			if ( $logo_id ) {
        			$image = wp_get_attachment_image_url( $logo_id, 'thumbnail' );
        		} else {
        			$image = $logo_url;
        		}
			} else {
				$author_id = jobtex_get_post_author($post_id);
				$employer_id = WP_Job_Board_Pro_User::get_employer_by_user_id($author_id);
				if ( has_post_thumbnail($employer_id) ) {
					$image = wp_get_attachment_image_url( get_post_thumbnail_id($employer_id), 'thumbnail' );
				} else {
					$image = jobtex_placeholder_img_src();
				}
			}

			$suggestion['image'] = $image;
	        
	        
	        $suggestion['salary'] = jobtex_job_display_salary($post, 'icon', false);

        	$suggestions[] = $suggestion;

		}
	}
    echo json_encode( $suggestions );
 
    exit;
}

// autocomplete search jobs
add_action( 'wjbp_ajax_jobtex_show_job_details', 'jobtex_show_job_details' );
function jobtex_show_job_details() {
    

    $job_id = isset($_REQUEST['job_id']) ? $_REQUEST['job_id'] : null;
    if ( empty($job_id) ) {
    	$return = array( 'status' => false, 'html' => esc_html__('The job is not exists.', 'jobtex') );
	   	echo wp_json_encode($return);
	   	exit;
    }
    $job = get_post($job_id);
    if ( empty($job) ) {
    	$return = array( 'status' => false, 'html' => esc_html__('The job is not exists.', 'jobtex') );
	   	echo wp_json_encode($return);
	   	exit;
    }
    

	ob_start();
		setup_postdata( $GLOBALS['post'] =& $job );
		echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'content-single-archive-job_listing' );
		wp_reset_postdata();
	$html = ob_get_clean();

	$return = array( 'status' => true, 'html' => $html );
   	echo wp_json_encode($return);
   	exit;
}


add_action( 'wjbp_ajax_jobtex_get_ajax_jobs', 'jobtex_get_ajax_jobs' );
function jobtex_get_ajax_jobs() {
	$settings = !empty($_POST['settings']) ? $_POST['settings'] : array();

    extract( $settings );

    $category_slugs = !empty($category_slugs) ? array_map('trim', explode(',', $category_slugs)) : array();
    $type_slugs = !empty($type_slugs) ? array_map('trim', explode(',', $type_slugs)) : array();
    $location_slugs = !empty($location_slugs) ? array_map('trim', explode(',', $location_slugs)) : array();

    $args = array(
        'limit' => $limit,
        'get_jobs_by' => $get_jobs_by,
        'orderby' => $orderby,
        'order' => $order,
        'categories' => $category_slugs,
        'types' => $type_slugs,
        'locations' => $location_slugs,
    );
    $loop = jobtex_get_jobs($args);
    
    if ( $loop->have_posts() ) {
        while ( $loop->have_posts() ) : $loop->the_post();
        	echo WP_Job_Board_Pro_Template_Loader::get_template_part( 'jobs-styles/inner-list' );
        endwhile;
        wp_reset_postdata();
    }
    exit();
}



function jobtex_hide_string($str = "") {
    $replaced = "";
    for($i = 0; $i < strlen($str) -1; $i++) $replaced .= "*";

    return substr($str, 0, 1)."".$replaced."".substr($str, -1, 1);
}


add_filter('wp-job-board-pro-mark-filled-job-return', 'jobtex_mark_filled_job_return', 10);
function jobtex_mark_filled_job_return($return) {
	$return['icon_class'] = 'ti-lock';
	return $return;
}

add_filter('wp-job-board-pro-mark-not-filled-job-return', 'jobtex_mark_not_filled_job_return', 10);
function jobtex_mark_not_filled_job_return($return) {
	$return['icon_class'] = 'ti-unlock';
	return $return;
}


// demo function
function jobtex_check_demo_account() {
	if ( defined('JOBTEX_DEMO_MODE') && JOBTEX_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'candidate' || strtolower($user_obj->data->user_login) == 'employer' ) {
			$return = array( 'status' => false, 'msg' => esc_html__('Demo users are not allowed to modify information.', 'jobtex') );
		   	echo wp_json_encode($return);
		   	exit;
		}
	}
}
add_action('wp-job-board-pro-process-apply-email', 'jobtex_check_demo_account', 10);
add_action('wp-job-board-pro-process-apply-internal', 'jobtex_check_demo_account', 10);
add_action('wp-job-board-pro-process-remove-applied', 'jobtex_check_demo_account', 10);
add_action('wp-job-board-pro-process-add-job-shortlist', 'jobtex_check_demo_account', 10);
add_action('wp-job-board-pro-process-remove-job-shortlist', 'jobtex_check_demo_account', 10);
add_action('wp-job-board-pro-process-follow-employer', 'jobtex_check_demo_account', 10);
add_action('wp-job-board-pro-process-unfollow-employer', 'jobtex_check_demo_account', 10);

add_action('wp-job-board-pro-process-add-candidate-shortlist', 'jobtex_check_demo_account', 10);
add_action('wp-job-board-pro-process-remove-candidate-shortlist', 'jobtex_check_demo_account', 10);

add_action('wp-job-board-pro-process-forgot-password', 'jobtex_check_demo_account', 10);
add_action('wp-job-board-pro-process-change-password', 'jobtex_check_demo_account', 10);
add_action('wp-job-board-pro-before-delete-profile', 'jobtex_check_demo_account', 10);
add_action('wp-job-board-pro-before-remove-job-alert', 'jobtex_check_demo_account', 10 );

add_action('wp-job-board-pro-before-process-remove-job', 'jobtex_check_demo_account', 10 );

function jobtex_check_demo_account2($error) {
	if ( defined('JOBTEX_DEMO_MODE') && JOBTEX_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'candidate' || strtolower($user_obj->data->user_login) == 'employer' ) {
			$error[] = esc_html__('Demo users are not allowed to modify information.', 'jobtex');
		}
	}
	return $error;
}
add_filter('wp-job-board-pro-submission-validate', 'jobtex_check_demo_account2', 10, 2);
add_filter('wp-job-board-pro-edit-validate', 'jobtex_check_demo_account2', 10, 2);

function jobtex_check_demo_account3($post_id, $prefix) {
	if ( defined('JOBTEX_DEMO_MODE') && JOBTEX_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'candidate' || strtolower($user_obj->data->user_login) == 'employer' ) {
			$_SESSION['messages'][] = array( 'danger', esc_html__('Demo users are not allowed to modify information.', 'jobtex') );
			$redirect_url = get_permalink( wp_job_board_pro_get_option('edit_profile_page_id') );
			WP_Job_Board_Pro_Mixes::redirect( $redirect_url );
			exit();
		}
	}
}
add_action('wp-job-board-pro-process-profile-before-change', 'jobtex_check_demo_account3', 10, 2);

function jobtex_check_demo_account5($post_id, $prefix) {
	if ( defined('JOBTEX_DEMO_MODE') && JOBTEX_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'candidate' || strtolower($user_obj->data->user_login) == 'employer' ) {
			$_SESSION['messages'][] = array( 'danger', esc_html__('Demo users are not allowed to modify information.', 'jobtex') );
			$redirect_url = get_permalink( wp_job_board_pro_get_option('my_resume_page_id') );
			WP_Job_Board_Pro_Mixes::redirect( $redirect_url );
			exit();
		}
	}
}
add_action('wp-job-board-pro-process-resume-before-change', 'jobtex_check_demo_account5', 10, 2);

function jobtex_check_demo_account4() {
	if ( defined('JOBTEX_DEMO_MODE') && JOBTEX_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'candidate' || strtolower($user_obj->data->user_login) == 'employer' ) {
			$return['msg'] = esc_html__('Demo users are not allowed to modify information.', 'jobtex');
			$return['status'] = false;
			echo json_encode($return); exit;
		}
	}
}
add_action('wp-private-message-before-reply-message', 'jobtex_check_demo_account4');
add_action('wp-private-message-before-add-message', 'jobtex_check_demo_account4');
add_action('wp-private-message-before-delete-message', 'jobtex_check_demo_account4');