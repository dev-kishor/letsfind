<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['state_submit'])) {
        $state_id = $_POST['state_id'];
        $state_name = $_POST['state_name'];
        $country_id = $_POST['country_id'];
        //************ state Name Already Exist Check Starts ***************
        $state_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "states  WHERE state_name='" . $state_name . "' AND state_id != $state_id ");
        if (mysqli_num_rows($state_name_exist_check) > 0) {
            $_SESSION['status_msg'] = "The Given State name is Already Exist Try Other!!!";
            header('Location: admin-state-edit.php?row=' . $state_id);
            exit;
        }
        //************ city Name Already Exist Check Ends ***************
        $sql = mysqli_query($conn, "UPDATE  " . TBL . "states SET state_name='" . $state_name . "' where state_id='" . $state_id . "'");
        if ($sql) {
            $_SESSION['status_msg'] = "State has been Updated Successfully!!!";
            header('Location: admin-all-state.php');
            exit;
        } else {
            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";
            header('Location: admin-state-edit.php?row=' . $state_id);
            exit;
        }
    }
} else {
    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";
    header('Location: admin-all-state.php');
    exit;
}
