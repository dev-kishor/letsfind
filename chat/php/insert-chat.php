<?php
session_start();
include_once "../../admin/config/db.php";
if (isset($_SESSION['user_id'])) {
    $outgoing_id = $_SESSION['user_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $thread_id = mysqli_real_escape_string($conn, $_POST['thread_id']);
    if (!empty($message)) {
        $check_ex_msg_sql = "SELECT * FROM " . TBL . "chat where sender_id = $outgoing_id and thread_id = $thread_id";
        $chech_res = mysqli_query($conn, $check_ex_msg_sql);
        $check_count = mysqli_num_rows($chech_res);

        if (!$check_count > 0) {
           $thread_msg_sql = "INSERT INTO " . TBL . "chat (sender_id, receiver_id, msg, thread_id) VALUES ({$outgoing_id}, {$incoming_id}, 'pollthreadjdk@{$thread_id}', '{$thread_id}')";
           mysqli_query($conn,$thread_msg_sql);
        }

        $sql = mysqli_query($conn, "INSERT INTO " . TBL . "chat (sender_id, receiver_id, msg, thread_id) VALUES ({$outgoing_id}, {$incoming_id}, '{$message}', '{$thread_id}')") or die();
    }
} else {
    header("location: ../login.php");
}
