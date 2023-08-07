<?php
//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}
$country_id = $_POST['country_id'];
//get matched data from State table
$state_sql = "SELECT * FROM  " . TBL . "states where country_id='" . $country_id . "'";
$state_rs = mysqli_query($conn, $state_sql);
$state_row_count = mysqli_num_rows($state_rs);
if ($state_row_count <= 0) {
?>
    <option value=""><?php echo $BIZBOOK['NO_CITY_FOUND_MESSAGE']; ?></option>
<?php
} else {
?>
    <option value="">Select State</option>
    <?php
    while ($state_row = mysqli_fetch_array($state_rs)) {
    ?>
        <option value="<?php echo $state_row['state_id']; ?>"><?php echo $state_row['state_name']; ?></option>
<?php
    }
}
?>