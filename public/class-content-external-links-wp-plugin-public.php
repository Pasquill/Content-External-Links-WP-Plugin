<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/Pasquill
 * @since      1.0.0
 *
 * @package    Content_External_Links_Wp_Plugin
 * @subpackage Content_External_Links_Wp_Plugin/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Content_External_Links_Wp_Plugin
 * @subpackage Content_External_Links_Wp_Plugin/public
 * @author     Pasquill <pasquill.x@gmail.com>
 */
class Content_External_Links_Wp_Plugin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->plugin_options = get_option($this->plugin_name);

		$this->site_url = site_url();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Content_External_Links_Wp_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Content_External_Links_Wp_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/content-external-links-wp-plugin-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Content_External_Links_Wp_Plugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Content_External_Links_Wp_Plugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/content-external-links-wp-plugin-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Filter the_content depending on options checked by user.
	 *
	 * @since    1.0.0
	 */
	public function filter_content( $content ) {

		// Ignore if all options disabled
		if( !isset( $this->plugin_options['nofollow'] ) && !isset( $this->plugin_options['blank'] ) ) {
			return $content;
		}

		// Get all matches
		preg_match_all( '/<a [^>]*>/m', $content, $matches, PREG_SET_ORDER, 0 );

		foreach ($matches as $match) {
			// Ignore if link is internal
			if( !!preg_match( '/' . preg_quote( $this->site_url, '/' ) . '/m', $match[0] ) || !preg_match( '/href="http(|s):\/\//m', $match[0] ) ) {
				continue;
			}

			$subject = $match[0];

			// NOFOLLOW
			if( isset( $this->plugin_options['nofollow'] ) ) {
				// Ignore if link contains nofollow attribute
				if( preg_match( '/rel="[^"]*nofollow[^"]*"/m', $subject ) ) {
					continue;
				}

				// Set replace
				if( preg_match( '/rel="[^"]*"/m', $subject ) ) {
					$replace = str_replace( ' rel="', ' rel="nofollow ', $subject );
				} else {
					$replace = str_replace( '<a', '<a rel="nofollow"', $subject );
				}

				// Replace
				$content = str_replace( $subject, $replace, $content );
				$subject = $replace;
			}

			// _BLANK
			if( isset( $this->plugin_options['blank'] ) ) {
				// Ignore if link contains _blank attribute
				if( preg_match( '/target="_blank"/m', $subject ) ) {
					continue;
				}

				// Set replace
				$replace = str_replace( '<a', '<a target="_blank"', $subject );

				// Replace
				$content = str_replace( $subject, $replace, $content );
			}
		}

		return $content;

	}

}
