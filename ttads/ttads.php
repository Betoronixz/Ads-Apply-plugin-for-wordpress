<?php
/*
 * Plugin Name:       TT Ads
 * Author:            Traffic Tail
 * Author URI:        https://traffictail.com/
 * Plugin URI:        https://traffictail.com/
 * Description:       
 */


if (!defined("ABSPATH")) {
    die("can't access");
}
function ttads_custom_stylesheet()
{
    // Enqueue your custom stylesheets from CDN
    wp_enqueue_style('feather2', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
    wp_enqueue_style("tt-cus-style", plugin_dir_url(__FILE__) . "assets/style.css");

    // Enqueue your custom scripts
    wp_enqueue_script('customsjs', plugin_dir_url(__FILE__) . "'assets/script.js'");
    wp_enqueue_script('boostjs', "https://code.jquery.com/jquery-3.2.1.slim.min.js");
    wp_enqueue_script('boostjs2', "https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js");
    wp_enqueue_script('boostjs3', "https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js");
}
add_action('wp_enqueue_scripts', 'ttads_custom_stylesheet');



function tt_selectively_enqueue_admin_script()
{
    if (isset($_GET['page']) && $_GET['page'] == 'ttads-form') {
        wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'assets/notice.css');

        wp_enqueue_script('jquery');
        wp_enqueue_style("font-awmw", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css");
        wp_enqueue_style("tt-cus-style", plugin_dir_url(__FILE__) . "assets/style.css");
        wp_enqueue_style('boostjsCS', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css");
        wp_enqueue_style('feather2', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
        wp_enqueue_style('tt-custom-style', plugin_dir_url(__FILE__) . 'assets/style.css');
        wp_enqueue_script('customjs', plugin_dir_url(__FILE__) . "'assets/script.js'");
    }
}
add_action('admin_enqueue_scripts', 'tt_selectively_enqueue_admin_script');
// Register activation hook
register_activation_hook(__FILE__, 'ttads_create_table');

function ttads_create_table()
{
    // Get global $wpdb object
    global $wpdb;

    // Set table name and create SQL query
    $table_name = $wpdb->prefix . 'tt_ads';
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                des VARCHAR(255) NOT NULL,
                date DATE,
                place VARCHAR(255),
                address VARCHAR(255) NOT NULL,
                mobile VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                status VARCHAR(255) NOT NULL,
                wtp VARCHAR(255) NOT NULL,
                wfp VARCHAR(255) NOT NULL,
                yt VARCHAR(255) NOT NULL,
                ap VARCHAR(255) NOT NULL,
                fb VARCHAR(255) NOT NULL,
                image VARCHAR(255) NOT NULL,
                ps VARCHAR(255) NOT NULL
            );";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    $table_name4 = $wpdb->prefix . 'my_ads_admin';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name4'") != $table_name4) {
        $sql4 = "CREATE TABLE $table_name4 (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_card_image  VARCHAR(255)
    );
    ";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql4);
    }


    // Set table name and create SQL query
    $table_name2 = $wpdb->prefix . 'analytics';
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name2'") != $table_name2) {
        $sql2 = "CREATE TABLE IF NOT EXISTS $table_name2 (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            subscriber INT(11) NOT NULL,
            youtube_daily_views INT(11) NOT NULL,
            website_daily_views INT(11) NOT NULL,
            website_weekly_views INT(11) NOT NULL,
            android_daily_views INT(11) NOT NULL,
            android_weekly_views INT(11) NOT NULL,
            fb_daily_views INT(11) NOT NULL,
            fb_page_likes INT(11) NOT NULL
        );";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql2);
    }

    if ($wpdb->get_var("SELECT COUNT(*) FROM $table_name2") == 0) {
        $wpdb->insert($table_name2, array(
            'subscriber' => 0,
            'youtube_daily_views' => 0,
            'website_daily_views' => 0,
            'website_weekly_views' => 0,
            'android_daily_views' => 0,
            'android_weekly_views' => 0,
            'fb_daily_views' => 0,
            'fb_page_likes' => 0
        ));
    }

    $table_name3 = $wpdb->prefix . 'tt_cost';
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name3'") != $table_name3) {
        $sql3 = "CREATE TABLE $table_name3 (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            wtp1w VARCHAR(255),
            wtp1m VARCHAR(255),
            wtp1y VARCHAR(255),
            wfp1w VARCHAR(255),
            wfp1m VARCHAR(255),
            wfp1y VARCHAR(255),
            yt3s VARCHAR(255),
            yt60s VARCHAR(255),
            aa1w VARCHAR(255),
            aa1m VARCHAR(255),
            aa1y VARCHAR(255),
            fb1w VARCHAR(255),
            fb1m VARCHAR(255),
            fb1y VARCHAR(255)
          );
          ";
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql3);
    }

    if ($wpdb->get_var("SELECT COUNT(*) FROM $table_name3") == 0) {
        $wpdb->query("INSERT INTO $table_name3 (wtp1w, wtp1m, wtp1y, wfp1w, wfp1m, wfp1y, yt3s, yt60s, aa1w, aa1m, aa1y, fb1w, fb1m, fb1y) VALUES ('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')");
    }
}


// adding on menu
add_action("admin_menu", "add_ttads_custom_menu");
function add_ttads_custom_menu()
{
    add_menu_page(
        "Tt ads",
        "TT-Ads-Form",
        "manage_options",
        "ttads-form",
        "ttadsform",
        "dashicons-index-card",
        6
    );
}


function ttadsform()
{

    include plugin_dir_path(__FILE__) . 'dashboard.php';
}

function my_custom_shortcode($atts)
{
    global $wpdb;

    $atts = shortcode_atts(array(
        'id' => 0,
    ), $atts);

    $table_name = $wpdb->prefix . 'tt_ads';

    $row = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $atts[id]");

    if (!$row) {
        return ''; // Return an empty string if the row is not found
    }

    $output = '<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="' . wp_upload_dir()['url'] . '/' . basename($row->image) . '" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">' . $row->title . '</h5>
      <p class="card-text"></p>
     
    </div>
  </div>';
    return $output;
}
add_shortcode('my_custom_shortcode', 'my_custom_shortcode');

include plugin_dir_path(__FILE__) . 'adsform.php';
include plugin_dir_path(__FILE__) . 'details.php';
