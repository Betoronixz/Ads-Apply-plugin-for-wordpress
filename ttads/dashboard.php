<?php
if (!defined("ABSPATH")) {
    die("can't access");
}
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

global $wpdb;
$table_name = $wpdb->prefix . "analytics";
$result = $wpdb->get_results("SELECT * FROM $table_name LIMIT 1");
// check if data exists

$r = $result[0];
?>

<div>
    <div class="wrapper">
        <input type="checkbox" id="btn">
        <label for="btn" class="menu-btn">
            <i class="fas fa-bars"></i>
            <i class="fas fa-times"></i>
        </label>
        <nav id="sidebar">
            <div class="title">
                <a href="https://traffictail.com/"><img src="https://traffictail.com/wp-content/uploads/2022/10/tt-logo.png" width="150px" alt="">
                </a>
            </div>
            <ul class="list-items">
                <li><a href="#" data-target="#setup-details"><i class="fas fa-home"></i>Setup Details</a></li>
                <li><a href="#" id="ap" data-target="#ads-applied"><i class="fas fa-sliders-h"></i>Ads Applied</a></li>
                <li><a href="#" id="tt_upcost" data-target="#ttcost"><i class="fas  fa-money-bill-1-wave"></i>Cost setup</a></li>
                <li><a href="#" data-target="#shortcode"><i class="fas fa-address-book"></i>Shortcode</a></li>
                <li><a href="#" id="qr" data-target="#setting"><i class="fas fa-cog"></i>Settings</a></li>

            </ul>
        </nav>
    </div>

    <div class="content">
        <div id="setup-details" class="section">
            <h1 class="text-center">Setup for Details </h1>
            <form method="POST" action="" class="container mt-3 ">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subscriber">Subscribers on YouTube</label>
                            <input type="text" class="form-control" value="<?php echo $r->subscriber; ?>" id="subscriber" name="subscriber" placeholder="Enter number of subscribers">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website-1day">Website 1 day views</label>
                            <input type="text" class="form-control" value="<?php echo $r->website_daily_views; ?>" id="website-1day" name="website-1day" placeholder="Enter number of views">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website-1day">YouTube daily views</label>
                            <input type="text" class="form-control" value="<?php echo $r->youtube_daily_views; ?>" id="youtube_daily_views" name="youtube_daily_views" placeholder="Enter number of views on Youtube">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website-1week">Website 1 week views</label>
                            <input type="text" class="form-control" value="<?php echo $r->website_weekly_views; ?>" id="website-1week" name="website-1week" placeholder="Enter number of views">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="android-daily">Android app daily views</label>
                            <input type="text" class="form-control" value="<?php echo $r->android_daily_views; ?>" id="android-daily" name="android-daily" placeholder="Enter number of views">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="android-weekly">Android app weekly views</label>
                            <input type="text" class="form-control" value="<?php echo $r->android_weekly_views; ?>" id="android-weekly" name="android-weekly" placeholder="Enter number of views">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fb-daily-views">Facebook daily views</label>
                            <input type="text" class="form-control" value="<?php echo $r->fb_daily_views; ?>" id="fb-daily-views" name="fb-daily-views" placeholder="Enter number of views">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fb-page-likes">Facebook page likes</label>
                            <input type="text" class="form-control" value="<?php echo $r->fb_page_likes; ?>" id="fb-page-likes" name="fb-page-likes" placeholder="Enter number of likes">
                        </div>
                    </div>
                </div>
                <button type="submit" name="dsubmit" class="btn btn-primary btn-lg btn-block">Submit</button>
            </form>
        </div>
        <div id="ads-applied" class="section">
        <?php
           
           function my_custom_list_table()
           {
               global $wpdb;

               $table_name = $wpdb->prefix . 'tt_ads';

               if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
                   $id = $_GET['id'];
                   $wpdb->delete($table_name, array('id' => $id));
               }

               // Handle update request
               // Handle update request
               if (isset($_POST['usubmit'])) {
                   $id = $_POST['id'];
                   $status = $_POST['status'];
                   if ($status == 'rejected') {
                       $wpdb->delete($table_name, array('id' => $id));
                   } else {
                       $wpdb->update(
                           $table_name,
                           array('status' => $status),
                           array('id' => $id)
                       );
                   }
                   echo '<script>setTimeout(function() { document.querySelector("#ap").click(); }, 500);</script>';
               }
               $data = $wpdb->get_results("SELECT * FROM $table_name");

               echo '<table class="wp-list-table widefat fixed striped">';
               echo '<thead><tr><th>Title</th><th>Description</th><th>Date</th><th>Place</th><th>Address</th><th>Mobile</th><th>Paymnet Screenshot</th><th>Email</th><th>Applied ads</th><th>Image</th><th>Shortcode</th> <th>Status</th></tr></thead>';
               echo '<tbody>';

               foreach ($data as $row) {
                   echo '<tr>';
                   echo '<td>' . $row->title . '</td>';
                   echo '<td>' . $row->des . '</td>';
                   echo '<td>' . $row->date . '</td>';
                   echo '<td>' . $row->place . '</td>';
                   echo '<td>' . $row->address . '</td>';
                   echo '<td>' . $row->mobile . '</td>';
                   echo '<td><a href="'. wp_upload_dir()['url'] . '/' . basename($row->ps) .'" download>Download</a></td>';
                   echo '<td>' . $row->email . '</td>';
                   echo '<td>';
                   if (isset($row->wtp) && !empty($row->wtp)) {
                       $wtp_text = '';
                       switch ($row->wtp) {
                           case '1w':
                               $wtp_text = '1 week';
                               break;
                           case '1m':
                               $wtp_text = '1 month';
                               break;
                           case '1y':
                               $wtp_text = '1 year';
                               break;
                           default:
                               $wtp_text = $row->wtp;
                               break;
                       }
                       echo 'Website Top Ads: ' . $wtp_text . '<hr>';
                   }
                   
                   if (isset($row->wfp) && !empty($row->wfp)) {
                       $wfp_text = '';
                       switch ($row->wfp) {
                           case '1w':
                               $wfp_text = '1 week';
                               break;
                           case '1m':
                               $wfp_text = '1 month';
                               break;
                           case '1y':
                               $wfp_text = '1 year';
                               break;
                           default:
                               $wfp_text = $row->wtp;
                               break;
                       }
                       echo 'Website footer Ads: ' . $wfp_text . '<hr>';
                   }
                   if (isset($row->yt) && !empty($row->yt)) {
                       $yt_text = '';
                       switch ($row->yt) {
                           case '1w':
                               $yt_text = '3 Sec';
                               break;
                           case '1m':
                               $yt_text = '60 Sec';
                               break;
                           
                           default:
                               $yt_text = $row->yt;
                               break;
                       }
                       echo 'Youtube Ads: ' . $yt_text . '<hr>';
                   }
                   if (isset($row->ap) && !empty($row->ap)) {
                       $ap_text = '';
                       switch ($row->ap) {
                           case '1w':
                               $ap_text = '1 week';
                               break;
                           case '1m':
                               $ap_text = '1 month';
                               break;
                           case '1y':
                               $ap_text = '1 year';
                               break;
                           default:
                               $ap_text = $row->ap;
                               break;
                       }
                       echo 'Android App Ads: ' . $ap_text . '<hr>';
                   }
                   if (isset($row->fb) && !empty($row->fb)) {
                       $fb_text = '';
                       switch ($row->fb) {
                           case '1w':
                               $fb_text = '1 week';
                               break;
                           case '1m':
                               $fb_text = '1 month';
                               break;
                           case '1y':
                               $fb_text = '1 year';
                               break;
                           default:
                               $fb_text = $row->fb;
                               break;
                       }
                       echo 'Facebook Ads: ' . $fb_text . '<hr>';
                   }
                   echo '</td>';
                   
                   echo '<td><img src="' . wp_upload_dir()['url'] . '/' . basename($row->image) . '" width="50px"></td>';
                   echo '<td>[my_custom_shortcode id="' . $row->id . '"]</td>';
                   echo '<td> <form method="POST">';
                   echo '<select name="status"  style="width: 70px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">';
                   echo '<option value="pending" ' . ($row->status == "pending" ? 'selected' : '') . '>Pending</option>';
                   echo '<option value="approved" ' . ($row->status == "approved" ? 'selected' : '') . '>Approved</option>';
                   echo '<option value="rejected" ' . ($row->status == "rejected" ? 'selected' : '') . '>Rejected</option>';
                   echo '</select>';
                   echo '<input type="hidden" name="id" value="' . $row->id . '">';
                   echo '<input type="submit" data-target="#ads-applied" class="ttup" name="usubmit" value="Update">';
                   echo '</form></td>';
                   echo '</tr>';
               }


               echo '</tbody>';
               echo '</table>';
           }

           add_shortcode('my_custom_list_table', 'my_custom_list_table');

           my_custom_list_table();

           ?>
            </form>
        </div>
        <div id="shortcode" class="section">
            <h5>Short code for form is [TT-ADS]</h5>
            <h5>Short code for details is [TT-details]</h5>
        </div>
        <div id="ttcost" class="section">
            <h1>Cost Setup</h1>
            <?php
            $table_name2 = $wpdb->prefix . "tt_cost";
            $result = $wpdb->get_results("SELECT * FROM $table_name2 LIMIT 1");
            // check if data exists

            $r2 = $result[0];
            ?>
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Website Header 1 Week cost</label>
                            <input type="text" value="<?php echo $r2->wtp1w; ?>" class="form-control" name="wtp1w">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Website Header 1 Month cost</label>
                            <input type="text" value="<?php echo $r2->wtp1m; ?>" class="form-control" name="wtp1m">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Website Header 1 year cost</label>
                            <input type="text" value="<?php echo $r2->wtp1y; ?>" class="form-control" name="wtp1y">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Website Footer 1 Week cost</label>
                            <input type="text" value="<?php echo $r2->wfp1w; ?>" class="form-control" name="wfp1w">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Website Footer 1 Month cost</label>
                            <input type="text" value="<?php echo $r2->wfp1m; ?>" class="form-control" name="wfp1m">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Website Footer 1 year cost</label>
                            <input type="text" value="<?php echo $r2->wfp1y; ?>" class="form-control" name="wfp1y">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Youtube 3 Sec Bamner</label>
                            <input type="text" value="<?php echo $r2->yt3s; ?>" class="form-control" name="yt3s">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Youtube 60 Sec Video</label>
                            <input type="text" value="<?php echo $r2->yt60s; ?>" class="form-control" name="yt60s">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Andorid App 1 week cost</label>
                            <input type="text" value="<?php echo $r2->aa1w; ?>" class="form-control" name="aa1w">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Andorid App 1 Month cost</label>
                            <input type="text" value="<?php echo $r2->aa1m; ?>" class="form-control" name="aa1m">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Andorid App 1 Year cost</label>
                            <input type="text" value="<?php echo $r2->aa1y; ?>" class="form-control" name="aa1y">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Facebook 1 week cost</label>
                            <input type="text" class="form-control" value="<?php echo $r2->fb1w; ?>" name="fb1w">
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Facebook 1 Month cost</label>
                            <input type="text" class="form-control" value="<?php echo $r2->fb1m; ?>" name="fb1m">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="android-weekly">Facebook 1 Year cost</label>
                            <input type="text" value="<?php echo $r2->fb1y; ?>" class="form-control" name="fb1y">
                        </div>
                    </div>
                </div>
                <button type="submit" name="costsubmit" class="btn btn-primary btn-lg btn-block">Submit</button>
            </form>
        </div>
        <div id="setting" class="section">
            <form action="" class="mt-5" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="h6" for="name">Upload QR Image:</label>
                        <input type="file" accept=".jpg,.jpeg,.png" name="id_card_image" class="form-control" required>
                    </div>
                </div>
                <input type="submit" value="Upload" name="idimage" class="btn btn-success btn-lg btn-block my-3" id="">
            </form>

            <?php if (isset($_POST["idimage"])) {
                global $wpdb;
                $id_card_image = $_FILES["id_card_image"];

                $id_card_image_path = "";
                if ($id_card_image["name"]) {
                    $upload_dir = plugin_dir_path(__FILE__);
                    $id_card_image_name = basename($id_card_image["name"]);
                    $id_card_image_path =
                        $upload_dir . "/" . $id_card_image_name;
                    move_uploaded_file(
                        $id_card_image["tmp_name"],
                        $id_card_image_path
                    );
                }

                // inserting image
                $table_name = $wpdb->prefix . "my_ads_admin";
                $wpdb->insert($table_name, [
                    "id_card_image" => $id_card_image_name,
                ]);
                echo '<script>setTimeout(function() { document.querySelector("#qr").click(); }, 500);</script>';
            } ?>
            <div class="idcard" style="margin-top: 30px;">
                <?php
                echo "<h4>Current image for QR</h4>";
                global $wpdb;
                // Get the ID card image from the database
                $table_name8 = $wpdb->prefix . "my_ads_admin"; // add prefix to table name
                $sql1 = "SELECT id_card_image FROM $table_name8 ORDER BY id DESC LIMIT 1"; // get the last row ordered by ID in descending order and limit the result to 1 row
                $result2 = $wpdb->get_results($sql1, ARRAY_A); // use get_results to get data as associative array
                if (!empty($result2)) {
                    $row2 = $result2[0]; // get first row from resultset
                    $id_card_image = $row2["id_card_image"];
                    echo '<img src="' .
                        plugin_dir_url(__FILE__) .
                        $id_card_image .
                        '"  width="500px">';
                } else {
                    echo "Please Upload image";
                }
                ?>
            </div>

        </div>
    </div>
