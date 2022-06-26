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
 * @since		1.0.9
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

        // add_action('admin_notices', [ $this, 'acf_error_admin_notice' ]);

       add_filter( 'image_sideload_extensions', [ $this, 'dali_image_sideload_extensions_filter'], 10, 2 );


      
    }

    public function elements(){

        $get_elements_fields = acf_get_fields('group_629aa7bfb1a3f');

        $elements = isset( $get_elements_fields[0]['layouts'] ) ? $get_elements_fields[0]['layouts'] : '';

        return $elements;
    }

    public function sections(){

        $get_sections_fields = acf_get_fields('group_62b030fecf181');

        $sections = isset( $get_sections_fields[0]['sub_fields']) ? $get_sections_fields[0]['sub_fields'] : '';
        
        return $sections;
    }


    public function add_page_builder_fields_group(){

        $elements = $this->elements();
        $sections = $this->sections();
        // prr($sections);

        
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
                            // array(
                            //     'key' => 'field_62b03a65baaaa',
                            //     'label' => 'Section Settings',
                            //     'name' => 'settings',
                            //     'type' => 'group',
                            //     'instructions' => '',
                            //     'required' => 0,
                            //     'conditional_logic' => 0,
                            //     'wrapper' => array(
                            //         'width' => '',
                            //         'class' => '',
                            //         'id' => '',
                            //     ),
                            //     'layout' => 'block',
                            //     'sub_fields' => array($sections),
                            // ),
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
                                'readonly' => 1,
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
                                'min' => 0,
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
                                        'readonly' => 1,
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
                        // 'message' => prr_html($sections),
                        'new_lines' => 'wpautop',
                        'esc_html' => 0,
                    ), 
                    array(
                        'key' => 'field_62a0707f55552',
                        'label' => 'section deleted ids',
                        'name' => 'del_section',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        // 'frontend_admin_display_mode' => 'hidden',
                        'readonly' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ), 
                    array(
                        'key' => 'field_62a0707f44442',
                        'label' => 'column deleted ids',
                        'name' => 'del_column',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        // 'frontend_admin_display_mode' => 'hidden',
                        'readonly' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_62a0707fff442',
                        'label' => 'widget deleted ids',
                        'name' => 'del_widget',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        // 'frontend_admin_display_mode' => 'hidden',
                        'readonly' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
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
        // prr($acf_data); die;
        // get checkbox KEY names from dashboard .
        $checkbox_name = get_option('dali_dashboard_acf_check_box', true);
        $checkbox_name_arr = [];
        if( ! empty( $checkbox_name ) ) {
            $checkbox_name_arr = explode("\n", $checkbox_name);
            $checkbox_name_arr = array_map('trim', $checkbox_name_arr);
        }
        
        if( !empty( $acf_data ) && is_array( $acf_data ) ) {

        $rows = [];   

        foreach( $acf_data as $row_key => $row ){

            $colomns = []; 
           
        if( isset( $row['columns'] ) && !empty( $row['columns'] ) ){
            foreach(  $row['columns'] as $colomn_key => $colomn ){

            $acf_widgets = []; 
            
            
        if( isset( $colomn['elements'] ) && !empty( $colomn['elements']) ){ 
            foreach ( $colomn['elements'] as $widget_key => $widget ) {
               
               
                // if( $widget['acf_fc_layout'] == 'dali_error_message'){
                //     // Add your query var if the acf layout are not retreive correctly.
                //     add_filter( 'redirect_post_location', array( $this, 'add_error_notice_query_var' ), 99 );
                //     return;
                // }

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
               
                if( isset( $widget['image'] ) ){ 
                        $widget['image']['source'] = 'library';                 
                        // TODO:: remove extra image keys .
     
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
            }
        }
            $rows[$row_key]= 
                [
                    'id' => empty( $row['section_id'] ) ? $this->_generate_random_string() : $row['section_id'],
                    'name' => empty( $row['name'] ) ? 'section-'. $this->_generate_random_string() : $row['name'],
                    'elType' => 'section',
                    'elements' => $colomns,
                ];

        }

        $new_elementor_data = $rows;

        $elementor_data = get_post_meta( $post_id, '_elementor_data');
        
        if( isset( $elementor_data[0] ) ){
            $elementor_data = json_decode( $elementor_data[0] , true );
        }else{
            $elementor_data = [];
        }


       
        // get elements deleted ids from post id.  
        $ele_to_delete = $this->ele_to_delete( $post_id );

        // handel deleted data from elementor data .
        $elementor_data = $this->handle_deleted_data( $ele_to_delete, $elementor_data );
    
        // check if section pos has changes reindex elementor data [ section_sorting ].
         $elementor_data = $this->section_sorting( $new_elementor_data, $elementor_data );

        // replace old elementor data with acf new data without lose elementor extra key.
        $updated_elementor_data = array_replace_recursive( $elementor_data, $new_elementor_data );



        // prr( $updated_elementor_data  );
        // die();
                
        //Unhook function to prevent infitnite looping
        remove_action('acf/save_post', array( $this, 'update_elementor_data' ) , 20);

        // add acf field css like [color & font size & ect .....] to postcss-id.css.
		$post_css = Post_CSS::create( $post_id );
        // Remove Post CSS meta .
		$post_css->delete();

        // Plugin::$instance->frontend->enqueue_font( 'cairo' );

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

        // add_filter( 'redirect_post_location', array( $this, 'add_update_notice_query_var' ), 99 );
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
            $nested = false;
            foreach ( $section_value['elements'] as $colomn_key => $colomn_value ) {

              if( $colomn_value['elType']  != 'column' ){
                $nested = true; 
                break;
              }
              $_column_size = isset($colomn_value['settings']['_inline_size']) ? $colomn_value['settings']['_inline_size'] : $colomn_value['settings']['_column_size'] ;


                // empty the widgets array;

                $widgets = [];

                //$colomn_elements = isset($colomn_value['settings']['elements']) ? $colomn_value['settings']['elements'] :  [] ;
                $colomn_elements = isset($colomn_value['elements']) ? $colomn_value['elements'] :  [] ;
                
                foreach ( $colomn_elements as $widget_key => $widget_value ) {
                    // هنشيك علي مستوي اوديجت
                    // check if is widget !
                    // nested === true; break; else -> 
                    if( $widget_value['elType']  != 'widget' ){
                        $nested = true; 
                        break;
                      }
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
           if( $nested == true ){
            $sections[$section_key] = [
                'field_628c017bd5152' => isset( $section_value['name'] ) ? $section_value['name'] : 'Nested-section-'.$section_key,
                'field_62a0707f4e238' => $section_value['id'],
                'field_624defb6a0589' => [],
            ];
           }else{
            $sections[$section_key] = [
                'field_628c017bd5152' => isset( $section_value['name'] ) ? $section_value['name'] : 'section-'.$section_key,
                'field_62a0707f4e238' => $section_value['id'],
                'field_624defb6a0589' => $colomns,
            ];
           }
            
            
            
        } // End Section  foreach.
    
       if( is_array( $sections ) && !empty( $sections ) ) {
            $value = $sections;
       }

        ?>
        <style>
            .acf-flexible-content .layout .acf-fc-layout-handle{
                border-bottom: var(--wd-primary-color) solid 1px !important;
                color: #fff;
                background: var(--wd-primary-color) !important;
            }
            .acf-field.acf-accordion .acf-label.acf-accordion-title {
                background: #a4afb7 !important;
                color: #ffffff !important;
            }
        </style>
        <?php

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

               foreach ( $element['sub_fields']  as $sub_fields_key => $sub_fields_value ) {

                    $field_name = $sub_fields_value['name'];
                    $field_key  = $sub_fields_value['key'];
                    $field_type = $sub_fields_value['type'];
                    
                    
                    
                    

                      switch ( $field_type ) {

                        case 'image':
                            // Parse home URL and parameter URL
                            $url = isset($value['settings'][$field_name]['url']) ? $value['settings'][$field_name]['url'] : '';
                            $widget[$field_key] = isset($value['settings'][$field_name]['id']) ? $value['settings'][$field_name]['id'] : '';
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
                                                $widget_sub[$i][$key] = isset($row['image']['id']) ? $row['image']['id'] : '';
                                                
                                            }elseif( isset( $row['background_image'] ) && $type == 'image' ){  

                                                $url = isset($row['background_image']['url']) ? $row['background_image']['url'] : '';     
                                                $widget_sub[$i][$key] = isset($row['background_image']['id']) ? $row['background_image']['id'] : '';  
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

                        case 'taxonomy':
                            $taxonomy = isset($value['settings'][$field_name]) ? $value['settings'][$field_name] : [];
                            // remove empty or null array.
                            $taxonomy = array_filter($taxonomy, function($value) { return !is_null($value) && $value !== ''; });
                            $taxonomy_name = isset($sub_fields_value['taxonomy']) ? $sub_fields_value['taxonomy'] : '' ;
                            if( empty( $taxonomy ) && !empty( $taxonomy_name ) ){
                                $taxonomy = $this->get_taxonomys_id( $taxonomy_name );
                            }                            
                            $widget[$field_key] = array_values( $taxonomy );

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
    public function ele_to_delete( $post_id = 0 ){

        $ele_to_delete = [];
        $del_section = get_field('del_section' , $post_id);
        $del_column  = get_field('del_column' , $post_id);
        $del_widget  = get_field('del_widget' , $post_id);

        if( !empty( $del_section ) ){
            $del_section = explode (",", $del_section); 
        }else{
            $del_section = [];
        }
        if( !empty( $del_column ) ){
            $del_column = explode (",", $del_column); 
        }else{
            $del_column = [];
        }
        if( !empty( $del_widget ) ){
            $del_widget = explode (",", $del_widget); 
        }else{
            $del_widget = [];
        }
       return $ele_to_delete = [
            'section' => array_filter($del_section),
            'column'  => array_filter($del_column),
            'widget'  => array_filter($del_widget),
        ]; 
              
    }
    
    /**
     * handle_deleted_data function
     *
     * @param [type] $new_elementor_data
     * @param [type] $elementor_data
     * @return array
     */
    public function handle_deleted_data($ele_to_delete, $elementor_data){
       
        // if no key to delete rtuen the same data . 
    //    prr( $ele_to_delete );
        if( empty ( $ele_to_delete ) ){
            return $elementor_data;
        }

        $ele_section_key = array_values($ele_to_delete['section']);
        $ele_column_key  = array_values($ele_to_delete['column']);
        $ele_widget_key  = array_values($ele_to_delete['widget']);
        // prr($ele_widget_key);
        $nested = false;

        foreach( $elementor_data as $section_key => $section ){

            if( in_array( $section['id'] , $ele_section_key ) ){
                //prr('section => [' . $section['id'] . '] key => [' . $section_key  . '] not in array');
                unset($elementor_data[$section_key]); 
            } 
            
            if( isset( $section['elements'] ) ){
                foreach( $section['elements'] as $column_key => $column ){

                    if( $column['elType']  != 'column' || $column['elType']  == 'section'){
                        $nested = true; 
                        break;
                      }

                    if( in_array($column['id'], $ele_column_key)  ){
                       // prr('column => [' . $column['id'] . '] key => [' . $column_key  . '] not in array');
                        unset($elementor_data[$section_key]['elements'][$column_key]);
                    } 
                    if( isset($column['elements'] ) ){
                        foreach( $column['elements'] as $widget_key => $widget ){
                            if( $widget['elType']  == 'column' || $widget['elType']  == 'section'){
                                $nested = true; 
                                break;
                              }

                            if( in_array($widget['id'], $ele_widget_key ) ){                      
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

        return $elementor_data;
        
    }

    public function elementor_fonts()
    {
        return [
			'groups' => Elementor\Fonts::get_font_groups(),
			'options' => Elementor\Fonts::get_fonts(),
		];
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

    public function section_sorting($new_data, $data_to_sort){

        $new_records = array();
        if( !empty( $data_to_sort ) && is_array( $data_to_sort ) ){
            foreach( $new_data as $id => $pos ) {
                // prr($pos['id']);
                foreach( $data_to_sort as $key => $record ) {
                    // prr( $record[ 'id' ] );
                    if( $record[ 'id' ] == $pos['id'] ) {
                        $new_records[] = $record;
                        break;
                    }
                }

            }
          return $new_records;
        }
    }

    public function get_taxonomys_id($taxonomy = ''){
        $taxonomies = get_terms( array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false
        ) );
        $taxonomies_id = [];
        if ( !empty($taxonomies) ) :
            foreach( $taxonomies as $category ) {
                $taxonomies_id[] = $category->term_id ;   
            }
        endif;
        return $taxonomies_id;
    }
}//end class
