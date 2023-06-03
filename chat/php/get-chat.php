<?php
session_start();
include_once "../../admin/config/db.php";
// if (file_exists('admin/classes/index.function.php')) {
//     include('admin/classes/index.function.php');
// }
if (isset($_SESSION['user_id'])) {

    $outgoing_id = $_SESSION['user_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $thread = mysqli_real_escape_string($conn, $_POST['thread']);
    $output = "";
    $sql = "SELECT " . TBL . "chat.* FROM " . TBL . "chat 
            LEFT JOIN " . TBL . "users ON " . TBL . "users.user_id = " . TBL . "chat.sender_id
            WHERE thread_id = $thread and (sender_id = {$outgoing_id} 
                AND receiver_id = {$incoming_id})
                OR (sender_id = {$incoming_id} 
                AND receiver_id = {$outgoing_id}) 
                ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['sender_id'] === $outgoing_id) {
                $thread_id = $row["thread_id"];
                if ($row['msg'] === "pollthreadjdk@" . $thread_id) {
                    $sql = "SELECT * FROM  " . TBL . "listings where listing_id='" . $thread_id . "'";
                    $rs = mysqli_query($conn, $sql);
                    $listrow = mysqli_fetch_array($rs);

                    $output .= '<div class="outgoing-chats">
                                    <div class="outgoing-msg">
                                        <div class="outgoing-chats-msg">
                                            <div class="chatthreadcard">
                                                <div class="chatthreadcardimg">
                                                    <img src="' . $webpage_full_link . "images/listings/" . $listrow['profile_image'] . '" alt="">
                                                </div>
                                                <span>' . $listrow['listing_name'] . ' <br>Lorem ipsum dolor sit amet.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                } else {
                    $output .= '<div class="outgoing-chats">
                                    <div class="outgoing-msg">
                                        <div class="outgoing-chats-msg">
                                        <p>' . $row['msg'] . '</p>
                                            <span class="time">18:30 PM | July 24 </span>
                                        </div>
                                    </div>
                                </div>';
                }
            } else {

                $output .= ' <div class="received-chats">
                            <div class="received-msg">
                                <div class="received-msg-inbox">
                                    <p>' . $row['msg'] . '</p>
                                    <span class="time">18:06 PM | July 24 </span>
                                </div>
                            </div>
                        </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}
