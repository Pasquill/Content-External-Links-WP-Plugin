<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/Pasquill
 * @since      1.0.0
 *
 * @package    Content_External_Links_Wp_Plugin
 * @subpackage Content_External_Links_Wp_Plugin/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Content_External_Links_Wp_Plugin
 * @subpackage Content_External_Links_Wp_Plugin/includes
 * @author     Pasquill <pasquill.x@gmail.com>
 */
class Content_External_Links_Wp_Plugin_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'content-external-links-wp-plugin',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
