<?php
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
        add_action('acf/init', array($this, 'add_page_builder_fields_group') );
       
        // update elementor with acf save hook 20 after save fields .
        add_action( 'acf/save_post', array( $this, 'update_elementor_data' ) , 20 ) ;
  
        //add_filter('acf/load_field/key=field_acf_rows', [ $this, 'acf_pb_load_fields' ]);
        add_filter('acf/load_value/key=field_acf_rows', array($this, 'acf_pb_load_fields' ), 10, 3);


      
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

        // prr($acf_data);
        // die;

        if( !empty( $acf_data ) && is_array( $acf_data ) ) {

        $rows = [];   

        foreach( $acf_data as $row_key => $row ){

            $colomns = []; 
            
            foreach( $row['columns'] as $colomn_key => $colomn ){

                $acf_widgets = []; 
                
            foreach ( $colomn['elements'] as $widget_key => $widget ) {
                // prr($widget);
                if( isset( $widget['font'] ) && is_array( $widget['font'] ) ){
                    foreach ($widget['font'] as $font_key => $font) {
                        $key_name = $font['acf_fc_layout'];
                        $widget[$key_name] = $font;
                        // unset($widget['font']);
                    }                  
                }
                if( isset( $widget['image'] ) && is_array( $widget['image'] ) ){   
                    
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
                        
                        //add source key to image array for elementor .
                        $widget['image']['source'] = 'library';

                        $widget['image'];
                                     
                }


                    
                    $acf_widgets[$widget_key] = [
                        'id' => empty( $widget['id'] ) ? $this->_generate_random_string() : $widget['id'],
                        'elType' => 'widget',
                        'widgetType' => $widget['acf_fc_layout'],
                        'settings' => $widget,                    
                    ];
                    
                    // $acf_widgets[$widget_key] = $this->generate_elementor_widget( $widget_key, $widget );
                }

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
        
        $updated_elementor_data = array_replace_recursive( $elementor_data, $new_elementor_data );
        

        // prr( $new_elementor_data, 'new data');
        // prr( $updated_elementor_data, 'updated');
        // die();
        // prr( $old_elementor_data , 'old');
        

        
        
        // $updated_elementor_data = array_merge_recursive( $old_elementor_data, $old_elementor_data );
             
        // We need the `wp_slash` in order to avoid the unslashing during the `update_post_meta`
		$json_value = wp_slash( wp_json_encode( $updated_elementor_data ) );
        $elementor_data = wp_slash( wp_json_encode( $elementor_data ) );


        //Unhook function to prevent infitnite looping
        remove_action('acf/save_post', array( $this, 'update_elementor_data' ) , 20);

        //update_post_meta(  $post_id, '_elementor_data',  $json_value  );
		// Don't use `update_post_meta` that can't handle `revision` post type
		update_post_meta( $post_id, '_elementor_data', $json_value );

        

        //-- if FREE version of Elementor plugin is installed
        if( defined( 'ELEMENTOR_VERSION' ) ){
            update_post_meta( $post_id, '_elementor_version', ELEMENTOR_VERSION );
        }
        //-- if PRO version of Elementor plugin is installed
        if( defined( 'ELEMENTOR_PRO_VERSION' ) ){
            update_post_meta( $post_id, '_elementor_pro_version', ELEMENTOR_PRO_VERSION );
        }

        // prr( $document );
        // die;

        //-- for Elementor
        update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );

        update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
        //die;


        //Rehook function to prevent infitnite looping
        add_filter('acf/save_post', array( $this, 'update_elementor_data' ), 20);

      } // End If is not empty acf row .

    }

    public function _generate_random_string(){
        return dechex( rand() );
    }

    public function generate_elementor_widget( $widget_key, $widget ){

        
    }
    

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
                'field_628c017bd5152' => 'section-'.$section_key,
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
                     
					// if ( $active && $active !== $layout['name'] ) {
					// 	continue;
					// }    
                      // fixed acf Field types.
                      switch ( $field_type ) {

                        case 'image':
                            $widget[$field_key] = isset($value['settings'][$field_name]['id']) ? $value['settings'][$field_name]['id'] : '';
                            // prr( $widget );  
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
                        $settingsName = isset($value['settings'][$field_name]) ? $value['settings'][$field_name] : '';                   
                            //   prr($group);
                        $widget_sub = [];  
                        if( isset( $sub_fields_value['sub_fields'] ) && !empty( $sub_fields_value['sub_fields'] ) ) {   
                            foreach ( $sub_fields_value['sub_fields'] as $k => $v ) {   
                                $key = $v['key'];
                                $name = $v['name'];                
                                if( is_array( $settingsName ) ){
                                    
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
                                    
                                    if( is_array( $settingsName ) ){
                                        foreach( $settingsName as $i => $row  ){  
                                            if( isset( $row['image'] ) && $name == 'image' ) {
                                                $widget_sub[$i][$key] = isset($row['image']['id']) ? $row['image']['id'] : '';
                                                // prr( $widget_sub ); 
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
                      if( $field_name === 'id' ){
                        $widget[$field_key] = isset($value['id']) ? $value['id'] : '';
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
            }else{
                $message = 'Missing Widget Layout Name :  [ '. $widgetType .' ]';
            }
            $widget = [
                'acf_fc_layout' => 'dali_error_message',
                'field_62a75313f0cc4' => $message,
            ];  
            // prr( $widget );            
            return $widget;

         } else {

            return $widget;
            
         } 
         
    }  
}
