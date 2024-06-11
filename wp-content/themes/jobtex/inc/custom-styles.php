<?php
if ( !function_exists ('jobtex_custom_styles') ) {
	function jobtex_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
		<?php if ( jobtex_get_config('main_color') != "" ) {
			$main_color = jobtex_get_config('main_color');
		} else {
			$main_color = '#14A077';
		}
		if ( jobtex_get_config('second_color') != "" ) {
			$second_color = jobtex_get_config('second_color');
		} else {
			$second_color = '#1F4B3F';
		}

		if ( jobtex_get_config('main_hover_color') != "" ) {
			$main_hover_color = jobtex_get_config('main_hover_color');
		} else {
			$main_hover_color = '#0e7355';
		}

		if ( jobtex_get_config('second_hover_color') != "" ) {
			$second_hover_color = jobtex_get_config('second_hover_color');
		} else {
			$second_hover_color = '#121212';
		}

		if ( jobtex_get_config('text_color') != "" ) {
			$text_color = jobtex_get_config('text_color');
		} else {
			$text_color = '#64666C';
		}

		if ( jobtex_get_config('link_color') != "" ) {
			$link_color = jobtex_get_config('link_color');
		} else {
			$link_color = '#121212';
		}

		if ( jobtex_get_config('link_hover_color') != "" ) {
			$link_hover_color = jobtex_get_config('link_hover_color');
		} else {
			$link_hover_color = '#14A077';
		}

		if ( jobtex_get_config('heading_color') != "" ) {
			$heading_color = jobtex_get_config('heading_color');
		} else {
			$heading_color = '#121212';
		}

		$main_color_rgb = jobtex_hex2rgb($main_color);
		$second_color_rgb = jobtex_hex2rgb($second_color);

		// font
		$main_font = jobtex_get_config('main-font');
		$main_font = !empty($main_font) ? json_decode($main_font, true) : array();
		$main_font_family = !empty($main_font['fontfamily']) ? $main_font['fontfamily'] : 'Plus Jakarta Sans';
		$main_font_weight = !empty($main_font['fontweight']) ? $main_font['fontweight'] : 400;
		$main_font_size = !empty(jobtex_get_config('main-font-size')) ? jobtex_get_config('main-font-size').'px' : '16px';

		$main_font_arr = explode(',', $main_font_family);
		if ( count($main_font_arr) == 1 ) {
			$main_font_family = "'".$main_font_family."'";
		}
		
		$heading_font = jobtex_get_config('heading-font');
		$heading_font = !empty($heading_font) ? json_decode($heading_font, true) : array();
		$heading_font_family = !empty($heading_font['fontfamily']) ? $heading_font['fontfamily'] : 'Plus Jakarta Sans';
		$heading_font_weight = !empty($heading_font['fontweight']) ? $heading_font['fontweight'] : 700;

		$heading_font_arr = explode(',', $heading_font_family);
		if ( count($heading_font_arr) == 1 ) {
			$heading_font_family = "'".$heading_font_family."'";
		}
		
		?>
		:root {

			--jobtex-theme-color: <?php echo trim($main_color); ?>;
			--jobtex-second-color: <?php echo trim($second_color); ?>;
			--jobtex-text-color: <?php echo trim($text_color); ?>;
			--jobtex-link-color: <?php echo trim($link_color); ?>;
			--jobtex-link_hover_color: <?php echo trim($link_hover_color); ?>;
			--jobtex-heading-color: <?php echo trim($heading_color); ?>;
			--jobtex-theme-hover-color: <?php echo trim($main_hover_color); ?>;
			--jobtex-second-hover-color: <?php echo trim($second_hover_color); ?>;

		  	--jobtex-theme-color-001: <?php echo esc_html(jobtex_generate_rgba($main_color_rgb, 0.01)); ?>
		  	--jobtex-theme-color-01: <?php echo esc_html(jobtex_generate_rgba($main_color_rgb, 0.1)); ?>
		  	--jobtex-theme-color-015: <?php echo esc_html(jobtex_generate_rgba($main_color_rgb, 0.15)); ?>
		  	--jobtex-theme-color-007: <?php echo esc_html(jobtex_generate_rgba($main_color_rgb, 0.07)); ?>
		  	--jobtex-theme-color-008: <?php echo esc_html(jobtex_generate_rgba($main_color_rgb, 0.08)); ?>
		  	--jobtex-theme-color-08: <?php echo esc_html(jobtex_generate_rgba($main_color_rgb, 0.8)); ?>
		  	--jobtex-theme-color-005: <?php echo esc_html(jobtex_generate_rgba($main_color_rgb, 0.05)); ?>

		  	--jobtex-main-font: <?php echo trim($main_font_family); ?>;
			--jobtex-main-font-size: <?php echo trim($main_font_size); ?>;
			--jobtex-main-font-weight: <?php echo trim($main_font_weight); ?>;
			--jobtex-heading-font: <?php echo trim($heading_font_family); ?>;
			--jobtex-heading-font-weight: <?php echo trim($heading_font_weight); ?>;
		}
			
		<?php if (  jobtex_get_config('header_mobile_color') != "" ) : ?>
			#apus-header-mobile {
				background-color: <?php echo esc_html( jobtex_get_config('header_mobile_color') ); ?>;
			}
		<?php endif; ?>
		

		<?php if (  jobtex_get_config('job_featured_background_color') != "" ) : ?>
			.job-grid.is-featured, .job-list.is-featured {
				background-color: <?php echo esc_html( jobtex_get_config('job_featured_background_color') ); ?>;
			}
		<?php endif; ?>

		<?php if (  jobtex_get_config('job_urgent_background_color') != "" ) : ?>
			.job-grid.is-urgent, .job-list.is-urgent {
				background-color: <?php echo esc_html( jobtex_get_config('job_urgent_background_color') ); ?>;
			}
		<?php endif; ?>

		<?php if (  jobtex_get_config('candidate_featured_background_color') != "" ) : ?>
			.candidate-card.is-featured .candidate-grid, .candidate-card.is-featured .candidate-list {
				background-color: <?php echo esc_html( jobtex_get_config('candidate_featured_background_color') ); ?>;
			}
		<?php endif; ?>

		<?php if (  jobtex_get_config('candidate_urgent_background_color') != "" ) : ?>
			.candidate-card.is-urgent .candidate-grid, .candidate-card.is-urgent .candidate-list {
				background-color: <?php echo esc_html( jobtex_get_config('candidate_urgent_background_color') ); ?>;
			}
		<?php endif; ?>

		<?php if (  jobtex_get_config('employer_featured_background_color') != "" ) : ?>
			.employer-card.is-featured .employer-grid, .employer-card.is-featured .employer-list {
				background-color: <?php echo esc_html( jobtex_get_config('employer_featured_background_color') ); ?>;
			}
		<?php endif; ?>

	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		return implode($new_lines);
	}
}