<?php
//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}
$state_id = $_POST['state_id'];
//get matched data from State table
$state_sql = "SELECT * FROM  " . TBL . "cities where state_id='" . $state_id . "'";
$state_rs = mysqli_query($conn, $state_sql);
$state_row_count = mysqli_num_rows($state_rs);
if ($state_row_count <= 0) {
?>
    <option value=""><?php echo $BIZBOOK['NO_CITY_FOUND_MESSAGE']; ?></option>
<?php
} else {
?>
<option value="">Select City</option>
    <?php
    while ($city_row = mysqli_fetch_array($state_rs)) {
    ?>
        <option value="<?php echo $city_row['city_id']; ?>"><?php echo $city_row['city_name']; ?></option>
<?php
    }
}
?>