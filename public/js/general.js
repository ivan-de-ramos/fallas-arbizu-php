// @codekit-prepend "jquery.min.js"
// @codekit-prepend "jquery.inview.js"

$(document).ready(function(){
	// add class when visible 
	$('section').bind('inview', function (event, visible) {
		if (visible == true) {
			$(this).unbind('inview');
		// element is now visible in the viewport
			$(this).addClass('visible');
		}
	});
	$('.image').bind('inview', function (event, visible) {
		if (visible == true) {
			$(this).unbind('inview');
		// element is now visible in the viewport
			$(this).addClass('visible');
		}
	});
	$(window).on('load', function () {
		$('*').trigger('inview'); 
	});
	// menu
	$( ".show-menu" ).click(function() {
		$( this ).toggleClass( "open" );
		$( 'nav' ).toggleClass( "open" );
		$( 'body' ).toggleClass( "menu-open" );
	});
});

//ON SCROLL
$(window).scroll(function() {
	var scrollNode = document.scrollingElement || document.documentElement;
	var scrollTop = scrollNode.scrollTop;

	if( scrollTop < 10 ){
		$('body').removeClass('mini');
	}else{
		$('body').addClass('mini');
	}
	
}); 
$("body").trigger('scroll');
