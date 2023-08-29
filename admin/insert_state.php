<?php
include "config/info.php";
if (isset($_POST['state_submit'])) {
    // prx($_POST);
    $country_id = safe_input_Text($_POST['country_id']);
    $cnt = count($_POST['state_name']);
    // *********** if Count of city name is zero means redirect starts ********
    if ($cnt == 0) {
        header('Location: admin-add-state.php');
        exit;
    }
    // *********** if Count of city name is zero means redirect ends ********
    for ($i = 0; $i < $cnt; $i++) {
        $state_name = safe_input_Text($_POST['state_name'][$i]);
        //************ city Name Already Exist Check Ends ***************
        $state_check_sql = "SELECT * FROM " . TBL . "states  WHERE state_name='" . $state_name . "' AND country_id='" . $country_id . "' ";
        $state_name_exist_check = mysqli_query($conn, $state_check_sql);
        if (mysqli_num_rows($state_name_exist_check) > 0) {
            $_SESSION['status_msg'] = "The Given City name $state_name is Already Exist Try Other!!!";
            header('Location: admin-add-state.php');
            exit;
        }
        $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "states (state_name,country_id) VALUES ('$state_name','$country_id')");
    }
    if ($sql) {
        $_SESSION['status_msg'] = "State(s) has been Added Successfully!!!";
        header('Location: admin-all-state.php');
        exit;
    } else {
        $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";
        header('Location: admin-add-state.php');
        exit;
    }
}
