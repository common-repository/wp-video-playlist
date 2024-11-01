jQuery(function($) {
	jQuery(document).ready(function($) {
		jQuery('.tabList li').on('click', function(e) {
			e.preventDefault();
			var thisParent = jQuery(this).parent().data('tab'),
				trgt = jQuery(this).find('a').attr('href');

			jQuery(this).addClass('active').siblings().removeClass('active');
			jQuery(thisParent).find('.tabWrapper').slideUp('slow');
			jQuery(trgt).slideDown('slow');
		});

		jQuery('.tabList li').each(function(index, el) {
			if(jQuery(this).hasClass('active')) {
				jQuery(this).trigger('click');
			}
		});

		jQuery(document).on('click', '.addMedia', function(event) {
			event.preventDefault();
			var mediaType = '',
				id = jQuery(this).attr('id');

			if(id == 'addVideo') {
				mediaType = 'video';
			} else if(id == 'addAudio') {
				mediaType = 'audio';
			} else {
				mediaType = 'image';
			}

			var thisVal = jQuery(this).val(),
				file = wp.media.frames.file_frame = wp.media({
					title: 'Select Media',
					library: {
						type: mediaType
					},
					button: {
						text: thisVal
					},
					multipal: false
				});

			file.on('select', function() {
				var vTrack = file.state().get('selection').first().toJSON();
				if (jQuery('#mediaName').val() == '') {
					jQuery('#mediaName').val(vTrack.title);
				}
				jQuery('#mediaUri').val(vTrack.url);
			});

			file.open();
		});
	});
});