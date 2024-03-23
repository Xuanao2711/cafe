<?php
/**
 * Flatsome functions and definitions
 *
 * @package flatsome
 */

require get_template_directory() . '/inc/init.php';

// Get the site URL
$site_url = get_site_url();

// Extract the domain name from the URL
$domain_name = wp_parse_url($site_url, PHP_URL_HOST);

$update_option_data = array(
    'id'           => 'new_id_123456',
    'type'         => 'PUBLIC',
    'domain'       => $domain_name, // Set the domain to the current domain name
    'registeredAt' => '2021-07-18T12:51:10.826Z',
    'purchaseCode' => 'abcd1234-5678-90ef-ghij-klmnopqrstuv',
    'licenseType'  => 'Regular License',
    'errors'       => array(),
    'show_notice'  => false
);

update_option('flatsome_registration', $update_option_data, 'yes');

flatsome()->init();

/**
 * It's not recommended to add any custom code here. Please use a child theme
 * so that your customizations aren't lost during updates.
 *
 * Learn more here: https://developer.wordpress.org/themes/advanced-topics/child-themes/
 */

function custom_product_info_color( $content ) {
    // Thay đổi màu của tên sản phẩm
    $name_color = '#4d8a54'; // Mã màu cho tên sản phẩm
    // Thay đổi màu của giá tiền
    $price_color = '#e4b95b'; // Mã màu cho giá tiền

    // Áp dụng màu cho tên sản phẩm
    $content = str_replace( '<a', '<a style="color: ' . $name_color . ';"', $content );
    // Áp dụng màu cho giá tiền
    $content = str_replace( '</span>', '</span><span style="color: ' . $price_color . ';">', $content );

    return $content;
}

// Hook để áp dụng filter cho tên sản phẩm và giá tiền
add_filter( 'woocommerce_loop_product_title', 'custom_product_info_color', 10, 1 );
add_filter( 'woocommerce_get_price_html', 'custom_product_info_color', 10, 1 );

