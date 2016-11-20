(function( $ ){
	
	//// ---> Проверка на существование элемента на странице
	jQuery.fn.exists = function() {
	   return jQuery(this).length;
	}

	$(function() {		
		
		$('.show').each(function(){
			$(this).mouseenter(function(){
				$(this).find('.action').fadeTo(0, 1) 
			});
			
			$(this).mouseleave(function(){
				$(this).find('.action').fadeTo(0, 0)
			});
		});		
		
	});

})( jQuery );