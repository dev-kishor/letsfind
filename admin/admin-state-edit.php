<?php
include "header.php";
?>
<?php if ($footer_row['admin_listing_show'] != 1 || $admin_row['admin_city_options'] != 1) {
    header("Location: profile.php");
}
?>
<!-- START -->
<section>
    <div class="ad-com">
        <div class="ad-dash leftpadd">
            <section class="login-reg">
                <div class="container">
                    <div class="row">
                        <div class="login-main add-list add-ncate">
                            <div class="log-bor">&nbsp;</div>
                            <span class="udb-inst">Edit State</span>
                            <div class="log log-1">
                                <div class="login">
                                    <h4>Edit this State</h4>
                                    <?php include "../page_level_message.php"; ?>
                                    <?php
                                    $state_id = $_GET['row'];
                                    $row = getStateById($state_id);
                                    // prx($row);
                                    ?>
                                    <form name="city_form" id="city_form" method="post" action="update_state.php" enctype="multipart/form-data" class="cre-dup-form cre-dup-form-show">
                                        <input type="hidden" class="validate" id="state_id" name="state_id" value="<?php echo $row['state_id']; ?>" required="required">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <select name="country_id" required="required" id="country_id" class="chosen-select form-control">
                                                                <option value="">Choose Country</option>
                                                                <?php
                                                                //Countries Query
                                                                foreach (getAllCountries() as $countries_row) {
                                                                ?>
                                                                    <option <?php if ($row['country_id'] == $countries_row['country_id']) {
                                                                                echo "selected";
                                                                            } ?> value="<?php echo $countries_row['country_id']; ?>"><?php echo $countries_row['country_name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" name="state_name" value="<?php echo $row['state_name']; ?>" class="form-control" placeholder="State name *" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <button type="submit" name="state_submit" class="btn btn-primary">Update</button>
                                    </form>
                                    <div class="col-md-12">
                                        <a href="admin-all-city.php" class="skip">Go to All State >></a>
                                    </div>
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
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="js/admin-custom.js"></script>
<script src="../js/select-opt.js"></script>
</body>

</html>