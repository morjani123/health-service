<?php

function jobtex_get_candidates( $params = array() ) {
	$params = wp_parse_args( $params, array(
		'limit' => -1,
		'post_status' => 'publish',
		'get_candidates_by' => 'recent',
		'orderby' => '',
		'order' => '',
		'post__in' => array(),
		'fields' => null, // ids
		'author' => null,
		'categories' => array(),
		'locations' => array(),
	));
	extract($params);

	$query_args = array(
		'post_type'         => 'candidate',
		'posts_per_page'    => $limit,
		'post_status'       => $post_status,
		'orderby'       => $orderby,
		'order'       => $order,
	);

	$meta_query = array();
	switch ($get_candidates_by) {
		case 'recent':
			$query_args['orderby'] = 'date';
			$query_args['order'] = 'DESC';
			break;
		case 'featured':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_PRO_CANDIDATE_PREFIX.'featured',
	           	'value' => 'on',
	           	'compare' => '=',
			);
			break;
		case 'urgent':
			$meta_query[] = array(
				'key' => WP_JOB_BOARD_PRO_CANDIDATE_PREFIX.'urgent',
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
            'taxonomy'      => 'candidate_category',
            'field'         => 'slug',
            'terms'         => $categories,
            'operator'      => 'IN'
        );
    }
    if ( !empty($locations) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'candidate_location',
            'field'         => 'slug',
            'terms'         => $locations,
            'operator'      => 'IN'
        );
    }

    if ( !empty($tax_query) ) {
    	$query_args['tax_query'] = $tax_query;
    }
    
    $meta_query[] = array(
		'relation' => 'OR',
		array(
			'key'       => WP_JOB_BOARD_PRO_CANDIDATE_PREFIX.'show_profile',
			'value'     => 'show',
			'compare'   => '==',
		),
		array(
			'key'       => WP_JOB_BOARD_PRO_CANDIDATE_PREFIX.'show_profile',
			'compare' => 'NOT EXISTS',
		),
	);
	
    if ( !empty($meta_query) ) {
    	$query_args['meta_query'] = $meta_query;
    }

    if ( method_exists('WP_Job_Board_Pro_Candidate', 'candidate_restrict_listing_query_args') ) {
	    $query_args = WP_Job_Board_Pro_Candidate::candidate_restrict_listing_query_args($query_args, null);
	}
	
	return new WP_Query( $query_args );
}

if ( !function_exists('jobtex_candidate_content_class') ) {
	function jobtex_candidate_content_class( $class ) {
		$prefix = 'candidates';
		if ( is_singular( 'candidate' ) ) {
            $prefix = 'candidate';
        }
		if ( jobtex_get_config($prefix.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'jobtex_candidate_content_class', 'jobtex_candidate_content_class', 1 , 1 );

if ( !function_exists('jobtex_get_candidates_layout_configs') ) {
	function jobtex_get_candidates_layout_configs() {
		$layout_type = jobtex_get_candidates_layout_sidebar();
		switch ( $layout_type ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => 'candidates-filter-sidebar', 'class' => 'col-lg-4 col-12'  );
		 		$configs['main'] = array( 'class' => 'col-lg-8 col-12' );
		 		break;
		 	case 'main-right':
		 	default:
		 		$configs['right'] = array( 'sidebar' => 'candidates-filter-sidebar',  'class' => 'col-lg-4 col-12' ); 
		 		$configs['main'] = array( 'class' => 'col-lg-8 col-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-lg-12 col-12' );
	 			break;
		}
		return $configs; 
	}
}

function jobtex_get_candidates_layout_sidebar() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$layout_type = get_post_meta( $post->ID, 'apus_page_layout', true );
	}
	if ( empty($layout_type) ) {
		$layout_type = jobtex_get_config('candidates_archive_layout', 'main-right');
	}
	return apply_filters( 'jobtex_get_candidates_layout_sidebar', $layout_type );
}

function jobtex_get_candidates_layout_type() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$layout_type = get_post_meta( $post->ID, 'apus_page_candidates_layout_type', true );
	}
	if ( empty($layout_type) ) {
		$layout_type = jobtex_get_config('candidates_layout_type', 'main-right');
	}
	return apply_filters( 'jobtex_get_candidates_layout_type', $layout_type );
}

function jobtex_get_candidates_display_mode() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$columns = get_post_meta( $post->ID, 'apus_page_candidates_display_mode', true );
	}
	if ( empty($columns) ) {
		$columns = jobtex_get_config('candidates_display_mode', 3);
	}
	return apply_filters( 'jobtex_get_candidates_columns', $columns );
}

