<?php

/**
 * Timber customizations for Maera_WC
 */
class Maera_WC_Timber {

	function __construct() {

		add_filter( 'maera/timber/locations', array( $this, 'twigs_location' ), 1 );
		add_filter( 'timber_context',         array( $this, 'timber_global_context' ) );

	}

	/**
	 * Modify Timber global context
	 */
	function timber_global_context( $data ) {

		global $product;
		if ( ! isset( $product ) ) {
			WC();
		}

		$data['product'] = $product;

		return $data;

	}

	/**
	 * Add the /views folder for our custom twigs
	 */
	function twigs_location( $locations ) {

		$locations[] = MAERA_WC_PATH . '/views';
		return $locations;

	}

}
