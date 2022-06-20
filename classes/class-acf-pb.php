<?php

use Elementor\Core\Files\CSS\Post as Post_CSS;
use Elementor\Plugin;

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * Class ACF_PB
 *
 * ACF Page Builder
 *
 * @package		DALI
 * @subpackage	Classes/ACF_PB
 * @author		Mohamed Yassin
 * @since		1.0.0
 */

class ACF_PB
{
    public $main_dashboard;

     

    public function __construct(){
       

       // acf hook add pb fields .
        add_action('acf/init', [ $this, 'add_page_builder_fields_group' ] );
       
        // update elementor with acf save hook 20 after save fields .
        add_action( 'acf/save_post', [ $this, 'update_elementor_data' ] , 20 ) ;
  
        add_filter('acf/load_value/key=field_acf_rows', [ $this, 'acf_pb_load_fields' ], 10, 3);

        add_action('admin_notices', [ $this, 'acf_error_admin_notice' ]);

        add_filter( 'image_sideload_extensions', [ $this, 'dali_image_sideload_extensions_filter'], 10, 2 );


      
    }

    public function elements(){

        $get_elements_fields = acf_get_fields('group_629aa7bfb1a3f');

        $elements = isset( $get_elements_fields[0]['layouts'] ) ? $get_elements_fields[0]['layouts'] : '';

        return $elements;
    }


