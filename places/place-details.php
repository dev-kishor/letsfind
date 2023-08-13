<?php
include "places-config-info.php";
include "../header.php";

if (file_exists('../config/places_page_authentication.php')) {
    include('../config/places_page_authentication.php');
}

if (isset($_SESSION['user_id'])) {
    $session_user_id = $_SESSION['user_id'];
}
$user_details_row = getUser($session_user_id);


$redirect_url = $webpage_full_link . 'dashboard';  //Redirect Url

if ($_GET['code'] == NULL && empty($_GET['code'])) {

    header("Location: $redirect_url");  //Redirect When code parameter is empty
}

//$place_codea = $_GET['code'];
$place_codea1 = str_replace('-', ' ', $_GET['code']);
$place_codea = str_replace('.php', '', $place_codea1);

$place_row = getSlugPlaces($place_codea); // To Fetch particular place Data

if ($place_row['place_id'] == NULL && empty($place_row['place_id'])) {

    header("Location: $redirect_url");  //Redirect When No User Found in Table
}

$place_id = $place_row['place_id'];

$place_category_id = $place_row['category_id'];

$place_category_row = getPlaceCategory($place_category_id);

$place_category_name = $place_category_row['category_name'];

placedetailpageview($place_id); //Function To Find Page View


?>

