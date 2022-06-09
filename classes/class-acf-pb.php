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

     

    public function __construct()
    {
       //$elements = $this->elements();
       //$this->add_page_builder_fields_group( $elements );
       
        add_action('acf/init', [$this, 'add_page_builder_fields_group'] );
       
        // convert acf field to elmentor ele .
        add_action( 'acf/save_post', array( $this, 'save_acf_to_elementor' ) ) ;

        //add_filter('acf/load_field/key=field_acf_rows', [ $this, '_acf_pb_load_fields' ]);
        add_filter('acf/load_value/key=field_acf_rows', [ $this, '_acf_pb_load_fields' ], 10, 3);
      
    }

    public function elements()
    {
        $elements = [];
        $elements = acf_get_fields('group_629aa7bfb1a3f')[0]['layouts'];
        return $elements;
        


        // $elements = [];
        // $allowed_widgets = get_field('available_elementor_widgets', 'dali_dashboard');
        // $elemetor_widgets = Sub_Site_Dashboard::available_elementor_widgets();

        // foreach ( (array) $allowed_widgets as $key => $widget) {

        //     if( $widget['enable'] != 1 ){
        //         continue;
        //     }
        //     $subs = [];

        //     $subs =  array_merge( $subs , $this->get_widget_fields( $key , $widget , $elemetor_widgets ) );

        //     $elements['layout_'.$key] =  array(
        //         'key' => 'layout_'.$key,
        //         'name' => $key,
        //         'label' => name_from_key( $key ),
        //         'display' => 'block',
        //         'sub_fields' => $subs,
        //         'min' => '',
        //         'max' => '',
        //     );

        // };
        // return $elements;
    }

    public function get_widget_fields( $key , $widget , $elemetor_widgets )
    {
        $controls = $elemetor_widgets[$key]['controls'];

        // foreach ($controls as $key => $control) {
            
        //     if( !i ){
        //         continue;
        //     }



        // }

        $subs= [];
        $subs[] = array(
            'key' => 'field_msg_'.$key,
            'label' => ' ',
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
            'message' => prr_html($elemetor_widgets[$key]),
            'new_lines' => 'wpautop',
            'esc_html' => 0,
        );      


        $subs[] = array(
            'key' => 'field_title_'.$key,
            'label' => 'title',
            'name' => 'title',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        );

        $subs[] = array(
            'key' => 'field_type_'.$key,
            'label' => 'type',
            'name' => 'type',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                1 => '1',
                2 => '2',
                3 => '3',
                4 => '4',
                5 => '5',
                6 => '6',
            ),
            'default_value' => false,
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'return_format' => 'value',
            'ajax' => 0,
            'placeholder' => '',
        );
        return $subs;
    }

    public function add_page_builder_fields_group(  )
    {
        //$data = get_field('available_elementor_widgets', 'dali_dashboard');
        $elements = acf_get_fields('group_629aa7bfb1a3f')[0]['layouts'];

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
                        'message' => prr_html($elements),
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

    public function get_available_widgets(Type $var = null)
    {
        # code...
    }

    public function save_acf_to_elementor($post_id){

        // prr_html($_POST['acf']) ;
        // echo "<pre>";
        // print_r( $_POST['acf'] );
        // echo "</pre>";
        
        // wp_die();

        //-- if FREE version of Elementor plugin is installed
        if( defined( 'ELEMENTOR_VERSION' ) )    {
           //update_post_meta( $post_id, '_elementor_version', ELEMENTOR_VERSION );
        }
        //-- if PRO version of Elementor plugin is installed
        if( defined( 'ELEMENTOR_PRO_VERSION' ) ){
            //update_post_meta( $post_id, '_elementor_pro_version', ELEMENTOR_PRO_VERSION );
        }

        //-- for Elementor
        //update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
        //update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
        
        //-- Elementor data in json formate .
        $elementor_data = [];


        
        $field_acf_rows = get_field('field_acf_rows', get_the_ID());

        if( !empty( $field_acf_rows ) && is_array( $field_acf_rows ) ) {

        $elemetor_sections = [];   

        foreach( $field_acf_rows as $row_key=>$section ){

            $elemetor_colomns = []; 
            

            foreach( $section['columns'] as $colomn_key=>$colomns ){

                $elemetor_widgets = []; 
                
                foreach ( $colomns['elements'] as $widgets_key => $widgets ) {
                    
                    
                    $elemetor_widgets[$widgets_key] = [
                        'id' => $widgets['id'],
                        'elType' => 'widget',
                        'settings' => [
                            'subtitle' => $widgets['subtitle'],
                            'title' => $widgets['title'],
                            'modal_button_text' => $widgets['modal_button_text'],
                            'scroll_y' => $widgets['scroll_y'],
                        ],
                        'widgetType' => $widgets['acf_fc_layout'],
                    ];
                }
                
                $elemetor_colomns[$colomn_key] = [

                    'id' => $colomns['columns_id'],
                    'elType' => 'column',
                    'settings' => [
                                //'_column_size' => $colomns['field_628c00dbd5151'],
                                '_inline_size' => $colomns['width'],
                                'column_sticky_offset' => 50,
                                'scroll_y' => -80,
                                'elements' => $elemetor_widgets,
                    ],
                    'isInner' => '',
                ];

            }
            $elemetor_sections[$row_key]= 
                [
                    'id' => $section['section_id'],
                    'elType' => 'section',
                    'elements' => $elemetor_colomns,
                ];

        }

        $new_elementor_data = $elemetor_sections;

        $old_elementor_data = get_post_meta( $post_id, '_elementor_data', TRUE );
        $old_elementor_data = json_decode($old_elementor_data , TRUE);

        $updated_elementor_data = [];
        
        
       // $updated_elementor_data = array_replace_recursive( $old_elementor_data, $new_elementor_data );
        $updated_elementor_data = array_merge_recursive( $old_elementor_data, $new_elementor_data );
        

        echo "<pre>";
        echo prr_html( $updated_elementor_data);
        echo "</pre>";
        
        wp_die();
        
        // We need the `wp_slash` in order to avoid the unslashing during the `update_post_meta`
		//$json_value = wp_slash( wp_json_encode( $updated_elementor_data ) );

		// Don't use `update_post_meta` that can't handle `revision` post type
		//$is_meta_updated = update_metadata( 'post', $post_id, 'updated_elementor_data', $json_value );
     
      } // End If is not empty acf row .

    }

    public function _generate_random_string()
    {
        return dechex( rand() );
    }
    

    /**
     * _acf_pb_load_fields function
     *
     * @param [type] $value
     * @param [type] $post_id
     * @param [type] $field
     * @return value
     */
    public function _acf_pb_load_fields($value, $post_id, $field){

        $elementor_data = get_post_meta( $post_id, '_elementor_data', TRUE );
        $elementor_data = json_decode($elementor_data , TRUE);
        
        // stop if there is no elementor data in the page .
        if ( count( $elementor_data ) === 0 ) {
            return;
        }

        //$value   = [];
        $sections = [];

        foreach ( $elementor_data as $section_key => $section_value ) {

            // empty the colomns array;
            $colomns = [];

            foreach ( $section_value['elements'] as $colomn_key => $colomn_value ) {

                $_column_size = $colomn_value['settings']['_inline_size'] > 0 ? $colomn_value['settings']['_inline_size'] : $colomn_value['settings']['_column_size'] ;

                // empty the widgets array;
                $widgets = [];    

                foreach ( $colomn_value['elements'] as $widget_key => $widget_value ) {
                    
                 // TODO: find way to cheack if keys exist.
                 if( $widget_value['elType'] == 'widget' ){ 

                    $widgets[$widget_key] = $this->load_acf_element_widgets( $widget_key, $widget_value );
                   
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
                  } 
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
            //$value = $sections;
       }

    //    echo prr_html( $value  );

        return $value;
        
    }
    
    /**
     * load_acf_element_widgets
     *
     * @param [type] $key
     * @param [type] $value
     * @return array/fields_key
     */
    public function load_acf_element_widgets( $key, $value ){
        
        // Get widget name from elementor data value.
        $widgetType = isset( $value['widgetType'] ) ? $value['widgetType'] : "";

        // Get our elements from acf layouts .
        // TODO: find way to cheack if keys exist.
        $elements = acf_get_fields('group_629aa7bfb1a3f')[0]['layouts'];

        // reset widget array . 
        $widget = [];

        // check if our element is not empty 1st .
        if( is_array( $elements ) && !empty( $elements ) ){
           
           foreach ($elements as $key => $element ) {
            
            // if acf element name match elmentor widget name continue .
            if( !empty($widgetType) ){
            //    var_dump($widgetType);
             if( $element['name'] ===  $widgetType  ){
                
                $widget['acf_fc_layout'] = $widgetType ;

               foreach ($element['sub_fields']  as $sub_fields_key => $sub_fields_value) {

                      $field_name = $sub_fields_value['name'];
                      $field_key  = $sub_fields_value['key'];
                      $field_type = $sub_fields_value['type'];
                      
                      // fixed acf Field types.
                      switch ( $field_type ) {

                          case 'image':
                            $widget[$field_key] = isset($value['settings'][$field_name]['id']) ? $value['settings'][$field_name]['id'] : '';
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

             } // End if ;

            } // End elements foreach. 
        
            return $widget;

        } // End Is_array .       
    }
     
}