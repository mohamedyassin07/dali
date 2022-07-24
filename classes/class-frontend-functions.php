<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

/**
 * FrontEndFunctions
 */
class FrontEndFunctions {
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){
        add_filter( 'manage_edit-shop_order_columns', [ $this, 'add_custom_column' ], 1 );
        add_action( 'manage_shop_order_posts_custom_column' , [ $this, 'add_order_column_content' ], 11 );
    }
    
    /**
     * add_custom_column
     *
     * @param  mixed $columns
     * @return void
     */
    public function add_custom_column( $columns ){
        // to remove just use unset
        unset( $columns['order_number'] );
        unset( $columns['order_date'] );
        unset( $columns['Invoice'] );
        // unset( $columns['order_total'] );
        // unset( $columns['order_actions'] );
        $number = 1;
        // Add new column after $number column
    return array_slice( $columns, 0, $number, true )
    + array( 'number_column' => __( 'رقم الطلب', 'woocommerce' ) )
    + array( 'customer_column' => __( 'العميل', 'woocommerce' ) )
    + array( 'date_column' => __( 'تاريخ الطلب', 'woocommerce' ) )
    + array( 'date_mod_column' => __( 'تاريخ تعديل الطلب', 'woocommerce' ) )
    + array( 'shipping_column' => __( 'الشحن', 'woocommerce' ) )
    + array( 'payment_column' => __( 'الدفع', 'woocommerce' ) )
    + array( 'nots_column' => __( 'الملاحظات', 'woocommerce' ) )
    + array_slice( $columns, $number, NULL, true );
  
    }
    
    /**
     * add_order_column_content
     *
     * @param  mixed $column
     * @return void
     */
    public function add_order_column_content( $column ){

        global $post, $the_order;
        if ( empty( $the_order ) || $the_order->get_id() !== $post->ID ) {
            $the_order = wc_get_order( $post->ID );
        }
        $order_url = $the_order->get_edit_order_url();
         
        switch ( $column ) {
            
            case 'number_column':
            echo '<a href="'.$order_url.'">'.trim(str_replace('#', '',  $the_order->get_order_number())).'</a>';
            break;

            case 'customer_column':
            echo $the_order->get_formatted_billing_full_name();
            break;

            case 'date_column':
            echo  $the_order->get_date_created()->format( 'Y/m/d' );
            break;

            case 'date_mod_column':
            echo  get_the_modified_date('Y/m/d', $post->ID);
            break;

            case 'shipping_column':
            echo $the_order->get_shipping_method();
            break;

            case 'payment_column':
            echo $the_order->get_payment_method_title();
            break;

            case 'nots_column':
            echo '<a href="'.$order_url.'"><span class="dashicons dashicons-welcome-write-blog"></span></a?';
            break;
        }


    }   

}