<!-- START -->
<section>
    <div class="plac-det-ban">
        <div class="container">
            <div class="row">
                <div class="all-list-bre plac-det-bred">
                    <ul>
                        <li><a href="<?php echo $slash ?>places"><?php echo $BIZBOOK['PLACE-ALL-PLACES']; ?></a></li>
                        <li>
                            <a href="<?php echo $PLACE_DETAIL_URL . urlModifier($place_row['place_slug']); ?>"><?php echo stripslashes($place_row['place_name']); ?></a>
                        </li>
                    </ul>
                </div>
                <div class="plac-det-ban-inn">
                    <div class="plac-det-ban-im">
                        <img src="<?php echo $slash; ?>places/images/banner/<?php echo $place_row['place_banner_image']; ?>" alt="">
                        <span class="share-new-top" data-toggle="modal" data-target="#sharepop"><i class="material-icons">share</i></span>
                        <div class="plac-det-tit">
                            <h1><?php echo stripslashes($place_row['place_name']); ?></h1>
                            <h4><?php echo $place_row['place_tags']; ?></h4>
                        </div>
                    </div>
                    <div class="plac-det-ban-sub">

                        <ul>
                            <li><span><?php echo $BIZBOOK['PLACE-STATUS']; ?>:
                                    <?php
                                    if ($place_row['place_status'] == 1) {
                                        if ($place_row['opening_time'] == "247") {
                                            echo $BIZBOOK['PLACE-OPEN'];
                                        } else {
                                            $currentDateTime = new DateTime(); // Get the current time
                                            $openingTime = new DateTime($place_row['opening_time']); // Set the opening time
                                            $closingTime = new DateTime($place_row['closing_time']); // Set the closing time

                                            if ($currentDateTime >= $openingTime && $currentDateTime <= $closingTime) {
                                                echo $BIZBOOK['PLACE-OPEN'];
                                            } else {
                                                echo $BIZBOOK['PLACE-CLOSED'];
                                            }
                                        }
                                    } elseif ($place_row['place_status'] == 2) {
                                        $currentDateTime = new DateTime(); // Get the current time
                                        $openingTime = new DateTime($place_row['opening_time']); // Set the opening time
                                        $closingTime = new DateTime($place_row['closing_time']); // Set the closing time

                                        if ($currentDateTime >= $openingTime && $currentDateTime <= $closingTime) {
                                            echo $BIZBOOK['PLACE-OPEN'];
                                        } else {
                                            echo $BIZBOOK['PLACE-CLOSED'];
                                        }
                                    } elseif ($place_row['place_status'] == 3) {
                                        echo $BIZBOOK['PLACE-CLOSED'];
                                    } elseif ($place_row['place_status'] == 4) {
                                        echo $BIZBOOK['PLACE-TEMPORARILY-CLOSED'];
                                    } elseif ($place_row['place_status'] == 5) {
                                        echo $BIZBOOK['PLACE-PERMANENTLY-CLOSED'];
                                    }
                                    ?></span></li>
                            <?php
                            if ($place_row['opening_time'] == "247") {
                            ?>
                                <li><span>Open : 24*7 </span></li>
                            <?php
                            } else {
                            ?>
                                <li><span><?php echo $BIZBOOK['PLACE-OPEN-TIME']; ?>: <?php echo $place_row['opening_time']; ?></span></li>
                                <li><span><?php echo $BIZBOOK['PLACE-CLOSE-TIME']; ?>: <?php echo $place_row['closing_time']; ?></span></li>
                            <?php
                            }

                            ?>

                            <li><span><?php echo $BIZBOOK['PLACE-TOURISM-FEE']; ?>: <?php echo $place_row['place_fee'] == 1 ? "Free" : "Paid"; ?></span></li>
                            <li><a href="<?php echo $place_row['google_map']; ?>" target="_blank"><?php echo $BIZBOOK['PLACE-DIRECTION']; ?></a></li>
                            <li><a href="#near" class="cta-near"><?php echo $BIZBOOK['PLACE-NEAR-BY-SERVICES']; ?></a></li>
                        </ul>
                    </div>
                </div>
                <?php
                if (strlen($place_row['place_description']) != 0) {
                ?>
                    <div class="all-list-bres">
                        <?php echo $place_row['place_description']; ?>
                        <!-- <p><?php //echo substr($place_row['place_description'], 0, 400) 
                                ?> <span id="extend" class="readmoreless">... READ MORE</span> <span id="restextendtext"><?php //echo substr($place_row['place_description'], 50) 
                                                                                                                            ?> <span id="minmize" class="readmoreless">READ LESS</span></span></p> -->
                    </div>
                <?php
                }
                ?>

            </div>
            <?php
            if ($place_row['place_fee'] != 1) {
            ?>
                <div class="">
                    <ul>
                        <li>Child : <?php echo $place_row['min_child'] ?> yrs to <?php echo $place_row['max_child'] ?> yrs <?php echo $place_row['fee_child'] ?> $</li>
                        <li>Adult : <?php echo $place_row['min_adult'] ?> yrs to <?php echo $place_row['max_adult'] ?> yrs <?php echo $place_row['fee_adult'] ?> $</li>
                        <li>Senior Citizen : <?php echo $place_row['min_senior'] ?> yrs to <?php echo $place_row['max_senior'] ?> yrs <?php echo $place_row['fee_senior'] ?> $</li>
                    </ul>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</section>
<!--END-->

<!--START-->
<section>
    <div class="plac-hom-bd plac-deta-sec plac-pad-top">
        <div class="container">
            <div class="row">
                <div class="plac-det-tit-inn">
                    <h2><?php echo $BIZBOOK['PLACE-PHOTO-GALLERY']; ?></h2>
                </div>
                <section id="gallery">
                    <div id="image-gallery">
                        <?php
                        $gallery_image_array = $place_row['place_gallery_image'];
                        $gallery_image = explode(',', $gallery_image_array);
                        foreach ($gallery_image as $item) {
                        ?>
                            <div class="plac-gal-imag">
                                <div class="img-wrapper">
                                    <a href="<?php echo $slash; ?>places/images/places/<?php echo $item; ?>"><img src="<?php echo $slash; ?>places/images/places/<?php echo $item; ?>" class="img-responsive"></a>
                                    <div class="img-overlay"><i class="material-icons">fullscreen</i></div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div><!-- End container -->
                </section>
            </div>
        </div>
    </div>
</section>
<!--END-->
<?php
if ((!empty($place_row['place_discover']))) {
?>
    <!--START-->
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com plac-pad-top">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><?php echo $BIZBOOK['PLACE-DISCOVER']; ?> Near <?php echo stripslashes($place_row['place_name']); ?></h2>
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul class="multiple-items1">
                            <?php
                            $place_discover_array = $place_row['place_discover'];
                            $place_discover = explode(',', $place_discover_array);
                            foreach ($place_discover as $item) {

                                $place_discover = getIdPlaces($item);
                                $place_discover_category_id = $place_discover['category_id'];
                                $place_discover_category_row = getPlaceCategory($place_discover_category_id);
                            ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img src="<?php echo $slash; ?>places/images/places/<?php echo explode(',', $place_discover['place_gallery_image'])[0]; ?>" alt="">
                                            <h4><?php echo stripslashes($place_discover['place_name']); ?></h4>
                                        </div>
                                        <div class="plac-hom-box-txt">
                                            <span><?php echo $place_discover_category_row['category_name']; ?></span>
                                            <span><?php echo $BIZBOOK['PLACE-MORE-DETAILS']; ?></span>
                                        </div>
                                        <a href="<?php echo $PLACE_DETAIL_URL . urlModifier($place_discover['place_slug']); ?>" class="fclick"></a>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->
<?php
}
if ((!empty($place_row['place_info_question']))) {
?>
    <!--START-->
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com plac-pad-top-30">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><?php echo $BIZBOOK['PLACE-WHAT-PEOPLE-ASK']; ?></h2>
                    </div>
                    <div class="plac-det-faq">
                        <div class="how-to-coll">
                            <ul>
                                <?php
                                $place_a_row_place_info_question_Array = explode('|', $place_row['place_info_question']);
                                $place_a_row_place_info_answer_Array = explode('|', $place_row['place_info_answer']);

                                $zipped = array_map(null, $place_a_row_place_info_question_Array, $place_a_row_place_info_answer_Array);
                                $si = 1;
                                foreach ($zipped as $tuple) {
                                    $tuple[0]; // Info question
                                    $tuple[1]; // Info Answer
                                    if ($tuple[0] != NULL) {
                                ?>
                                        <li>
                                            <h4 class="<?php if ($si == 1) { ?> colact <?php } ?>"><?php echo stripslashes($tuple[0]); ?></h4>
                                            <div <?php if ($si == 1) { ?>style="display: block;" <?php } ?>>
                                                <p><?php echo stripslashes($tuple[1]); ?></p>
                                            </div>
                                        </li>
                                <?php
                                    }
                                    $si++;
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->
<?php
}
// if ((!empty($place_row['place_related']))) {
?>

<?php
// }
if ((!empty($place_row['todo_name']))) {
?>
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com plac-pad-top">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2>Things To Do Near <?php echo stripslashes($place_row['place_name']); ?></h2>
                    </div>
                    <div class="plac-hom-all-pla">

                        <ul class="multiple-items2">
                            <?php
                            $todo_name = $place_row['todo_name'];
                            $todo_url = $place_row['todo_url'];
                            $todo_img = $place_row['todo_img'];
                            $todo_name_Array = explode('|', $todo_name);
                            $todo_url_Array = explode('|', $todo_url);
                            $todo_img_Array = explode(',', $todo_img);
                            $zipped = array_map(null, $todo_name_Array, $todo_url_Array, $todo_img_Array);
                            foreach ($zipped as $tuple) {
                                $tuple[0]; // Info question
                                $tuple[1]; // Info Answer
                            ?>
                                <!-- <li class="col-md-3">
                                    <a href="<?php echo $tuple[1]; ?>" target="_blank">
                                        <div class="pg-list-ser-p1">
                                            <img src="<?php echo $slash; ?>places/images/todo/<?php echo $tuple[2] ?>" alt="">
                                        </div>
                                        <div class="pg-list-ser-p2">
                                            <h4><?php echo $tuple[0] ?></h4>
                                        </div>
                                    </a>
                                </li> -->

                                <li>
                                    <div class="land-pack-grid">
                                        <div class="land-pack-grid-img">
                                            <img src="<?php echo $slash; ?>places/images/todo/<?php echo $tuple[2] ?>" alt="" loading="lazy">
                                        </div>
                                        <div class="land-pack-grid-text">
                                            <h4><?php echo $tuple[0] ?> </h4>
                                        </div>
                                        <a href="<?php echo $tuple[1]; ?>" class="land-pack-grid-btn"><?php echo $tuple[0] ?></a>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>
<!--START-->
<section>
    <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com plac-pad-top">
        <div class="container">
            <div class="row">
                <div class="plac-det-tit-inn">
                    <h2><?php echo $BIZBOOK['PLACE-RELATED-PLACES']; ?></h2>
                </div>
                <div class="plac-hom-all-pla">
                    <ul class="multiple-items1">
                        <?php
                        $place_cate_id = getAllPlacesCategory($place_row['category_id']);
                        while ($row = mysqli_fetch_array($place_cate_id)) {
                            // pr($row);
                        ?>
                            <li>
                                <div class="plac-hom-box">
                                    <div class="plac-hom-box-im">
                                        <img src="<?php echo $slash; ?>places/images/places/<?php echo explode(',', $row['place_gallery_image'])[0]; ?>" alt="">
                                        <h4><?php echo stripslashes($row['place_name']); ?></h4>
                                    </div>
                                    <div class="plac-hom-box-txt">
                                        <span></span>
                                        <span><?php echo $BIZBOOK['PLACE-MORE-DETAILS']; ?></span>
                                    </div>
                                    <a href="<?php echo $PLACE_DETAIL_URL . urlModifier($row['place_slug']); ?>" class="fclick"></a>
                                </div>
                            </li>
                        <?php
                        }

                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END-->


<section>
    <div class="str">
        <div class="container">
            <div class="row">
                <div class="plac-hom-tit plac-hom-tit-ic-ser">
                    <h2><?php echo $BIZBOOK['PLACE-TOP-NEARBY-SERVICES']; ?></h2>
                    <p><?php echo $BIZBOOK['PLACE-TOP-NEARBY-SERVICES-P']; ?> <b><?php echo $BIZBOOK['PLACE-TOP-NEARBY-SERVICES-B']; ?></b></p>
                </div>
                <div class="land-pack">
                    <ul>
                        <?php
                        foreach (getAllRecommCat($place_row['place_pincode']) as $category_sql_row) {
                        ?>
                            <li>
                                <div class="land-pack-grid">
                                    <div class="land-pack-grid-img">
                                        <img loading="lazy" src="../images/services/<?php echo $category_sql_row['category_image']; ?>" alt="">
                                    </div>
                                    <div class="land-pack-grid-text">
                                        <h4>
                                            <?php echo $category_sql_row['category_name']; ?>

                                            </span>
                                        </h4>
                                    </div>
                                    <a href="<?php echo $ALL_LISTING_URL . urlModifier($category_sql_row['category_slug']); ?>&verify=<?php echo $_GET['code']; ?>" class="fclick"></a>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--START-->
<!-- <section>
    <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com" id="near">
        <div class="container">
            <div class="row"> -->
<!-- <div class="plac-hom-tit plac-hom-tit-ic-ser">
                    <h2><?php echo $BIZBOOK['PLACE-TOP-NEARBY-SERVICES']; ?></h2>
                    <p><?php echo $BIZBOOK['PLACE-TOP-NEARBY-SERVICES-P']; ?> <b><?php echo $BIZBOOK['PLACE-TOP-NEARBY-SERVICES-B']; ?></b></p>
                </div> -->
<!-- <div class="plac-hom-all-pla">
                    <ul> -->
<?php
// foreach (getAllRecommCat($place_row['place_pincode']) as $category_sql_row) {
?>
<!-- <li>
                                <div class="plac-hom-box">
                                    <div class="plac-hom-box-im">
                                        <img loading="lazy" src="../images/services/<?php echo $category_sql_row['category_image']; ?>" alt="">
                                        <span class="plac-det-cate"><?php echo $category_sql_row['category_name']; ?></span>
                                    </div>
                                    <div class="plac-hom-box-txt disc">
                                        <div class="revi-box-1">
                                        </div>
                                        <span><?php echo $BIZBOOK['PLACE-MORE-DETAILS']; ?></span>
                                    </div>
                                    <a href="<?php echo $ALL_LISTING_URL . urlModifier($category_sql_row['category_slug']); ?>&verify=<?php echo $_GET['code']; ?>" class="fclick"></a>
                                </div>
                            </li> -->
<?php
// }
?>
<!-- </ul>
                </div> -->
<!-- </div>
        </div>
    </div>
</section> -->
<!--END-->
<?php
// }
$loger = getAllRecommEvent($place_row['place_pincode']);
$event_count = mysqli_num_rows($loger);
// echo $event_count;
if ($event_count) {
?>
    <!--START-->
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-hom-tit plac-hom-tit-ic-eve">
                        <h2><?php echo $BIZBOOK['PLACE-EVENTS-H2']; ?> <b><?php echo stripslashes($place_row['place_name']); ?></b></h2>
                        <p><?php echo $BIZBOOK['PLACE-EVENTS-P']; ?> <b><?php echo $BIZBOOK['PLACE-EVENTS-B']; ?></b></p>
                    </div>
                    <div class="plac-hom-all-pla plac-det-eve">
                        <ul class="multiple-items1">
                            <?php
                            foreach (getAllRecommEvent($place_row['place_pincode']) as $place_events) {
                            ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img loading="lazy" src="<?php echo $slash; ?>images/events/<?php echo $place_events['event_image']; ?>" alt="">
                                            <h4><?php echo $place_events['event_name']; ?></h4>
                                            <span class="plac-det-cate"><?php echo dateMonthFormatconverter($place_events['event_start_date']); ?> <?php echo dateDayFormatconverter($place_events['event_start_date']); ?></span>
                                        </div>
                                        <a href="<?php echo $EVENT_URL . urlModifier($place_events['event_slug']); ?>" class="fclick"></a>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->

<?php
}
$loger = getExpertUsingPincode($place_row['place_pincode']);
$event_count = mysqli_num_rows($loger);
if ($event_count) {
?>
    <!--START-->
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-hom-tit plac-hom-tit-ic-exp">
                        <h2><?php echo $BIZBOOK['PLACE-EXPERTS-H2']; ?> <b><?php echo stripslashes($place_row['place_name']); ?></b></h2>
                        <p><?php echo $BIZBOOK['PLACE-EXPERTS-P']; ?> <b><?php echo $BIZBOOK['PLACE-EXPERTS-B']; ?></b></p>
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul class="multiple-items1">
                            <?php
                            $place_experts_array = $place_row['place_experts'];
                            $place_experts = explode(',', $place_experts_array);
                            foreach (getExpertUsingPincode($place_row['place_pincode']) as $place_experts) {

                                $place_experts_category_id = $place_experts['category_id'];
                                $place_experts_category = getExpertCategory($place_experts_category_id);
                                $place_experts_expert_id = $place_experts['expert_id'];

                                // Service Expert Rating. for Rating of Star Starts

                                foreach (getExpertReview($place_experts_expert_id) as $star_rating_row) {
                                    if ($star_rating_row["rate_cnt"] > 0) {
                                        $star_rate_times = $star_rating_row["rate_cnt"];
                                        $star_sum_rates = $star_rating_row["total_rate"];
                                        $star_rate_one = $star_sum_rates / $star_rate_times;
                                        $star_rate_two = number_format($star_rate_one, 1);
                                        $star_rate = floatval($star_rate_two);
                                    } else {
                                        $rate_times = 0;
                                        $rate_value = 0;
                                        $star_rate = 0;
                                    }
                                }

                                // Service Expert Rating. for Rating of Star Ends

                            ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img loading="lazy" src="<?php echo $slash; ?>service-experts/images/services/<?php echo $place_experts['profile_image']; ?>" alt="">
                                            <h4><?php echo $place_experts['profile_name']; ?></h4>
                                            <span class="plac-det-cate"><?php echo $place_experts_category['category_name']; ?></span>
                                        </div>
                                        <div class="plac-hom-box-txt">
                                            <div class="revi-box-1">
                                                <?php
                                                if ($star_rate != 0) {
                                                ?>
                                                    <b><?php echo $star_rate_two; ?></b>
                                                <?php
                                                } ?>
                                                <?php
                                                if ($star_rate != 0) {
                                                ?>
                                                    <label class="rat">
                                                        <?php
                                                        for ($i = 1; $i <= ceil($star_rate); $i++) {
                                                        ?>
                                                            <i class="material-icons">star</i>
                                                        <?php
                                                        }
                                                        $bal_star_rate = abs(ceil($star_rate) - 5);

                                                        for ($i = 1; $i <= $bal_star_rate; $i++) {
                                                        ?>
                                                            <i class="material-icons ratstar">star</i>
                                                        <?php
                                                        }
                                                        ?>
                                                    </label>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if ($star_rate != 0) {
                                                ?>
                                                    <span class="re-cnt"><?php echo $review_count; ?><?php echo $BIZBOOK['REVIEWS']; ?></span>
                                                <?php
                                                } ?>
                                            </div>
                                            <span><?php echo $BIZBOOK['PLACE-MORE-DETAILS']; ?></span>
                                        </div>
                                        <a href="<?php echo $SERVICE_EXPERT_URL . urlModifier($place_experts['expert_slug']); ?>" class="fclick"></a>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->
<?php
}
$loger = getPincodeMatchNews($place_row['place_pincode']);
$event_count = mysqli_num_rows($loger);
// echo $event_count;
if ($event_count) {
?>
    <!--START-->
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-hom-tit plac-hom-tit-ic-nws">
                        <h2><?php echo $BIZBOOK['PLACE-NEWS-H2']; ?> <b><?php echo stripslashes($place_row['place_name']); ?></b></h2>
                        <p><?php echo $BIZBOOK['PLACE-NEWS-P']; ?> <b><?php echo $BIZBOOK['PLACE-NEWS-B']; ?></b></p>
                    </div>
                    <div class="plac-hom-all-pla plac-det-eve">
                        <ul class="multiple-items1">
                            <?php
                            foreach (getPincodeMatchNews($place_row['place_pincode']) as $places_news) {
                                $places_news_category_id = $places_news['category_id'];
                                $places_news_category = getNewsCategory($places_news_category_id);
                            ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img loading="lazy" src="<?php echo $slash; ?>/news/images/news/<?php echo $places_news['news_image']; ?>" alt="">
                                            <h4><?php echo stripslashes($places_news['news_title']); ?></h4>
                                            <span class="plac-det-cate"><?php echo $places_news_category['category_name']; ?></span>
                                        </div>
                                        <a href="<?php echo $NEWS_DETAIL_URL . urlModifier($places_news['news_slug']); ?>" class="fclick"></a>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->
<?php
}
?>
<section>
    <div class="container">
        <div class="row">
            <div class="plac-hom-tit plac-hom-tit-ic-sugg">
                <h2><?php echo $BIZBOOK['PLACE-HOME-H-3-1']; ?></h2>
                <p><?php echo $BIZBOOK['PLACE-HOME-P-3-1']; ?> <b><?php echo $BIZBOOK['PLACE-HOME-B-3-1']; ?></b></p>
                <span data-toggle="modal" data-target="#addplacepop"><?php echo $BIZBOOK['PLACE-HOME-SPAN-3-1']; ?></span>
            </div>
        </div>
    </div>
</section>

<!-- SHARE POPUP -->
<div class="pop-ups pop-quo">
    <!-- The Modal -->
    <div class="modal fade" id="addplacepop">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="log-bor">&nbsp;</div>
                <span class="udb-inst"><?php echo $BIZBOOK['PLACE-HOME-P-4-1']; ?></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- Modal Header -->
                <div class="quote-pop">
                    <h4><?php echo $BIZBOOK['PLACE-PLACE-DETAILS']; ?></h4>
                    <div id="place_pop_enq_success" class="log" style="display: none;">
                        <p><?php echo $BIZBOOK['PLACE_ADD_SUCCESSFUL_MESSAGE']; ?></p>
                    </div>
                    <div id="place_pop_enq_fail" class="log" style="display: none;">
                        <p><?php echo $BIZBOOK['OOPS_SOMETHING_WENT_WRONG']; ?></p>
                    </div>
                    <form method="post" name="place_add_request_form" id="place_add_request_form" class="place_add_request_form">
                        <input type="hidden" class="form-control" name="enquiry_sender_id" value="<?php echo $session_user_id; ?>" placeholder="" required>
                        <div class="form-group">
                            <input type="text" name="place_name" class="form-control" placeholder="<?php echo $BIZBOOK['PLACE-PLACE-NAME-LABEL']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="place_address" class="form-control" placeholder="<?php echo $BIZBOOK['PLACE-PLACE-ADDRESS-LABEL']; ?>" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="place_description" placeholder="<?php echo $BIZBOOK['PLACE-PLACE-DESCRIPTION-LABEL']; ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="fil-img-uplo">
                                <span class="dumfil"><?php echo $BIZBOOK['PLACE-PLACE-IMAGE-LABEL']; ?></span>
                                <input type="file" name="place_image" accept="image/*,.jpg,.jpeg,.png" class="form-control" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="enquiry_name" class="form-control" placeholder="<?php echo $BIZBOOK['PLACE-PLACE-ENQUIRY-NAME-LABEL']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['PLACE-PLACE-ENQUIRY-EMAIL-LABEL']; ?>" required="required" value="" name="enquiry_email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" title="<?php echo $BIZBOOK['PLACE-PLACE-ENQUIRY-INVALID-EMAIL-TITLE']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="" name="enquiry_mobile" placeholder="<?php echo $BIZBOOK['PLACE-PLACE-ENQUIRY-MOBILE-LABEL']; ?>" pattern="[7-9]{1}[0-9]{9}" title="<?php echo $BIZBOOK['PLACE-PLACE-ENQUIRY-INVALID-MOBILE-TITLE']; ?>" required>
                        </div>
                        <input type="hidden" id="source">
                        <button <?php if ($session_user_id == NULL || empty($session_user_id)) {
                                ?> disabled="disabled" <?php } ?> type="submit" id="place_add_request_submit" name="place_add_request_submit" class="place_add_request_submit btn btn-primary"><?php if ($session_user_id == NULL || empty($session_user_id)) {
                                                                                                                                                                                                ?><?php echo $BIZBOOK['LOG_IN_TO_SUBMIT']; ?><?php } else { ?><?php echo $BIZBOOK['SUBMIT']; ?><?php } ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SHARE POPUP -->
<div class="modal fade sharepop" id="sharepop">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $BIZBOOK['NEWS-SHARE-NOW']; ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <input type="text" value="" id="shareurl">
                <div class="shareurltip">
                    <button onclick="shareurl()" onmouseout="shareurlout()">
                        <span class="shareurltxt" id="myTooltip"><?php echo $BIZBOOK['NEWS-COPY-TO-CLIPBOARD']; ?></span>
                        Copy text
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
include "../footer.php";
?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/select-opt.js"></script>
<script type="text/javascript">
    var webpage_full_link = '<?php echo $webpage_full_link; ?>';
</script>
<script type="text/javascript">
    var login_url = '<?php echo $LOGIN_URL; ?>';
</script>
<script src="<?php echo $slash; ?>js/slick.js"></script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script>
    $('.multiple-items1').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]

    });
    $('.multiple-items2').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]

    });

    // Gallery image hover
    $(".img-wrapper").hover(
        function() {
            $(this).find(".img-overlay").animate({
                opacity: 1
            }, 600);
        },
        function() {
            $(this).find(".img-overlay").animate({
                opacity: 0
            }, 600);
        }
    );

    // Lightbox
    var $overlay = $('<div id="overlay"></div>');
    var $image = $("<img>");
    var $prevButton = $('<div id="prevButton"><i class="material-icons">chevron_left</i></div>');
    var $nextButton = $('<div id="nextButton"><i class="material-icons">chevron_right</i></div>');
    var $exitButton = $('<div id="exitButton"><i class="material-icons">close</i></div>');

    // Add overlay
    $overlay.append($image).prepend($prevButton).append($nextButton).append($exitButton);
    $("#gallery").append($overlay);

    // Hide overlay on default
    $overlay.hide();

    // When an image is clicked
    $(".img-overlay").click(function(event) {
        event.preventDefault();
        var imageLocation = $(this).prev().attr("href");
        $image.attr("src", imageLocation);
        $overlay.fadeIn("slow");
    });

    // When the overlay is clicked
    $overlay.click(function() {
        $(this).fadeOut("slow");
    });

    // When next button is clicked
    $nextButton.click(function(event) {
        $("#overlay img").hide();
        var $currentImgSrc = $("#overlay img").attr("src");
        var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
        var $nextImg = $($currentImg.closest(".plac-gal-imag").next().find("img"));
        var $images = $("#image-gallery img");
        if ($nextImg.length > 0) {
            $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
        } else {
            $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
        }
        event.stopPropagation();
    });

    // When previous button is clicked
    $prevButton.click(function(event) {
        $("#overlay img").hide();
        var $currentImgSrc = $("#overlay img").attr("src");
        var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
        var $nextImg = $($currentImg.closest(".plac-gal-imag").prev().find("img"));
        $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
        event.stopPropagation();
    });

    $exitButton.click(function() {
        $("#overlay").fadeOut("slow");
    });

    $(document).on('click', 'a[href^="#"]', function(event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);
    });
    // console.log('huygug');
</script>
</body>

</html>