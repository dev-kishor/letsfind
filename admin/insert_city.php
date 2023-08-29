<?php
include "config/info.php";
if (isset($_POST['city_submit'])) {
    $cnt = count($_POST['city_name']);
    $country_id = $_POST['country_id'];
    $state_id = safe_input_Text($_POST['state_id']);
    // *********** if Count of city name is zero means redirect starts ********
    if ($cnt == 0) {
        header('Location: admin-add-city.php');
        exit;
    }
    // *********** if Count of city name is zero means redirect ends ********
    for ($i = 0; $i < $cnt; $i++) {
        $city_name = $_POST['city_name'][$i];
        $check_sql = "SELECT * FROM " . TBL . "cities  WHERE city_name='" . $city_name . "' AND state_id='" . $state_id . "' ";
        $city_name_exist_check = mysqli_query($conn, $check_sql);
        if (mysqli_num_rows($city_name_exist_check) > 0) {
            $_SESSION['status_msg'] = "The Given City name $city_name is Already Exist Try Other!!!";
            header('Location: admin-add-city.php');
            exit;
        }

        //************ city Name Already Exist Check Ends ***************
        $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "cities (city_name,state_id,city_cdt) VALUES ('$city_name','$state_id','$curDate')");
    }
    if ($sql) {
        $_SESSION['status_msg'] = "City(s) has been Added Successfully!!!";
        header('Location: admin-all-city.php');
        exit;
    } else {
        $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";
        header('Location: admin-add-city.php');
        exit;
    }
}
