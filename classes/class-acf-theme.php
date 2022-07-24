<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * Class ACF_THEME_SHANGE
 *
 * ACF Page CONTENT
 *
 * @package		DALI
 * @subpackage	Classes/ACF_THEME_SHANGE
 * @author		sherif ali
 * @since		1.0.0
 */
class ACF_THEME_SHANGE {

        
    /**
     * __construct
     *
     * @return void
     */
    function __construct(){
        add_action( 'acf/save_post', [ $this, 'blog_front_page' ], 20 ) ;
        add_filter('acf/load_field/key=field_62d951b0a9992', [ $this, 'acf_load_theme_field_choices' ]);
        add_filter('acf/load_value/key=field_62d951b0a9992', [ $this, 'acf_load_theme_field_value' ], 20, 3);
    }
    
    /**
     * blog_front_page
     *
     * @param  mixed $post_id
     * @return update/wp-options
     */
    public function blog_front_page($post_id)
    {
        
        if( isset( $_POST['_acf_post_id'] ) &&  (int) $_POST['_acf_post_id'] != (int) $post_id ) {
            return;
        }
       
        // remove hook to get new data .
        remove_filter('acf/load_value/key=field_62d951b0a9992', array($this, 'acf_load_theme_field_value' ), 10, 3);
       
        $home_page = '';
        // get page id from acf .
        if ( isset( $_POST['acf']['field_62d951b0a9992'] ) ) {
            $home_page = $_POST['acf']['field_62d951b0a9992'];
        }

        // update our home page .
        if( !empty ( $home_page ) && is_numeric( $home_page ) ){
            update_blog_option( get_current_blog_id(), 'page_on_front', $home_page );
        }

    }
    
    /**
     * acf_load_theme_field_choices
     *
     * @param  mixed $field
     * @return field/choices
     */
    public function acf_load_theme_field_choices( $field  )
    {
        // reset choices
        $field['choices'] = array();
        $args = array( 'post_type' => 'page', 'post_per_page' => -1 );
        $base_site_id = 36;

        switch_to_blog( $base_site_id );     
        $site_template_pages = get_pages( $args );

        foreach( (array)$site_template_pages as $pages ) {
           if( get_field('make_page_template', $pages->ID) === true){
                $previwe_link = '<a title=" ' .__('View Template Preview', 'wp-ultimo'). '"
                class="button button-primary button-large"
                href="' . get_permalink($pages->ID) . '" target="_blank">
                <P> معاينة : ' . esc_attr( get_field('page_template_description', $pages->ID) ). '</P>
            </a>';
                $choice = '<div><img class="wu-site-template-image wu-w-full wu-border-solid wu-border wu-border-gray-300 wu-mb-4 wu-bg-white"
                src="'. esc_attr( get_field('page_template_image', $pages->ID) ) .'">' . $previwe_link . '</div>';
                $field['choices'][ $pages->ID ] = $choice;

            }
        } 
        restore_current_blog();  
        
        // return the field
        return $field;
    }
    
    /**
     * acf_load_theme_field_value
     *
     * @param  mixed $value
     * @param  mixed $post_id
     * @param  mixed $field
     * @return void
     */
    public function acf_load_theme_field_value( $value, $post_id, $field )
    {

        $page_on_front = get_blog_option( get_current_blog_id(), 'page_on_front' );
        
        if( !empty( $page_on_front  )  && is_numeric( $page_on_front ) ) {
            $value = $page_on_front;
        }
        return $value;
    }

}