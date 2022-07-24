<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

class Dali_CustomListPage {
    
    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        add_action( 'admin_init', [ $this, 'add_exclude_filter' ], 99999999999999999 );     
    }
        
    /**
     * add_exclude_filter
     * @return void
     */
    public function add_exclude_filter() {
        global $pagenow, $typenow;
        add_filter( 'page_row_actions', [ $this, 'row_actions' ], 10, 2 );  
        if( 'edit.php' === $pagenow && 'page' === $typenow && isset( $_GET[ 'wpfa_id' ] )  ) {
          add_action( 'pre_get_posts', [ $this, 'set_viewable_posts_by_id' ]);
          
        }
    }    
 
    /**
     * set_viewable_posts_by_id
     *
     * @param  mixed $query
     * @return void
     */
    public function set_viewable_posts_by_id( $query ) {

        global $pagenow, $typenow;

        $pages_template_id = $this->get_pages_id();

        if( 'edit.php' === $pagenow && 'page' === $query->query['post_type'] && isset( $_GET[ 'wpfa_id' ] )  ) {
           
            $enable_pages = [];
            $front_page_id = get_blog_option( get_current_blog_id(), 'page_on_front' );

            if( !empty( $pages_template_id ) && count($pages_template_id) > 0 ) {
                $enable_pages = array_unique( array_merge(  (array)$front_page_id, $pages_template_id ) ) ;
            }else{
                $enable_pages = $front_page_id ;
            }
            
            $query->set('post__in', $enable_pages );

            wp_reset_query();
                
        }
        
          
    }

    /**
     * get_page_ids
     *
     * @return void
     */
    public function get_pages_id(){

        $pages_ids = [];
        $args = array( 
            'post_type' => 'page', 
            'post_per_page' => -1 ,
            'meta_key'  => 'make_page_template',
            'meta_value' => 1
        );

        $base_site_id = 36;
        switch_to_blog( $base_site_id );     
        $site_template_pages = get_pages( $args );

        foreach( (array)$site_template_pages as $pages ) {
            $pages_ids[] = $pages->ID ;
        }

        restore_current_blog();  

        return $pages_ids;
    }

    function row_actions( $actions, $post ) {

        if ( $post->post_type === 'page' ) {

            $page_on_front = get_blog_option( get_current_blog_id(), 'page_on_front' );
            $ajax_link     = admin_url( 'admin-ajax.php?action=front_page&id='.$post->ID.'&redirect_link ='.network_site_url( $_SERVER['REQUEST_URI'] ) );
            $style         = 'style="color: #45a787 ;"';

            if( (int) $page_on_front === (int) $post->ID ) {
                $style     = 'style="color: #ff5722 ;"';
                $ajax_link = '#';
                $action_url = '<span ' . $style . '>الصفحة الرئيسية</span>';
            }else{
                $action_url = '<a href="#" id="front_page_actions" class="button" data-id="'.$post->ID.'" ' . $style . '>الصفحة الرئيسية</a><span class="btn-loader houzez-loader-js"></span>';
            }

            $actions['front_page'] = $action_url;
            
            unset($actions['edit']);
            unset($actions['trash']);
    
        }  

        return $actions;
    }

}

add_action("wp_ajax_nopriv_dali_front_page",  "dali_front_page" );
add_action("wp_ajax_dali_front_page", "dali_front_page" );
/**
 * front_page
 *
 * @return void
 */
function dali_front_page()
{
    $page_id =  isset( $_POST['id'] ) ? $_POST['id'] : null ;

    if( is_numeric( $page_id )  && !empty( $page_id )) {

        update_blog_option( get_current_blog_id(), 'page_on_front', $page_id );

        echo wp_send_json( array( 'success' => true, 'msg' => esc_html__('تأكيد اختيار صفحة   [ ' . get_the_title( $page_id ) . ' ]   كصفحة  رئيسية ؟' , 'dali') ) );     
   
    } else {
      
        echo wp_send_json( array( 'success' => false, 'msg' => esc_html__('صفحة خاطئة !', 'dali') ) );
   
    }

    die;
}