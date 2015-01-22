<?php
/*
Plugin Name:         Maera WooCommerce Addon
Plugin URI:
Description:         Add support for WooCommerce to the Maera Framework
Version:             0.1-dev
Author:              Aristeides Stathopoulos, Dimitris Kalliris
Author URI:          https://press.codes
Text Domain:         maera_wc
*/


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MAERA_WC_VER', '0.1-dev' );

/**
* The main Maera_EDD class
*/
class Maera_WC {

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

		if ( ! defined( 'MAERA_WC_FILE' ) ) { define( 'MAERA_WC_FILE', __FILE__ ); }
		if ( ! defined( 'MAERA_WC_PATH' ) ) { define( 'MAERA_WC_PATH', dirname( __FILE__ ) ); }
		if ( ! defined( 'MAERA_WC_URL' ) ) { define( 'MAERA_WC_URL', plugin_dir_url( __FILE__ ) ); }

		$this->requires();

		$maera_wc_timber = new Maera_WC_Timber();

	}

	/**
	 * Include any required files
	 */
	function requires() {

		require_once( __DIR__ . '/includes/class-Maera_WC_Timber.php');
		require_once( __DIR__ . '/includes/class-Maera_WC_Template_Loader.php');

	}

}

function maera_wc_init() {
	if ( ! isset( $GLOBALS['woocommerce'] ) ) {
		$GLOBALS['woocommerce'] = WC();
	}
	// Load our Maera_WC class if WooCommerce is installed
	if ( class_exists( 'WooCommerce' ) ) {
		Maera_WC::get_instance();
	}
}
add_action( 'plugins_loaded', 'maera_wc_init' );

/**
 * Licensing handler
 */
function maera_wc_licensing() {

	if ( is_admin() && class_exists( 'Maera_Updater' ) ) {
		$maera_wc_license = new Maera_Updater( 'plugin', __FILE__, 'Maera WooCommerce Addon', MAERA_WC_VER, '@aristath, @fovoc' );
	}

}
add_action( 'init', 'maera_wc_licensing' );
