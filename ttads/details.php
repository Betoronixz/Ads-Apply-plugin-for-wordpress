<?php
if (!defined("ABSPATH")) {
  die("can't access");
}
require_once(ABSPATH . 'wp-includes/pluggable.php');

add_shortcode("TT-details", "ads_detail_func");
function ads_detail_func()
{
  ob_start();
  global $wpdb;
  $table_name = $wpdb->prefix . "analytics";
  $result = $wpdb->get_results("SELECT * FROM $table_name");
  if (!empty($result)) {
    foreach ($result as $r) {

?>
      <section class="sec">

        <div class="card-content ">
          <h2>
            <span class="insight"> Get insights that help your business grow.</span>
          </h2>
          <p class="card-info">
          </p>

          <div class="card-social-media row ">
            <div class="col-md-3  text-center p-3 border">
              <p class="card-count"> <?php echo $r->subscriber ?> </p>
              <p> <img src="<?php echo plugins_url('assets/images/youtube.png', __FILE__); ?>" width="20px" alt="">
                Subscribers on YouTube</p>
            </div>
            <div class="col-md-3  text-center p-3 border">
              <p class="card-count"> <?php echo $r->youtube_daily_views ?></p>
              <p> <img src="<?php echo plugins_url('assets/images/youtube.png', __FILE__); ?>" width="20px" alt=""> YouTube daily views </p>
            </div>

            <div class="col-md-3  text-center p-3 border">
              <p class="card-count"> <?php echo $r->website_weekly_views ?></p>
              <p><img src="<?php echo plugins_url('assets/images/internet.png', __FILE__); ?>" width="20px" alt=""> Website 1 week views </p>
            </div>
            <div class="col-md-3  text-center p-3 border">
              <p class="card-count"> <?php echo $r->website_daily_views ?> </p>
              <p><img src="<?php echo plugins_url('assets/images/internet.png', __FILE__); ?>" width="20px" alt=""> Website 1 day views </p>
            </div>
            <div class="col-md-3  text-center p-3 border">
              <p class="card-count"><?php echo $r->android_daily_views ?></p>
              <p> <img src="<?php echo plugins_url('assets/images/android.png', __FILE__); ?>" width="20px" alt=""> Android app daily views</p>
            </div>
            <div class="col-md-3  text-center p-3 border">
              <p class="card-count"> <?php echo $r->android_weekly_views ?></p>
              <p> <img src="<?php echo plugins_url('assets/images/android.png', __FILE__); ?>" width="20px" alt=""> Android app weekly views </p>
            </div>
            <div class="col-md-3  text-center p-3 border">
              <p class="card-count"><?php echo $r->fb_daily_views ?></p>
              <p><img src="<?php echo plugins_url('assets/images/facebook.png', __FILE__); ?>" width="20px" alt=""> Facebook daily views </p>
            </div>
            <div class="col-md-3  text-center p-3 border">
              <p class="card-count"><?php echo $r->fb_page_likes ?></p>
              <p> <img src="<?php echo plugins_url('assets/images/facebook.png', __FILE__); ?>" width="20px" alt=""> Facebook page likes</p>
            </div>
          </div>
          <button type="button" class="btn btn-lg  btn-success mt-3" data-toggle="modal" data-target="#exampleModal">Apply Now</button>
        </div>
      </section class="sec">
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
            <?php echo do_shortcode("[TT-ADS]"); ?>
            </div>

          </div>
        </div>
      </div>
<?php
    }
  }

  return ob_get_clean();
}
?>