<?php


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

        
        add_filter( 'login_redirect', [ $this, 'login_redirect_page' ], 999999, 3 );

        add_action( 'DALI/after_login_redirect', [ $this, 'after_login_redirect' ], 99999999, 2 );

        //add_action( 'admin_init', [ $this, 'redirect_to_dashboard' ], 1);

        // add_action( 'init', [ $this, 'redirect_to_user_dashboard' ]);
        
            
		// add_filter('allowed_redirect_hosts', [ $this, 'allow_safe_redirects_to_dashboard_subsite'] );
    }
    
    /**
     * login_redirect_page
     *
     * @param  mixed $redirect_to
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function login_redirect_page( $redirect_to, $request, $user ){

        $user_id = isset( $user->ID ) ? $user->ID : '';

        $dashboard_page_url = $this->get_dashboard_page_url($user);

        $home_url = get_site_url( get_current_blog_id() ); 
        $network_admin_url = network_admin_url();

        if( is_super_admin( $user_id ) ){
            $dashboard_page_url = $network_admin_url;
        }

        $user_site = get_active_blog_for_user( $user_id );
        $user_site_id = '';
        if( !empty( $user_site ) ){
            $user_site_id = $user_site->blog_id;
        }            
        
        
    if( ! current_user_can( 'manage_network' ) ){

        // if user is member of the blog but not an admin .
        if( is_user_member_of_blog( $user_id, get_current_blog_id() ) == true && !empty( $user_site ) && ( get_main_site_id() != get_current_blog_id() ) ) {
           
            //wp_die('is_user_member_of_blog');
           
            if ( isset( $user->roles ) && is_array( $user->roles ) && $dashboard_page_url != null ) {         
                
                if ( in_array( 'administrator', $user->roles ) || in_array( 'shop_manager', $user->roles ) ) {
                   
                    // wp_die('administrator');

                    do_action('DALI/after_login_redirect', $dashboard_page_url, $user);
    
                    return $dashboard_page_url;
                }  

            }

        }
        
        // main site ;
        if( is_user_member_of_blog( $user_id, get_current_blog_id() ) == true && !empty( $user_site ) && ( get_current_blog_id() == get_main_site_id() ) ) {
           
            //wp_die('is_user_member_of_blog');
            is_multisite() && switch_to_blog( $user_site_id );

            $userData = get_userdata( $user_id );

            // wp_die(get_current_blog_id());

            if ( isset( $userData->roles ) && is_array( $userData->roles ) && $dashboard_page_url != null ) {         
                if ( in_array( 'administrator', $userData->roles ) || in_array( 'shop_manager', $userData->roles ) ) {

                    do_action('DALI/after_login_redirect', $dashboard_page_url, $user);
    
                    return $dashboard_page_url;
                }
                else{ 
                    // wp_die('customer');

                    return $$redirect_to;      
                }
            }
            is_multisite() && restore_current_blog();
            
        }
        
        // if user login from his site .
        // if( $user_site_id == get_current_blog_id() ) {}

        // if user login from site he is not a member .    
        if( is_user_member_of_blog( $user_id, get_current_blog_id() ) == false && !empty( $user_site ) ) {

            is_multisite() && switch_to_blog( $user_site_id );
            $userData = get_userdata( $user_id );
            
            if ( isset( $userData->roles ) && is_array( $userData->roles ) && $dashboard_page_url != null ) {         
                if ( in_array( 'administrator', $userData->roles ) || in_array( 'shop_manager', $userData->roles ) ) {

                    do_action('DALI/after_login_redirect', $dashboard_page_url, $user);
    
                    return $dashboard_page_url;
                }
                else{ 
                    // wp_die('customer');

                    return $$redirect_to;      
                }
            }
            is_multisite() && restore_current_blog();
        }
                  // do_action('dali_after_login_redirect', admin_url(), $user_id);
    } else {
        // wp_die('super admin');
        // is super admin .
        do_action('DALI/after_login_redirect', $dashboard_page_url, $user_id);
        return $dashboard_page_url;
    }

        // wp_die('other');
                  
        return $redirect_to;  

    }
    
    /**
     * site_dashboard_page_id
     *
     * @return void
     */
    function get_site_dashboard_page_id() {
        
        $template = wu_get_site_templates(array('fields' => 'ids'));

        $template_id = isset( $template[0] ) ? $template[0] : 1 ;

        $id = get_field( 'site_dashboard_page_id' , 'dali_dashboard' );
        
        if ( $id && !empty( $id ) ) {

            return $id;

        } else {

        is_multisite() && switch_to_blog($template_id);

        $id = get_field( 'site_dashboard_page_id' , 'dali_dashboard' );

        if ( $id && !empty( $id ) ) {
            return $id;
        }

        is_multisite() && restore_current_blog();

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
        
        if ( !empty( $dashboard_site_id ) ) {

            $result = get_the_permalink( $dashboard_site_id );

        }else {

            $result = get_site_url( $site_id );
        }

        is_multisite() && restore_current_blog();

        return $result;		

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
    
    /**
     * after_login_redirect
     *
     * @param  mixed $redirect_to
     * @param  mixed $user
     * @return void
     */
    public function after_login_redirect($redirect_to ,$user){

        if( empty( $redirect_to ) ){
            return;
        }

        wp_redirect( $redirect_to );
        exit();
        
    }

    
    function redirect_to_dashboard() {

        global $current_user;
        $wp_safe_redirect_url = home_url('/');

        if ( is_user_logged_in() && is_admin() ) {
            
            if ( is_super_admin( $current_user->ID ) ) {
                return;
            }

            if ( ! current_user_can( 'manage_network' ) && ( ! wp_doing_ajax() ) && ( current_user_can( 'administrator' )  ) ) {
                //   show_admin_bar(false);
                $wp_safe_redirect_url = home_url('/d_dashboard');
            }
            wp_redirect( $wp_safe_redirect_url );
            exit;
        }
    }

    public function redirect_to_user_dashboard(){

         
    if( WPFA_Global_Dashboard_Obj()->is_global_dashboard() ) {
            
            global $current_user;
            
            $user_id =  get_current_user_id();
            
            $author_obj = get_user_by('id', $user_id);
        
            $blogs = get_blogs_of_user( $user_id );

            if( count( $blogs ) > 1 ){

                unset($blogs[1]);

            }
             
            $user_site_id = array_key_first($blogs);

            if( !empty( $user_site_id ) )  {

                is_multisite() && switch_to_blog( $user_site_id );

                $dashboard_site_id = $this->get_site_dashboard_page_id();
                
                if ( !empty( $dashboard_site_id ) ) {
    
                    $dashboard_site_url = get_the_permalink( $dashboard_site_id );

                }

                is_multisite() && restore_current_blog();
                
                if( empty ( $dashboard_site_url ) ){
                    return;
                }
                wp_redirect( $dashboard_site_url );
                exit;
            }    
             
        }
        
    }

}