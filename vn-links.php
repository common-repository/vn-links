<?php
/**
 * @link              https://codetot.com
 * @since             0.0.1
 * @package           Vn_Links
 *
 * @wordpress-plugin
 * Plugin Name:       VN Links
 * Plugin URI:        https://github.com/codetot-web/vn-links
 * Description:       Manage external links and display links as dropdown in a single widget or block. One of most required feature for all government sites in Vietnam.
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Version:           0.0.2
 * Author:            CODE TOT JSC
 * Author URI:        https://codetot.vn
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vn-links
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'VN_LINKS_VERSION', '0.0.2' );
define( 'VN_LINKS_DIR', plugin_dir_path(__FILE__));
define( 'VN_LINKS_URI', plugins_url('vn-links'));

require VN_LINKS_DIR . 'inc/class-vn-links-init.php';

/**
 * Run a plugin
 *
 * @return void
 */
function vn_links_widget_run() {
	$plugin = new Vn_Links_Init();
}

vn_links_widget_run();
