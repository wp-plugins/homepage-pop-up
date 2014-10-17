// mlab_popup.js v1.0.0, 28.08.2014
// Copyright (c) 2014 Magneticlab (http://www.magneticlab.ch)

jQuery(document).ready(function(){
	
	jQuery('#preview_help').hide();	
	
	if ( jQuery( "#wp-popup_text-wrap" ).hasClass( "tmce-active" ) ){
		jQuery('#mlab_popup_preview').prop('disabled', true); 
		jQuery('#preview_help').show();		
	}
							   		   
	//Close Popups and Fade Layer
	jQuery('a.close, #fade').live('click', function() {
		//When clicking on the close or fade layer...
	  	jQuery('#fade , .popup_block').fadeOut(function() {
			//jQuery('#fade, a.close').remove();  
		}); //fade them both out		
		return false;
	});
	
	// Preview function in admin page
	jQuery('#mlab_popup_preview').live('click', function() { 
		//reset
		jQuery('#preview_titre').html( '' );
		jQuery('#preview_text').html( '' ); 
		//get		
		var titre = jQuery('#popup_titre').attr( 'value');
		var text  = jQuery('#popup_text').val(); 
		var width = jQuery('#popup_width').attr( 'value')+'px';  
		//set
		jQuery('#preview_titre').append( titre );
		jQuery('#preview_text').append( text ); 
		jQuery('.popup_block').css( "max-width", width );  
		jQuery('#fade , .popup_block').fadeIn();
	}); 
	
	// Preview only available on text editor	
	jQuery('#popup_text-tmce, #popup_text-html').live('click', function() {			 
		if ( jQuery('#mlab_popup_preview').is(':disabled') == false ){ 
			jQuery('#mlab_popup_preview').prop('disabled', true); 
			jQuery('#preview_help').show();
		} 
		else if ( jQuery('#mlab_popup_preview').is(':disabled') == true ){ 
			jQuery('#mlab_popup_preview').prop('disabled', false);
			jQuery('#preview_help').hide();
		} 
	}); 
	
	// Preview image from new src in admin page
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				jQuery("#preview_image").attr("src", e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	jQuery("#popup_img").change(function(){
		readURL(this);
	});
	
});


