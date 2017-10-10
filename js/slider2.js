function Slider( container, nav ) {
	var container = container;
	var nav = nav.show();

	var current = 0;

	var imgs = container.find('img');
	var imgWidth = imgs[current].width;
	var imgsLen = imgs.length;

	nav.on('click', function() {
		var current = setCurrent( $(this).data('dir') );

		sliderTransition();
	});

}

function sliderTransition( coords ) {
	container.animate({
		'margin-left': coords || -( current * imgWidth )
	});
};

function setCurrent( dir ) {
	var pos = current;

	pos += ( ~~( dir === 'next' ) || -1 );
	current = ( pos < 0 ) ? imgsLen -1 : pos % imgsLen;

	return current;
};