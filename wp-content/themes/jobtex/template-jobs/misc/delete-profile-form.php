<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty($user_id) ) {
	return;
}
?>
<div class="box-dashboard-wrapper sb-20">
	<h3 class="widget-title"><?php echo esc_html__('Delete Profile','jobtex') ?></h3>
	<div class="inner-list">
		<div class="widget-delete">
			<div class="conf-messages"><?php esc_html_e('Are you sure! You want to delete your profile.', 'jobtex'); ?></div>
			<div class="undone-messages"><?php esc_html_e('This can\'t be undone!', 'jobtex'); ?></div>

			<form method="post" action="" class="delete-profile-form">

				<div class="form-group">
					<div class="conf-deleted"><?php esc_html_e( 'Please enter your login Password to confirm:', 'jobtex' ); ?></div>
					<input id="delete-profile-password" class="form-control" type="password" name="password" required="required" placeholder="<?php esc_attr_e('Password', 'jobtex'); ?>">
				</div><!-- /.form-control -->

				<?php
					do_action('wp-job-board-pro-delete-profile-form-fields');
					wp_nonce_field('wp-job-board-pro-delete-profile-nonce', 'nonce');
				?>

				<button type="submit" class="btn btn-danger delete-profile-btn"><?php esc_html_e( 'Delete Profile', 'jobtex' ); ?></button>
			</form>
		</div>
	</div>
</div>