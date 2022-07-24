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

				// run required classes
				new Sub_Site_Dashboard;
				new ACF_PB;
				new DALI_Redirections;
				new ACF_PAGE_CONTENT;
				new FrontEndFunctions;
				new ACF_THEME_SHANGE;
				new Dali_CustomListPage;

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
			require_once dali_path ( 'classes/class-dali-redirections.php' );
			require_once dali_path ( 'classes/class-acf-page-content.php' );
			require_once dali_path ( 'classes/class-frontend-functions.php' );				
			require_once dali_path ( 'classes/class-acf-theme.php' );
			require_once dali_path ( 'classes/class-post-list.php' );	
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
			add_action( 'plugin_action_links_' . DALI_PLUGIN_BASE, array( $this, 'add_plugin_action_link' ), 20 );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_backend_scripts_and_styles' ), 20 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_scripts_and_styles' ), 20 );
			add_action( 'elementor/editor/before_enqueue_styles', array( $this, 'enqueue_frontend_scripts_and_styles' ), 20 );
			add_action( 'acf/include_field_types', array( $this, 'include_field' ) );
		}

		/**
		 * Include field.
		 *
		 * @since 1.0.0
		 */
		public function include_field() {
			require_once DALI_PLUGIN_DIR . '/fields/class-dali-acf-field-dimensions-v5.php';
			require_once DALI_PLUGIN_DIR . '/fields/class-dali-acf-field-hidden-v5.php';
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
			wp_enqueue_style( ' add_cairo_font ', 'https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap', false );
			wp_enqueue_script( 'dali_backend_scripts', DALI_PLUGIN_URL . 'assets/js/dali-backend.js', array(), DALI_VERSION, false );
			wp_localize_script( 'dali', 'dali', array(
				'plugin_name'   	=> __( 'dali', 'dali' ),
			));
			$dali_object = array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),		
			);
			wp_localize_script( 'dali_backend_scripts', 'ajax_wpx', $dali_object );   
		}

		public function enqueue_frontend_scripts_and_styles(){
			wp_enqueue_style( 'dali_frontend_style', DALI_PLUGIN_URL . 'assets/css/dali-frontend.css', array(), DALI_VERSION, false );
		}
}

endif; // End if class_exists check.