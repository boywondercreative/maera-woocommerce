<?php
/**
 * Template Loader
 *
 * @class 		WC_Template
 * @version		2.2.0
 * @package		WooCommerce/Classes
 * @category	Class
 * @author 		WooThemes
 */
class Maera_WC_Template_Loader {

	function __construct() {
		add_filter( 'woocommerce_locate_template', array( $this, 'locate_template' ), 10, 3 );
	}

	/**
	 * Use our own templates folder for loading WooCommerce files from this plugin.
	 */
	function locate_template( $template, $template_name, $template_path ) {

		global $woocommerce;
		$_template = $template;

		if ( ! $template_path ) {
			$template_path = $woocommerce->template_url;
		}

		$plugin_path  = MAERA_WC_PATH . '/templates/';

		// Look within passed path within the theme - this is priority
		$template = locate_template( array(
			$template_path . $template_name,
			$template_name
		));

		// Modification: Get the template from this plugin, if it exists
		if ( ! $template && file_exists( $plugin_path . $template_name ) ) {
			$template = $plugin_path . $template_name;
		}

		// Use default template
		if ( ! $template ) {
			$template = $_template;
		}

		return $template;

	}

}
Maera_WC_Template_Loader::init();
