<?php
// Installation du plugin  

  
  // Base de Données
  function mlab_install() {
	 global $wpdb;
	 global $mlab_db_version;
  
	 $table_name = $wpdb->prefix . MLAB_DB_TABLE;
	 	
	 $sql = "CREATE TABLE $table_name (
	 id mediumint(9) NOT NULL AUTO_INCREMENT,
	 options mediumtext NULL,
	 titre tinytext NOT NULL,
	 text text NOT NULL,
	 mlab_key VARCHAR(55) DEFAULT '' NULL,
	 UNIQUE KEY id (id)
	 );";
  
	 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	 dbDelta( $sql );
   
	 add_option( "mlab_db_version", MLAB_PLUGIN_VERSION );
  }

  // Données initiales
  function mlab_install_data() {
	 global $wpdb;
	 $titre	= "Magneticlab Popup System";
	 $text	= "Votre text ici";
	 $options = serialize( array("activate" 	=> '0',
	 							 "width" 		=> '350'
								 )
						  );
	 $mlab_key = "";
	 $table_name = $wpdb->prefix . MLAB_DB_TABLE;
	 $rows_affected = $wpdb->insert( $table_name, array( 'options' 	=> $options,
														 'titre' 	=> $titre,
														 'text' 	=> $text,
														 'mlab_key' => $mlab_key 
														)
								    );
  }
  
  function mlab_uninstall(){
	   
	  //drop mlab_popup db table
	  global $wpdb;
	  $table_name = $wpdb->prefix . MLAB_DB_TABLE;
	  $wpdb->query( "DROP TABLE IF EXISTS $table_name " ); 
	  delete_option( 'mlab_db_version' );  
	  
  }
