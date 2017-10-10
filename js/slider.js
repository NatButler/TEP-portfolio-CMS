function Slider( container, nav ) {
	this.container = container;
	this.nav = nav.show();

	this.current = 0;

	this.imgs = this.container.find('img');
	this.imgWidth = this.imgs[this.current].width;
	this.imgsLen = this.imgs.length;

	this.events.click.call(this);
}

Slider.prototype.transition = function( coords ) {
	this.container.animate({
		'margin-left': coords || -( this.current * this.imgWidth )
	});
};

Slider.prototype.setCurrent = function( dir ) {
	var pos = this.current;

	pos += ( ~~( dir === 'next' ) || -1 );
	this.current = ( pos < 0 ) ? this.imgsLen -1 : pos % this.imgsLen;

	return this.current;
};

Slider.prototype.events = {
	click: function() {
		var self = this;

		self.nav.on('click', function() {
			var current = self.setCurrent( $(this).data('dir') );

			self.transition();
		});
	}
};