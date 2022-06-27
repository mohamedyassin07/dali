<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * Class Sub_Site_Dashboard
 *
 * This class contains repetitive functions that
 * are used create the store site dashboard
 *
 * @package		DALI
 * @subpackage	Classes/Sub_Site_Dashboard
 * @author		Mohamed Yassin
 * @since		1.0.0
 */

class Sub_Site_Dashboard
{    
    /**
     * main_dashboard
     *
     * @var mixed
     */
    public $main_dashboard;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->main_dashboard = 'dali_subsite_main_dashboard';
        
        add_action( 'init', array( $this, 'add_options_pages' ) );
        add_action( 'plugins_loaded', array( $this, 'add_main_dashboard_fields' ) );
        add_action( 'acf/save_post', array( $this, 'save_wp_settings' ) ) ;
        add_action( 'acf/save_post', array( $this, 'save_theme_settings' ) ) ; 
        add_filter( 'wp_frontend_admin/admin_css', array( $this ,  'add_css'), 10 , 2 );  
        
        add_filter( 'admin_body_class', array( $this ,  'add_unique_body_class' ) ,  10 ,  1 );
            
        // add_filter( 'acf/update_value/key=field_628911712e54833', array( $this, 'save_available_widgets_to_json' ), 10, 4 );
    }
    
    /**
     * save_available_widgets_to_json
     *
     * @param  mixed $value
     * @param  mixed $post_id
     * @param  mixed $field
     * @param  mixed $original
     * @return void
     */
    public function save_available_widgets_to_json( $value, $post_id, $field, $original  )
    {
        //remote_prr($_REQUEST['acf'] );
        return null;
    }
    
    /**
     * add_options_pages
     *
     * @return void
     */
    public function add_options_pages()
    {
        if( function_exists('acf_add_options_page') ) {

            acf_add_options_page(array(
                'menu_title' 	=> __( 'Dali Dashboard' , 'dali' ),
                'page_title'	=> __( 'Dali Dashboard' , 'dali' ),
                'menu_slug' 	=> 'dali_dashboard',
                'post_id'       => 'dali_dashboard',
                'redirect'		=> false
            ));

            acf_add_options_page(array(
                'menu_title' 	=> __( 'Dali WP Settings' , 'dali' ),
                'page_title'	=> __( 'Dali WP Settings' , 'dali' ),
                'menu_slug' 	=> 'dali_wp_settings',
                'post_id'       => 'dali_wp_settings',
                'parent_slug'   => 'dali_dashboard',
                'redirect'		=> false
            ));            

            acf_add_options_page(array(
                'menu_title' 	=> __( 'Dali Theme Settings' , 'dali' ),
                'page_title'	=> __( 'Dali theme Settings' , 'dali' ),
                'menu_slug' 	=> 'dali_theme_settings',
                'post_id'       => 'dali_theme_settings',
                'parent_slug'   => 'dali_dashboard',
                'redirect'		=> false
            )); 
            acf_add_options_page(array(
                'menu_title' 	=> __( 'Dali Pages Settings' , 'dali' ),
                'page_title'	=> __( 'Dali Pages Settings' , 'dali' ),
                'menu_slug' 	=> 'dali_pages_settings',
                'post_id'       => 'dali_pages_settings',
                'parent_slug'   => 'dali_dashboard',
                'redirect'		=> false
            ));            

        }
    }
    
    /**
     * add_main_dashboard_fields
     *
     * @return void
     */
    public function add_main_dashboard_fields(){
        
        $fields = array_merge(
            $this->wordpress_options_tab_fields(),
            $this->theme_options_tab_fields(),
            $this->frontend_admin_css_tab_fields(),
            $this->get_page_components_tab_fields(),
            $this->enable_elementor_components_tab_fields(),
            $this->ckeck_acf_fields_name(),
            $this->dali_site_dashboard_page_id(), 
            $this->get_pages_to_edit_ids_tab(), 
        );

        $fields_group = array(
            'key' => 'group_623c9acf9c15d',
            'title' => 'tabs',
            'fields' => $fields,
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'dali_dashboard',
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
     * wordpress_options_tab_fields
     *
     * @return void
     */
    public function wordpress_options_tab_fields()
    {
        $wp_options =  wp_load_alloptions();
        $wp_options = prr_html( $wp_options );

        return array(
            array(
                'key' => 'field_623c9aecf75b5',
                'label' => 'WordPress Options',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_623c9b40f75b8',
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
                'message' => $wp_options,
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
        );
    }
    
    /**
     * theme_options_tab_fields
     *
     * @return void
     */
    public function theme_options_tab_fields()
    {
        $theme_options = get_option( 'xts-woodmart-options' );
        $theme_options = prr_html( $theme_options );

        return array(
            array(
                'key' => 'field_623c9b39f75b7',
                'label' => 'Theme Options',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_623c9afcf75b6',
                'label' => '',
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
                'message' => $theme_options,
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
        );
    }

    public function frontend_admin_css_tab_fields()
    {
        return array(
            array(
                'key' => 'field_623c9b39f2323',
                'label' => 'Frontend Admin Css',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_6211853728847',
                'label' => 'General CSS',
                'name' => 'general_css',
                'type' => 'textarea',
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
                'mode' => 'css',
                'lines' => 1,
                'indent_unit' => 4,
                'maxlength' => '',
                'rows' => 30,
                'max_rows' => '',
                'return_entities' => 0,
            ),
            array(
                'key' => 'field_629c21b092e37',
                'label' => 'Show Id',
                'name' => 'show_id',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'hide_admin' => 0,
                'message' => '',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_629c1eba92e34',
                'label' => 'Custom Css',
                'name' => 'custom_css',
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
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_629c216f92e35',
                        'label' => 'ID',
                        'name' => 'id',
                        'type' => 'number',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '10',
                            'class' => '',
                            'id' => '',
                        ),
                        'hide_admin' => 0,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                    array(
                        'key' => 'field_629c218992e36',
                        'label' => 'css',
                        'name' => 'css',
                        'type' => 'textarea',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '90',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'mode' => 'css',
                        'lines' => 1,
                        'indent_unit' => 4,
                        'maxlength' => '',
                        'rows' => 3,
                        'max_rows' => '',
                        'return_entities' => 0,
        



                    ),
                ),
            ),
        );
    }
    
    /**
     * get_page_components_tab_fields
     *
     * @return void
     */
    public function get_page_components_tab_fields()
    {
        $dali_checked_page = get_option( 'dali_dashboard_dali_checked_page' );
        $elementor_data = json_decode(  get_post_meta( $dali_checked_page , '_elementor_data' ,  true ) ,  true );
        $elementor_data = prr_html( $elementor_data );

        return array(
            array(
                'key' => 'field_623c9b39f75b8',
                'label' => 'Get A Page Elementor Components',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_624da77f1dd3c',
                'label' => 'choose the page and click update to get the new page data',
                'name' => 'dali_checked_page',
                'type' => 'post_object',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'page',
                ),
                'taxonomy' => '',
                'allow_null' => 0,
                'multiple' => 0,
                'return_format' => 'id',
                'ui' => 1,
            ),
            array(
                'key' => 'field_623c9afcf75b8',
                'label' => '',
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
                'message' => $elementor_data,
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
        );
    }
    
    /**
     * available_elementor_widgets
     *
     * @return void
     */
    public static function available_elementor_widgets()
    {
        //  we can get the widgets from the previous url but it take too much time 
        // so we will make it manual now
        $widgets = file_get_contents( dali_path('assets/elementor_widgets.js') );
        return json_decode( $widgets , true );
    }
    
    /**
     * enable_elementor_components_tab_fields
     *
     * @return void
     */
    public function enable_elementor_components_tab_fields()
    {
        $subs = $this->elementor_widgets_control_fields();

        $fields =  array(
            array(
                'key' => 'field_623c9b39f75b9',
                'label' => 'Enable Elementor Components',
                'name' => ' 3',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_628911712e54833',
                'label' => 'Available Elementor Widgets',
                'name' => 'available_elementor_widgets',
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
                'sub_fields' => $subs
            ),
        );

        return $fields;
    }

    
    
    /**
     * elementor_widgets_control_fields
     *
     * @return void
     */
    public function elementor_widgets_control_fields()
    {
        $data = $this->available_elementor_widgets();
        $subs =  array();

        foreach ($data as $key => $field)
        {
            $name = name_from_key( $key );

            $subs[] = array(
                'key' => 'field_'.$key,
                'label' => $name,
                'name' => $key,
                'type' => 'group',
                //'instructions' => prr_html($field),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'hide_admin' => 0,
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_enable_'.$key,
                        'label' => 'Enable',
                        'name' => 'enable',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50%',
                            'class' => '',
                            'id' => '',
                        ),
                        'hide_admin' => 0,
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 1,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                    ),
                    array(
                        'key' => 'field_tabs_'.$key,
                        'label' => 'Tabs',
                        'name' => 'tabs',
                        'type' => 'checkbox',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_enable_'.$key,
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '50%',
                            'class' => '',
                            'id' => '',
                        ),
                        'hide_admin' => 0,
                        'choices' => $field['tabs_controls'],
                        'allow_custom' => 0,
                        'default_value' => array(
                        ),
                        'layout' => 'horizontal',
                        'toggle' => 0,
                        'return_format' => 'value',
                        'save_custom' => 0,
                    ),
                    array(
                        'key' => 'field_fields_'.$key,
                        'label' => 'fields',
                        'name' => 'fields',
                        'type' => 'repeater',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_enable_'.$key,
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'hide_admin' => 0,
                        'collapsed' => 'field_6292d642eee83',
                        'min' => 0,
                        'max' => 0,
                        'layout' => 'table',
                        'button_label' => '',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_6292d71e345b3',
                                'label' => 'Name',
                                'name' => 'name',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '30',
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
                                'key' => 'field_6292d71e38047',
                                'label' => 'Slug',
                                'name' => 'slug',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '30',
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
                                'key' => 'field_6292d71e3bb18',
                                'label' => 'Type',
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
                                'hide_admin' => 0,
                                'choices' => array(
                                    'type1' => 'Type1',
                                    'type2' => 'Type2',
                                ),
                                'default_value' => false,
                                'allow_null' => 0,
                                'multiple' => 0,
                                'ui' => 0,
                                'return_format' => 'value',
                                'ajax' => 0,
                                'placeholder' => '',
                            ),
                        ),
                    ),
                ),
            );
        
        }
        

        return $subs;
    }
    
    /**
     * ckeck_acf_fields_name
     *
     * @return void
     */
    public function ckeck_acf_fields_name()
    {
        return array(
            array(
                'key' => 'field_623c9b39f1111',
                'label' => 'Acf Checkbox',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_6211853711111',
                'label' => 'acf PageBuilder Checkbox field name.',
                'name' => 'acf_check_box',
                'type' => 'textarea',
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
                'mode' => 'css',
                'lines' => 1,
                'indent_unit' => 4,
                'maxlength' => '',
                'rows' => 30,
                'max_rows' => '',
                'return_entities' => 0,
            ),
        );
    }
     
     /**
      * dali_site_dashboard_page_id
      *
      * @return void
      */
     public function dali_site_dashboard_page_id()
     {
        
        return array(
            array(
                'key' => 'field_623c9b39f5656',
                'label' => 'User Dashboard Page',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_62b813a4cd9cc',
                'label' => 'User Dashboard Page',
                'name' => 'site_dashboard_page_id',
                'type' => 'post_object',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'page',
                ),
                'taxonomy' => '',
                'allow_null' => 0,
                'multiple' => 0,
                'return_format' => 'id',
                'ui' => 1,
            ),
        );
     }    

     public function get_pages_to_edit_ids_tab(){

        return array(
            array(
                'key' => 'field_623c9009f5656',
                'label' => 'Page To edit in dashboard',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array(
                'key' => 'field_62b81114cd9cc',
                'label' => 'User Dashboard Page',
                'name' => 'page_ids',
                'type' => 'post_object',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'page',
                ),
                'taxonomy' => '',
                'allow_null' => 0,
                'multiple' => 1,
                'return_format' => 'id',
                'ui' => 1,
            ),
        );
        
     }
     
    /**
     * save_wp_settings
     *
     * @param  mixed $post_id
     * @return void
     */
    public function save_wp_settings( $post_id )
    {
        if( $post_id !== 'dali_wp_settings'){
            return;
        }

        $fields = isset( $_REQUEST['acf'] ) ? $_REQUEST['acf'] : array();

        foreach ($fields as $key => $value) {
            $option = get_field_object( $key )['name'];
            update_option( $option, $value, true );
        }
        
        $_REQUEST['acf'] = [];
    }
    
    /**
     * save_theme_settings
     *
     * @param  mixed $post_id
     * @return void
     */
    public function save_theme_settings( $post_id )
    {
        if( $post_id !== 'dali_theme_settings'){
            return;
        }

        $fields = isset( $_REQUEST['acf'] ) ? $_REQUEST['acf'] : array();
        
        foreach ($fields as $key => $value) {
            $main_field         = get_field_object( $key );
            $main_field_name    = $main_field['name'];
            
            if( is_string( $value ) ){
                $this->update_theme_option( $main_field_name, $value );
            }elseif ( is_array($value) ) {
                $main_field_class   = $main_field['wrapper']['class'];
                $new_value = [];

                foreach ((array)$main_field['sub_fields'] as $sub_field ) {
                    $new_value[ $sub_field['name'] ] = $value[ $sub_field['key'] ];
                }

                if ( $main_field_class == 'dali-associative-array' ) {
                    $this->update_theme_option( $main_field_name, $new_value );
                }elseif ( $main_field_class == 'dali-nested-array' ) {
                    $this->update_theme_option( $main_field_name, array( $new_value) );
                }

            }
        }

        $_REQUEST['acf'] = [];
    }
    
    /**
     * update_theme_option
     *
     * @param  mixed $option
     * @param  mixed $value
     * @return void
     */
    public function update_theme_option( $option, $value )
    {
        $options = get_option( 'xts-woodmart-options' );

        if( isset ( $options[$option]) ){
            $options[$option] = $value;
            update_option( 'xts-woodmart-options', $options, true );
        }
    }

	/**
	 * add_admin_css
     * Outputs CSS as header links and/or inline header styles
	 *
	 * @return void
	 */
	public function add_admin_css()
    {
        return;

        global $wp_styles;

        $css = get_option('dali_dashboard_dali_admin_css', true);

		if ( $css ) {
			$css .= "\n";
		}

		/**
		 * Filters the CSS that should be added directly to all admin pages.
		 *
		 * @since 1.0
		 *
		 * @param string $files CSS code (without `<style>` tag).
		 */
		$css = trim( apply_filters( 'dali_add_admin_css', $css ) );

		if ( $css ) {
			echo "
			<style>
			$css
			</style>
			";
		}
	}
        
    /**
     * add_css
     *
     * @param  mixed $admin_css
     * @param  mixed $source_id
     * @return void
     */
    public function add_css( $admin_css , $source_id = null )
    {
        if( get_field( 'show_id' , 'dali_dashboard' ) == 1 ) {
            echo "this css id is  "  . $source_id;
        }

        $admin_css .= get_field( 'general_css', 'dali_dashboard' );

        $custom = get_field( 'custom_css', 'dali_dashboard' );
        foreach ((array)$custom as $css) {
            if( isset( $css['id'] ) && $css['id'] == $source_id ){
                $admin_css .= $css['css'];
                return $admin_css;
            }
        }

        return $admin_css;
    }
    
    /**
     * add_unique_body_class
     *
     * @param  mixed $classes
     * @return void
     */
    public function add_unique_body_class( $classes )
    {
        $screen = get_current_screen();
        $class = $screen->id . '-' .  ( $screen->base == '' ? 'base' : $screen->base )  . '-' . ( $screen->action == '' ? 'base' : $screen->action );
        return $classes . ' ' . $class . ' ';
    }
    
}