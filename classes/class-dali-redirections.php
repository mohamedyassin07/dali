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

        add_filter( 'login_redirect', [ $this, 'dali_login_redirect_page' ], 999, 3 );

		// add_filter('allowed_redirect_hosts', [ $this, 'allow_safe_redirects_to_dashboard_subsite'] );

        // add_filter('login_url', [ $this, 'filter_login_url' ], 20, 3);

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

        // var_dump($this->get_dashboard_page_url()); die;

        if ( isset( $user->roles ) && is_array( $user->roles ) ) {

            if ( in_array( 'administrator', $user->roles ) ) {
                return $this->get_dashboard_page_url();
            }
            if ( in_array( 'subscriber', $user->roles ) ) {
                return $this->get_dashboard_page_url();
            }else {
                return home_url();
            }
        } else {
            return $redirect_to;
        }
        
    }
    
    /**
     * get_dashboard_site_id
     *
     * @return void
     */
    function get_dashboard_site_id() {
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
	public function get_dashboard_page_url() {

		$dashboard_site_id = $this->get_dashboard_site_id();
 
		if ( !$dashboard_site_id ) {

			return false;

		} // end if;

		return wu_switch_blog_and_run(function() use ( $dashboard_site_id ) {

			return get_the_permalink( $dashboard_site_id );

		});

	} // end get_page_url;

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
        if (isset($this->master_users['user' . $user_id])) {
            return $this->master_users['user' . $user_id];
        }
        $this->master_users['user' . $user_id] = is_multisite() ? user_can($user_id, $this->master_capability()) : $user_id === $this->get_main_admin_id();
        return $this->master_users['user' . $user_id];
    }

        
    /**
     * allow_safe_redirects_to_dashboard_subsite
     *
     * @param  mixed $hosts
     * @return void
     */
    function allow_safe_redirects_to_dashboard_subsite($hosts) {
        $frontend_dashboard_url = $this->get_dashboard_page_url();
        if (is_multisite() && $frontend_dashboard_url) {
            $dashboard_host = parse_url($frontend_dashboard_url, PHP_URL_HOST);
            if (!in_array($dashboard_host, $hosts, true)) {
                $hosts[] = $dashboard_host;
            }
        }
        return $hosts;
    }

    
}
