<?php   

// Ajout du popup sur la page d'accueil
 
  global $wpdb;
  $table_name = $wpdb->prefix . "mlab_popup";
  $result = $wpdb->get_results( "SELECT * FROM $table_name" );
  
  // Ajout des CSS et JS
  wp_enqueue_style( 'style-name', MLAB_ROOT_URL . '/css/mlab_popup.css' );
  wp_enqueue_script( 'script-name', MLAB_ROOT_URL . '/js/mlab_popup.js', array(), '1.0.0', true );    		
	  
  // Récupération des options
  $options = unserialize( $result[0]->options );
  
  //Affichage du popup si activé dans l'admin 
  if( $options['activate'] ) {
	  
	  // Largeur minimum autorisée = 200
	  $max_width =  $options['width'] <= 199 ? '200': $options['width'];	
	  
	  // On remplace les retour charriot par des retour à la ligne  
	  $text = str_replace( CHR( 13 ) . CHR( 10 ), '<br/>', $result[0]->text );
	  
	  print '<div class="modal fades in "tabindex="-1" role="dialog" style="display: block;">
				<div class="modal-dialog" style="width:'.$max_width.'px;">
					<div class="modal-content">
						<div class="modal-header">
							<img class="close" src="' . MLAB_ROOT_URL . '/images/close_pop.png" title="' . __( 'Close Window','mlab_popup' ) . '" alt="Close" width="25" height="25"> 
						  	<h4 class="modal-title">' . $result[0]->titre . '</h4>
						</div>
						<div class="modal-body">          
						   ' . $text . '
						</div>
						<div class="modal-footer">';
						if ( ! empty( $options['label'] ) && ! empty( $options['link'] ) ) :
							print '<a href="' . $options['link'] . '" class="modal-link"><input type="button" class="button button-primary modal-label" value="' . $options['label'] . '" style=" cursor:pointer"></a>';
						endif;
						print '</div>
					</div><!-- /.modal-content --> 
				</div><!-- /.modal-dialog --> 
			</div>';
			 
			 
  }
  
 
  