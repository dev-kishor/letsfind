<?php
include "header.php";
?>
<?php if ($footer_row['admin_place_show'] != 1) {
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <section class="ud-cen">
                <div class="container">
                    <div class="row">
                        <div class="plac-panl">
                            <div class="log-bor">&nbsp;</div>
                            <span class="udb-inst">Add new Place</span>
                            <div class="log log-1">
                                <div class="login">
                                    <?php include "../page_level_message.php"; ?>
                                    <form name="place_form" id="place_form" method="POST" action="insert_place.php" enctype="multipart/form-data">
                                        <ul>
                                            <li>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h6>Place details & Info</h6>
                                                            <label>Place name</label>
                                                            <input type="text" name="place_name" class="form-control" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <select name="category_id" required="required" class="chosen-select form-control">
                                                                <option value="">Select place category</option>
                                                                <?php
                                                                foreach (getAllPlaceCategories() as $row) {
                                                                ?>
                                                                    <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tag name</label>
                                                            <input type="text" required="required" name="place_tags" class="form-control" placeholder="Ex: Group of three waterfalls">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select name="place_status" required="required" class="chosen-select form-control">
                                                                <option value="1">Active</option>
                                                                <option value="2">Open</option>
                                                                <option value="3">Closed</option>
                                                                <option value="4">Temporarily closed</option>
                                                                <option value="5">Permanently closed</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tourism fee</label>
                                                            <select name="place_fee" required="required" class="chosen-select form-control" id="place_fee">
                                                                <option value="1">Free</option>
                                                                <option value="2">Paid</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" id="fee_structure" style="display: none;">
                                                        <table class="responsive-table bordered" id="myTable">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>
                                                                        <div class="form-group">
                                                                            <label>Min Age (yrs)</label>
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="form-group">
                                                                            <label>Max Age (yrs)</label>
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="form-group">
                                                                            <label>Fee ($)</label>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th><label for="Child">Child</label></th>
                                                                    <th>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input type="text" name="min_child" class="form-control feest" placeholder="5" id="minmaxfee">
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input type="text" name="max_child" class="form-control feest" placeholder="15" id="minmaxfee">
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input type="text" name="fee_child" class="form-control feest" placeholder="100$" id="minmaxfee">
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th><label for="Adult">Adult</label></th>
                                                                    <th>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input type="text" name="min_adult" class="form-control feest" placeholder="15" id="minmaxfee">
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input type="text" name="max_adult" class="form-control feest" placeholder="45" id="minmaxfee">
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input type="text" name="fee_adult" class="form-control feest" placeholder="150$" id="minmaxfee">
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                                <tr>
                                                                    <th><label for="Senior citizen">Senior citizen</label></th>
                                                                    <th>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input type="text" name="min_senior" class="form-control feest" placeholder="45" id="minmaxfee">
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input type="text" name="max_senior" class="form-control feest" placeholder="100" id="minmaxfee">
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                    <th>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <input type="text" name="fee_senior" class="form-control feest" placeholder="20$" id="minmaxfee">
                                                                            </div>
                                                                        </div>
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Open time</label>
                                                            <select name="opening_time" required="required" id="opening_time" class="chosen-select form-control">
                                                                <?php
                                                                $time = '4:00'; // start
                                                                for ($i = 0; $i <= 19; $i++) {
                                                                    $prev = date('g:i a', strtotime($time)); // format the start time
                                                                    $next = strtotime('+60mins', strtotime($time)); // add 60 mins
                                                                    $time = date('g:i A', $next); // format the next time
                                                                ?>
                                                                    <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                                <option value="247">24 Hours</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" id="closing_time_box">
                                                        <div class="form-group">
                                                            <label>Close time</label>
                                                            <select name="closing_time" id="closing_time" required="required" class="chosen-select form-control" data-placeholder="Select places">
                                                                <?php
                                                                $time = '5:00'; // start
                                                                for ($i = 0; $i <= 18; $i++) {
                                                                    $prev = date('g:i a', strtotime($time)); // format the start time
                                                                    $next = strtotime('+60mins', strtotime($time)); // add 60 mins
                                                                    $time = date('g:i A', $next); // format the next time
                                                                ?>
                                                                    <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <select name="country_id" required="required" id="country_id" class="chosen-select form-control">
                                                                <option value="" disabled selected>Choose Country</option>
                                                                <?php
                                                                //Countries Query
                                                                foreach (getAllCountries() as $countries_row) {
                                                                ?>
                                                                    <option value="<?php echo $countries_row['country_id']; ?>"><?php echo $countries_row['country_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <select name="state_id" required="required" id="state_id" class="chosen-select form-control">
                                                                <option value="" disabled selected>Choose State</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED START-->
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <select name="city_id" required="required" id="city_id" class="chosen-select form-control">
                                                                <option value="" disabled selected>Choose City</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Pincode</label>
                                                            <input type="text" name="pincode" required="required" placeholder="Ex: 3003" class="form-control" id="pincode">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <input type="text" name="address" required="required" placeholder="Ex: A 778-B abcarea, 3003" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Direction(Google map link)</label>
                                                            <input type="text" name="google_map" required="required" placeholder="Ex: https://goo.gl/maps/cUZ39XriLPf9HhKk7" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>About Place</label>
                                                            <textarea class="form-control" required="required" name="place_description" id="place_description" placeholder="Product details"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <hr>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h6>Near by services & activity</h6>
                                                            <label>Discover places</label>
                                                            <select name="place_discover[]" multiple="multiple" class="chosen-select form-control" data-placeholder="Select places">
                                                                <?php
                                                                foreach (getAllPlaces() as $row) {
                                                                ?>
                                                                    <option value="<?php echo $row['place_id']; ?>"><?php echo $row['place_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!-- <hr> -->
                                                <!--FILED START-->
                                                <!-- because of pincode -->
                                                <!-- <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Related places</label>
                                                            <select name="place_related[]" multiple="multiple" class="chosen-select form-control" data-placeholder="Select places">
                                                                <?php
                                                                foreach (getAllPlaces() as $row) {
                                                                ?>
                                                                    <option value="<?php echo $row['place_id']; ?>"><?php echo $row['place_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- because of pincode -->
                                                <!--FILED END-->
                                                <!-- <hr> -->
                                                <!--FILED START-->
                                                <!-- because of pincode -->
                                                <!-- <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Top near by Services(Business listings)</label>
                                                            <select name="place_listings[]" multiple="multiple" class="chosen-select form-control" data-placeholder="Select Listings">
                                                                <?php
                                                                foreach (getAllListing() as $row) {
                                                                ?>
                                                                    <option value="<?php echo $row['listing_id']; ?>"><?php echo $row['listing_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- because of pincode -->
                                                <!--FILED END-->
                                                <hr>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Events in this place</label>
                                                            <select name="place_events[]" disabled multiple="multiple" class="chosen-select form-control" data-placeholder="Select Events">
                                                                <?php
                                                                foreach (getAllEvents() as $row) {
                                                                ?>
                                                                    <option value="<?php echo $row['event_id']; ?>"><?php echo $row['event_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <hr>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Services Experts in this place</label>
                                                            <select name="place_experts[]" disabled multiple="multiple" class="chosen-select form-control" data-placeholder="Select Experts">
                                                                <?php
                                                                foreach (getAllExperts() as $row) {
                                                                ?>
                                                                    <option value="<?php echo $row['expert_id']; ?>"><?php echo $row['profile_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <hr>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>News & Articles in this place</label>
                                                            <select name="places_news[]" disabled multiple="multiple" class="chosen-select form-control" data-placeholder="Select News/Articles">
                                                                <?php
                                                                foreach (getAllNews() as $row) {
                                                                ?>
                                                                    <option value="<?php echo $row['news_id']; ?>"><?php echo $row['news_title']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <hr>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h6>Banner</h6>
                                                            <!--FILED END-->
                                                            <div>
                                                                <input type="file" required="required" name="banner" class="form-control" id="banner_img" accept="image/*,.jpg,.jpeg,.png">
                                                            </div>
                                                            <!--FILED START-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h6>Photo gallery</h6>
                                                            <!--FILED END-->
                                                            <div>
                                                                <input type="file" required="required" name="place_gallery_image[]" class="form-control place_gallery_image" id="place_gallery_image" accept="image/*,.jpg,.jpeg,.png" multiple>
                                                            </div>
                                                            <!--FILED START-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--FILED END-->
                                                <!-- Things todo -->
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h6>Things to do</h6>
                                                            <span class="add-list-add-btn plac-todo-add" title="add new field">+</span>
                                                            <span class="add-list-rem-btn plac-todo-remov" title="remove field">-</span>
                                                        </div>
                                                    </div>
                                                    <ul class="plac-ask-que thingstodo">
                                                        <li>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Name</label>
                                                                    <input type="text" name="todo_name[]" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>URL</label>
                                                                    <input type="text" name="todo_url[]" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <input type="file" name="todo_img[]" class="form-control" onchange="filehandle(this)" accept="image/*,.jpg,.jpeg,.png">
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- Things todo -->
                                                <hr>
                                                <!--FILED START-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <h6>What people ask</h6>
                                                            <span class="add-list-add-btn plac-ask-add" title="add new field">+</span>
                                                            <span class="add-list-rem-btn plac-ask-remov" title="remove field">-</span>
                                                        </div>
                                                    </div>
                                                    <ul class="plac-ask-que whatask">
                                                        <li>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Question:</label>
                                                                    <input type="text" name="place_info_question[]" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label>Answer:</label>
                                                                    <input type="text" name="place_info_answer[]" class="form-control">
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Question:</label>
                                                                    <input type="text" name="place_info_question[]" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label>Answer:</label>
                                                                    <input type="text" name="place_info_answer[]" class="form-control">
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--FILED END-->
                                                <hr>
                                                <!--FILED END-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group jb-fm-box-hig">
                                                            <h5 data-toggle="collapse" data-target="#jb-expe">SEO
                                                                details</h5>
                                                            <div id="jb-expe" class="collapse coll-box">
                                                                <input type="text" name="seo_title" class="form-control" placeholder="SEO Title">
                                                                <hr>
                                                                <input type="text" name="seo_description" class="form-control" placeholder="Meta descriptions">
                                                                <hr>
                                                                <input type="text" name="seo_keywords" class="form-control" placeholder="Meta keywords">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <!--FILED START-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" id="place_submit" name="place_submit" class="btn btn-primary">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                        <!--FILED END-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<!-- END -->
<div id="toastbar"></div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/select-opt.js"></script>
<script type="text/javascript" src="../js/imageuploadify.min.js"></script>
<script src="js/admin-custom.js"></script>
<script src="js/logic.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // $('input[id="place_gallery_image"]').imageuploadify();
    })
</script>
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('place_description');
    $(document).ready(function() {
        $('#place_fee').change(function() {
            let selected_fee = this.value
            let fee_structure = document.getElementById("fee_structure");
            if (selected_fee === "1") {
                fee_structure.style.display = "none";
                $(".feest").prop('required', false);
            } else {
                fee_structure.style.display = "block";
                $(".feest").prop('required', true);
            }
            console.log(this.value);
        })
    })
    var minmaxfee = document.querySelectorAll('#minmaxfee');
    document.getElementById('pincode').onkeyup = selectValue

    function selectValue() {
        let minmaxfeeVal = this;
        minmaxfeeVal.value = minmaxfeeVal.value.replace(/[^0-9\^]/g, "");
    }
    for (btn of minmaxfee)
        btn.onkeyup = selectValue;
</script>
</body>

</html>