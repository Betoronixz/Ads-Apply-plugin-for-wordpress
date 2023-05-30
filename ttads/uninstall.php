<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

global $wpdb;
$table_name = $wpdb->prefix . 'tt_ads';
$sql = "DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);

$table_name2 = $wpdb->prefix . 'analytics';
$sql2 = "DROP TABLE IF EXISTS $table_name2";
$wpdb->query($sql2);

$table_name3 = $wpdb->prefix . 'tt_cost';
$sql3 = "DROP TABLE IF EXISTS $table_name3";
$wpdb->query($sql3);

$table_name4 = $wpdb->prefix . 'my_ads_admin';
$sql4 = "DROP TABLE IF EXISTS $table_name4";
$wpdb->query($sql4);