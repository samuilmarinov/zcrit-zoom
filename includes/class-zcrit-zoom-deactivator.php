<?php

/**
 * Fired during plugin deactivation
 *
 * @link       Zcrit
 * @since      1.0.0
 *
 * @package    Zcrit_Zoom
 * @subpackage Zcrit_Zoom/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Zcrit_Zoom
 * @subpackage Zcrit_Zoom/includes
 * @author     Zcrit <Zcrit-Zoom@Zcrit.com>
 */
class Zcrit_Zoom_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		
		$template = get_stylesheet_directory().'/zoomsdk.php'; 
		if (file_exists($template)) {
			unlink($template);
		}

	}

}
