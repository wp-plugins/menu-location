<?php
/*
Plugin Name: Menu Location
Plugin URI: http://pankajanupam.in/wordpress-plugins/
Description: you can add number of menu location in your theme with it.
Version: 1.0.1
Author: Pankaj Anupam
Author URI: http://pankajanupam.in/
License: GPLv2 or later
*/

/*  Copyright 2011  PANKAJ ANUPAM  (email : mymail.anupam@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function anu_menu_location(){
		add_options_page('Add Menu Location', 'Menu Loaction', 'manage_options', 'menu_location','anu_manage_menu_location');
		add_action( 'admin_init', 'register_mysettings' );
}
add_action('admin_menu','anu_menu_location');

function register_mysettings() { // whitelist options
  register_setting( 'menu-location-settings-group', 'location_option_name' );
}

// Admin Panel Options
function anu_manage_menu_location(){ ?>
	<div class="wrap">
		<h2>Add Menu Location</h2>
			<form method="post" action="options.php">
					<?php settings_fields( 'menu-location-settings-group' ); ?>
					    <table class="form-table">
					        <tr valign="top">
						        <th scope="row">Menu Location <br /><small> You can enter more than one menu location name sapreated by comma.</small></th>
						        <td><textarea style="width:400px" name="location_option_name" ><?php echo get_option('location_option_name'); ?></textarea></td>
					        </tr>
					    </table>					    
					    <p class="submit">
					    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
					    </p>					
			</form>
	</div>
<?php }

if($anu_menu_location = get_option('location_option_name')){ // check menu location set or not
	
	$anu_menu_location_array = explode(',',$anu_menu_location); // change string to array
	
	//change array to assocated array ('menu-slug'=>'menu location')
	foreach ($anu_menu_location_array as $val){	$anu_menu_location_array_acc[str_ireplace(' ','-',$val)] = $val; }
	
	unset($anu_menu_location_array);
	if(isset($anu_menu_location_array_acc)){ register_nav_menus($anu_menu_location_array_acc); }	
}