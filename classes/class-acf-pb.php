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
       add_action('acf/init', array( $this,'add_page_builder_fields_group') );

        // convert acf field to elmentor ele .
        // add_action( 'acf/save_post', array( $this, 'save_acf_to_elementor' ) ) ;
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
           update_post_meta( $post_id, '_elementor_version', ELEMENTOR_VERSION );
        }
        //-- if PRO version of Elementor plugin is installed
        if( defined( 'ELEMENTOR_PRO_VERSION' ) ){
            update_post_meta( $post_id, '_elementor_pro_version', ELEMENTOR_PRO_VERSION );
        }

        //-- for Elementor
        update_post_meta( $post_id, '_elementor_edit_mode', 'builder' );
        update_post_meta( $post_id, '_elementor_template_type', 'wp-page' );
        
        //-- Elementor data in json formate .
        $_elementor_data = [];
        
        $field_acf_rows = get_field('field_acf_rows', get_the_ID());

        // foreach( $field_acf_rows as $section ){
        //     $_data[]= 
        //         [
        //             'id' => $this->_generate_random_string(),
        //             'elType' => 'section',
        //         ];

        // }
        // $_elementor_data = [
		// 	[
        //         //foreach section .
		// 		'id' => $this->_generate_random_string(),
		// 		'elType' => 'section',
		// 		'elements' => [

        //             //foreach column .
		// 			[
		// 				'id' => $this->_generate_random_string(),
		// 				'elType' => 'column',
        //                 'settings' => [
        //                             '_column_size' => 33,
        //                             '_inline_size' => '',
        //                             'column_sticky_offset' => 50,
        //                             'scroll_y' => -80,
        //                 ],
        //                 //foreach widgets .
		// 				'elements' => [
		// 					[
		// 						'id' => $this->_generate_random_string(),
		// 						'elType' => $widget_type::get_type(),
		// 						'widgetType' => $widget_type->get_name(),
		// 						'settings' => [
        //                             'subtitle' => '',
        //                             'title' => 'Add Your Heading Text Here',
        //                             'modal_button_text' => 'Open Modal',
        //                             'scroll_y' => -80,
        //                         ],
		// 					],
		// 				],
		// 			],
		// 		],
		// 	],
		// ];
       
        $field_acf_rows = get_field('field_acf_rows', get_the_ID());
        
        foreach ( $section['columns'] as $column ){

            foreach ( $column['elements']  as $widget ) {
                
                $_widget_elements[] = [
                    'id' => dechex( rand() ),
                    'elType' => 'widget',
                    'widgetType' => $widget['acf_fc_layout'],
                    'settings' => [
                        'subtitle' => $widget['subtitle'],
                        'title' => $widget['title'],
                        'modal_button_text' => 'Open Modal',
                        'scroll_y' => $widget['scroll_y'],
                    ],
                ];
            }
            
            
            
            $_column_elements[] = 

            //foreach column .
            [
                'id' => dechex( rand() ),
                'elType' => 'column',
                'settings' => [
                            '_column_size' => $column['width'],
                            '_inline_size' => $column['width'],
                            'column_sticky_offset' => 50,
                            'scroll_y' => -80,
                ],
                //foreach widgets .
                'elements' => $_widget_elements,
            ];
        }
		foreach( $field_acf_rows as $section ){		
				$_elementor_data []= [					
						//foreach section .
						'id' => dechex( rand() ),
						'elType' => 'section',
						'elements' => $_column_elements
				];
				

		}

        // We need the `wp_slash` in order to avoid the unslashing during the `update_post_meta`
		$json_value = wp_slash( wp_json_encode( $_elementor_data ) );

		// Don't use `update_post_meta` that can't handle `revision` post type
		$is_meta_updated = update_metadata( 'post', $post_id, '_elementor_data', $json_value );

    }

    public function _generate_random_string()
    {
        return dechex( rand() );
    }

}