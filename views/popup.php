<?php
// Seulement sur la page d'accueil
add_action( 'wp', 'mlab_is_home' );
function mlab_is_home() {
  if ( is_home() or $_SERVER["REQUEST_URI"] == "/" || $_SERVER["REQUEST_URI"] == "/index.php")
	  add_action( 'wp_enqueue_scripts', 'add_home_popup' );
}

// Ajout du popup
function add_home_popup() {
  global $wpdb;
  $table_name = $wpdb->prefix . "mlab_popup";
  $result = $wpdb->get_results( "SELECT * FROM $table_name" );
  
  // Ajout des CSS et JS
  wp_enqueue_style( 'style-name', MLAB_ROOT_URL . '/css/mlab_popup.css' );
  wp_enqueue_script( 'script-name', MLAB_ROOT_URL . '/js/mlab_popup.js', array(), '1.0.0', true);    		
	  
  // Récupération des options
  $options = unserialize($result[0]->options);
  
  //Affichage du popup si activé dans l'admin 
  if($options['activate']){
	  
	  // Largeur minimum autorisée = 200
	  $max_width =  $options['width'] <= 199? '200': $options['width'];
	  
	  
	  $text = str_replace(CHR(13).CHR(10),'<br/>',$result[0]->text);
	  print '<div id="fade" style="display: block;"></div>
			 <div class="popup_block" style="display: block; max-width: '.$max_width.'px; margin-top: -204.5px; margin-left: -215px;">
			 <a href="#" class="close"><img src="' . MLAB_ROOT_URL . '/images/close_pop.png" class="btn_close" title="' . __('Close Window','mlab_popup') . '" alt="Close" width="50" height="50"></a>
			 <h2>'.$result[0]->titre.'</h2> 
			 <p>'.$text.'</p>
			 </div>';
  }
  
}
  