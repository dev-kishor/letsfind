<?php

//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}

$type_id = $_POST['type_id'];

if ($type_id == 1) {     //Listings City

    foreach (getAllListingPageCities() as $city_listrow) {
        if (strpos($city_listrow['city_id'], ',') !== false) {
            $city_id_array = array_unique(explode(',', $city_listrow['city_id']));
            foreach ($city_id_array as $places) {
                $row = getCity($places);
                ?>
                ?>
                <option value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
                <?php
            }
        }
    }
} elseif ($type_id == 2) {  //Service Experts City

    foreach (getAllExpertsGroupByCity() as $expert_location_row) {
        $expert_location = $expert_location_row['city_id'];

        $row = getExpertCity($expert_location);
        ?>
        <option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
        <?php
    }
} elseif ($type_id == 3) {  //Jobs City

//get matched data from Jobs City table
    foreach (getAllJobGroupByCity() as $job_location_row) {
        $job_location = $job_location_row['job_location'];

        $row = getJobCity($job_location);
        ?>
        <option value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
        <?php
    }
} elseif ($type_id == 5) {  //News City

//get matched data from News City table
    foreach (getAllNewsCities() as $row) {
        ?>
        <option value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
        <?php
    }
} else {
    ?>
    <option value=""></option>
    <?php
}
?>
