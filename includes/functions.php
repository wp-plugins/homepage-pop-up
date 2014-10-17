<?php
 // Mise à jour des données
  function mlab_update_data() {
	  
	  global $wpdb; 
	  $wpdb->show_errors();
	  $table_name		= $wpdb->prefix . MLAB_DB_TABLE;
	  $titre			= $_POST['popup_titre'];
	  $text				= $_POST['popup_text']; 
	  $activate			= isset($_POST['activate'])?	$_POST['activate']:		null;
	  $width			= isset($_POST['popup_width'])?	$_POST['popup_width']:	'350';
	  $options = serialize( array("activate" 	=> $activate,
	  							  "width" 		=> $width 
								  )
						   );
		 			   
	   $result =  $wpdb->update( $table_name, 
									array('titre' 		=> $titre,
									      'text' 		=> $text,										  
										  'options' 	=> $options 
										  ), 
									array( 'ID' => 1 ), 
									array( '%s', '%s', '%s' ), 
									array( '%s' ) 
							);
							
	  return $result;
	 
	   
  }
  
  function display_message(){ 
	  global $statut;  
	  switch($statut){
		  case'success':
		  echo '<div id="message" class="updated"><p>' . __('Update  successful','mlab_popup') . '</p></div>';
		  break;
		  case'error':
		  echo '<div id="message" class="error"><p> ' . __('Unable to update','mlab_popup') . ' </p></div>'; 
		  break;
	  }
	  
  }
  
  
  // Si le formulaire est posté
  $updateData = isset($_POST['mlab_popup_submit'])? $_POST['mlab_popup_submit']: ''; 
  if($updateData){
	  if( mlab_update_data() ) {
		  $statut = 'success';
		  add_action('admin_notices', 'display_message' );
	  } else {
		  $statut = 'error';
		  add_action('admin_notices', 'display_message' );
	  }  
  }
  
  
  // Interface admin  
  function mlab_create_settings_page() {
	  global $mlab_settings_page;
	  if (function_exists('add_options_page')) {
			 $page_title 	= 'Homepage Pop-up';
			 $menu_title 	= 'Homepage Pop-up';
			 $capability 	= 'manage_options';
			 $menu_slug 	= MLAB_PLUGIN_SLUG;
			 $function 		= array('mlab_popup','showOptionsPage');
			 $mlab_settings_page =  add_options_page($page_title, $menu_title, $capability, $menu_slug, $function);
	  }
	  
  }
 
	  
  // Ajout des CSS et JS
  function mlab_load_scripts($hook) {
	  global $mlab_settings_page;  
	  if( $hook != 'settings_page_mlab_popup' ) return; 	  
	  wp_enqueue_style( 'style-name', MLAB_ROOT_URL . '/css/mlab_popup.css' );
	  wp_enqueue_script( 'custom-js', MLAB_ROOT_URL . '/js/mlab_popup.js' );
  }
  


 