<?php
if (!defined("ABSPATH")) {
    die("can't access");
}
require_once(ABSPATH . 'wp-includes/pluggable.php');

add_shortcode("TT-ADS", "ads_form_func");
function ads_form_func()
{
    ob_start();
?>

    <div id="costdata" style="display: none;">
        <?php
        global $wpdb;
        $table_name2 = $wpdb->prefix . 'tt_cost';

        // Fetch the row with ID 1
        $result = $wpdb->get_row("SELECT * FROM $table_name2 WHERE id = 1");

        // If a row was found, display the data in the div tags
        if ($result) {
        ?>
            <div id="c1"><?php echo $result->wtp1w; ?></div>
            <div id="c2"><?php echo $result->wtp1m; ?></div>
            <div id="c3"><?php echo $result->wtp1y; ?></div>
            <div id="c4"><?php echo $result->wfp1w; ?></div>
            <div id="c5"><?php echo $result->wfp1m; ?></div>
            <div id="c6"><?php echo $result->wfp1y; ?></div>
            <div id="c7"><?php echo $result->yt3s; ?></div>
            <div id="c8"><?php echo $result->yt60s; ?></div>
            <div id="c9"><?php echo $result->aa1w; ?></div>
            <div id="c10"><?php echo $result->aa1m; ?></div>
            <div id="c11"><?php echo $result->aa1y; ?></div>
            <div id="c12"><?php echo $result->fb1w; ?></div>
            <div id="c13"><?php echo $result->fb1m; ?></div>
            <div id="c14"><?php echo $result->fb1y; ?></div>
        <?php
        } else {
            echo 'No data found';
        }
        ?>

    </div>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-md-6">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="col-md-6">
                <label for="des">Description:</label>
                <input type="text" class="form-control" id="des" name="des" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="date">Date:</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>
            <div class="col-md-6">
                <label for="place">Place:</label>
                <input type="text" class="form-control" id="place" name="place">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="col-md-6">
                <label for="mobile">Mobile:</label>
                <input type="tel" class="form-control" id="mobile" name="mobile" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col-md-6">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Website Top Banner <b>Cost: <span id="ttcost1" style="margin-right: 200px;"></span></b></label>
                <select class="form-control" name="wtp" id="wtp" onchange="updatecost()">
                    <option value="">--Select-- </option>
                    <option value="1w">1 Week </option>
                    <option value="1m">1 Month</option>
                    <option value="1y">1 year</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Website Footer Banner <b>Cost: <span id="ttcost2" style="margin-right: 200px;"></span></b></label>
                <select class="form-control" name="wfp" id="wfp" onchange="updatecost2()">
                    <option value="">--Select-- </option>
                    <option value="1w">1 Week </option>
                    <option value="1m">1 Month</option>
                    <option value="1y">1 year</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Youtube Banner <b>Cost: <span id="ttcost3" style="margin-right: 200px;"></span></b></label>
                <select class="form-control" name="yt" id="yt" onchange="updatecost3()">
                    <option value="">--Select-- </option>
                    <option value="1w">3 Sec </option>
                    <option value="1m">60 sec</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Andorid App <b>Cost: <span id="ttcost4" style="margin-right: 200px;"></span></b></label>
                <select class="form-control" name="ap" id="ap" onchange="updatecost4()">
                    <option value="">--Select-- </option>
                    <option value="1w">1 Week </option>
                    <option value="1m">1 Month</option>
                    <option value="1y">1 year</option>
                </select>
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-md-6">
                <label>Facebook <b>Cost: <span id="ttcost5" style="margin-right: 200px;"></span></b></label>
                <select class="form-control" name="fb" id="fb" onchange="updatecost5()">
                    <option value="">--Select-- </option>
                    <option value="1w">1 Week </option>
                    <option value="1m">1 Month</option>
                    <option value="1y">1 year</option>
                </select>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-md-2 mt-4">
                <?php
                $n1 = rand(1, 20);
                $n2 = rand(1, 20);
                $sum = $n1 + $n2;
                echo $n1 . "+" . $n2 . "=";
                ?>
            </div>
            <div class="col-md-4 mt-4">
                <input type="number" name="sum">
                <input type="hidden" value="<?php echo  $sum ?>" name="sum2">
            </div>
            <div class="col-md-12">
                <?php
                echo "<h4>image for QR Payment</h4>";
                global $wpdb;
                // Get the ID card image from the database
                $table_name8 = $wpdb->prefix . "my_ads_admin"; // add prefix to table name
                $sql1 = "SELECT id_card_image FROM $table_name8 ORDER BY id DESC LIMIT 1"; // get the last row ordered by ID in descending order and limit the result to 1 row
                $result2 = $wpdb->get_results($sql1, ARRAY_A); // use get_results to get data as associative array
                if (!empty($result2)) {
                    $row2 = $result2[0]; // get first row from resultset
                    $id_card_image = $row2["id_card_image"];
                    echo '<img src="' . plugin_dir_url(__FILE__) . $id_card_image . '"  width="500px">';
                }
                ?>
            </div>
            <div class="col-md-6">
                <label for="image">Payment Screenshot:</label>
                <input type="file" class="form-control" id="ps" name="ps" required>
            </div>
        </div>
        <input type="submit" class="btn btn-lg btn-block mt-3" name="apsubmit" value="Submit">

    </form>

<?php
    if (isset($_POST["apsubmit"])) {
        if ($_POST["sum"] !== $_POST["sum2"]) {
            echo "<script>alert('Invalid Captcha')</script>";
            $current_url = esc_url_raw($_SERVER['REQUEST_URI']);
            wp_safe_redirect($current_url);
            exit; // Always exit after redirecting
        } else {
            global $wpdb;
            $table_name = $wpdb->prefix . 'tt_ads';

            // Get form data and sanitize
            $title = sanitize_text_field($_POST['title']);
            $description = sanitize_textarea_field($_POST['des']);
            $date = sanitize_text_field($_POST['date']);
            $place = sanitize_text_field($_POST['place']);
            $address = sanitize_text_field($_POST['address']);
            $mobile = sanitize_text_field($_POST['mobile']);
            $email = sanitize_email($_POST['email']);
            $wtp = sanitize_text_field($_POST['wtp']);
            $wfp = sanitize_text_field($_POST['wfp']);
            $ap = sanitize_text_field($_POST['ap']);
            $fb = sanitize_text_field($_POST['fb']);
            $yt = sanitize_text_field($_POST['yt']);
            
            // checking if email exist
            $table_name = $wpdb->prefix . 'tt_ads';
            $existing_email = $wpdb->get_var("SELECT email FROM $table_name WHERE email = '$email' AND status = 'pending'");
            if ($existing_email) {
                // Redirect to the same page after submitting the form
                echo '<script>alert("Your request  in pending");</script>';
                $current_url = esc_url_raw($_SERVER['REQUEST_URI']);
                wp_safe_redirect($current_url);
                exit;
            }

            // Sanitize uploaded file
            $image = $_FILES['image'];
            $ps = $_FILES['ps'];

            // Upload  Profile picture
            $image_path = '';
            if ($image['name']) {
                $upload_dir = wp_upload_dir();
                $image_name = basename($image['name']);
                $image_path = $upload_dir['path'] . '/' . $image_name;
                move_uploaded_file($image['tmp_name'], $image_path);
            }

            $ps_path = '';
            if ($ps['name']) {
                $upload_dir = wp_upload_dir();
                $ps_name = basename($ps['name']);
                $ps_path = $upload_dir['path'] . '/' . $ps_name;
                move_uploaded_file($ps['tmp_name'], $ps_path);
            }
            // Sanitize and validate other fields
            $status = 'pending';

            // Prepare data for insertion
            $data = array(
                'title' => $title,
                'des' => $description,
                'date' => $date,
                'place' => $place,
                'address' => $address,
                'mobile' => $mobile,
                'email' => $email,
                'image' => $image_path,
                'ps' => $ps_path,
                'wtp' => $wtp,
                'wfp' => $wfp,
                'yt' => $yt,
                'ap' => $ap,
                'fb' => $fb,
                'status' => $status,
            );

            // Insert data into the database
            $result = $wpdb->insert($table_name, $data);
            if ($result === false) {
                wp_die('Failed to insert data into database: ' . $wpdb->last_error);
            } else {

                echo '<script>alert("Data inserted successfully!");</script>';
                $current_url = esc_url_raw($_SERVER['REQUEST_URI']);
                wp_safe_redirect($current_url);
                exit;
            }
        }
    }
    return ob_get_clean();
}
?>
