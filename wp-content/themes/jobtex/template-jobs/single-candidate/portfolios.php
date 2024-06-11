<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$meta_obj = WP_Job_Board_Pro_Candidate_Meta::get_instance($post->ID);

if ( $meta_obj->check_post_meta_exist('portfolio_photos') && ($portfolio_photos = $meta_obj->get_post_meta( 'portfolio_photos' )) ) {
?>
    <div id="job-candidate-portfolio" class="candidate-detail-portfolio portfolio">
    	<div class="content-bottom">
	    	<div class="slick-carousel row-20"
                data-carousel="slick"

                data-items="3"
                data-large="3"
                data-medium="3"
                data-small="3"
                data-smallest="2"

                data-slidestoscroll="1"
                data-slidestoscroll_large="1"
                data-slidestoscroll_medium="1"
                data-slidestoscroll_small="1>"
                data-slidestoscroll_smallest="1"

                data-pagination="false"
                data-nav="true"
                data-rows="1"
                data-infinite="true"
                data-autoplay="true">
		        <?php  foreach ($portfolio_photos as $attach_id => $img_url) { ?>
		            <div class="item">
		            	<div class="education-item portfolio-item">
			            	<div class="position-relative">
			            		<a href="<?php echo esc_url($img_url); ?>" data-elementor-lightbox-slideshow="jobtex-gallery" class="popup-image-gallery">
			            			<?php echo jobtex_get_attachment_thumbnail($attach_id, '280x190'); ?>
			                	</a>
		                	</div>
		                </div>
		            </div>
		        <?php } ?>
	        </div>
        </div>
    </div>
<?php }