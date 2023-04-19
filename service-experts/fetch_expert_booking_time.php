<?php
if (file_exists('./expert-config-info.php')) {
    include "./expert-config-info.php";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enquiry_date_expert = $_POST["enquiry_date_expert"];
    $expert_user_id = $_POST["expert_user_id"];
    $expert_id = $_POST["expert_id"];
    $available_time_start = $_POST["available_time_start"];
    $available_time_end = $_POST["available_time_end"];

    $enquiry_date_expert_informate = date('Y-m-d', strtotime($enquiry_date_expert));
    $sql = "select appointment_time from " . TBL . "expert_enquiries where appointment_date = '" . $enquiry_date_expert_informate . "' and expert_id = " . $expert_id . " and expert_user_id = " . $expert_user_id . " and enquiry_status = 200";

    $enquiry_res = mysqli_query($conn, $sql);
    $existTimeSlot = array();

    while ($row = mysqli_fetch_assoc($enquiry_res)) {
        array_push($existTimeSlot, $row["appointment_time"]);
    }

    $start_time = $available_time_start;
    $new_start_time1 = strtotime('-60mins', strtotime($start_time));
    $new_start_time = date('g:i A', $new_start_time1); // format the next time

    $end_time = $available_time_end;
    $new_end_time1 = strtotime('+60mins', strtotime($end_time));
    $new_end_time = date('g:i A', $new_end_time1); // format the next time

    $workingHours = (((strtotime($new_end_time) - strtotime($start_time)) / 3600) - 1);

    $aviable_time = array();
    $time = $new_start_time; // start
    for ($i = 0; $i <= $workingHours; $i++) {
        $prev = date('g:i a', strtotime($time)); // format the start time
        $next = strtotime('+60mins', strtotime($time)); // add 60 mins
        $time = date('g:i A', $next); // format the next time
        if (!in_array($time, $existTimeSlot)) {
?>
            <option value="<?php echo $time; ?>"><?php echo $time; ?></option>
<?php
        }
    }
} else {
    header('Location: index');
    exit;
}