</div>
<?php
if (isset($_POST["dsubmit"])) {
    // Get global $wpdb object
    global $wpdb;

    // Set table name
    $table_name = $wpdb->prefix . "analytics";

    // Get form data
    $subscriber = $_POST["subscriber"];
    $website_1day = $_POST["website-1day"];
    $website_1week = $_POST["website-1week"];
    $android_daily = $_POST["android-daily"];
    $android_weekly = $_POST["android-weekly"];
    $fb_daily_views = $_POST["fb-daily-views"];
    $fb_page_likes = $_POST["fb-page-likes"];
    $youtube_daily_views = $_POST["youtube_daily_views"];

    // Update query
    $wpdb->update(
        $table_name,
        [
            "subscriber" => $subscriber,
            "website_daily_views" => $website_1day,
            "website_weekly_views" => $website_1week,
            "android_daily_views" => $android_daily,
            "android_weekly_views" => $android_weekly,
            "fb_daily_views" => $fb_daily_views,
            "fb_page_likes" => $fb_page_likes,
            "youtube_daily_views" => $youtube_daily_views,
        ],
        ["id" => 1]
    );
    echo "<script>location.reload(true);</script>";
}

// COST UPDATE
if (isset($_POST["costsubmit"])) {
    // Get global $wpdb object
    global $wpdb;

    // Set table name
    $table_name = $wpdb->prefix . "tt_cost";

    // Get form data
    $wtp1w = $_POST["wtp1w"];
    $wtp1m = $_POST["wtp1m"];
    $wtp1y = $_POST["wtp1y"];
    $wfp1w = $_POST["wfp1w"];
    $wfp1m = $_POST["wfp1m"];
    $wfp1y = $_POST["wfp1y"];
    $yt3s = $_POST["yt3s"];
    $yt60s = $_POST["yt60s"];
    $aa1w = $_POST["aa1w"];
    $aa1m = $_POST["aa1m"];
    $aa1y = $_POST["aa1y"];
    $fb1w = $_POST["fb1w"];
    $fb1m = $_POST["fb1m"];
    $fb1y = $_POST["fb1y"];

    // Update query
    $result = $wpdb->update(
        $table_name,
        [
            "wtp1w" => $wtp1w,
            "wtp1m" => $wtp1m,
            "wtp1y" => $wtp1y,
            "wfp1w" => $wfp1w,
            "wfp1m" => $wfp1m,
            "wfp1y" => $wfp1y,
            "yt3s" => $yt3s,
            "yt60s" => $yt60s,
            "aa1w" => $aa1w,
            "aa1m" => $aa1m,
            "aa1y" => $aa1y,
            "fb1w" => $fb1w,
            "fb1m" => $fb1m,
            "fb1y" => $fb1y,
        ],
        ["id" => 1]
    );

    if ($result !== false) {
        echo "<script>location.reload(true);</script>";
        echo '<script>setTimeout(function() { document.getElementById("tt_upcost").click(); }, 500);</script>';
    }
}

?>