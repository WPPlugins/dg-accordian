<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://projects.dinesh-ghimire.com.np/
 * @since      1.0.0
 *
 * @package    Dg_Accordian
 * @subpackage Dg_Accordian/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dg_Accordian
 * @subpackage Dg_Accordian/includes
 * @author     Dinesh Ghimire <developer.dinesh1@gmail.com>
 */
class Dg_Accordian_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dg-accordian',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
