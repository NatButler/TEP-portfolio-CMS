(function() {
	var nav = $('nav');

	var sliderDIV = $('div.slider'),
		sliderUL = sliderDIV.children('ul'),
		imgs = sliderUL.find('img'),
		imgWidth = imgs[0].width,
		imgsLen = imgs.length;

	var Portfolio = {

		init: function( config ) {
			this.config = config;

			this.setSliderSize();
			this.bindEvents();
			this.setFader();

			$.ajaxSetup({
				url: 'index.php',
				type: 'POST'
			});

			this.config.display.css('top', this.displayHeight(this.config.sliderDIV));
			this.config.sliderNumsDiv.css('width', this.config.sliderWidth);
			$('#header h1').fadeIn(4000);

			//$(document).ready(function() {
				this.config.mainContent.css('padding-left', '0px');
			//});
		},

		displayHeight: function( elem ) {
			return (this.config.windowHeight / 2 - elem.outerHeight() / 2) - 90;
		},

		bindEvents: function() {
			var self = Portfolio;
			this.config.sliderDIV
					.mouseenter(function() { self.config.enter.fadeIn(); })
					.mouseleave(function() { self.config.enter.fadeOut(); });
			this.config.sliderDIV.one('click', this.enterSite);
			this.config.categorySelect.on('click', this.fetchImages);
			this.config.sliderNav.on('click', function() {
				var current = self.setCurrent( $(this).data('dir') );
				var newSliderWidth = imgs[current].width;
				self.sliderTransition(-self.config.marginArr[current], newSliderWidth);
			});
			this.config.thumbnailTab.on('click', this.toggleThumbnails);
		},

		unbindEvents: function() {
			window.clearInterval(this.config.fadeInt);
			this.config.sliderDIV.unbind('mouseenter');
			this.config.sliderDIV.unbind('mouseleave');
		},

		setSliderSize: function() {
			if ( this.config.windowHeight > 800 && this.config.windowWidth > 1250 ) {
				this.config.sliderWidth = 1000;
				this.config.sliderHeight = 667;
			} else if ( this.config.windowWidth < 850 ) {
				this.config.sliderWidth = 550;
				this.config.sliderHeight = 367;
			} else {
				this.config.sliderWidth = 900; //700
				this.config.sliderHeight = 600; //467
			}
		},

		setFader: function() {
			var self = Portfolio,
				marginLeft = 0,
				totalImgsWidth = imgWidth * imgsLen;

			this.config.fadeInt = setInterval(function() {
				self.config.sliderUL.animate({
					opacity: 0
				}, 1000, function() {
					if (marginLeft === -(totalImgsWidth-imgWidth)) {
			     		self.config.sliderUL.css('margin-left', '0px');
			     		marginLeft = 0;
			     	} else {
						self.config.sliderUL.css('margin-left', '-=' + imgWidth);
						marginLeft -= imgWidth;
			     	}
				}).animate({
					opacity: 1
				}, 1000);
			}, 5000);
		},

		enterSite: function() {
			var self = Portfolio;
			self.unbindEvents();

			self.config.enter.hide();
			self.config.sliderUL.hide();
			nav.fadeIn(1000);
			self.config.header.css('border-bottom', '1px solid #ccc');

			self.config.aside.animate({
				left: '0px'
			}, 500).removeClass('initial');

			self.config.display.animate({
				top: (self.config.windowHeight / 2 - self.config.sliderHeight / 2) - 43 //75
			}, 500);

			self.config.mainContent.animate({
				//left: aside.width(),
				//width: '-='+aside.width(),
				//top: (windowHeight / 2 - sliderHeight / 2)
				'padding-left': self.config.aside.width()
			}, 500, function() {
				self.config.sliderDIV.animate({
					width: self.config.sliderWidth,
					height: self.config.sliderHeight
				}, { queue: false, duration: 500, complete: triggerClick });
			});

			self.config.sliderNav.css('height', self.config.sliderHeight); //.css('width', display.outerWidth() / 2.1 + 'px');

			function triggerClick() {
				self.config.categorySelect.first().trigger('click');				
			}
		},

		fetchImages: function(e) {
			var self = Portfolio,
				$this = $(this);

			if ( !$this.hasClass('active') ) {
				self.config.sliderUL.hide();
				self.config.thumbDisplay.hide();

				$.ajax({
					data: 'image_set=' + this.text.toLowerCase().replace(' ', '_'),
					dataType: 'json'
				}).done(function( results ) {
					self.config.sliderUL.empty().append( self.buildImgList(results) );
					self.config.thumbDisplay.empty().append( self.buildThumbsList(results) );
					self.config.sliderNumsDiv.empty().append( self.config.slideNums );
					self.setSlider();
					self.setLocation($this);
				});
			}
			e.preventDefault();
		},

		buildImgList: function(results) { // COULD USE TEMPLATING EG. HANDLEBARS
			var html = '',
				w,
				margin = 0;

			this.config.marginArr = [0];
			this.config.slideNums = '';

			for ( var i = 0; i < results.length; i++ ) {
				if ( this.config.sliderWidth === 550 && results[i].img_width < 1000 ) {
					w = 243;
				} else if ( this.config.sliderWidth < 1000 && results[i].img_width < 1000 ) {
					w = 400; //311 397
				} else if ( this.config.sliderWidth === 1000 && results[i].img_width < 1000 ) {
					w = 444;
				} else {
					w = this.config.sliderWidth;
				}

				html += '<li><img src="'+results[i].img_path+results[i].file_name+'" alt="'+results[i].alt_tag+'" width="'+w+'" /></li>';

				// CALCULATES MARGIN POSITION FOR EACH SLIDE
				margin += w;
				this.config.marginArr.push(margin);

				// CREATES SLIDE NUMBERS
				this.config.slideNums += '<a href="#">' + (i+1) + '</a>';
			}
			return html;
		},

		buildThumbsList: function(results) {
			var html = '';
			for ( var i = 0; i < results.length; i++ ) {
				html += '<img src="'+results[i].img_path+'thumbs/'+results[i].file_name+'" alt="'+results[i].alt_tag+'" />';
			}
			html += '<div style="clear: both;"></div>';
			return html;
		},

		setSlider: function() {
			var self = Portfolio;

			this.config.sliderUL.css('margin-left', '0px');
			current = 0;
			imgs = this.config.sliderUL.find('img');
			imgWidth = imgs[current].width;
			imgsLen = imgs.length;
			this.config.thumbnails = this.config.thumbDisplay.find('img');
			this.config.sliderNumsDiv.empty().append( self.config.slideNums );
			this.config.sliderNumsA = this.config.sliderNumsDiv.find('a');
			this.sliderTransition(null, imgWidth);

			if ( imgsLen === 1 ) {
				self.config.sliderNav.hide();
			} else {
				self.config.sliderNav.show();
			}

			this.config.sliderUL.fadeIn(500);
			this.config.thumbDisplay.fadeIn(500);

			this.config.thumbnails.on('click', function() {
				current = self.config.thumbnails.index(this);
				var newSliderWidth = imgs[current].width;
				self.sliderTransition(-self.config.marginArr[current], newSliderWidth);
			});

			this.config.sliderNumsA.on('click', function() {
				current = self.config.sliderNumsA.index(this);
				var newSliderWidth = imgs[current].width;
				self.sliderTransition(-self.config.marginArr[current], newSliderWidth);
			});
		},

		sliderTransition: function( coords, newSliderWidth ) {
			this.config.sliderUL.animate({
				'margin-left': coords || -( current * imgWidth )
			});
			this.config.sliderDIV.animate({
				width: newSliderWidth
			});

			this.config.thumbnails.removeClass('selected');
			$(this.config.thumbnails[current]).addClass('selected');

			this.config.sliderNumsA.removeClass('current-pos');
			$(this.config.sliderNumsA[current]).addClass('current-pos');
		},

		setCurrent:	function( dir ) {
			var pos = current;

			pos += ( ~~( dir === 'next' ) || -1 );
			current = ( pos < 0 ) ? imgsLen -1 : pos % imgsLen;

			return current;
		},

		setLocation: function( $this ) {
			var set = $this.text(),
				cat = $this.closest('ul').siblings('h4').text();
			
			this.config.categorySelect.removeClass('active');	
			$this.addClass('active');
			$('#location').empty().append('<span>' + cat + ' > ' + set + '</span>');
		},

		toggleThumbnails: function() {
			var aside = $(this).parent('#aside'),
				asideWidth = aside.outerWidth();

			if ( aside.hasClass('active') || aside.hasClass('initial') ) {
				aside.animate({
					left: -asideWidth
				}).removeClass('active').removeClass('initial').addClass('hidden');
				Portfolio.config.mainContent.animate({
					'padding-left': -asideWidth
				}, 700).removeClass('contracted').addClass('expanded');

			} else {
				Portfolio.config.mainContent.animate({
					'padding-left': asideWidth
				}, 300).removeClass('expanded').addClass('contracted');
				aside.animate({
					left: 0
				}, 300).removeClass('hidden').addClass('active');
			}
		}

	};

	Portfolio.init({
		windowHeight: $(window).height(),
		windowWidth: $(window).width(),
		sliderWidth: '',
		sliderHeight: '',
		fadeInt: '',
		aside: $('#aside'),
		mainContent: $('#main-content'),
		display: $('#display'),
		categorySelect: nav.find('a.image-set'), // DEPENDS ON GLOBAL VAR
		sliderDIV: $('div.slider').css('overflow', 'hidden'),
		sliderUL: sliderDIV.children('ul'), // DEPENDS ON GLOBAL VAR
		sliderNav: $('.button'),
		thumbDisplay: $('#thumbnails'),
		thumbnails: '',
		marginArr: '',
		sliderNumsDiv: $('#slide-nums'),
		slideNums: '',
		sliderNumsA: '',
		enter: $('#enter'),
		header: $('div#header'),
		thumbnailTab: $('div#aside-tab')
	});

})();