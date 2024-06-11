<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="box-dashboard-wrapper">
	<div class="alert alert-warning not-allow-wrapper">
		<?php
		if ( empty($need_role) ) {
			echo esc_html__( 'You are not allowed to access this page.', 'jobtex' );
		} else {
			switch ($need_role) {
				case 'employer':
					$need_role = esc_html__( 'employer', 'jobtex' );
					break;
				default:
					$need_role = esc_html__( 'candidate', 'jobtex' );
					break;
			}
			echo sprintf(esc_html__( 'You need to login with %s account to access this page.', 'jobtex' ), $need_role);
		}

		?>
	</div><!-- /.alert -->
</div>