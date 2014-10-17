<?php
// Class mlab_popup pour l'admin
 class mlab_popup{
	 
	 public static function showOptionsPage(){		  
		 
		 global $wpdb;
		 $table_name 	= $wpdb->prefix . "mlab_popup";
		 $result 		= $wpdb->get_results( "SELECT * FROM wp_mlab_popup" );
		 $options 		= unserialize($result[0]->options); 
		 ?>
          <div class="wrap mlab-popup">
            <?php get_screen_icon('options-general');  ?>
            <h2>Magneticlab Homepage Pop-up</h2>            
            <p><span>Version <?php echo get_option( "mlab_db_version" ) ?></span>            
              <?php printf(__('de %1$s par %2$s', 'mlab_popup'), '<strong>Magneticlab Sàrl</strong>', '<strong><a href="http://www.magneticlab.ch" title="Web design lab">magneticlab.ch</a></strong>'); ?></p> 
            <form method="post" action="" enctype="multipart/form-data">
              <table class="form-table">
                <tbody>
                  <tr valign="top">
                    <th scope="row"><label for="activate">Activé</label></th>
                    <td><input name="activate" type="checkbox" id="activate" value="1" <?php echo $options['activate'] == '1'? 'checked':'';?> ></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="popup_titre">Titre du popup</label></th>
                    <td><input name="popup_titre" type="text" id="popup_titre" value="<?php echo $result[0]->titre; ?>" class="regular-text"></td>
                  </tr>
                  <tr valign="top">
                    <th scope="row"><label for="popup_text">Texte</label></th>
                    <td><textarea name="popup_text" id="popup_text" style="width: 100%; max-width: 350px; min-height: 245px;"><?php echo $result[0]->text; ?></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="2"><p class="submit">
                        <input type="submit" name="mlab_popup_submit" id="mlab_popup_submit" class="button button-primary" value="Enregistrer les modifications"> 
                        <input type="button" name="mlab_popup_preview" id="mlab_popup_preview" class="button button-primary" value="Prévisualiser">
                      </p></td>
                  </tr>
                </tbody>
              </table>
            </form>
          </div>
		 <?php
		
		 // Preview
		 // Largeur minimum autorisée = 200
		 $max_width =  $options['width'] <= 199? '200': $options['width'];	 
		
		 print '<div id="fade" style="display: none;"></div> 
			   <div class="popup_block" style="display: none; max-width: 200px!important; margin-top: -204.5px; margin-left: -215px;">
			   <a href="#" class="close"><img src="' . MLAB_ROOT_URL . '/images/close_pop.png" class="btn_close" title="Close Window" alt="Close" width="50" height="50"></a>
			   <h2 id="preview_titre"></h2>
			   <p id="preview_text"></p>
			   </div>';
	 }
	 
 }