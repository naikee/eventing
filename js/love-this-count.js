jQuery(document).ready(function($){

	$('.adeetheming-love').live('click',
	    function() {
    		var link = $(this);
    		if(link.hasClass('active')) return false;
		
    		var id = $(this).attr('id'),
    			postfix = link.find('.adeetheming-love-postfix').text();
			
    		$.post(adeetheming_love.ajaxurl, { action:'adeetheming-love', likes_id:id, postfix:postfix }, function(data){
    			link.html(data).addClass('active').attr('title','You already like this');
    		});
		
    		return false;
	});
	
	if( $('body.ajax-adeetheming-love').length ) {
        $('.adeetheming-love').each(function(){
    		var id = $(this).attr('id');
    		$(this).load(adeetheming_love.ajaxurl, { action:'adeetheming-love', post_id:id });
    	});
	}

});