<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // prx($_POST);
    if (isset($_POST['city_submit'])) {
        $city_id = safe_input_Text($_POST['city_id']);
        $city_name = safe_input_Text($_POST['city_name']);
        $country_id = safe_input_Text($_POST['country_id']);
        $state_id = safe_input_Text($_POST['state_id']);
        //************ city Name Already Exist Check Starts ***************
        $city_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "cities  WHERE city_name='" . $city_name . "' AND state_id = $state_id AND city_id != $city_id ");
        if (mysqli_num_rows($city_name_exist_check) > 0) {
            $_SESSION['status_msg'] = "The Given city name is Already Exist Try Other!!!";
            header('Location: admin-city-edit.php?row=' . $city_id);
            exit;
        }
        //************ city Name Already Exist Check Ends ***************

        $sql = mysqli_query($conn, "UPDATE  " . TBL . "cities SET city_name='" . $city_name . "', state_id='" . $state_id . "' where city_id='" . $city_id . "'");
        if ($sql) {
            $_SESSION['status_msg'] = "city has been Updated Successfully!!!";
            header('Location: admin-all-city.php');
            exit;
        } else {
            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";
            header('Location: admin-city-edit.php?row=' . $city_id);
            exit;
        }
    }
} else {
    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";
    header('Location: admin-all-city.php');
    exit;
}
