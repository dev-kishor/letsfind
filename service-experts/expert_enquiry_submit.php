<?php

/**
 * Created by Vignesh.
 * User: Vignesh
 */

//database configuration
if (file_exists('expert-config-info.php')) {
    include "expert-config-info.php";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //    Enquiry Insert Part Starts


    $enquiry_sender_id = $_POST["enquiry_sender_id"];

    $is_general_id = $_POST["general_id"]; //General Enquiry Lead

    if ($is_general_id == 1) {

        $expert_id = 0;
        $expert_user_id = 0;
    } else {
        $expert_id = $_POST["expert_id"];
        $expert_user_id = $_POST["expert_user_id"];
    }

    $enquiry_name = $_POST["enquiry_name"];
    $enquiry_email = $_POST["enquiry_email"];
    $enquiry_mobile = $_POST["enquiry_mobile"];
    $enquiry_source = $_POST["enquiry_source"];

    $appointment_date_1 = $_POST["enquiry_date"];
    $appointment_date = date('Y-m-d', strtotime($appointment_date_1));

    $appointment_time = $_POST["enquiry_time"];
    $enquiry_message = $_POST["enquiry_message"];
    $enquiry_location = $_POST["enquiry_location"];

    $enquiry_category = $_POST["enquiry_category"];

    $payment_status = "Pending";

    /*
     Closed = 100
     New = 200
     On the way = 300
     Pending = 400
     Done = 500  */

    $enquiry_status = 200;

    if ($is_general_id != 1) {

        if ($expert_user_id == $enquiry_sender_id) {

            echo 403403;  // Enquiring User Id and Owner Id is Same
            exit();
        }
    }


    $enquiry_qry = "INSERT INTO " . TBL . "expert_enquiries
					(expert_id,expert_user_id,enquiry_sender_id,is_general_id,enquiry_source,enquiry_name, enquiry_email, enquiry_mobile, appointment_date,appointment_time,enquiry_message, enquiry_location, payment_status, enquiry_category, enquiry_status, enquiry_cdt)
					VALUES
					('$expert_id', '$expert_user_id', '$enquiry_sender_id', '$is_general_id', '$enquiry_source','$enquiry_name', '$enquiry_email', '$enquiry_mobile', '$appointment_date', '$appointment_time', '$enquiry_message', '$enquiry_location', '$payment_status', '$enquiry_category', '$enquiry_status', '$curDate')";

    $enquiry_res = mysqli_query($conn, $enquiry_qry);

    $EnquiryID = mysqli_insert_id($conn);


    if ($enquiry_res) {
        //****************************    Admin Primary email fetch starts    *************************

        $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************

        if ($expert_user_id != 0) {
            $user_row = getUser($expert_user_id);
            $email_id = $user_row['email_id'];
            $first_name = $user_row['first_name'];


            $admin_email = $admin_primary_email; // Admin Email Id

            $to1 = $email_id;
            $subject1 = "$admin_site_name New Expert Enquiry";

            $client_sql_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "mail WHERE mail_id = 23 "); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);

            $mail_template_client = $client_sql_fetch_row['mail_template'];

            $message2 = "<!DOCTYPE html>
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
                                        <td>A New Enquiry has been received. For reference, here's your enquiry information:</td>
                                    </tr>     
                                    <tr><td>&nbsp;</td></tr>        
                                    <tr>
                                        <td style='font-size: 18px;color:#000;font-weight: bold;line-height: 26px;'>Enquiry informations:</td>
                                    </tr>
                                    <tr>
                                        <td><strong> Enquirer name:</strong> <span contenteditable='false'> $enquiry_name </span></td>
                                    </tr>     
                                    <tr>
                                        <td><strong>Mobile Number :</strong> <span contenteditable='false'> $enquiry_mobile </span></td>
                                    </tr> 
                                    <tr>
                                        <td><strong>Email Id :</strong> <span contenteditable='false'> $enquiry_email </span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Message :</strong> <span contenteditable='false'> $enquiry_message </span></td>
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

            $headers1 = "From: " . "$admin_email" . "\r\n";
            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
            $headers1 .= "MIME-Version: 1.0\r\n";
            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";

            mail($to1, $subject1, $message2, $headers1); //Client email


            //****************************    client email ends    *************************
        }
        echo $EnquiryID;
    } else {
        echo 500500;
    }
} else {

    header('Location: index');
    exit;
}

//    Enquiry Insert Part Ends