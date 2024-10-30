<?php 
/*
    Plugin Name: Order Chat for WooCommerce
    Description: Enviar la lista del carrito por WhatsApp
    Tags: WhatsApp, Orders, WooCommerce, Cart, Cart WooComemrce
    Author: Miguel Fuentes
    Author URI: https://kodewp.com
    Version: 1.0
    Tested up to: 5.5.1
    Requires PHP: 7.0
    License: GPL v2 or later
*/

if (!defined('ABSPATH')) exit;

add_action( 'admin_menu', 'kwp_orders_WooCommerce_WhatsApp_add_admin_menu' );
add_action( 'admin_init', 'kwp_orders_WooCommerce_WhatsApp_settings_init' );

function kwp_orders_WooCommerce_WhatsApp_add_admin_menu(  ) {
    add_options_page( 'Woo Orders WhatsApp', 'Woo Orders WhatsApp', 'manage_options', 'settings-icons-chat', 'kwp_options_page_orders_WooCommerce_WhatsApp' );
}

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'kwp_plugin_page_settings_orders_WooCommerce_WhatsApp_link');
function kwp_plugin_page_settings_orders_WooCommerce_WhatsApp_link( $links ) {
	$links[] = '<a href="' . admin_url( 'options-general.php?page=settings-icons-chat' ) . '">' . __('Settings') . '</a>';
	return $links;
}

function kwp_orders_WooCommerce_WhatsApp_settings_init(  ) {
    register_setting( 'kwp_orders_WooCommerce_WhatsApp_plugin', 'kwp_orders_WooCommerce_WhatsApp_settings' );

    add_settings_section(
        'kwp_kwpPlugin_section', __( 'Carrito de Compras', 'wordpress' ),
        'kwp_orders_WooCommerce_WhatsApp_settings_section_callback',
        'kwp_orders_WooCommerce_WhatsApp_plugin'
    );

    add_settings_field(
        'kwp_orders_WooCommerce_WhatsApp_activate', __( 'Finalizar Compra', 'wordpress' ),
        'kwp_orders_WooCommerce_WhatsApp_activate',
        'kwp_orders_WooCommerce_WhatsApp_plugin',
        'kwp_kwpPlugin_section'
    );

    add_settings_field(
        'kwp_orders_WooCommerce_WhatsApp_Label_Button', __( 'Label Boton', 'wordpress' ),
        'kwp_orders_WooCommerce_WhatsApp_Label_Button',
        'kwp_orders_WooCommerce_WhatsApp_plugin',
        'kwp_kwpPlugin_section'
    );

    add_settings_field(
        'kwp_orders_WooCommerce_WhatsApp_Color_Button', __( 'Color Boton', 'wordpress' ),
        'kwp_orders_WooCommerce_WhatsApp_Color_Button',
        'kwp_orders_WooCommerce_WhatsApp_plugin',
        'kwp_kwpPlugin_section'
    );

    add_settings_field(
        'kwp_orders_WooCommerce_WhatsApp_Border_Radius', __( 'Border Radius', 'wordpress' ),
        'kwp_orders_WooCommerce_WhatsApp_Border_Radius',
        'kwp_orders_WooCommerce_WhatsApp_plugin',
        'kwp_kwpPlugin_section'
    );

    add_settings_field(
        'kwp_orders_WooCommerce_WhatsApp_numero', __( 'WhatsApp Numero', 'wordpress' ),
        'kwp_orders_WooCommerce_WhatsApp_numero',
        'kwp_orders_WooCommerce_WhatsApp_plugin',
        'kwp_kwpPlugin_section'
    );

    add_settings_field(
        'kwp_orders_WooCommerce_WhatsApp_message', __( 'WhatsApp Mensaje', 'wordpress' ),
        'kwp_orders_WooCommerce_WhatsApp_message',
        'kwp_orders_WooCommerce_WhatsApp_plugin',
        'kwp_kwpPlugin_section'
    );

}

function kwp_orders_WooCommerce_WhatsApp_activate() {
    $options = get_option( 'kwp_orders_WooCommerce_WhatsApp_settings' );
    $html = '<input type="checkbox" id="kwp_orders_WooCommerce_WhatsApp_activate" name="kwp_orders_WooCommerce_WhatsApp_settings[kwp_orders_WooCommerce_WhatsApp_activate]" value="1"' . checked( 1, $options['kwp_orders_WooCommerce_WhatsApp_activate'], false ) . '/>';
    $html .= '<label for="kwp_orders_WooCommerce_WhatsApp_activate">Eliminar el boton "Finalizar Compra".</label>';
    echo $html;
}

function kwp_orders_WooCommerce_WhatsApp_Label_Button(  ) {
    $options = get_option( 'kwp_orders_WooCommerce_WhatsApp_settings' ); ?>
    <input type='text' class="regular-text" name='kwp_orders_WooCommerce_WhatsApp_settings[kwp_orders_WooCommerce_WhatsApp_Label_Button]' value='<?php echo $options['kwp_orders_WooCommerce_WhatsApp_Label_Button']; ?>'>
<?php
}

function kwp_orders_WooCommerce_WhatsApp_Color_Button(  ) {
    $options = get_option( 'kwp_orders_WooCommerce_WhatsApp_settings' ); ?>
    <input type="text" class="kwp-color-picker" data-alpha="true" data-default-color="#2ab200" name="kwp_orders_WooCommerce_WhatsApp_settings[kwp_orders_WooCommerce_WhatsApp_Color_Button]" value="<?php echo $options['kwp_orders_WooCommerce_WhatsApp_Color_Button']; ?>"/>

<?php
}