    public function add_page_builder_fields_group(){

        $elements = $this->elements();
        
        if( function_exists('acf_add_local_field_group') ):
    
            acf_add_local_field_group(array(
                'key' => 'group_acf_page_builder',
                'title' => 'Page Builder',
                'fields' => array(
                    array(
                        'key' => 'field_acf_rows',
                        'label' => 'Rows',
                        'name' => 'row',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'hide_admin' => 0,
                        'collapsed' => 'field_628c017bd5152',
                        'min' => 1,
                        'max' => 0,
                        'layout' => 'block',
                        'button_label' => '',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_628c017bd5152',
                                'label' => 'Name',
                                'name' => 'name',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'hide_admin' => 0,
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_62a0707f4e238',
                                'label' => 'section id',
                                'name' => 'section_id',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'frontend_admin_display_mode' => 'hidden',
                                'readonly' => 0,
                                'default_value' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'maxlength' => '',
                            ),
                            array(
                                'key' => 'field_624defb6a0589',
                                'label' => 'Columns',
                                'name' => 'columns',
                                'type' => 'repeater',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'hide_admin' => 0,
                                'collapsed' => 'field_628c00dbd5151',
                                'min' => 1,
                                'max' => 6,
                                'layout' => 'block',
                                'button_label' => 'Add Column',
                                'sub_fields' => array(
                                    array(
                                        'key' => 'field_628c00dbd5151',
                                        'label' => 'Width Percentage',
                                        'name' => 'width',
                                        'type' => 'number',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => array(
                                            'width' => '',
                                            'class' => '',
                                            'id' => '',
                                        ),
                                        'hide_admin' => 0,
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'prepend' => '',
                                        'append' => '%',
                                        'min' => 1,
                                        'max' => 100,
                                        'step' => '',
                                    ),
                                    array(
                                        'key' => 'field_62a0707f88852',
                                        'label' => 'columns id',
                                        'name' => 'columns_id',
                                        'type' => 'text',
                                        'instructions' => '',
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => array(
                                            'width' => '',
                                            'class' => '',
                                            'id' => '',
                                        ),
                                        'frontend_admin_display_mode' => 'hidden',
                                        'readonly' => 0,
                                        'default_value' => '',
                                        'placeholder' => '',
                                        'prepend' => '',
                                        'append' => '',
                                        'maxlength' => '',
                                    ),
                                    array(
                                        'key' => 'field_628bef20f5c59',
                                        'label' => 'Elements',
                                        'name' => 'elements',
                                        'type' => 'flexible_content',
                                        //'instructions' => prr_html($elements),
                                        'required' => 0,
                                        'conditional_logic' => 0,
                                        'wrapper' => array(
                                            'width' => '',
                                            'class' => '',
                                            'id' => '',
                                        ),
                                        'layouts' => $elements,
                                        'button_label' => 'Add Element',
                                        'min' => '',
                                        'max' => '',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_623c9b40f75b6',
                        'label' => 'data',
                        'name' => '',
                        'type' => 'message',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        //'message' => prr_html($elements),
                        'new_lines' => 'wpautop',
                        'esc_html' => 0,
                    ),        
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'page',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'acf_after_title',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
                'show_in_rest' => 0,
            ));
            
            endif;		
    }

    public function get_available_widgets(){}

    public function update_elementor_data($post_id){
         
        // only save data if is the page build with elementor .
        $is_builder = get_post_meta( $post_id, '_elementor_edit_mode', true);

        if( $is_builder != 'builder' ){
            return;
        }

        // prr( $_POST['acf'] );
        // die;
    
        // remove hook to get new data .
        remove_filter('acf/load_value/key=field_acf_rows', array($this, 'acf_pb_load_fields' ), 10, 3);

        

        $acf_data = get_field('field_acf_rows', $post_id);
        
        // get checkbox names from dashboard .
        $checkbox_name = get_option('dali_dashboard_acf_check_box', true);
        $checkbox_name_arr = [];
        if( ! empty( $checkbox_name ) ) {
            $checkbox_name_arr = explode("\n", $checkbox_name);
            $checkbox_name_arr = array_map('trim', $checkbox_name_arr);
        }
        
        
        // prr($checkbox_name_arr);
        // die;

        if( !empty( $acf_data ) && is_array( $acf_data ) ) {

        $rows = [];   

        foreach( $acf_data as $row_key => $row ){

            $colomns = []; 
            
            foreach( $row['columns'] as $colomn_key => $colomn ){

                $acf_widgets = []; 
                
            foreach ( $colomn['elements'] as $widget_key => $widget ) {
               
               
                if( $widget['acf_fc_layout'] == 'dali_error_message'){
                    // Add your query var if the acf layout are not retreive correctly.
                    add_filter( 'redirect_post_location', array( $this, 'add_error_notice_query_var' ), 99 );
                    return;
                }

               // fix for acf checkbox for elementor .
                if( is_array( $checkbox_name_arr ) && !empty( $checkbox_name_arr ) ){
                   foreach ($checkbox_name_arr as $key => $value) {
                       if( isset( $widget[$value] ) && array_key_exists( $value, $widget ) ){
                           if( $widget[$value] == 1 ){
                               $widget[$value] = 'yes'; 
                           } else {
                               $widget[$value] = ''; 
                           }
                       }
                   }
                }
               

                // prr( $widget );
                    
                // prr($widget_key);
                if( isset( $widget['image'] ) ){ 
                        $widget['image']['source'] = 'library';                 
                        // remove extra image keys .
                        unset( $widget['image']['title'] );
                        unset( $widget['image']['sizes'] );
                        unset( $widget['image']['ID'] );
                        unset( $widget['image']['filename'] );
                        unset( $widget['image']['filesize'] );
                        unset( $widget['image']['link'] );
                        unset( $widget['image']['author'] );
                        unset( $widget['image']['description'] );
                        unset( $widget['image']['caption'] );
                        unset( $widget['image']['name'] );
                        unset( $widget['image']['status'] );
                        unset( $widget['image']['uploaded_to'] );
                        unset( $widget['image']['date'] );
                        unset( $widget['image']['modified'] );
                        unset( $widget['image']['menu_order'] );
                        unset( $widget['image']['mime_type'] );
                        unset( $widget['image']['type'] );
                        unset( $widget['image']['subtype'] );
                        unset( $widget['image']['icon'] );
                        unset( $widget['image']['width'] );
                        unset( $widget['image']['height'] );       
                }

                    if( $widget['acf_fc_layout'] == 'dali_warning_message'){
                        $_widgetType = $widget['widgettype'];
                    }else{
                        $_widgetType = $widget['acf_fc_layout'];
                    }
                    
                    $acf_widgets[$widget_key] = [
                        'id' => empty( $widget['_id'] ) ? $this->_generate_random_string() : $widget['_id'],
                        'elType' => 'widget',
                        'widgetType' => $_widgetType,
                        'settings' => $widget,                    
                    ];
                    
                    // $acf_widgets[$widget_key] = $this->generate_elementor_widget( $widget_key, $widget );
                }
                // prr($widget); 

                //  prr($acf_widgets);

                $colomns[$colomn_key] = [
                    'id' => empty( $colomn['columns_id'] ) ? $this->_generate_random_string() : $colomn['columns_id'],
                    'elType' => 'column',
                    'settings' => [
                        '_column_size' => $colomn['width'],
                        '_inline_size' => $colomn['width'],
                        'column_sticky_offset' => 50,
                        'scroll_y' => -80,                               
                    ],
                    'elements' => $acf_widgets,
                ];

            }

            $rows[$row_key]= 
                [
                    'id' => empty( $row['section_id'] ) ? $this->_generate_random_string() : $row['section_id'],
                    'name' => empty( $row['name'] ) ? 'section-'. $this->_generate_random_string() : $row['name'],
                    'elType' => 'section',
                    'elements' => $colomns,
                ];

        }
        // die;
        $new_elementor_data = $rows;

        $elementor_data = get_post_meta( $post_id, '_elementor_data');
        
        if( isset( $elementor_data[0] ) ){
            $elementor_data = json_decode( $elementor_data[0] , true );
        }else{
            $elementor_data = [];
        }
        
        // check for updated data on save [ handle deleted data].
        $elementor_data = $this->handle_deleted_data($new_elementor_data, $elementor_data);

        // prr( $elementor_data );
        // die();
        
        $updated_elementor_data = array_replace_recursive( $elementor_data, $new_elementor_data );
                
        //Unhook function to prevent infitnite looping
        remove_action('acf/save_post', array( $this, 'update_elementor_data' ) , 20);

        // Remove Post CSS
		$post_css = Post_CSS::create( $post_id );
        //  prr($post_css); die();
		$post_css->delete();

        Plugin::$instance->frontend->enqueue_font( 'cairo' );

        // We need the `wp_slash` in order to avoid the unslashing during the `update_post_meta`
		$json_value = wp_slash( wp_json_encode( $updated_elementor_data ) );
		update_post_meta( $post_id, '_elementor_data', $json_value );

        //-- if FREE version of Elementor plugin is installed
        if( defined( 'ELEMENTOR_VERSION' ) ){
            update_post_meta( $post_id, '_elementor_version', ELEMENTOR_VERSION );
        }
        //-- if PRO version of Elementor plugin is installed
        if( defined( 'ELEMENTOR_PRO_VERSION' ) ){
            update_post_meta( $post_id, '_elementor_pro_version', ELEMENTOR_PRO_VERSION );
        }

        //-- for Elementor
        update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );

        update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
        //die;

        add_filter( 'redirect_post_location', array( $this, 'add_update_notice_query_var' ), 99 );
        //Rehook function to prevent infitnite looping
        add_filter('acf/save_post', array( $this, 'update_elementor_data' ), 20);

      } // End If is not empty acf row .

    }

    public function _generate_random_string(){
        return dechex( rand() );
    }

    public function generate_elementor_widget( $widget_key, $widget ){}
    

    /**
     * acf_pb_load_fields function
     *
     * @param [type] $value
     * @param [type] $post_id
     * @param [type] $field
     * @return value
     */
    public function acf_pb_load_fields($value, $post_id, $field){

        $elementor_data = get_post_meta( $post_id, '_elementor_data');
        
        if( isset( $elementor_data[0] ) ){
            $elementor_data = json_decode( $elementor_data[0] , true );
        }else{
            $elementor_data = [];
        }
           
        // stop if there is no elementor data in the page .
        if ( empty( $elementor_data ) ) {
            return;
        }

        $value   = [];
        $sections = [];

        foreach ( $elementor_data as $section_key => $section_value ) {

            // empty the colomns array;
            $colomns = [];

            foreach ( $section_value['elements'] as $colomn_key => $colomn_value ) {

                $_column_size = isset($colomn_value['settings']['_inline_size']) ? $colomn_value['settings']['_inline_size'] : $colomn_value['settings']['_column_size'] ;

                // empty the widgets array;
                $widgets = [];

                //$colomn_elements = isset($colomn_value['settings']['elements']) ? $colomn_value['settings']['elements'] :  [] ;
                $colomn_elements = isset($colomn_value['elements']) ? $colomn_value['elements'] :  [] ;
                
                foreach ( $colomn_elements as $widget_key => $widget_value ) {
                    
                 // TODO: find way to cheack if keys exist.
                 

                    $widgets[$widget_key] = $this->acf_element_widgets( $widget_key, $widget_value );
                   
                    /* 
                    $widgets[$widget_key]= [
                        'acf_fc_layout'       => $widget_value['widgetType'],
                        'field_629b8c423615d' => $widget_value['settings']['title'],
                        'field_629b8c793615e' => $widget_value['settings']['subtitle'],
                        'field_629b8d30542d6' => isset($widget_value['settings']['after_title']) ? $widget_value['settings']['after_title'] : '',
                        'field_629b8d91542d7' => '',
                        'field_629b8daf542d8' => 'Default (22px)',
                        'field_629b95aafb0cf' => '',
                        'field_629b977ffb0d7' => '',
                        'field_629b983ffb0d8' => 4,
                        'field_629b99e1fb0d9' => 'modal_button_text',
                        'field_629b9a07fb0da' => [],
                    ];  
                    */                                     
                  
                } // End Widgets foreach.

                $colomns[$colomn_key] = [
                    'field_628c00dbd5151' => $_column_size,
                    'field_62a0707f88852' => $colomn_value['id'],
                    'field_628bef20f5c59' => $widgets,
                ]; 


            } // End Colomn foreach .

            $sections[$section_key] = [
                'field_628c017bd5152' => isset( $section_value['name'] ) ? $section_value['name'] : 'section-'.$section_key,
                'field_62a0707f4e238' => $section_value['id'],
                'field_624defb6a0589' => $colomns,
            ];
            
            
        } // End Section  foreach.
       
       if( is_array( $sections ) && !empty( $sections ) ) {
            $value = $sections;
       }

        // prr( $value  );

        return $value;
        
    }
    
    /**
     * acf_element_widgets
     *
     * @param [type] $key
     * @param [type] $value
     * @return array/fields_key
     */
    public function acf_element_widgets( $widget_key, $value ){
        
        // Get widget name from elementor data value.
        $widgetType = isset( $value['widgetType'] ) ? $value['widgetType'] : '';

        // Get our elements from acf layouts .
        $elements = $this->elements();

        // reset widget array . 
        $widget = [];
        
        // check if our element is not empty 1st .
        if( is_array( $elements ) && !empty( $elements ) ){
           
           foreach ($elements as $element ) {
            
            // if acf element name match elmentor widget name continue . 
            $elementName[] = $element['name'];     
            
            if( $element['name'] == $widgetType ){

                // prr($widgetType, $element['name']);
               $widget['acf_fc_layout'] = $widgetType ;

               foreach ( $element['sub_fields']  as $sub_fields_key => $sub_fields_value) {

                    $field_name = $sub_fields_value['name'];
                    $field_key  = $sub_fields_value['key'];
                    $field_type = $sub_fields_value['type'];
                    
                    
                    
                    

                      switch ( $field_type ) {

                        case 'image':
                            // Parse home URL and parameter URL
                            $url = isset($value['settings'][$field_name]['url']) ? $value['settings'][$field_name]['url'] : '';
                            $link_url = parse_url( $url );
                            $home_url = parse_url( $_SERVER['HTTP_HOST'] ); 
                            $home_url = parse_url( home_url() );  // Works for WordPress
                            // Decide on target
                            if( empty($link_url['host']) ) {
                                // Is an internal link
                                $image_id = isset($value['settings'][$field_name]['id']) ? $value['settings'][$field_name]['id'] : '';
                            } elseif( $link_url['host'] == $home_url['host'] ) {
                                // Is an internal link
                                $image_id = isset($value['settings'][$field_name]['id']) ? $value['settings'][$field_name]['id'] : '';
                            } else {
                                // Is an external link
                                $url     = isset($value['settings'][$field_name]['url']) ? $value['settings'][$field_name]['url'] : '';
                                if( empty( $url ) ){
                                    $image_id = '';
                                }else{
                                    $post_id = get_the_ID();  
                                    $image_id = media_sideload_image( $url, $post_id, null, 'id' );
                                }
                                
                            }   
                            
                           
                            $widget[$field_key] = $image_id;
                        break;


                        case 'flexible_content':

                        // prr($sub_fields_value);
                        $flexible_content =  isset($value['settings'][$field_name]) ? $value['settings'][$field_name] : '';                          
                        $widget_sub = [];
                        if( !empty( $flexible_content ) && is_array( $flexible_content ) ){ 
                            // prr($flexible_content);
                            foreach ($flexible_content as $flexkey => $flex) {                
                              foreach ( $sub_fields_value['layouts'] as $k => $v) {
                                  
                                if( $flex['acf_fc_layout'] === $v['name'] ) {
                                    $layout_key = str_replace("layout_", "", $v['key']);
                                    $widget_sub['acf_fc_layout'] = $v['name'];
                                    foreach ($v['sub_fields'] as $kk => $vv) {
                                        $subkey = $vv['key'];
                                        $name = $vv['name'];
                                        $widget_sub[$subkey] = isset($flex[$name]) ? $flex[$name] : '';
                                        
                                    } 
                                    $layout[$layout_key] = $widget_sub;
                                }
                              }  
                            }
                            $widget[$field_key] = $layout; 
                            // prr( $widget );
                        }      
                        break;


                        case 'group':
                        $settings =  isset($value['settings']) ? $value['settings'] : '';  
                        $elementor_settingsName = isset($value['settings'][$field_name]) ? $value['settings'][$field_name] : '';                   
                            //   prr($group);
                        $widget_sub = [];  
                        if( isset( $sub_fields_value['sub_fields'] ) && !empty( $sub_fields_value['sub_fields'] ) ) {   
                            foreach ( $sub_fields_value['sub_fields'] as $k => $v ) { 
                                
                                $key = $v['key'];
                                $name = $v['name'];                
                                if( is_array( $elementor_settingsName ) ){
                                    $widget_sub[$key] = isset($value['settings'][$field_name][$name]) ? $value['settings'][$field_name][$name] : '';                                       
                                }else{
                                    $widget_sub[$key] = isset($settings[$name]) ? $settings[$name] : ''; 
                                } 
                                // prr($widget_sub, $name);         
                            }  

                            $widget[$field_key] = $widget_sub; 
                            }
                            //   prr( $widget );
                            break; 
                        
                        
                        case 'repeater':
                            $settings =  isset($value['settings']) ? $value['settings'] : ''; 
                            $widget_sub = [];
                            
                        $settingsName = isset($value['settings'][$field_name]) ? $value['settings'][$field_name] : '';                   
                        if( isset( $sub_fields_value['sub_fields'] ) && !empty( $sub_fields_value['sub_fields'] ) ) {   
                            foreach ( $sub_fields_value['sub_fields'] as $k => $v ) {
                                
                                    $key = $v['key']; 
                                    $name = $v['name'];
                                    $type = $v['type'];
                                    
                                    if( is_array( $settingsName ) ){
                                        foreach( $settingsName as $i => $row  ){  
                                            $widget_sub_sub = [];
                                                if( $v['type'] === 'group' ){
                                                    foreach( $v['sub_fields'] as $subfield_key => $subfield ){
                                                        $subf_key  = $subfield['key'];
                                                        $subf_name = $subfield['name'];
                                                        $widget_sub_sub[$subf_key]= isset($row[$name][$subf_name]) ? $row[$name][$subf_name] : '';
                                                        
                                                        } 
                                                $widget_sub[$i][$key] = $widget_sub_sub;
                                                        // prr( $widget_sub ); 
                                                }else
                                            if( isset( $row['image'] ) && $type == 'image' ) {
                                                $url = isset($row['image']['url']) ? $row['image']['url'] : '';
                                                $link_url = parse_url( $url );
                                                $home_url = parse_url( $_SERVER['HTTP_HOST'] ); 
                                                $home_url = parse_url( home_url() );  // Works for WordPress
                                                // Decide on target
                                                if( empty($link_url['host']) ) {
                                                    // Is an internal link
                                                    $image_id = isset($row['image']['id']) ? $row['image']['id'] : '';
                                                } elseif( $link_url['host'] == $home_url['host'] ) {
                                                    // Is an internal link
                                                    $image_id = isset($row['image']['id']) ? $row['image']['id'] : '';
                                                } else {
                                                    // Is an external link
                                                    $url     = isset($row['image']['url']) ? $row['image']['url'] : '';
                                                    if( empty( $url ) ){
                                                        $image_id = '';
                                                    }else{
                                                        $post_id = get_the_ID();  
                                                        $image_id = media_sideload_image( $url, $post_id, null, 'id' );
                                                    }

                                                }          
                                                $widget_sub[$i][$key] = $image_id;
                                                
                                            }elseif( isset( $row['background_image'] ) && $type == 'image' ){  

                                                $url = isset($row['background_image']['url']) ? $row['background_image']['url'] : '';
                                                $link_url = parse_url( $url );
                                                $home_url = parse_url( $_SERVER['HTTP_HOST'] ); 
                                                $home_url = parse_url( home_url() );  // Works for WordPress
                                                // Decide on target
                                                if( empty($link_url['host']) ) {
                                                    // Is an internal link
                                                    $image_id = isset($row['background_image']['id']) ? $row['background_image']['id'] : '';
                                                } elseif( $link_url['host'] == $home_url['host'] ) {
                                                    // Is an internal link
                                                    $image_id = isset($row['background_image']['id']) ? $row['background_image']['id'] : '';
                                                } else {
                                                    // Is an external link
                                                    $url     = isset($row['background_image']['url']) ? $row['background_image']['url'] : '';
                                                    if( empty( $url ) ){
                                                        $image_id = '';
                                                    }else{
                                                        $post_id = get_the_ID();  
                                                        $image_id = media_sideload_image( $url, $post_id, null, 'id' );
                                                    }

                                                }          
                                                $widget_sub[$i][$key] = $image_id;  
                                            }else{
                                                $widget_sub[$i][$key] = isset($row[$name]) ? $row[$name] : '';
                                            }
                                          
                                        }                                         
                                    } 
                            }  

                            $widget[$field_key] = $widget_sub;       
                        } 
                            // prr( $widget ); 
                        break;    
                            

                        default:
                            $widget[$field_key] = isset($value['settings'][$field_name]) ? $value['settings'][$field_name] : '';
                        break;

                      } // End switch ( $field_type ).
                      
                      // update hidden id in acf field for widget .
                      if( $field_name === '_id'){
                        $widget[$field_key] = isset( $value['id'] ) ? $value['id'] : '';
                     //    prr( $widget );
                     } 

                    } // End Sub fields foreach. 

                } // End if ;

            } // End elements foreach. 
            // prr($elementName);
             
        } // End Is_array . 
        $widgetType = isset( $value['widgetType'] ) ? $value['widgetType'] : ''; 
        if( empty ( $widget ) ){    
            if( empty ( $widgetType ) ) {
                $message = 'Nested Layout Not Allowed';
                $widget = [
                    'acf_fc_layout' => 'dali_error_message',
                    'field_62a75313f0cc4' => $message,
                ]; 
            }else{
                $message = 'Missing Widget Layout Name :  [ '. $widgetType .' ]';
                $widget = [
                    'acf_fc_layout' => 'dali_warning_message',
                    'field_62acdb900f180' => $message,
                    'field_62acdbad0f181' => isset( $value['id'] ) ? $value['id'] : '',
                    'field_62acde27786a1' => $widgetType,
                ]; 
            }
             
            // prr( $widget );            
            return $widget;

         } else {

            return $widget;
            
         } 
         
    }  
    
    /**
     * get_keys_from_array function
     *
     * @param array $data
     * @return array
     */
    public function get_keys_from_array( $data = array() ){

        $ele_section_key = [];
        $ele_column_key  = [];
        $ele_widget_key  = [];
        foreach( ( array )$data as $sections_key => $section ){
            if( isset( $section['id'] ) ){   
                $ele_section_key[] = $section['id'];
                if( isset( $section['elements'] ) ){
                    foreach ( $section['elements'] as $column_key => $column ){
                        $ele_column_key[] = $column['id'];
                        if( isset( $column['elements'] ) ){
                            foreach( $column['elements'] as $widget_key => $widget ){
                                $ele_widget_key[] = $widget['id'];
                            }
                       }
                    }
                }
            }
        }
        return $ele_ = [
            'section' => $ele_section_key,
            'column' => $ele_column_key,
            'widget' => $ele_widget_key,
        ];       
    }
    
    /**
     * handle_deleted_data function
     *
     * @param [type] $new_elementor_data
     * @param [type] $elementor_data
     * @return array
     */
    public function handle_deleted_data($new_elementor_data, $elementor_data){


        $ele_data_keys = $this->get_keys_from_array( $new_elementor_data );
        $ele_section_key = array_values($ele_data_keys['section']);
        $ele_column_key  = array_values($ele_data_keys['column']);
        $ele_widget_key  = array_values($ele_data_keys['widget']);
        // prr($ele_widget_key);
        
        foreach( $elementor_data as $section_key => $section ){
            $sec_key = isset($section[$section_key]) ? $section[$section_key] : '';
            if( !in_array( $section['id'] , $ele_section_key ) ){
                //prr('section => [' . $section['id'] . '] key => [' . $section_key  . '] not in array');
                unset($elementor_data[$section_key]); 
            } 
            if( isset( $section['elements'] ) ){
                foreach( $section['elements'] as $column_key => $column ){
                    $col_key = isset($column[$column_key]) ? $column[$column_key] : '';
                    if( !in_array($column['id'], $ele_column_key)  ){
                       // prr('column => [' . $column['id'] . '] key => [' . $column_key  . '] not in array');
                        unset($elementor_data[$section_key]['elements'][$column_key]);
                    } 
                    if( isset($column['elements'] ) ){
                        foreach( $column['elements'] as $widget_key => $widget ){
                            $col = $column['elements'];
                            if( !in_array($widget['id'], $ele_widget_key ) ){                      
                                //prr('widget => [' . $widget['id'] . '] key => [' . $widget_key  . '] not in array');
                                unset($elementor_data[$section_key]['elements'][$column_key]['elements'][$widget_key]); 
                                // break;  
                            }
                            // prr($widget);
                        }
                         
                    }
                    
                    // prr($column);  
                } 
            }
            
        }

        $_ele_data_keys = $this->get_keys_from_array( $elementor_data );
        $_ele_section_key = array_values($_ele_data_keys['section']);
        $_ele_column_key  = array_values($_ele_data_keys['column']);
        $_ele_widget_key  = array_values($_ele_data_keys['widget']);
        // prr( $_ele_widget_key );

        return $elementor_data;
        
    }

    public function elementor_fonts()
    {
        return [
			'groups' => Elementor\Fonts::get_font_groups(),
			'options' => Elementor\Fonts::get_fonts(),
		];
    }

    public function acf_error_admin_notice(){
        if ( isset( $_GET['dali_update'] ) && $_GET['dali_update'] == 'error' ) {
       
        echo '<div class="notice notice-error is-dismissible">
                <p>Error Save page Error In acf layout</p>
        </div>';
        
       } else { 
        return;
       }
        

    }
    public function add_error_notice_query_var( $location ) {
        remove_filter( 'redirect_post_location', [ $this, 'add_error_notice_query_var' ], 99 );
        remove_query_arg( 'dali_update' );
        return add_query_arg( array( 'dali_update' => 'error' ), $location );
    }
    
    public function add_update_notice_query_var( $location ) {
        remove_filter( 'redirect_post_location', [ $this, 'add_update_notice_query_var' ], 99 );
        remove_query_arg( 'dali_update' );
        return add_query_arg( array( 'dali_update' => 'success' ), $location );
    }

    /**
     * Function for `image_sideload_extensions` filter-hook.
     * 
     * @param string[] $allowed_extensions Array of allowed file extensions.
     * @param string   $file               The URL of the image to download.
     *
     * @return string[]
     */
    function dali_image_sideload_extensions_filter( $allowed_extensions, $file ){

        $allowed_extensions = array( 'jpg', 'jpeg', 'jpe', 'png', 'gif', 'webp', 'svg' );

        return $allowed_extensions;
    }

}
