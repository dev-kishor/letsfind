<?php

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $receiver = $_POST["receiver"];
    if (isset($_POST["sender"])) {
        $sender = $_POST["sender"];
    } else {
        $sender = "vistor";
    }
    $sender_name = $_POST["sender_name"];
    $sender_mobile = $_POST["sender_mobile"];
    $sender_email = $_POST["sender_email"];
    $sender_subject = $_POST["subject"];
    $message = $_POST["message"];

    $sql_for_insert = "INSERT INTO " . TBL . "mail_message (`receiver_id`, `sender_id`, `sender_name`, `sender_mobile`, `sender_email`, `subject`, `message`) VALUES ('$receiver', '$sender', '$sender_name', '$sender_mobile', '$sender_email', '$sender_subject', '$message')";

    $insert_res = mysqli_query($conn, $sql_for_insert);

    $insertID = mysqli_insert_id($conn);

    if ($insert_res) {
        $user_row = getUser($receiver);
        $email_id = $user_row['email_id'];
        $first_name = $user_row['first_name'];

        $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_email = $admin_primary_email; // Admin Email Id

        $to = $email_id;
        $subject = "$admin_site_name New Message";

        $message = "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta http-equiv='Content-Type' content='text/html' charset='utf-8'>
                <title>Bizbook Mailers</title>
            </head>
            
            <body id='page-top' class='index'>
               <table border='0' cellspacing='0' cellpadding='0' style='width:100%;font-size:14px;font-family:Quicksand, Calibri, Arial, Verdana, sans-serif;background: #f5f6fa;color:#738196;line-height: 21px;padding: 30px;'>
                    <tbody>
                        <tr>
                            <td>
                                <table style='background: #fff;width:500px;padding: 20px;margin: 0 auto;box-shadow: 0px 1px 10px 13px #2d313703;border-radius: 8px;font-weight: 500;'>
                                    <tbody>
                                    <tr>
                                        <td style='font-size: 24px;color:#000;font-weight: bold;line-height: 30px;'>Hi <span contenteditable='false'> $first_name </span></td>
                                    </tr>
                                    <tr>
                                        <td style='height: 5px;line-height: 2px;'>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>A New Message has been received. For reference, here's message information:</td>
                                    </tr>     
                                    <tr><td>&nbsp;</td></tr>        
                                    <tr>
                                        <td style='font-size: 18px;color:#000;font-weight: bold;line-height: 26px;'>Sender informations:</td>
                                    </tr>
                                    <tr>
                                        <td><strong> Name:</strong> <span contenteditable='false'> $sender_name </span></td>
                                    </tr>     
                                    <tr>
                                        <td><strong>Mobile Number :</strong> <span contenteditable='false'> $sender_mobile </span></td>
                                    </tr> 
                                    <tr>
                                        <td><strong>Email :</strong> <span contenteditable='false'> $sender_email </span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Subject :</strong> <span contenteditable='false'> $sender_subject </span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Message :</strong> <span contenteditable='false'> $message </span></td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>    
                                    <tr>
                                        <td>Thanks, <br><span contenteditable='false'> $admin_site_name </span></td>
                                    </tr>    
                                </tbody></table>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </body>
            
            </html>";
        $headers = "From: " . "$admin_email" . "\r\n";
        $headers .= "Reply-To: " . "$admin_email" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=utf-8\r\n";

        mail($to, $subject, $message, $headers); //Client email

        echo $insertID;
    } else {
        echo 500;
    }
} else {

    header('Location: index');
    exit;
}
