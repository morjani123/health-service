<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( $packages ) : ?>
	<div class="widget m-0 woocommerce widget-subwoo">
		<h2 class="widget-title"><?php esc_html_e( 'Packages', 'jobtex' ); ?></h2>
		<div class="row">
			<?php foreach ( $packages as $key => $package ) :
				$product = wc_get_product( $package );
				if ( ! $product->is_type( array( 'job_package', 'job_package_subscription' ) ) || ! $product->is_purchasable() ) {
					continue;
				}
				?>
				<div class="col-12 col-sm-6 col-lg-4">
					<div class="subwoo-inner <?php echo esc_attr($product->is_featured()?'is_featured':''); ?>">
						<div class="item">
							<div class="header-sub">
								<div class="inner-sub">
									<div class="icon-wrapper">
                                        <?php
                                        $icon_class = get_post_meta($product->get_id(), '_jobs_icon_class', true);
                                        if ( $icon_class ) {
                                            ?>
                                            <span class="<?php echo esc_attr($icon_class); ?>"></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
									<div class="top-info d-flex align-items-center">
                                        <h3 class="title"><?php echo get_the_title($product->get_id()); ?></h3>
                                        <?php if($product->is_featured()){ ?>
                                            <div class="recommended ms-auto">
                                                <?php echo esc_html__('Recommended','jobtex'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
								</div>
							</div>
							<div class="bottom-sub">
								<div class="price">
									<?php echo (!empty($product->get_price())) ? $product->get_price_html() : esc_html__('Free', 'jobtex'); ?>
								</div>
								<div class="short-des"><?php echo apply_filters( 'the_excerpt', get_post_field('post_excerpt', $product->get_id()) ) ?></div>
								<div class="button-action">
									<div class="add-cart">
										<button class="button w-100" type="submit" name="wjbpwpl_job_package" value="<?php echo esc_attr($product->get_id()); ?>" id="package-<?php echo esc_attr($product->get_id()); ?>">
											<?php esc_html_e('Get Started', 'jobtex') ?>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach;
				wp_reset_postdata();
			?>
		</div>
	</div>
<?php endif; ?>