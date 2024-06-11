<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
jobtex_load_select2();
?>
<div class="box-dashboard-wrapper">
	<h3 class="widget-title"><?php echo esc_html__('Jobs Shortlist','jobtex') ?></h3>
	<div class="inner-list">
		<div class="search-orderby-wrapper d-md-flex align-items-center">
			<div class="search-jobs-shortlist-form search-applicants-form">
				<form action="" method="get">
					<div class="d-flex align-items-center position-relative">
						<button class="search-submit btn btn-sm btn-search" name="submit">
							<i class="icon-search"></i>
						</button>
						<input type="text" placeholder="<?php esc_attr_e( 'Search ...', 'jobtex' ); ?>" class="form-control" name="search" value="<?php echo esc_attr(isset($_GET['search']) ? $_GET['search'] : ''); ?>">
					</div>
					<input type="hidden" name="paged" value="1" />
				</form>
			</div>
			<div class="sort-jobs-shortlist-form sortby-form">
				<?php
					$orderby_options = apply_filters( 'wp_job_board_pro_my_jobs_orderby', array(
						'menu_order'	=> esc_html__( 'Sort by: Default', 'jobtex' ),
						'newest' 		=> esc_html__( 'Sort by: Newest', 'jobtex' ),
						'oldest'     	=> esc_html__( 'Sort by: Oldest', 'jobtex' ),
					) );

					$orderby = isset( $_GET['orderby'] ) ? wp_unslash( $_GET['orderby'] ) : 'newest'; 
				?>

				<div class="orderby-wrapper">
					<form class="my-jobs-ordering" method="get">
						<select name="orderby" class="orderby">
							<?php foreach ( $orderby_options as $id => $name ) : ?>
								<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
							<?php endforeach; ?>
						</select>
						<input type="hidden" name="paged" value="1" />
						<?php WP_Job_Board_Pro_Mixes::query_string_form_fields( null, array( 'orderby', 'submit', 'paged' ) ); ?>
					</form>
				</div>
			</div>
		</div>

		<?php
		if ( !empty($job_ids) && is_array($job_ids) ) {
			if ( get_query_var( 'paged' ) ) {
			    $paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
			    $paged = get_query_var( 'page' );
			} else {
			    $paged = 1;
			}
			$query_vars = array(
				'post_type'         => 'job_listing',
				'posts_per_page'    => get_option('posts_per_page'),
				'paged'    			=> $paged,
				'post_status'       => array('publish', 'expired'),
				'post__in'       	=> $job_ids,
			);

			if ( isset($_GET['search']) ) {
				$query_vars['s'] = $_GET['search'];
			}
			if ( isset($_GET['orderby']) ) {
				switch ($_GET['orderby']) {
					case 'menu_order':
						$query_vars['orderby'] = array(
							'menu_order' => 'ASC',
							'date'       => 'DESC',
							'ID'         => 'DESC',
						);
						break;
					case 'newest':
						$query_vars['orderby'] = 'date';
						$query_vars['order'] = 'DESC';
						break;
					case 'oldest':
						$query_vars['orderby'] = 'date';
						$query_vars['order'] = 'ASC';
						break;
				}
			}
			$jobs = new WP_Query($query_vars);
			
			if ( $jobs->have_posts() ) { ?>
				<div class="table-responsive">
				<table class="job-table">
					<thead>
						<tr>
							<th class="job-title"><?php esc_html_e('Job Title', 'jobtex'); ?></th>
							<th class="job-date"><?php esc_html_e('Posted Date', 'jobtex'); ?></th>
							<th class="job-actions"><?php esc_html_e('Actions', 'jobtex'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php while ( $jobs->have_posts() ) : $jobs->the_post();
							global $post;

							$author_id = jobtex_get_post_author($post->ID);
							$employer_id = WP_Job_Board_Pro_User::get_employer_by_user_id($author_id);
							$types = get_the_terms( $post->ID, 'job_listing_type' );
							$category = get_the_terms( $post->ID, 'job_listing_category' );
							$location = get_the_terms( $post->ID, 'job_listing_location' );
							$address = get_post_meta( $post->ID, WP_JOB_BOARD_PRO_JOB_LISTING_PREFIX . 'address', true );
							$salary = WP_Job_Board_Pro_Job_Listing::get_salary_html($post->ID);

							$job_id = $post->ID;
							?>

							<?php do_action( 'wp_job_board_pro_before_job_content', $post->ID ); ?>
							<tr class="job-applied-wrapper">
								<td>
									<div class="job-applied">
								        <div class="employer-logo">
								            <?php jobtex_job_display_employer_logo( $jobs, true ); ?>
								        </div>
									
										<div class="job-content">
											<div class="title-wrapper">
												<h2 class="job-table-info-content-title">
										        	<a href="<?php echo esc_url(get_permalink($job_id)); ?>" rel="bookmark"><?php echo get_the_title($job_id); ?></a>
										        </h2>
										        <?php jobtex_job_display_featured_icon($post,'icon'); ?>
										    </div>
									        <div class="job-metas">
									            <?php if ( $location ) { ?>
									        		<div class="location-job">
									        			<i class="icon-map-pin"></i>
											            <?php foreach ($location as $term) { ?>
											                <a href="<?php echo get_term_link($term); ?>"><?php echo trim($term->name); ?></a>
											                <?php break; ?>
											            <?php } ?>
										            </div>
										        <?php } ?>
										        <?php if ( $category ) { ?>
									        		<div class="category-job">
									        			<svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						                                    <path d="M13.334 4.66797H2.66732C1.93094 4.66797 1.33398 5.26492 1.33398 6.0013V12.668C1.33398 13.4043 1.93094 14.0013 2.66732 14.0013H13.334C14.0704 14.0013 14.6673 13.4043 14.6673 12.668V6.0013C14.6673 5.26492 14.0704 4.66797 13.334 4.66797Z" stroke="#64666C" stroke-linecap="round" stroke-linejoin="round"></path>
						                                    <path d="M10.6673 14V3.33333C10.6673 2.97971 10.5268 2.64057 10.2768 2.39052C10.0267 2.14048 9.68761 2 9.33398 2H6.66732C6.3137 2 5.97456 2.14048 5.72451 2.39052C5.47446 2.64057 5.33398 2.97971 5.33398 3.33333V14" stroke="#64666C" stroke-linecap="round" stroke-linejoin="round"></path>
						                                  </svg>
											            <?php foreach ($category as $term) { ?>
											                <a href="<?php echo get_term_link($term); ?>"><?php echo trim($term->name); ?></a>
											                <?php break; ?>
											            <?php } ?>
										            </div>
										        <?php } ?>
									        </div>
										</div>
									</div>
								</td>
								<td>
									<?php echo get_the_time(get_option('date_format'), $job_id); ?>
								</td>
								<td>
									<div class="action-button">
										<a href="javascript:void(0)" class="btn-remove-job-shortlist btn-action-icon deleted" data-job_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-pro-remove-job-shortlist-nonce' )); ?>" data-toggle="tooltip" title="<?php esc_attr_e('Remove', 'jobtex'); ?>"><i class="ti-close"></i></a>
										<a class="btn-action-icon" href="<?php echo esc_url(get_permalink($job_id)); ?>" data-toggle="tooltip" title="<?php esc_attr_e('View Job', 'jobtex'); ?>"><i class="ti-eye"></i></a>
									</div>
								</td>
							</tr>

							<?php do_action( 'wp_job_board_pro_after_job_content', $post->ID );
						endwhile; ?>
					</tbody>
				</table>
				</div>
				
				<?php WP_Job_Board_Pro_Mixes::custom_pagination( array(
					'wp_query' => $jobs,
					'max_num_pages' => $jobs->max_num_pages,
					'prev_text'     => '<i class="icon-keyboard_arrow_left"></i>',
					'next_text'     => '<i class="icon-keyboard_arrow_right"></i>',
				));

				wp_reset_postdata();
			}
		?>

		<?php } else { ?>
			<div class="not-found"><?php esc_html_e('No jobs found.', 'jobtex'); ?></div>
		<?php } ?>
	</div>
</div>