(function($) {

$(document).ready(function() {

	$('html').addClass('js');

	// LOGIN SCREEN
	var container = $('#form-container');
	var displayHeight = ($(window).height() / 2 - container.outerHeight() / 2) - 15;
	container.css('top', displayHeight);

	// BLOG
	var blogImgSelect = $('#post_img');
	var post_img = $('#post_img_display');

	if ( blogImgSelect.val() === "null" ) {
		post_img.empty().hide();
	}

	blogImgSelect.on('change', function() {
		var src = blogImgSelect.val();

		if ( src === "null" ) {
			post_img.empty().hide();
		} else {
			post_img.empty().append('<img src="../'+src+'" alt="post-image" class="post-thumbnail" />').show();			
		}
	});

	// FORM FUNCTION
	var formInput = $('form.update').find('input');
	var formTextarea = $('form.update').find('#body');
	var formDropDown = $('form.update').find('select');
	var save = $('#save');
	var categorySelect = $('#category');
	var categoryText = $('#new_category');
	var imageSetSelect = $('#image_set');
	var imageText = $('#new_set');
	var img_slider = $('#img_slider');

	var datatableCheckbox = $('.datatableCheckbox');

	formInput.on('change', function() {
		save.removeAttr('disabled');
		save.attr('enabled', 'enabled');
		$(this).css('outline', '1px dotted red');
	});

	formTextarea.on('change', function() {
		save.removeAttr('disabled');
		save.attr('enabled', 'enabled');
		$(this).css('outline', '1px dotted red');
	});

	formDropDown.on('change', function() {
		save.removeAttr('disabled');
		save.attr('enabled', 'enabled');
		$(this).css('outline', '1px dotted red');
	});

	if ( categorySelect.val() === 'blog' ) {
		img_slider.attr('disabled', 'disabled');
		imageSetSelect.attr('disabled', 'disabled');
	} else {
		categorySelect.on('change', function() {
			var selected = categorySelect.val();

			if ( selected == 'blog' ) {
				categoryText.attr('disabled', 'disabled');
				img_slider.attr('disabled', 'disabled');
				imageSetSelect.attr('disabled', 'disabled');
				imageText.attr('disabled', 'disabled');			
			}
			else if ( selected ) {
				categoryText.attr('disabled', 'disabled');
				imageText.removeAttr('disabled');
				imageText.attr('enabled', 'enabled');
				imageSetSelect.removeAttr('disabled');
				imageSetSelect.attr('enabled', 'enabled');
				img_slider.removeAttr('disabled');
				img_slider.attr('enabled', 'enabled');
			} 
			else {
				categoryText.removeAttr('disabled');
				categoryText.attr('enabled', 'enabled');
				imageText.removeAttr('disabled');
				imageText.attr('enabled', 'enabled');
				imageSetSelect.removeAttr('disabled');
				imageSetSelect.attr('enabled', 'enabled');
				img_slider.removeAttr('disabled');
				img_slider.attr('enabled', 'enabled');
			}
		});
	}

	imageSetSelect.on('change', function() {
		var selected = imageSetSelect.val();

		if ( selected ) {
			imageText.attr('disabled', 'disabled');
		} else {
			imageText.removeAttr('disabled');
			imageText.attr('enabled', 'enabled');
		}
	});

	datatableCheckbox.on('change', function() {
		var $this = $(this),
			table;

		( $this.attr('id').indexOf('img') > -1 ) ? table = 'images' : table = 'blog';

		var dataObj = {
			id: $this.attr('name'),
			checkbox: +( this.checked ),
			table: table
		};

		$.ajax({
			type: 'POST',
			url: '../controllers/slider-check.php',
			data: dataObj,
			cache: false,

			success: function(data) {
				
			}
		});

	});

	$('#delete').on('click', function(e) {
		e.preventDefault();
		if ( confirm('Delete?') ) {
			this.form.submit();
		}
	});

	$('.status').delay(1500).fadeOut(500);
	$('.file-details').delay(1500).fadeOut(500);
	$('.file-status').delay(1500).fadeOut(500);
	$('.uploaded-thumb').delay(1500).fadeOut(500);

	// NAVIGATION
	// var navLinkCurrent = $('nav li a.current').siblings('ul').slideDown();
	// var navLink = $('nav li');

	// navLink.on('hover', function() {
	// 	if ( !$(this).find('a').hasClass('current') ) {
	// 		$(this).find('a').next('ul').slideToggle();
	// 	}
	// });

});

})(jQuery);