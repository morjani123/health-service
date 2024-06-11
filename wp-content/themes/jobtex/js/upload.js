jQuery(document).ready(function($){
	"use strict";
	var jobtex_upload;
	var jobtex_selector;

	function jobtex_add_file(event, selector) {

		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		jobtex_selector = selector;

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( jobtex_upload ) {
			jobtex_upload.open();
			return;
		} else {
			// Create the media frame.
			jobtex_upload = wp.media.frames.jobtex_upload =  wp.media({
				// Set the title of the modal.
				title: "Select Image",

				// Customize the submit button.
				button: {
					// Set the text of the button.
					text: "Selected",
					// Tell the button not to close the modal, since we're
					// going to refresh the page when the image is selected.
					close: false
				}
			});

			// When an image is selected, run a callback.
			jobtex_upload.on( 'select', function() {
				// Grab the selected attachment.
				var attachment = jobtex_upload.state().get('selection').first();

				jobtex_upload.close();
				jobtex_selector.find('.upload_image').val(attachment.attributes.url).change();
				if ( attachment.attributes.type == 'image' ) {
					jobtex_selector.find('.jobtex_screenshot').empty().hide().prepend('<img src="' + attachment.attributes.url + '">').slideDown('fast');
				}
			});

		}
		// Finally, open the modal.
		jobtex_upload.open();
	}

	function jobtex_remove_file(selector) {
		selector.find('.jobtex_screenshot').slideUp('fast').next().val('').trigger('change');
	}
	
	$('body').on('click', '.jobtex_upload_image_action .remove-image', function(event) {
		jobtex_remove_file( $(this).parent().parent() );
	});

	$('body').on('click', '.jobtex_upload_image_action .add-image', function(event) {
		jobtex_add_file(event, $(this).parent().parent());
	});

});