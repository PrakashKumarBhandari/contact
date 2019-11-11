<?php
global $wpdb;
$table_name = $wpdb->prefix . "contact1234";
$my_products_db_version = '1.0.0';
$charset_collate = $wpdb->get_charset_collate();

if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {

    $sql = "CREATE TABLE $table_name (
            ID mediumint(9) NOT NULL AUTO_INCREMENT,
            `name` varchar 255,
            `email` varchar 255,
			`phone` varchar 255,
			`message` text,
			`post_date` datetime,
			`status` enum('0','1') 0,
            PRIMARY KEY  (ID))    $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    add_option( 'my_db_version', $my_products_db_version );
}
?>