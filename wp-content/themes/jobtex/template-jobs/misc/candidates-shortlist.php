<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
jobtex_load_select2();
?>
<div class="box-dashboard-wrapper">
	<h3 class="widget-title"><?php echo esc_html__('Candidate Shortlist','jobtex') ?></h3>
	<div class="inner-list">
		<div class="search-orderby-wrapper d-md-flex align-items-center">
			<div class="search-candidate-shortlist-form search-applicants-form">
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
			<div class="sort-candidate-shortlist-form sortby-form">
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

		<?php if ( !empty($candidate_ids) && is_array($candidate_ids) ) {
			if ( get_query_var( 'paged' ) ) {
			    $paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
			    $paged = get_query_var( 'page' );
			} else {
			    $paged = 1;
			}
			$query_vars = array(
				'post_type'         => 'candidate',
				'posts_per_page'    => get_option('posts_per_page'),
				'paged'    			=> $paged,
				'post_status'       => array('publish', 'expired'),
				'post__in'       	=> $candidate_ids,
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

			$candidates = new WP_Query($query_vars);
			
			if ( $candidates->have_posts() ) { ?>
				<div class="header-applicants d-none d-md-flex align-items-center">
					<div class="col-12 col-md-8"><?php echo esc_html__( 'Candidates', 'jobtex' ); ?></div>
					<div class="col-12 col-md-4 text-md-end"><?php echo esc_html__( 'Action', 'jobtex' ); ?></div>
				</div>
				<?php while ( $candidates->have_posts() ) : $candidates->the_post();
					global $post;
					$rating_avg = WP_Job_Board_Pro_Review::get_ratings_average($post->ID);
					?>

					<?php do_action( 'wp_job_board_pro_before_candidate_content', $post->ID ); ?>

					<article <?php post_class('applicants-candidate'); ?>>
						<div class="candidate-list candidate-applicant candidate-archive-layout d-md-flex align-items-center m-0">
				            <div class="col-12 col-md-8">
				                <div class="d-flex align-items-center">
				                    <?php if ( has_post_thumbnail() ) { ?>
						                <div class="candidate-logo">
					                        <a href="<?php the_permalink(); ?>">
					                            <?php echo get_the_post_thumbnail( $post->ID, 'thumbnail' ); ?>
					                        </a>
						                </div>
						            <?php } ?>
				                    <div class="candidate-info-content">
				                    	<?php jobtex_candidate_display_job_title($post); ?>
				                        <div class="title-wrapper">
				                            <?php
				                            $title = jobtex_candidate_name($post);
				                            ?>
				                            <h2 class="candidate-title">
				                                <a href="<?php the_permalink(); ?>" rel="bookmark">
				                                    <?php echo trim($title) ?>
				                                </a>
				                            </h2>
				                            <?php jobtex_candidate_display_featured_icon($post,'icon'); ?>
				                        </div>
				                        <div class="job-metas">
				                            <?php jobtex_candidate_display_short_location($post, 'icon'); ?>
				                            <?php jobtex_candidate_display_salary($post, 'icon'); ?>
				                        </div>
				                    </div>
				                </div>
				            </div>
				            <div class="col-12 col-md-4 text-md-end">
				                <div class="action-button">
				                    <a data-toggle="tooltip" href="<?php the_permalink(); ?>" class="btn-action-icon view" title="<?php esc_attr_e('View Profile', 'jobtex'); ?>"><i class="ti-eye"></i></a>
				                    

				                    <?php
				                    if ( jobtex_is_wp_private_message() ) {
					                    $candidate_user_id = WP_Job_Board_Pro_User::get_user_by_candidate_id($post->ID);
					                    jobtex_private_message_form_btn($post, $candidate_user_id);
					                }
				                    ?>

						    		<a data-toggle="tooltip" href="javascript:void(0)" class="btn-action-icon deleted btn-remove-candidate-shortlist" data-candidate_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-job-board-pro-remove-candidate-shortlist-nonce' )); ?>" title="<?php esc_attr_e('Delete candidate', 'jobtex'); ?>"><i class="ti-close"></i></a>
					    		</div>
				            </div>

					    </div>	


					</article><!-- #post-## -->

					<?php do_action( 'wp_job_board_pro_after_candidate_content', $post->ID );
				endwhile;

				WP_Job_Board_Pro_Mixes::custom_pagination( array(
					'wp_query' => $candidates,
					'max_num_pages' => $candidates->max_num_pages,
					'prev_text'     => '<i class="icon-keyboard_arrow_left"></i>',
					'next_text'     => '<i class="icon-keyboard_arrow_right"></i>',
				));

				wp_reset_postdata();
			}
		?>

		<?php } else { ?>
			<div class="not-found"><?php esc_html_e('Don\'t have any candidates in shortlist', 'jobtex'); ?></div>
		<?php } ?>
	</div>
</div>