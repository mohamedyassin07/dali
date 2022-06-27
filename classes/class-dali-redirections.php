<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;


/**
 * Class DALI_Redirections
 *
 * ACF Page Builder
 *
 * @package		DALI
 * @subpackage	Classes/DALI_Redirections
 * @author		sherif ali
 * @since		1.0.0
 */
class DALI_Redirections {
    
    /**
     * master_users
     *
     * @var array
     */
    var $master_users = [];
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){

        add_filter( 'login_redirect', [ $this, 'dali_login_redirect_page' ], 5, 3 );

		// add_filter('allowed_redirect_hosts', [ $this, 'allow_safe_redirects_to_dashboard_subsite'] );
    }
    
    /**
     * dali_login_redirect_page
     *
     * @param  mixed $redirect_to
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function dali_login_redirect_page( $redirect_to, $request, $user ){

        global $user;

        $dashboard_page_url = $this->get_dashboard_page_url($user);
         
        // var_dump( $dashboard_page_url ); die;

        if ( isset( $user->roles ) && is_array( $user->roles ) && $dashboard_page_url != null ) {

            if ( in_array( 'administrator', $user->roles ) ) {
                return $dashboard_page_url;
            }else {
                return home_url();
            }
        } else {
            return $redirect_to;
        }
        
    }
    
    /**
     * site_dashboard_page_id
     *
     * @return void
     */
    function get_site_dashboard_page_id() {
        $id = get_field( 'site_dashboard_page_id' , 'dali_dashboard' );
        if ( $id && !empty( $id ) ) {
            return (int) $id;
        }
    }

    /**
	 * Returns the URL for a particular page type.
	 *
	 * @since 2.0.0
	 *
	 * @param array $page Page to return the URL.
	 * @return string
	 */
	public function get_dashboard_page_url($user) {

		$user_id = isset( $user->ID ) ? $user->ID : get_current_user_id();
        $site_id = get_active_blog_for_user( $user_id );
        
        $site_id = isset( $site_id->blog_id ) ? $site_id->blog_id : get_current_blog_id();
        
        is_multisite() && switch_to_blog($site_id);

        $dashboard_site_id = $this->get_site_dashboard_page_id();
        

        return $this->dali_switch_blog_and_run( $dashboard_site_id );

        is_multisite() && restore_current_blog();

        // return $result;		

	} // end get_page_url;

    /**
     * Tries to switch to a site to run the callback, before returning.
     *
     * @since 2.0.0
     *
     * @param array|string $callback Callable to run.
     * @param int          $site_id Site to switch to. Defaults to main site.
     * @return mixed
     */
    function dali_switch_blog_and_run( $dashboard_site_id ) {

        $site_id = get_active_blog_for_user( get_current_user_id(  ) );
        $site_id = isset( $site_id->blog_id ) ? $site_id->blog_id : get_current_blog_id();

        is_multisite() && switch_to_blog($site_id);

        if ( !empty( $dashboard_site_id ) ) {

            $result = get_the_permalink( $dashboard_site_id );

        }else {

            $result = get_site_url( $site_id );
        }
        
        is_multisite() && restore_current_blog();

        return $result;

    } // end wu_switch_blog_and_run;

    /**
     * master_capability
     *
     * @return void
     */
    function master_capability() {
        return is_multisite() ? 'manage_network' : 'manage_options';
    }
    
    /**
     * is_master_user
     *
     * @param  mixed $user_id
     * @return void
     */
    function is_master_user($user_id = null) {
        if (!$user_id) {
            $user_id = get_current_user_id();
        }
        
        if( is_multisite() && user_can( $user_id, $this->master_capability() ) ){
            return true;
        }else{
            return false;
        }
       
    }

        
    /**
     * allow_safe_redirects_to_dashboard_subsite
     *
     * @param  mixed $hosts
     * @return void
     */
    function allow_safe_redirects_to_dashboard_subsite($hosts) {
        $frontend_dashboard_url = $this->get_dashboard_page_url($user);
        if (is_multisite() && $frontend_dashboard_url) {
            $dashboard_host = parse_url($frontend_dashboard_url, PHP_URL_HOST);
            if (!in_array($dashboard_host, $hosts, true)) {
                $hosts[] = $dashboard_host;
            }
        }
        return $hosts;
    }

    
}