function kwp_orders_WooCommerce_WhatsApp_Border_Radius(  ) {
    $options = get_option( 'kwp_orders_WooCommerce_WhatsApp_settings' ); ?>
    <input type='number' class="small-text" name='kwp_orders_WooCommerce_WhatsApp_settings[kwp_orders_WooCommerce_WhatsApp_Border_Radius]' value='<?php echo $options['kwp_orders_WooCommerce_WhatsApp_Border_Radius']; ?>'> (solo agregar numeros)
<?php
}

function kwp_orders_WooCommerce_WhatsApp_numero(  ) {
    $options = get_option( 'kwp_orders_WooCommerce_WhatsApp_settings' ); ?>
    <input type='text' class="regular-text" name='kwp_orders_WooCommerce_WhatsApp_settings[kwp_orders_WooCommerce_WhatsApp_numero]' value='<?php echo $options['kwp_orders_WooCommerce_WhatsApp_numero']; ?>'>
<?php
}

function kwp_orders_WooCommerce_WhatsApp_message(  ) {
    $options = get_option( 'kwp_orders_WooCommerce_WhatsApp_settings' ); ?>
    <input type='text' class="regular-text" name='kwp_orders_WooCommerce_WhatsApp_settings[kwp_orders_WooCommerce_WhatsApp_message]' value='<?php echo $options['kwp_orders_WooCommerce_WhatsApp_message']; ?>'>
<?php
}

function kwp_orders_WooCommerce_WhatsApp_settings_section_callback(  ) {
    echo __( 'Configurar el boton para enviar la lista del carrito por WhatsApp. <hr>');
}

function kwp_options_page_orders_WooCommerce_WhatsApp(  ) {
    ?>
    <div class="wrap">
        <form action='options.php' method='post'>
            <h2>Configuración: Woo Orders WhatsApp</h2>
            <?php
            settings_fields( 'kwp_orders_WooCommerce_WhatsApp_plugin' );
            do_settings_sections( 'kwp_orders_WooCommerce_WhatsApp_plugin' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function kwp_orders_WooCommerce_WhatsAp_enqueue_color_picker() {
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'kwp_custom_js', plugins_url('assets/js/kwp_custom.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'kwp_orders_WooCommerce_WhatsAp_enqueue_color_picker' );

$kwp_WCW_checkbox = get_option('kwp_orders_WooCommerce_WhatsApp_settings');

add_action('woocommerce_proceed_to_checkout', 'kwp_orders_WooCommerce_WhatsAp_new_button');

function kwp_orders_WooCommerce_WhatsAp_new_button() {
    $options = get_option( 'kwp_orders_WooCommerce_WhatsApp_settings' );
    global $woocommerce; ?>
    <a href="https://api.whatsapp.com/send?phone=<?php echo $options['kwp_orders_WooCommerce_WhatsApp_numero'] ?>&text=<?php echo $options['kwp_orders_WooCommerce_WhatsApp_message'] ?>%0A%0A<?php 
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
        $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
        echo wc_get_formatted_cart_item_data( $cart_item );
        echo $cart_item['quantity']; ?> X <?php echo $product_name; ?> - <?php echo get_woocommerce_currency_symbol(); ?> <?php echo $_product->get_price();;
        echo '%0A%0A';
    }
    echo '*Total:* '; echo get_woocommerce_currency_symbol(); 
    echo $woocommerce->cart->total; ?>" target="_blank" class="checkout-button button alt wc-forward" id="btn_order_whatsapp">
    <img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/svg/whatsapp.svg'; ?>" width="40">
    <?php echo $options['kwp_orders_WooCommerce_WhatsApp_Label_Button'] ?>
    </a>
 <?php
}

add_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );

function kwp_orders_WooCommerce_WhatsAp_plugins_loaded_callback() {
    remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
}

if ( isset( $kwp_WCW_checkbox['kwp_orders_WooCommerce_WhatsApp_activate'] ) ) {
    add_action( 'plugins_loaded', 'kwp_orders_WooCommerce_WhatsAp_plugins_loaded_callback' );
} else {

}

add_action('wp_footer','kwp_clearListOrderWC', 20);

function kwp_clearListOrderWC() {
    
    $options = get_option( 'kwp_orders_WooCommerce_WhatsApp_settings' );

    global $woocommerce;
    
    if ( isset( $_GET['empty-cart'] ) ) {
        $woocommerce->cart->empty_cart(); 
    } ?>

    <script type="text/javascript">
        document.getElementById("btn_order_whatsapp").onclick = function () {
            setTimeout(function(){
                window.location="<?php echo $woocommerce->cart->get_cart_url(); ?>?empty-cart";
            }, 3000)
        };
    </script>
    <style>
        #btn_order_whatsapp{
            background: <?php echo $options['kwp_orders_WooCommerce_WhatsApp_Color_Button'] ?>;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: 0.3s;
            border: none !important;
            -webkit-border-radius: <?php echo $options['kwp_orders_WooCommerce_WhatsApp_Border_Radius'] ?>px;
            -moz-border-radius: <?php echo $options['kwp_orders_WooCommerce_WhatsApp_Border_Radius'] ?>px;
            border-radius: <?php echo $options['kwp_orders_WooCommerce_WhatsApp_Border_Radius'] ?>px;
        }
        #btn_order_whatsapp:hover{
            opacity: 0.9;
        }
        #btn_order_whatsapp:after{
            display: none;
        }
        #btn_order_whatsapp img{
            max-width: 40px;
            margin-right: 20px;
        }
        .widget_shopping_cart_content .button.checkout.wc-forward{
            display: none !important;
        }
    </style>
    <?php
}