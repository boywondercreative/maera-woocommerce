<?php
/*
Plugin Name:         Maera WooCommerce Addon
Plugin URI:
Description:         Add support for WooCommerce to the Maera Framework
Version:             0.1-dev
Author:              Aristeides Stathopoulos, Dimitris Kalliris
Author URI:          https://press.codes
Text Domain:         maera_woo
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MAERA_WOO_VER', '0.1-dev' );

/**
* The main Maera_EDD class
*/
class Maera_Woo {

	private static $instance;

	/**
	 * Get the class instance
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {

		if ( ! defined( 'MAERA_WOO_FILE' ) ) { define( 'MAERA_WOO_FILE', __FILE__ ); }
		if ( ! defined( 'MAERA_WOO_PATH' ) ) { define( 'MAERA_WOO_PATH', dirname( __FILE__ ) ); }
		if ( ! defined( 'MAERA_WOO_URL' ) ) { define( 'MAERA_WOO_URL', plugin_dir_url( __FILE__ ) ); }

		$this->requires();

	}

	/**
	 * Include any required files
	 */
	function requires() {

		require_once( __DIR__ . '/includes/class-Maera_Woo_Timber.php');

	}

}

// Load our Maera_EDD class if WooCommerce is installed
if ( class_exists( 'WooCommerce' ) ) {
	Maera_Woo::get_instance();
}

/**
 * Licensing handler
 */
function maera_woo_licensing() {

	if ( is_admin() && class_exists( 'Maera_Updater' ) ) {
		$maera_woo_license = new Maera_Updater( 'plugin', __FILE__, 'Maera Woo', MAERA_WOO_VER, '@aristath, @fovoc' );
	}

}
add_action( 'init', 'maera_woo_licensing' );
