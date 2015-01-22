<?php
/**
 * The Template for displaying products in a product tag. Simply includes the archive template.
 *
 * Override this template by copying it to yourtheme/woocommerce/taxonomy-product_tag.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

Maera_Template::dependencies();

Maera_Template::header();
Maera_Template::main('archive-product.twig');
Maera_Template::footer();
