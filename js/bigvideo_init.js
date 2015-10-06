// BACKGROUND VIDEO INIT

jQuery(function() {	   
	      
'use strict';	      

	var videoContainer = jQuery('#video');

	if ( videoContainer.length !== 0 ){

	    var BV = new $.BigVideo({useFlashForFirefox:false});
	    BV.init();
	    if ( Modernizr.touch ) {

		    BV.show(videoContainer.attr('data-imagefallback'));

		} else {

		    BV.show( [
		    	videoContainer.attr('data-video-ie' ),{
				         ambient:false,
				         loop: false,
			             type: "video/mp4"
				         },
		    	videoContainer.attr('data-video' ),{
				         ambient:false,
				         loop: false,
			             type: "video/webm"
				         }
				]                  

			);

		    //BV.show([
		    //	{ type: "video/mp4",  src: "videoContainer.attr('data-video-ie' )" },
        	//	{ type: "video/webm", src: "videoContainer.attr('data-video' )" }        		
    		//]);
		}
		    
		// To initially mute the volume

		BV.getPlayer().volume(0)
		jQuery('.mute').html( '<i class="fa fa-volume-off"></i>' );

		jQuery.fn.toggleClick=function(){
			var functions=arguments
			return this.click(function(){
				var iteration=jQuery(this).data('iteration')||0
				//console.log(iteration)
				functions[iteration].apply(this,arguments)
				iteration= (iteration+1) %functions.length
				jQuery(this).data('iteration',iteration)
			})
		}

		// Create Mute Button

		jQuery(function(){
			jQuery('.mute').toggleClick(function(){
				BV.getPlayer().volume(1);
				jQuery('.mute').html( '<i class="fa fa-volume-up"></i>' );
			},
			function(){
				BV.getPlayer().volume(0);
				jQuery('.mute').html( '<i class="fa fa-volume-off"></i>' );
			})
		})   

	}
   
});