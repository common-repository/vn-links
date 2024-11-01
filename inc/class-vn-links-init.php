<?php
/**
 * Main Class
 *
 * @package vn_links_widget
 * @author codetot
 * @since 0.0.1
 */

class Vn_Links_Init {
	public function __construct() {
		$this->load_classes();

		Vn_Links_Post_Types::instance();
		Vn_Links_Assets::instance();
		Vn_Links_Shortcode::instance();

		$widget = new Vn_Links_Legacy_Widget();
	}

	/**
	 * Load all PHP classes
	 *
	 * @return void
	 */
	public function load_classes() {
		require_once VN_LINKS_DIR . 'inc/class-vn-links-post-types.php';
		require_once VN_LINKS_DIR . 'inc/class-vn-links-assets.php';
		require_once VN_LINKS_DIR . 'inc/class-vn-links-shortcode.php';
		require_once VN_LINKS_DIR . 'inc/class-vn-links-legacy-widget.php';
	}
}
