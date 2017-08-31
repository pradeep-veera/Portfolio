$ = jQuery;



$(document).ready(function($) {

	
	$('#site-navigation li.menu-item-has-children > a').css('cursor', 'default').click(function(e) {        
        e.preventDefault();
    });
	
	
	$('#mobile-navigation').hukuMmenu();
	
	$('a.mobile-menu').click(function(e) {
		e.preventDefault();
		$('html').toggleClass('mmenu-open');
		$('#content').toggleClass('dark-layer-page');
		$('#content-inner').toggleClass('dark-layer-page');
	});
	
	$('.dark-layer').click(function(e) {
		e.preventDefault();
		$('html').removeClass('mmenu-open');
		$('#content').removeClass('dark-layer-page');
		$('#content-inner').removeClass('dark-layer-page');		
	});
/*	
    $('.skills').bxSlider({
        slideMargin:3,
        infiniteLoop: true,
        speed : 100,
        mode:'fade',
    });

    $('.experiences').bxSlider({
        slideMargin:3,
        infiniteLoop: true,
        speed : 100,
        mode:'fade',
    });	

    $('.educations').bxSlider({
        slideMargin:3,
        infiniteLoop: true,
        speed : 100,
        mode:'fade',
    });	
*/  	
});






//===================== Ajax ============================

/* Ajax */
function doAjaxRequest(fn, args) {
	args['action'] = 'do_ajax';		
	args['fn'] = fn;
	
	jQuery.ajax({
		url: my_data.ajaxurl,
		data:args,
		dataType: 'JSON',
		success:function(data){
			/* $.globalEval( data.page_content ); */
			window[data.fn]( data );			
		},
		error: function( jqXHR, textStatus, errorThrown ){
			unlockPage();
			alert( 'Fehler' );
			console.log( jqXHR );
			console.log( textStatus );
			console.log( errorThrown );
		} 
	}); 
}

/* success functions */







//===================== Functions =======================

function getViewport() {
	var e = window, a = 'inner';
	if (!('innerWidth' in window )) {
		a = 'client';
		e = document.documentElement || document.body;
	}		
	return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}



function preloadImages(images, isDone) {
	window.imagesToPreload = 0;
	for (var i = 0; i < images.length; i++) {
		window.imagesToPreload++;
		var img = new Image();
		$(img).one('load error', function() {			
			window.imagesToPreload--;
			if ( window.imagesToPreload === 0 ) {
				isDone();
			}
		});
		$(img).attr("src", my_data.theme_url + '/images/' + images[i]);
	}
}