<?php

/**
 * Created by Vignesh.
 * User: Vignesh
 */
if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['place_submit'])) {
        $place_id = $_POST["place_id"];
        $place_banner_image_old = $_POST["place_banner_image_old"];
        $place_gallery_image_old = $_POST["place_gallery_image_old"];
        $place_name = $_POST["place_name"];
        $place_description = $_POST["place_description"];
        $place_tags = $_POST["place_tags"];
        $place_fee = $_POST["place_fee"];
        $seo_title = $_POST["seo_title"];
        $seo_description = $_POST["seo_description"];
        $seo_keywords = $_POST["seo_keywords"];
        $place_status = $_POST["place_status"];
        $min_child = $_POST["min_child"];
        $max_child = $_POST["max_child"];
        $fee_child = $_POST["fee_child"];
        $min_adult = $_POST["min_adult"];
        $max_adult = $_POST["max_adult"];
        $fee_adult = $_POST["fee_adult"];
        $min_senior = $_POST["min_senior"];
        $max_senior = $_POST["max_senior"];
        $fee_senior = $_POST["fee_senior"];
        $place_discover1 = $_POST["place_discover"];
        $prefix = $fruitList = '';
        foreach ($place_discover1 as $fruit) {
            $place_discover .= $prefix . $fruit;
            $prefix = ',';
        }
        $place_related1 = $_POST["place_related"];
        $prefix = $fruitList = '';
        foreach ($place_related1 as $fruit) {
            $place_related .= $prefix . $fruit;
            $prefix = ',';
        }
        $place_listings1 = $_POST["place_listings"];
        $prefix = $fruitList = '';
        foreach ($place_listings1 as $fruit) {
            $place_listings .= $prefix . $fruit;
            $prefix = ',';
        }
        $place_events1 = $_POST["place_events"];
        $prefix = $fruitList = '';
        foreach ($place_events1 as $fruit) {
            $place_events .= $prefix . $fruit;
            $prefix = ',';
        }
        $place_experts1 = $_POST["place_experts"];
        $prefix = $fruitList = '';
        foreach ($place_experts1 as $fruit) {
            $place_experts .= $prefix . $fruit;
            $prefix = ',';
        }
        $places_news1 = $_POST["places_news"];
        $prefix = $fruitList = '';
        foreach ($places_news1 as $fruit) {
            $places_news .= $prefix . $fruit;
            $prefix = ',';
        }
        $category_id = $_POST["category_id"];
        // Place Timing Details
        $opening_time = $_POST["opening_time"];
        $closing_time = $_POST["closing_time"];
        $google_map = $_POST["google_map"];
        $address = $_POST["address"];
        $pincode = $_POST["pincode"];
        // Place Other Information
        $place_info_question123 = $_POST["place_info_question"];
        $prefix1 = $fruitList = '';
        foreach ($place_info_question123 as $fruit1) {
            $place_info_question .= $prefix1 . addslashes($fruit1);
            $prefix1 = '|';
        }
        $place_info_answer123 = $_POST["place_info_answer"];
        $prefix1 = $fruitList = '';
        foreach ($place_info_answer123 as $fruit1) {
            $place_info_answer .= $prefix1 . addslashes($fruit1);
            $prefix1 = '|';
        }
        function checkPlaceSlugs($link, $place_id, $counter = 1)
        {
            global $conn;
            $newLink = $link;
            do {
                $checkLink = mysqli_query($conn, "SELECT place_id FROM " . TBL . "places WHERE place_slug = '$newLink' AND place_id != '$place_id'");
                if (mysqli_num_rows($checkLink) > 0) {
                    $newLink = $link . '' . $counter;
                    $counter++;
                } else {
                    break;
                }
            } while (1);
            return "$newLink";
        }
        $place_name1 = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $place_name));
        $place_slug = checkPlaceSlugs($place_name1, $place_id);
        // ************************  Gallery Image Upload starts  **************************
        $all_place_gallery_image = $_FILES['place_gallery_image'];
        $all_place_gallery_image23 = $_FILES['place_gallery_image']['name'];

        if ($_FILES['banner']['name'] == "") {
            $place_banner_image = $place_banner_image_old;
        } else {
            $banner_img = $_FILES['banner'];
            if (!empty($banner_img['name'])) {
                $file1 = rand(1000, 100000) . $banner_img['name'];
                $file_loc1 = $banner_img['tmp_name'];
                $file_size1 = $banner_img['size'];
                $file_type1 = $banner_img['type'];
                $allowed = array("image/jpeg", "image/png", "image/jpg");
                if (in_array($file_type1, $allowed)) {
                    $folder1 = "../places/images/banner/";
                    $new_size = $file_size1 / 1024;
                    $new_file_name1 = strtolower($file1);
                    $event_image1 = str_replace(' ', '-', $new_file_name1);
                    $place_banner_image = compressImage($event_image1, $file_loc1, $folder1, $new_size);
                }
            }
        }

        if (count(array_filter($_FILES['place_gallery_image']['name'])) <= 0) {
            $place_gallery_image = $place_gallery_image_old;
        } else {
            for ($k = 0; $k < count($all_place_gallery_image23); $k++) {
                if (!empty($all_place_gallery_image['name'][$k])) {
                    $file1 = rand(1000, 100000) . $all_place_gallery_image['name'][$k];
                    $file_loc1 = $all_place_gallery_image['tmp_name'][$k];
                    $file_size1 = $all_place_gallery_image['size'][$k];
                    $file_type1 = $all_place_gallery_image['type'][$k];
                    $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
                    if (in_array($file_type1, $allowed)) {
                        $folder1 = "../places/images/places/";
                        $new_size1 = $file_size1 / 1024;
                        $new_file_name1 = strtolower($file1);
                        $event_image1 = str_replace(' ', '-', $new_file_name1);
                        //move_uploaded_file($file_loc1, $folder1 . $event_image1);
                        $place_gallery_image1[] = compressImage($event_image1, $file_loc1, $folder1, $new_size1);
                    } else {
                        $place_gallery_image1[] = '';
                    }
                }
            }
            $place_gallery_image = implode(",", $place_gallery_image1);
            $place_gallery_image = $place_gallery_image . "," . $place_gallery_image_old;
        }
        // ************************  Gallery Image Upload ends  **************************
        $place_qry =
            "UPDATE  " . TBL . "places  SET category_id='" . $category_id . "'
            , place_name='" . $place_name . "', place_description='" . $place_description . "'
            , min_child='" . $min_child . "'
            , max_child='" . $max_child . "'
            , fee_child='" . $fee_child . "'
            , min_adult='" . $min_adult . "'
            , max_adult='" . $max_adult . "'
            , fee_adult='" . $fee_adult . "'
            , min_senior='" . $min_senior . "'
            , max_senior='" . $max_senior . "'
            , fee_senior='" . $fee_senior . "'
            , place_tags='" . $place_tags . "', place_fee='" . $place_fee . "'
            , seo_title='" . $seo_title . "', seo_description='" . $seo_description . "'
            , seo_keywords='" . $seo_keywords . "', places_news='" . $places_news . "'
            , place_experts='" . $place_experts . "', place_events='" . $place_events . "'
            , place_listings='" . $place_listings . "', place_related='" . $place_related . "'
            , place_discover='" . $place_discover . "', place_banner_image='" . $place_banner_image . "'
            , place_gallery_image='" . $place_gallery_image . "', opening_time='" . $opening_time . "'
            , closing_time ='" . $closing_time . "', google_map ='" . $google_map . "',place_address ='" . $address . "',place_pincode ='" . $pincode . "', place_status ='" . $place_status . "'
            , place_info_question ='" . $place_info_question . "', place_info_answer ='" . $place_info_answer . "'
            , place_slug ='" . $place_slug . "' where place_id ='" . $place_id . "'";
        $place_res = mysqli_query($conn, $place_qry);
        if ($place_res) {
            $_SESSION['status_msg'] = "Your Places has been Updated Successfully!!!";
            header('Location: place-all.php');
            exit;
        } else {
            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";
            header('Location: place-edit.php?code=' . $place_id);
        }
    }
} else {
    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";
    header('Location: place-all.php');
    exit;
}
