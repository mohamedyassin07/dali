<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) exit;


/**
 * Class ACF_PAGE_CONTENT
 *
 * ACF Page CONTENT
 *
 * @package		DALI
 * @subpackage	Classes/ACF_PAGE_CONTENT
 * @author		sherif ali
 * @since		1.0.0
 */
class ACF_PAGE_CONTENT {

        
    /**
     * __construct
     *
     * @return void
     */
    function __construct(){
        add_action( 'plugins_loaded', [ $this, 'acf_pages_content_field' ] );
        add_action( 'acf/save_post', [ $this, 'save_page_content' ] ) ;
    }
    
    /**
     * get_page_ids
     *
     * @return void
     */
    public function get_page_ids(){

        $page_ids = [];
        $get_page_ids = get_field( 'page_ids' , 'dali_dashboard' );
        if( !empty( $get_page_ids ) ){
             $page_ids = $get_page_ids ;
        }
        return $page_ids;

    }
    
    /**
     * get_page_content_field
     *
     * @return void
     */
    public function get_page_content_field(){

        $sub_fields = [];
        $page_ids = $this->get_page_ids();

        if( !empty( $page_ids ) ) {
            $args = array(
                'post_type' => 'page',
                'numberposts' => -1,
                'post_status' => 'any',
                'post__in' => $page_ids
            );
            
            $pages = get_posts($args);

            foreach( $pages as $page ){

                $page_url =  $page->guid ;

                $view_page = '<a href="'.$page_url.'" target="_blank" rel="noopener noreferrer" class="button button-primary button-small">View Page</a>';
                
                $sub_fields[] =  array(
                    'key'   => 'field_'.$page->post_name,
                    'label' => $page->post_title .'&nbsp;&nbsp;&nbsp;'.$view_page,
                    'name'  => 'post_'.$page->ID,
                    'type'  => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                );
            }
        }
        
        
        

        return $sub_fields;
    }
    
    /**
     * acf_pages_content_field
     *
     * @return void
     */
    public function acf_pages_content_field(){

        $sub_fields = $this->get_page_content_field();

        $fields_group = array(
                'key' => 'group_62b967d94c7d1',
                'title' => 'Pages Content Setting ',
                'fields' => array(
                    array(
                        'key' => 'field_62b967ec8fd2a',
                        'label' => '',
                        'name' => 'pages_content_setting',
                        'type' => 'group',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'sub_fields' => $sub_fields,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'dali_pages_settings',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
                'show_in_rest' => 0,
    
        );

        acf_add_local_field_group( $fields_group );
    } 
            
    /**
     * save_page_content
     *
     * @param  mixed $post_id
     * @return void
     */
    public function save_page_content($post_id){
        
        // only fire save hook on page dali pages settings .
        if( isset($_POST['_acf_post_id']) &&  (int) $_POST['_acf_post_id'] != (int) $post_id ) {
            return;
        }
        

        $pages_content_setting = get_field( 'pages_content_setting' , 'dali_pages_settings' );

        if( !empty( $pages_content_setting ) ){

            foreach( $pages_content_setting as $page_id => $page_content ){

                
                $id = str_replace( "post_", "", $page_id );

                // Update page
                $page_data = array(
                    'ID'            => (int) $id,
                    'post_content'  => $page_content,
                );
                wp_update_post($page_data);
            }
        }

    }    

   
}// end classes/ACF_PAGE_CONTENT
