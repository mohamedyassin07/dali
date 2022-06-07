<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'Dali' ) ) :

	/**
	 * Main Dali Class.
	 *
	 * @package		DALI
	 * @subpackage	Classes/Dali
	 * @since		1.0.0
	 * @author		Mohamed Yassin
	 */
	final class Dali {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Dali
		 */
		private static $instance;

		/**
		 * DALI helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Dali_Helpers
		 */
		public $helpers;

		/**
		 * DALI settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Dali_Settings
		 */
		public $settings;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'dali' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'dali' ), '1.0.0' );
		}

		/**
		 * Main Dali Instance.
		 *
		 * Insures that only one instance of Dali exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Dali	The one true Dali
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Dali ) ) {
				/**
				 * Fire a custom action to allow dependencies
				 * before the plugin setup
				 */
				do_action( 'DALI/before_plugin_loaded' );

				self::$instance	= new Dali;

				if( DALI_DEBUG ){
					self::$instance->enable_debug_enviroment_settings();
				}

				self::$instance->includes();
				self::$instance->add_hooks();

				self::$instance->load_sub_site_dashboard();


				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'DALI/plugin_loaded' );
			}

			return self::$instance;
		}

		public function enable_debug_enviroment_settings()
		{
			ini_set('display_errors', 1); 
			ini_set('display_startup_errors', 1); 
			error_reporting(E_ALL);		
		}
		
		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once DALI_PLUGIN_DIR . 'helpers/basics.php';
			require_once dali_path ( 'classes/class-sub-sites-dashboard.php' );
			require_once dali_path ( 'classes/class-acf-pb.php' );			
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function add_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
			// add_action( 'plugins_loaded', array( self::$instance, 'load_sub_site_dashboard' ) , 20 );

			if( get_current_blog_id() !== 1){
				add_action( 'plugins_loaded', array( self::$instance, 'load_acf_pb' ) , 30 );
				add_action( 'plugin_action_links_' . DALI_PLUGIN_BASE, array( $this, 'add_plugin_action_link' ), 20 );
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts_and_styles' ), 20 );		
			}
		}


		


		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_sub_site_dashboard() {
			new Sub_Site_Dashboard;
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_acf_pb() {
			new ACF_PB;
		}

				/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'dali', FALSE, dirname( plugin_basename( DALI_PLUGIN_FILE ) ) . '/languages/' );
		}

		/**
		* Adds action links to the plugin list table
		*
		* @access	public
		* @since	1.0.0
		*
		* @param	array	$links An array of plugin action links.
		*
		* @return	array	An array of plugin action links.
		*/
		public function add_plugin_action_link( $links ) {
			$settings_link = sprintf( '<a href="%s" title="Custom Link" style="font-weight:700;">%s</a>', admin_url('admin.php?page='.DALI_SLUG ) , __( 'Settings', 'dali' ) );
			array_unshift( $links, $settings_link );	
			return $links;
		}

		/**
		 * Enqueue the backend related scripts and styles for this plugin.
		 * All of the added scripts andstyles will be available on every page within the backend.
		 *
		 * @access	public
		 * @since	1.0.0
		 *
		 * @return	void
		 */
		public function enqueue_backend_scripts_and_styles() {
			wp_enqueue_script( 'dali-backend-script', dali_url ('assets/js/dali-backend.js' ), array(), DALI_VERSION, false );
			wp_localize_script( 'dali-backend-script', 'dali', array(
				'plugin_name'   	=> __( 'dali', 'dali' ),
			));
		}
}

endif; // End if class_exists check.