function jobtex_get_candidates_inner_style() {
	global $post;
	$display_mode = jobtex_get_candidates_display_mode();
	if ( $display_mode == 'list' ) {
		if ( is_page() && is_object($post) ) {
			$inner_style = get_post_meta( $post->ID, 'apus_page_candidates_inner_list_style', true );
		}
		if ( empty($inner_style) ) {
			$inner_style = jobtex_get_config('candidates_inner_list_style', 'list');
		}
	} else {
		if ( is_page() && is_object($post) ) {
			$inner_style = get_post_meta( $post->ID, 'apus_page_candidates_inner_grid_style', true );
		}
		if ( empty($inner_style) ) {
			$inner_style = jobtex_get_config('candidates_inner_grid_style', 'grid');
		}
	}
	return apply_filters( 'jobtex_get_candidates_inner_style', $inner_style );
}

function jobtex_get_candidates_columns() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$columns = get_post_meta( $post->ID, 'apus_page_candidates_columns', true );
	}
	if ( empty($columns) ) {
		$columns = jobtex_get_config('candidates_columns', 3);
	}
	return apply_filters( 'jobtex_get_candidates_columns', $columns );
}

function jobtex_get_candidate_layout_type() {
	global $post;
	$layout_type = get_post_meta($post->ID, WP_JOB_BOARD_PRO_CANDIDATE_PREFIX.'layout_type', true);
	
	if ( empty($layout_type) ) {
		$layout_type = jobtex_get_config('candidate_layout_type', 'v1');
	}
	return apply_filters( 'jobtex_get_candidate_layout_type', $layout_type );
}

function jobtex_get_candidates_pagination() {
	global $post;
	if ( is_page() && is_object($post) ) {
		$pagination = get_post_meta( $post->ID, 'apus_page_candidates_pagination', true );
	}
	if ( empty($pagination) ) {
		$pagination = jobtex_get_config('candidates_pagination', 'default');
	}
	return apply_filters( 'jobtex_get_candidates_pagination', $pagination );
}


// post per page
add_filter('wp-job-board-pro-candidate-filter-query', 'jobtex_candidate_filter_query', 10, 2);
function jobtex_candidate_filter_query( $query, $params) {
	$query_vars = &$query->query_vars;
	$query_vars['posts_per_page'] = jobtex_candidate_get_limit_number();
	$query->query_vars = $query_vars;
	
	return $query;
}

add_filter( 'wp-job-board-pro-candidate-query-args', 'jobtex_candidate_filter_query_args', 10, 2 );
function jobtex_candidate_filter_query_args($query_args, $params) {
	$query_args['posts_per_page'] = jobtex_candidate_get_limit_number();
	return $query_args;
}

function jobtex_candidate_get_limit_number() {
	if ( isset( $_REQUEST['candidates_ppp'] ) ) {
        $number = intval( $_REQUEST['candidates_ppp'] );
    } elseif ( !empty($_COOKIE['candidates_per_page']) ) {
        $number = intval( $_COOKIE['candidates_per_page'] );
    } else {
        $value = wp_job_board_pro_get_option('number_candidates_per_page', 10);
        $number = intval( $value );
    }
    return $number;
}

add_action('init', 'jobtex_candidate_save_ppp');
function jobtex_candidate_save_ppp() {
	if ( !empty( $_REQUEST['candidates_ppp'] ) ) {
        $number = intval( $_REQUEST['candidates_ppp'] );
        setcookie('candidates_per_page', $number, time() + 864000);
        $_COOKIE['candidates_per_page'] = $number;
    }
}

function jobtex_candidate_check_hidden_review() {
	$view = wp_job_board_pro_get_option('candidates_restrict_review', 'all');
	if ( $view == 'always_hidden' ) {
		return false;
	}
	return true;
}

function jobtex_get_candidates_show_filter_top() {
	$layout_type = jobtex_get_candidates_layout_type();
	$layout_sidebar = jobtex_get_candidates_layout_sidebar();
	$show_filter_top = false;
	if ( $layout_sidebar == 'main' && (is_active_sidebar( 'candidates-filter-top-sidebar' ) || is_active_sidebar( 'candidates-filter-top-maps-sidebar' )) ) {
		$show_filter_top = true;
	}
	return apply_filters( 'jobtex_get_candidates_show_filter_top', $show_filter_top );
}


add_filter('wp-job-board-pro-candidate-admin-custom-fields', 'jobtex_candidate_metaboxes_fields', 10);
function jobtex_candidate_metaboxes_fields($fields) {
	$prefix = WP_JOB_BOARD_PRO_CANDIDATE_PREFIX;
	$layout_key = 'tab-heading-candidate-layout'.rand(100,1000);
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

function jobtex_is_candidates_page() {
	if ( is_page() ) {
		$page_name = basename(get_page_template());
		if ( $page_name == 'page-candidates.php' ) {
			return true;
		}
	} elseif( is_post_type_archive('candidate') || is_tax('candidate_category') || is_tax('candidate_location') ) {
		return true;
	}
	return false;
}

function jobtex_candidate_placeholder_img_src( $size = 'thumbnail' ) {
	$src               = get_template_directory_uri() . '/images/placeholder.png';
	$placeholder_image = jobtex_get_config('candidate_placeholder_image');
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

	return apply_filters( 'jobtex_candidate_placeholder_img_src', $src );
}