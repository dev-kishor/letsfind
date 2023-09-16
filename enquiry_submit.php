<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //    Enquiry Insert Part Starts
    $service_name = $_POST["service_name"];
    $service_price = $_POST["service_price"];
    if ($_POST["listing_id"] != NULL) {
        $listing_id = $_POST["listing_id"];
    } else {
        $listing_id = 0;
    }
    if ($_POST["event_id"] != NULL) {
        $event_id = $_POST["event_id"];
    } else {
        $event_id = 0;
    }
    if ($_POST["blog_id"] != NULL) {
        $blog_id = $_POST["blog_id"];
    } else {
        $blog_id = 0;
    }
    if ($_POST["product_id"] != NULL) {
        $product_id = $_POST["product_id"];
    } else {
        $product_id = 0;
    }
    if ($_POST["listing_user_id"] != NULL) {
        $listing_user_id = $_POST["listing_user_id"];
    } else {
        $listing_user_id = 99999;
    }
    if ($_POST["enquiry_sender_id"] != NULL) {
        $enquiry_sender_id = $_POST["enquiry_sender_id"];
    } else {
        $enquiry_sender_id = 88888;
    }
    if ($_POST["enquiry_category"] != NULL) {
        $enquiry_category = $_POST["enquiry_category"];
    } else {
        $enquiry_category = 0;
    }
    if ($_POST["appointment_date"] != NULL) {
        $appointment_date = $_POST["appointment_date"];
    } else {
        $appointment_date = "0000-00-00";
    }
    if ($_POST["appointment_time"] != NULL) {
        $appointment_time = $_POST["appointment_time"];
    } else {
        $appointment_time = "00:00:00";
    }
    if ($_POST["enquiry_name"] != NULL) {
        $enquiry_name = $_POST["enquiry_name"];
    } else {
        $enquiry_name = 'N/A';
    }
    if ($_POST["enquiry_email"] != NULL) {
        $enquiry_email = $_POST["enquiry_email"];
    } else {
        $enquiry_email = 'N/A';
    }
    if ($_POST["enquiry_mobile"] != NULL) {
        $enquiry_mobile = $_POST["enquiry_mobile"];
    } else {
        $enquiry_mobile = 0;
    }
    if ($_POST["enquiry_message"] != NULL) {
        $enquiry_message = $_POST["enquiry_message"];
    } else {
        $enquiry_message = "N/A";
    }
    if ($_POST["enquiry_source"] != NULL) {
        $enquiry_source = $_POST["enquiry_source"];
    } else {
        $enquiry_source = "N/A";
    }
    $payment_status = "Pending";
    if ($listing_user_id == $enquiry_sender_id) {
        echo '3';  // Enquiring User Id and Owner Id is Same
        exit();
    }
    $enquiry_qry = "INSERT INTO " . TBL . "enquiries 
					(listing_id,event_id,blog_id,product_id,listing_user_id,enquiry_sender_id,enquiry_source,enquiry_name, enquiry_email, enquiry_mobile, appointment_date,appointment_time,enquiry_message, service_name, service_price, payment_status, enquiry_category, enquiry_cdt) 
					VALUES 
					('$listing_id','$event_id','$blog_id', '$product_id', '$listing_user_id', '$enquiry_sender_id', '$enquiry_source','$enquiry_name', '$enquiry_email', '$enquiry_mobile', '$appointment_date', '$appointment_time', '$enquiry_message', '$service_name', '$service_price', '$payment_status', '$enquiry_category', '$curDate')";
    $enquiry_res = mysqli_query($conn, $enquiry_qry);
    $EnquiryID = mysqli_insert_id($conn);
    if ($enquiry_res) {
        if ($service_name == NULL) {
            //****************************    Admin Primary email fetch starts    *************************
            $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer  WHERE footer_id = '1' ");
            $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
            $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
            $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
            $admin_site_name = $admin_primary_email_fetchrow['website_address'];
            $admin_address = $admin_primary_email_fetchrow['footer_address'];
            //****************************    Admin Primary email fetch ends    *************************
            $user_row = getUser($listing_user_id);
            // ************************SEND EMAIL ON LISTING EMAIL************************
            $user_row = getUser($listing_user_id);
            $listing_email_sql = mysqli_query($conn, "SELECT * FROM " . TBL . "listings where listing_id = " . $listing_id . "");
            $listing_email = mysqli_fetch_assoc($listing_email_sql);
            $email_id =  $listing_email["listing_email"];
            $listing_name =  $listing_email["listing_name"];
            // ************************SEND EMAIL ON LISTING EMAIL************************
            $first_name = $user_row['first_name'];
            $user_plan = $user_row['user_plan']; //Fetch of Logged In user Plan
            $user_plan_type = getPlanType($user_plan); //Fetch Logged In User Plan details and data
            $plan_type_email_notification = $user_plan_type['plan_type_email_notification'];
            $admin_email = $admin_primary_email; // Admin Email Id
            $to1 = $email_id;
            $subject1 = "$admin_site_name New Enquiry";
            $client_sql_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "mail WHERE mail_id = 23 "); //User mail template fetch
            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);
            $mail_template_client = $client_sql_fetch_row['mail_template'];
            $enquiry_listing_link = $webpage_full_link . "db-enquiry";
            $enquiry_listing_img = $webpage_full_link . "images/listings/" . $listing_email['profile_image'];
            $message2 = '<!DOCTYPE html>
           <html lang="en">
           
           <head>
               <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
               <title>Bizbook Mailers</title>
           </head>
           
           <body id="page-top" class="index">
              <table border="0" cellspacing="0" cellpadding="0" style="width:100%;font-size:14px;font-family:Quicksand, Calibri, Arial, Verdana, sans-serif;background: #f5f6fa;color:#738196;line-height: 21px;padding: 30px;">
                   <tbody>
                       <tr>
                           <td>
                               <table style="background: #fff;width:500px;padding: 20px;margin: 0 auto;box-shadow: 0px 1px 10px 13px #2d313703;border-radius: 8px;font-weight: 500;">
                                   <tbody>
                                   <tr>
                                       <td style="font-size: 24px;color:#000;font-weight: bold;line-height: 30px;">Hi <span contenteditable="false">' . $first_name . '</span></td>
                                   </tr>
                                   <tr>
                                       <td style="height: 5px;line-height: 2px;">&nbsp;</td>
                                   </tr>
                                   <tr>
                                       <td>A New Enquiry has been received. For reference, here' . "'" . 's your enquiry information:</td>
                                   </tr>     
                                   <tr><td>&nbsp;</td></tr>        
                                   <tr>
                                       <td style="font-size: 18px;color:#000;font-weight: bold;line-height: 26px;">Enquiry informations:</td>
                                   </tr>
                                   <tr>
                                       <td><strong> Enquirer name:</strong> <span contenteditable="false">' . $enquiry_name . '</span></td>
                                   </tr>     
                                   <tr>
                                       <td><strong>Mobile Number :</strong> <span contenteditable="false">' . $enquiry_mobile . '</span></td>
                                   </tr> 
                                   <tr>
                                       <td><strong>Email Id :</strong> <span contenteditable="false">' . $enquiry_email . '</span></td>
                                   </tr>
                                   <tr>
                                       <td><strong>Message :</strong> <span contenteditable="false">' . $enquiry_message . '</span></td>
                                   </tr>
                                   <tr><td>&nbsp;</td></tr>
                                   <tr>
                                        <td><img src="' . $enquiry_listing_img . '" width="100px">  </td>
                                    </tr>
                                   <tr>
                                        <td><strong><a target="_blank" href="' . $enquiry_listing_link . '"> Click to Reply</a>  </strong></td>
                                   </tr>
                                   <tr><td>&nbsp;</td></tr>    
                                   <tr>
                                       <td>Thanks, <br><span contenteditable="false">' . $admin_site_name . '</span></td>
                                   </tr>    
                               </tbody></table>
                           </td>
                       </tr>
                       
                   </tbody>
               </table>
           </body>
           
           </html>';
            // echo $message2;
            // die();
            $headers1 = "From: " . "$admin_email" . "\r\n";
            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
            $headers1 .= "MIME-Version: 1.0\r\n";
            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";
            if ($plan_type_email_notification == 1) {
                mail($to1, $subject1, $message2, $headers1); //Client email
            }
            //****************************    client email ends    *************************
            echo '1';
        } else {
            echo $EnquiryID;
        }
    } else {
        echo '2';
    }
} else {
    header('Location: index');
    exit;
}
//    Enquiry Insert Part Ends
