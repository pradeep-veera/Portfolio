


jQuery(document).ready(function($) {
	
	$('body').hukuLightbox();
	
});


(function($){
    $.fn.hukuLightbox = function(ename, cb){
        return this.each(function(){
            
			$(this).find('a').map(function() {
				if ( typeof $(this).attr('href') == 'string' && $(this).attr('href').match(/\.(jpg|png|gif)$/i) ) {
					return this
				}
			}).attr('rel', 'group1').fancybox({
				padding: 5,
				helpers: {
					overlay: {
						locked: false
					}
				}
			});
            
        });
    };
}(jQuery));