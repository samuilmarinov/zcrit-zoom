<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       Zcrit
 * @since      1.0.0
 *
 * @package    Zcrit_Zoom
 * @subpackage Zcrit_Zoom/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Zcrit_Zoom
 * @subpackage Zcrit_Zoom/includes
 * @author     Zcrit <Zcrit-Zoom@Zcrit.com>
 */
class Zcrit_Zoom_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'zcrit-zoom',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
