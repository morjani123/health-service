<?php

if ( !function_exists( 'jobtex_page_metaboxes' ) ) {
	function jobtex_page_metaboxes(array $metaboxes) {
		global $wp_registered_sidebars;
        $sidebars = array();

        if ( !empty($wp_registered_sidebars) ) {
            foreach ($wp_registered_sidebars as $sidebar) {
                $sidebars[$sidebar['id']] = $sidebar['name'];
            }
        }
        $headers = array_merge( array('global' => esc_html__( 'Global Setting', 'jobtex' )), jobtex_get_header_layouts() );
        $footers = array_merge( array('global' => esc_html__( 'Global Setting', 'jobtex' )), jobtex_get_footer_layouts() );

		$prefix = 'apus_page_';

        $columns = array(
            '' => esc_html__( 'Global Setting', 'jobtex' ),
            '1' => esc_html__('1 Column', 'jobtex'),
            '2' => esc_html__('2 Columns', 'jobtex'),
            '3' => esc_html__('3 Columns', 'jobtex'),
            '4' => esc_html__('4 Columns', 'jobtex'),
            '6' => esc_html__('6 Columns', 'jobtex')
        );
        // Jobs Page
        $fields = array(
            array(
                'name' => esc_html__( 'Jobs Layout', 'jobtex' ),
                'id'   => $prefix.'layout_type',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'default' => esc_html__('Default', 'jobtex'),
                    'fullwidth' => esc_html__('Full Width', 'jobtex'),
                    'half-map' => esc_html__('Half Map', 'jobtex'),
                    'top-map' => esc_html__('Top Map', 'jobtex'),
                    'half-job-details' => esc_html__('Half Job Details', 'jobtex'),
                    'half-job-details-v2' => esc_html__('Half Job Details 2', 'jobtex'),
                )
            ),
            array(
                'id' => $prefix.'inner_list_style',
                'type' => 'select',
                'name' => esc_html__('Jobs list item style', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'list' => esc_html__('List Default', 'jobtex'),
                    'list-v1' => esc_html__('List V1', 'jobtex'),
                    'list-v2' => esc_html__('List V2', 'jobtex'),
                ),
            ),
            array(
                'id' => $prefix.'jobs_columns',
                'type' => 'select',
                'name' => esc_html__('Listing Columns', 'jobtex'),
                'options' => $columns,
            ),
            array(
                'id' => $prefix.'jobs_pagination',
                'type' => 'select',
                'name' => esc_html__('Pagination Type', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'default' => esc_html__('Default', 'jobtex'),
                    'loadmore' => esc_html__('Load More Button', 'jobtex'),
                    'infinite' => esc_html__('Infinite Scrolling', 'jobtex'),
                ),
            ),

            array(
                'id' => $prefix.'jobs_show_filter_top',
                'type' => 'select',
                'name' => esc_html__('Show Filter Top', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'no' => esc_html__('No', 'jobtex'),
                    'yes' => esc_html__('Yes', 'jobtex')
                ),
            ),
            array(
                'id' => $prefix.'jobs_filter_top_sidebar',
                'type' => 'select',
                'name' => esc_html__('Jobs Filter Top Sidebar', 'jobtex'),
                'description' => esc_html__('Choose a filter top sidebar for your website.', 'jobtex'),
                'options' => array(
                    '' => esc_html__('Global Setting', 'jobtex'),
                    'jobs-filter-top-sidebar' => esc_html__('Jobs Filter Top Sidebar', 'jobtex'),
                ),
                'default' => ''
            ),

            array(
                'id' => $prefix.'jobs_show_offcanvas_filter',
                'type' => 'select',
                'name' => esc_html__('Show Offcanvas Filter', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'no' => esc_html__('No', 'jobtex'),
                    'yes' => esc_html__('Yes', 'jobtex')
                ),
            ),

            array(
                'id' => $prefix.'jobs_filter_sidebar',
                'type' => 'select',
                'name' => esc_html__('Jobs Filter Sidebar', 'jobtex'),
                'description' => esc_html__('Choose a filter sidebar for your website.', 'jobtex'),
                'options' => array(
                    '' => esc_html__('Global Setting', 'jobtex'),
                    'jobs-filter-sidebar' => esc_html__('Jobs Filter Sidebar', 'jobtex'),
                    'jobs-filter2-sidebar' => esc_html__('Jobs Filter 2 Sidebar', 'jobtex'),
                ),
                'default' => ''
            ),

        );
        
        $metaboxes[$prefix . 'jobs_setting'] = array(
            'id'                        => $prefix . 'jobs_setting',
            'title'                     => esc_html__( 'Jobs Settings', 'jobtex' ),
            'object_types'              => array( 'page' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );


        // Employers Page
        $fields = array(
            array(
                'name' => esc_html__( 'Employers Layout', 'jobtex' ),
                'id'   => $prefix.'employers_layout_type',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'default' => esc_html__('Default', 'jobtex'),
                    'half-map' => esc_html__('Half Map', 'jobtex'),
                    'top-map' => esc_html__('Top Map', 'jobtex'),
                )
            ),
            array(
                'id' => $prefix.'employers_display_mode',
                'type' => 'select',
                'name' => esc_html__('Employers display mode', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'grid' => esc_html__('Grid', 'jobtex'),
                    'list' => esc_html__('List', 'jobtex'),
                )
            ),
            array(
                'id' => $prefix.'employers_inner_list_style',
                'type' => 'select',
                'name' => esc_html__('Employers list item style', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'list' => esc_html__('List Default', 'jobtex'),
                    'list-v1' => esc_html__('List V1', 'jobtex'),
                    'list-v2' => esc_html__('List V2', 'jobtex'),
                ),
            ),
            array(
                'id' => $prefix.'employers_inner_grid_style',
                'type' => 'select',
                'name' => esc_html__('Employers grid item style', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'grid' => esc_html__('Grid Default', 'jobtex'),
                ),
            ),
            array(
                'id' => $prefix.'employers_columns',
                'type' => 'select',
                'name' => esc_html__('Employer Columns', 'jobtex'),
                'options' => $columns,
                'description' => esc_html__('Apply for display mode is grid and simple.', 'jobtex'),
            ),
            array(
                'id' => $prefix.'employers_pagination',
                'type' => 'select',
                'name' => esc_html__('Pagination Type', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'default' => esc_html__('Default', 'jobtex'),
                    'loadmore' => esc_html__('Load More Button', 'jobtex'),
                    'infinite' => esc_html__('Infinite Scrolling', 'jobtex'),
                ),
            ),


        );
        $metaboxes[$prefix . 'employers_setting'] = array(
            'id'                        => $prefix . 'employers_setting',
            'title'                     => esc_html__( 'Employers Settings', 'jobtex' ),
            'object_types'              => array( 'page' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );

        // Candidates Page
        $fields = array(
            array(
                'name' => esc_html__( 'Candidates Layout', 'jobtex' ),
                'id'   => $prefix.'candidates_layout_type',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'default' => esc_html__('Default', 'jobtex'),
                    'half-map' => esc_html__('Half Map', 'jobtex'),
                    'top-map' => esc_html__('Top Map', 'jobtex'),
                )
            ),
            array(
                'id' => $prefix.'candidates_display_mode',
                'type' => 'select',
                'name' => esc_html__('Candidates display mode', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'grid' => esc_html__('Grid', 'jobtex'),
                    'list' => esc_html__('List', 'jobtex'),
                )
            ),
            array(
                'id' => $prefix.'candidates_inner_list_style',
                'type' => 'select',
                'name' => esc_html__('Candidates list item style', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'list' => esc_html__('List Default', 'jobtex'),
                ),
            ),
            array(
                'id' => $prefix.'candidates_inner_grid_style',
                'type' => 'select',
                'name' => esc_html__('Candidates grid item style', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'grid' => esc_html__('Grid Default', 'jobtex'),
                ),
            ),
            array(
                'id' => $prefix.'candidates_columns',
                'type' => 'select',
                'name' => esc_html__('Candidate Columns', 'jobtex'),
                'options' => $columns,
                'description' => esc_html__('Apply for display mode is grid.', 'jobtex'),
            ),
            array(
                'id' => $prefix.'candidates_pagination',
                'type' => 'select',
                'name' => esc_html__('Pagination Type', 'jobtex'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'jobtex' ),
                    'default' => esc_html__('Default', 'jobtex'),
                    'loadmore' => esc_html__('Load More Button', 'jobtex'),
                    'infinite' => esc_html__('Infinite Scrolling', 'jobtex'),
                ),
            ),
        );
        $metaboxes[$prefix . 'candidates_setting'] = array(
            'id'                        => $prefix . 'candidates_setting',
            'title'                     => esc_html__( 'Candidates Settings', 'jobtex' ),
            'object_types'              => array( 'page' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );

        // General
	    $fields = array(
			array(
				'name' => esc_html__( 'Select Layout', 'jobtex' ),
				'id'   => $prefix.'layout',
				'type' => 'select',
				'options' => array(
					'main' => esc_html__('Main Content Only', 'jobtex'),
					'left-main' => esc_html__('Left Sidebar - Main Content', 'jobtex'),
					'main-right' => esc_html__('Main Content - Right Sidebar', 'jobtex')
				)
			),
			array(
                'id' => $prefix.'fullwidth',
                'type' => 'select',
                'name' => esc_html__('Is Full Width?', 'jobtex'),
                'default' => 'no',
                'options' => array(
                    'no' => esc_html__('No', 'jobtex'),
                    'yes' => esc_html__('Yes', 'jobtex')
                )
            ),
            array(
                'id' => $prefix.'left_sidebar',
                'type' => 'select',
                'name' => esc_html__('Left Sidebar', 'jobtex'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'right_sidebar',
                'type' => 'select',
                'name' => esc_html__('Right Sidebar', 'jobtex'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'show_breadcrumb',
                'type' => 'select',
                'name' => esc_html__('Show Breadcrumb?', 'jobtex'),
                'options' => array(
                    'no' => esc_html__('No', 'jobtex'),
                    'yes' => esc_html__('Yes', 'jobtex')
                ),
                'default' => 'yes',
            ),
            array(
                'id' => $prefix.'breadcrumb_color',
                'type' => 'colorpicker',
                'name' => esc_html__('Breadcrumb Background Color', 'jobtex')
            ),
            array(
                'id' => $prefix.'breadcrumb_image',
                'type' => 'file',
                'name' => esc_html__('Breadcrumb Background Image', 'jobtex')
            ),
            array(
                'id' => $prefix.'header_type',
                'type' => 'select',
                'name' => esc_html__('Header Layout Type', 'jobtex'),
                'description' => esc_html__('Choose a header for your website.', 'jobtex'),
                'options' => $headers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'header_transparent',
                'type' => 'select',
                'name' => esc_html__('Header Transparent', 'jobtex'),
                'description' => esc_html__('Choose a header for your website.', 'jobtex'),
                'options' => array(
                    'no' => esc_html__('No', 'jobtex'),
                    'yes' => esc_html__('Yes', 'jobtex')
                ),
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'footer_type',
                'type' => 'select',
                'name' => esc_html__('Footer Layout Type', 'jobtex'),
                'description' => esc_html__('Choose a footer for your website.', 'jobtex'),
                'options' => $footers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'extra_class',
                'type' => 'text',
                'name' => esc_html__('Extra Class', 'jobtex'),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'jobtex')
            )
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'jobtex' ),
			'object_types'              => array( 'page' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'jobtex_page_metaboxes' );

if ( !function_exists( 'jobtex_cmb2_style' ) ) {
	function jobtex_cmb2_style() {
        wp_enqueue_style( 'jobtex-cmb2-style', get_template_directory_uri() . '/inc/vendors/cmb2/assets/style.css', array(), '1.0' );
		wp_enqueue_script( 'jobtex-admin', get_template_directory_uri() . '/js/admin.js', array( 'jquery' ), '20150330', true );
	}
}
add_action( 'admin_enqueue_scripts', 'jobtex_cmb2_style' );


