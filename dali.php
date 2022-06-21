<?php
/**
 * Dali
 *
 * @package       DALI
 * @author        Mohamed Yassin
 * @version       1.1.0
 *
 * @wordpress-plugin
 * Plugin Name:   Dali
 * Plugin URI:    https://mydomain.com
 * Description:   Short Description
 * Version:       1.1.0
 * Author:        Mohamed Yassin
 * Author URI:    https://developeryassin.wordpress.com
 * Text Domain:   dali
 * Domain Path:   /languages
 * GitHub Plugin URI: mohamedyassin07/dali
 * GitHub Plugin URI: https://github.com/mohamedyassin07/dali
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
// Plugin Name
define( 'DALI_NAME', 'Dali' );

// Plugin Slug
define( 'DALI_SLUG', 'dali' );

// Plugin version
define( 'DALI_VERSION',	'1.0.0' );

// Plugin Root File
define( 'DALI_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'DALI_PLUGIN_BASE',	plugin_basename( DALI_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'DALI_PLUGIN_DIR',	plugin_dir_path( DALI_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'DALI_PLUGIN_URL',	plugin_dir_url( DALI_PLUGIN_FILE ) );

// Dali debug status
if ( ! defined('DALI_DEBUG') ) {
	$dali_settings = get_option( DALI_SLUG );
	if( 
		isset ( $_GET['dali_debug'] ) || 
		( isset ( $dali_settings['general']['dali_debug'] ) &&  $dali_settings['general']['dali_debug'] != 0 )
	){
		define( 'DALI_DEBUG',	true );
	}else {
		define( 'DALI_DEBUG',	true );
	}
}


/**
 * Load the main class for the core functionality
 */
require_once DALI_PLUGIN_DIR . 'class-dali.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Mohamed Yassin
 * @since   1.0.0
 * @return  object|Dali
 */
function dali() {
	return Dali::instance();
}

dali();