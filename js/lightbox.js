(function($) {

$(document).ready(function() {

var lightbox = {
	container: $('#lightbox'),

	init: function( config ) {
		this.config = config;

		$('.lightbox-button').on('click', this.load);
	},

	load: function(e) {
		e.preventDefault();
		var href = $(this).attr('href'),
			lightboxWindow = lightbox.container.find('#lightbox-window');

		if ( href.indexOf('.jpg') > -1 ) {
			lightboxWindow.append('<img src="'+href+'" id="lightbox-img" />');
			lightbox.show();
		} else {
			lightboxWindow.load(href, lightbox.show);
		}
	},

	show: function() {
		lightbox.close.call(lightbox.container);
		var lightboxWindow = lightbox.container.show().find('#lightbox-window');
		lightbox.position(lightboxWindow);
	},

	post: function(elem) {
		var form = elem.find('form');

		form.on('submit', function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				type: 'POST',
				url: '../controllers/upload-img.php',
				xhr: function() {  // Custom XMLHttpRequest
			            var myXhr = $.ajaxSettings.xhr();
			            if (myXhr.upload) { // Check if upload property exists
			                myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // For handling the progress of the upload
			            }
			            return myXhr;
	        		},
				data: formData,
				cache: false,
				contentType: false,
	        	processData: false,
				success: function(data) {
					
					window.location = '../admin/portfolio.php';
				}
			});

			function progressHandlingFunction(e) {
			    if(e.lengthComputable){
			        $('progress').attr({value:e.loaded,max:e.total});
			    }
			};

		});
	},

	close: function() {
		var $this = $(this),
			lightboxWindow = $this.find('#lightbox-window'),
			lightboxImg = $('#lightbox-img');

		if ( lightboxImg.length > 0 ) {
			lightboxImg.on('click', function() {
				lightbox.restart($this, lightboxWindow);
			});
		} else {
			lightbox.post(lightboxWindow);

			$('<span class="close">close</span>')
				.prependTo(lightboxWindow)
				.on('click', function() {
					lightbox.restart($this, lightboxWindow);
				});			
		}
	},

	restart: function(elem, lightboxWindow) {
		elem.hide();
		lightboxWindow.empty()
						.css('top', 0)
						.css('margin-left', 0);
	},

	position: function(elem) {
		var width = elem.outerWidth(),
			height = elem.outerHeight();

		if ( width > 40 ) {
			elem.css('margin-left', (this.config.windowWidth - width) / 2);
		
			if ( height > 40 && height < this.config.windowHeight ) {
				elem.css('top', (this.config.windowHeight - height) / 2);
			} else {
				elem.css('top', 0);
			}
		}
	

	}

};

lightbox.init({
	windowHeight: $(window).height(),
	windowWidth: $(window).width()
});

});

})(jQuery);