<?php
if ($current_home_page == '1') {
    ?>

    <section>
        <div id="demo" class="carousel slide cate-sli caro-home" data-ride="carousel">
            <div class="container">
                <div class="row">
                    <div class="inn">
                        <div class="carousel-inner">
                            <?php
                            $si = 1;
                            foreach (getAllSlider() as $slider_row) {

                                ?>
                                <div class="carousel-item <?php if ($si == 1) { ?>active<?php } ?>">
                                    <img src="images/slider/<?php echo $slider_row['slider_photo']; ?>"
                                         alt="Los Angeles"
                                         width="1100" height="500">
                                    <a href="<?php echo $slider_row['slider_link']; ?>" target="_blank"></a>
                                </div>
                                <?php
                                $si++;
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--START-->
    <section>
        <div class="plac-hom-bd">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><?php echo $BIZBOOK['EXPL-MORE-FEA']; ?></h2>
                    </div>
                    <div class="plac-hom-all-pla hom-more-modu">
                        <ul class="travel-sliser-auto">
                            <?php
                            if (isset($_SESSION['user_id'])) {

                               $setting_job_show = $user_details_row['setting_job_show'];
                               $setting_product_show = $user_details_row['setting_product_show'];
                               $setting_coupon_show = $user_details_row['setting_coupon_show'];
                               $setting_expert_show = $user_details_row['setting_expert_show'];
                            }else{
                                $setting_job_show = 1;
                                $setting_product_show = 1;
                                $setting_coupon_show = 1;
                                $setting_expert_show = 1;
                            }
                            ?>
                            <?php if ($footer_row['admin_job_show'] == 1 && $setting_job_show == 1) { ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img src="images/home2-hand.jpg" alt="">
                                            <div class="inn-text">
                                                <h4><?php echo $BIZBOOK['HOM-MODU-TIT-JOB']; ?></h4>
                                                <a href="jobs/">Start finding <i
                                                        class="material-icons">arrow_forward</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                            <?php if ($footer_row['admin_product_show'] == 1 && $setting_product_show == 1) { ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img src="images/products/start-selling.jpg" alt="">
                                            <div class="inn-text">
                                                <h4><?php echo $BIZBOOK['HOM-MODU-TIT-PROD']; ?></h4>
                                                <a href="all-products">Start selling <i class="material-icons">arrow_forward</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                            <?php if ($footer_row['admin_coupon_show'] == 1 && $setting_coupon_show == 1) { ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img src="images/coupon-deals.jpg" alt="">
                                            <div class="inn-text">
                                                <h4><?php echo $BIZBOOK['HOM-MODU-TIT-DEAL']; ?></h4>
                                                <a href="coupons">Coupons <i
                                                        class="material-icons">arrow_forward</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php }
                            if ($footer_row['admin_place_show'] == 1) { ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img src="images/places/3.jpg" alt="">
                                            <div class="inn-text">
                                                <h4><?php echo $BIZBOOK['HOM-MODU-TIT-TRAVEL']; ?></h4>
                                                <a href="places/">Explore travel <i
                                                        class="material-icons">arrow_forward</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php }
                            if ($footer_row['admin_expert_show'] == 1 && $setting_expert_show == 1) { ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img src="images/experts/expert1.jpg" alt="">
                                            <div class="inn-text">
                                                <h4><?php echo $BIZBOOK['HOM-MODU-TIT-EXP']; ?></h4>
                                                <a href="service-experts/">Book Expert Now <i class="material-icons">arrow_forward</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php }
                            if ($footer_row['admin_news_show'] == 1) { ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img src="images/news.jpg" alt="">
                                            <div class="inn-text">
                                                <h4><?php echo $BIZBOOK['HOM-MODU-TIT-NEWS']; ?></h4>
                                                <a href="news/">News & Magazines <i
                                                        class="material-icons">arrow_forward</i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->

    <!--PRICING DETAILS
    <section class="<?php if ($footer_row['admin_language'] == 2) {
        echo "lg-arb";
    } ?> pri">
        <div class="container">
            <div class="row">
                <div class="plac-det-tit-inn">
                    <h2><?php echo $BIZBOOK['CHOOSE_YOUR_PLAN']; ?></h2>
                </div>
                <div>
                    <ul>
                        <?php
                        $si = 1;
                        foreach (getAllPlanType() as $plan_type_row) {
                            ?>
                            <li>
                                <div class="pri-box">
                                    <div class="c2">
                                        <h4><?php echo $plan_type_row['plan_type_name']; ?><?php echo $BIZBOOK['PLAN']; ?></h4>

                                        <?php if ($plan_type_row['plan_type_id'] == 1) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_GETTING_STARTED']; ?></p>
                                        <?php } elseif ($plan_type_row['plan_type_id'] == 2) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_PERFECT_SMALL_TEAMS']; ?></p>
                                        <?php } elseif ($plan_type_row['plan_type_id'] == 3) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_BEST_VALUE_LARGE']; ?></p>
                                        <?php } else { ?>
                                            <p><?php echo $BIZBOOK['PRICING_MADE_ENTERPRISES']; ?></p>
                                            <?php
                                        } ?>

                                    </div>
                                    <div class="c3">
                                        <h2><span></span><?php if ($plan_type_row['plan_type_price'] == 0) {
                                                echo $BIZBOOK['FREE'];
                                            } else {
                                                echo $footer_row['currency_symbol'] . '' . $plan_type_row['plan_type_price'];
                                            } ?></h2>
                                        <?php if ($plan_type_row['plan_type_id'] == 1) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_SINGLE_USER']; ?></p>
                                        <?php } elseif ($plan_type_row['plan_type_id'] == 2) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_STARTUP_BUSINESS']; ?></p>
                                        <?php } elseif ($plan_type_row['plan_type_id'] == 3) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_MEDIUM_BUSINESS']; ?></p>
                                        <?php } else { ?>
                                            <p><?php echo $BIZBOOK['PRICING_MADE_ENTERPRISES']; ?></p>
                                            <?php
                                        } ?>

                                    </div>
                                    <div class="c5">
                                        <a href="<?php
                                        if (isset($_SESSION['user_id'])) {
                                            echo "db-plan-change";
                                        } else {
                                            echo "login";
                                        } ?>" class="cta1"><?php echo $BIZBOOK['PRICING_GET_START']; ?></a>
                                        <a href="pricing-details" class="cta2"
                                           target="_blank"><?php echo $BIZBOOK['HOM-VI-KNOW-MORE']; ?></a>
                                    </div>
                                </div>
                            </li>
                            <?php
                            $si++;
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>-->
    <!--END PRICING DETAILS-->

    <!-- START -->
    <section>
        <div class="str count">
            <div class="container">
                <div class="row">
                    <div class="how-wrks">
                        <div class="home-tit">
                            <h2><span><?php echo $BIZBOOK['HOM-HOW-TIT']; ?></span></h2>
                            <p><?php echo $BIZBOOK['HOM-HOW-SUB-TIT']; ?></p>
                        </div>
                        <div class="how-wrks-inn">
                            <ul>
                                <li>
                                    <div>
                                        <span>1</span>
                                        <img src="images/icon/how1.png" alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-1']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-1']; ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <span>2</span>
                                        <img src="images/icon/how2.png" alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-2']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-2']; ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <span>3</span>
                                        <img src="images/icon/how3.png" alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-3']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-3']; ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <span>4</span>
                                        <img src="images/icon/how4.png" alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-4']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-4']; ?></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php if ($footer_row['admin_mobile_app_feature'] == 1) { ?>
                        <div class="mob-app">
                            <div class="lhs">
                                <img src="images/mobile.png" alt="">
                            </div>
                            <div class="rhs">
                                <h2><?php echo $BIZBOOK['HOM-APP-TIT']; ?>
                                    <span><?php echo $BIZBOOK['HOM-APP-TIT-SUB']; ?></span></h2>
                                <ul>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-1']; ?></li>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-2']; ?></li>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-3']; ?></li>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-4']; ?></li>
                                </ul>
                                <span><?php echo $BIZBOOK['HOM-APP-SEND']; ?></span>
                                <a href="#"><img src="images/gstore.png" alt=""> </a>
                                <a href="#"><img src="images/astore.png" alt=""> </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->
    <?php
} elseif ($current_home_page == '2') {
    ?>

    <!--START-->
    <section>
        <div class="plac-hom-bd">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><span><?php echo $BIZBOOK['HOM-POP-TIT']; ?></span> <?php echo $BIZBOOK['HOM-POP-TIT1']; ?>
                        </h2>
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul class="travel-sliser">
                            <?php
                            foreach (getAllCategories() as $category_sql_row) {
                                ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img
                                                src="images/services/<?php echo $category_sql_row['category_image']; ?>"
                                                alt="">
                                            <h4><?php echo $category_sql_row['category_name']; ?></h4>
                                        </div>
                                        <div class="plac-hom-box-txt">
                                            <span>Listing: <?php echo AddingZero_BeforeNumber(getCountCategoryListing($category_sql_row['category_id'])); ?></span>
                                            <span>More details</span>
                                        </div>
                                        <a href="all-listing?category=<?php echo preg_replace('/\s+/', '-', strtolower($category_sql_row['category_name'])); ?>"
                                           class="fclick"></a>
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
    <!--START-->
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><span><?php echo $BIZBOOK['HOM-BAN-TIT-CAT']; ?></span></h2>
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul class="travel-sliser">
                            <?php
                            foreach (getAllActiveExpertCategoriesPos() as $expert_categories_row) {

                                $category_name = $expert_categories_row['category_name'];

                                $category_id = $expert_categories_row['category_id'];

                                $total_experts_category = getCountCategoryExperts($category_id);
                                ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img
                                                src="<?php echo $slash; ?>service-experts/images/services/<?php echo $expert_categories_row['category_image']; ?>"
                                                alt="">
                                            <h4><?php echo $category_name; ?></h4>
                                        </div>
                                        <div class="plac-hom-box-txt">
                                            <span><?php echo $BIZBOOK['SERVICE-EXPERTS-EXPERTS']; ?><?php echo $total_experts_category; ?></span>
                                            <span>More details</span>
                                        </div>
                                        <a href="<?php echo $ALL_EXPERTS_URL . urlModifier($expert_categories_row['category_slug']); ?>"
                                           class="fclick"></a>
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


    <!--START-->
    <section>
        <div class="plac-hom-bd">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><?php echo $BIZBOOK['EXPL-MORE-FEA']; ?></h2>
                    </div>
                    <div class="plac-hom-all-pla hom-more-modu">
                        <ul>
                            <li>
                                <div class="plac-hom-box">
                                    <div class="plac-hom-box-im">
                                        <img src="images/home2-hand.jpg" alt="">
                                        <div class="inn-text">
                                            <h4>Start finding your dream job now</h4>
                                            <a href="jobs/">Start finding <i
                                                    class="material-icons">arrow_forward</i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="plac-hom-box">
                                    <div class="plac-hom-box-im">
                                        <img src="images/products/start-selling.jpg" alt="">
                                        <div class="inn-text">
                                            <h4>Start selling your products online</h4>
                                            <a href="all-products">Start selling <i
                                                    class="material-icons">arrow_forward</i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="plac-hom-box">
                                    <div class="plac-hom-box-im">
                                        <img src="images/coupon-deals.jpg" alt="">
                                        <div class="inn-text">
                                            <h4>Coupon and deals for your shopping</h4>
                                            <a href="coupons">Coupons <i class="material-icons">arrow_forward</i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->


    <!--START-->
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-hom-tit plac-hom-tit-ic-ser">
                        <h2>
                            <span><?php echo $BIZBOOK['HOM-BEST-TIT']; ?></span> <?php echo $BIZBOOK['HOM-BEST-TIT1']; ?>
                        </h2>
                        <p><?php echo $BIZBOOK['HOM-BEST-SUB-TIT']; ?></p>
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul class="travel-sliser">
                            <?php
                            $pop_bus = 1;
                            foreach (getAllFeaturedListing() as $row) {

                                $listing_id = $row['listing_id'];

                                $listing_sql_row = getIdListing($listing_id);
                                $featured_category_id = $listing_sql_row['category_id'];

                                $popular_business_category_sql_row = getCategory($featured_category_id);

                                // List Rating. for Rating of Star
                                foreach (getListingReview($listing_id) as $star_rating_row) {
                                    if ($star_rating_row["rate_cnt"] > 0) {
                                        $star_rate_times = $star_rating_row["rate_cnt"];
                                        $star_sum_rates = $star_rating_row["total_rate"];
                                        $star_rate_one = $star_sum_rates / $star_rate_times;
                                        //$star_rate_one = (($Star_rate_value)/5)*100;
                                        $star_rate_two = number_format($star_rate_one, 1);
                                        $star_rate = $star_rate_two;

                                    } else {
                                        $rate_times = 0;
                                        $rate_value = 0;
                                        $star_rate = 0;
                                    }
                                }

                                ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img
                                                src="<?php if ($listing_sql_row['profile_image'] != NULL || !empty($listing_sql_row['profile_image'])) {
                                                    echo "images/listings/" . $listing_sql_row['profile_image'];
                                                } else {
                                                    echo "images/listings/hot4.jpg";
                                                } ?>" alt="">
                                            <h4><?php echo $listing_sql_row['listing_name']; ?></h4>
                                            <span
                                                class="plac-det-cate"><?php echo $popular_business_category_sql_row['category_name']; ?></span>
                                        </div>
                                        <div class="plac-hom-box-txt">
                                            <div class="revi-box-1">
                                            <span class="red-sml-cta"><?php echo $BIZBOOK['LEAD-GET-QUOTE']; ?></span>
                                            </div>
                                            <span>More details</span>
                                        </div>
                                        <a href="<?php echo $LISTING_URL . urlModifier($listing_sql_row['listing_slug']); ?>"
                                           class="fclick"></a>
                                    </div>
                                </li>
                                <?php
                                $pop_bus++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->


    <!--START-->
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-hom-tit plac-hom-tit-ic-eve">
                        <h2><span><?php echo $BIZBOOK['HOM-EVE-TIT']; ?></span> <?php echo $BIZBOOK['HOM-EVE-TIT1']; ?>
                        </h2>
                        <p><?php echo $BIZBOOK['HOM-EVE-SUB-TIT']; ?></p>
                    </div>
                    <div class="plac-hom-all-pla plac-det-eve">
                        <ul class="travel-sliser">
                            <?php

                            foreach (getAllTopEvents() as $topeventrow_1) { //To Fetch Top Events First Two Rows using position Id

                                $event_name = $topeventrow_1['event_name'];

                                $event_sql_row = getEvent($event_name);

                                $user_id = $event_sql_row['user_id'];

                                $user_details_row = getUser($user_id);

                                ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img src="images/events/<?php echo $event_sql_row['event_image']; ?>"
                                                 alt="">
                                            <h4><?php echo $event_sql_row['event_name']; ?></h4>
                                            <span
                                                class="plac-det-cate"><?php echo dateMonthFormatconverter($event_sql_row['event_start_date']); ?><?php echo dateDayFormatconverter($event_sql_row['event_start_date']); ?></span>
                                        </div>
                                        <a href="<?php echo $EVENT_URL . urlModifier($event_sql_row['event_slug']); ?>"
                                           class="fclick"></a>
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


    <!--START-->
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-hom-tit plac-hom-tit-ic-nws">
                        <h2><?php echo $BIZBOOK['NEWS-HOMEPAGE-BANNER-H1-TEXT-2']; ?>
                            <b><?php echo $place_row['place_name']; ?></b></h2>
                        <p><?php echo $BIZBOOK['NEWS-HOMEPAGE-BANNER-P-TEXT']; ?>
                            <b><?php echo $BIZBOOK['PLACE-NEWS-B']; ?></b></p>
                    </div>
                    <div class="plac-hom-all-pla plac-det-eve">
                        <ul class="travel-sliser">
                            <?php
                            foreach (getAllNewsSlider() as $home_page_slider_row) {

                                $home_page_slider_news_id = $home_page_slider_row['news_id'];

                                $home_page_slider_news_slider_id = $home_page_slider_row['news_slider_id'];

                                $home_page_slider_news_sql_row = getIdNews($home_page_slider_news_id);

                                $home_page_slider_category_id = $home_page_slider_news_sql_row['category_id'];

                                $home_page_slider_category_row = getNewsCategory($home_page_slider_category_id);

                                $home_page_slider_category_name = $home_page_slider_category_row['category_name'];

                                ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img
                                                src="<?php echo $slash; ?>news/images/news/<?php echo $home_page_slider_news_sql_row['news_image']; ?>"
                                                alt="">

                                            <h4><?php echo stripslashes($home_page_slider_news_sql_row['news_title']); ?></h4>
                                            <span
                                                class="plac-det-cate"><?php echo $home_page_slider_category_name; ?></span>
                                        </div>
                                        <a href="<?php echo $NEWS_DETAIL_URL . urlModifier($home_page_slider_news_sql_row['news_slug']); ?>"
                                           class="fclick"></a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->

    <!--START-->
    <section>
        <div class="plac-hom-bd">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2><?php echo $BIZBOOK['PLACE-MENU']; ?></h2>
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul class="travel-sliser">
                            <?php
                            foreach (getAllPlaces() as $placerow) {

                                $place_id = $placerow['place_id'];

                                $category_id = $placerow['category_id'];

                                $category_row = getPlaceCategory($category_id);

                                ?>
                                <li>
                                    <div class="plac-hom-box">
                                        <div class="plac-hom-box-im">
                                            <img
                                                src="<?php echo $slash; ?>places/images/places/<?php echo explode(',', $placerow['place_gallery_image'])[0]; ?>"
                                                alt="">
                                            <h4><?php echo stripslashes($placerow['place_name']); ?></h4>
                                        </div>
                                        <div class="plac-hom-box-txt">
                                            <span><?php echo $category_row['category_name']; ?></span>
                                            <span><?php echo $BIZBOOK['PLACE-MORE-DETAILS']; ?></span>
                                        </div>
                                        <a href="<?php echo $PLACE_DETAIL_URL . urlModifier($placerow['place_slug']); ?>"
                                           class="fclick"></a>
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
} elseif ($current_home_page == '3') {
    ?>

    <!-- START -->
    <section>
        <div>
            <div class="container">
                <div class="row">
                    <!--<div class="home-tit">
                        <h2><span>Top Services</span> Cras nulla nulla, pulvinar sit amet nunc at, lacinia viverra lectus. Fusce imperdiet ullamcorper metus eu fringilla.</h2>
                    </div>-->
                    <div class="home-tit">
                        <h2><span><?php echo $BIZBOOK['HOM-POP-TIT']; ?></span> <?php echo $BIZBOOK['HOM-POP-TIT1']; ?>
                        </h2>
                        <p><?php echo $BIZBOOK['HOM-POP-SUB-TIT']; ?></p>
                    </div>
                    <div class="land-pack">
                        <ul>
                            <?php
                            foreach (getAllCategories() as $category_sql_row) {
                                ?>
                                <li>
                                    <div class="land-pack-grid">
                                        <div class="land-pack-grid-img">
                                            <img
                                                src="<?php echo $webpage_full_link; ?>images/services/<?php echo $category_sql_row['category_image']; ?>"
                                                alt="">
                                        </div>
                                        <div class="land-pack-grid-text">
                                            <h4><?php echo $category_sql_row['category_name']; ?>
                                                <span
                                                    class="dir-ho-cat"><?php echo $BIZBOOK['LISTINGS']; ?><?php echo AddingZero_BeforeNumber(getCountCategoryListing($category_sql_row['category_id'])); ?></span>
                                            </h4>
                                        </div>
                                        <a href="<?php echo $ALL_LISTING_URL . urlModifier($category_sql_row['category_slug']); ?>"
                                           class="land-pack-grid-btn"><?php echo $BIZBOOK['VIEW_ALL_LISTINGS']; ?></a>
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
    <!-- END -->

    <!-- START -->
    <section>
        <div class="str hom2-cus hom4-fea">
            <div class="container">
                <div class="row">
                    <div class="home-tit">
                        <h2>
                            <span><?php echo $BIZBOOK['HOM-BEST-TIT']; ?></span> <?php echo $BIZBOOK['HOM-BEST-TIT1']; ?>
                        </h2>
                        <p><?php echo $BIZBOOK['HOM-BEST-SUB-TIT']; ?></p>
                    </div>

                    <div class="hom2-cus-sli">
                        <ul class="multiple-items1">
                            <?php
                            $pop_bus = 1;
                            foreach (getAllFeaturedListing() as $row) {

                                $listing_id = $row['listing_id'];

                                $listing_sql_row = getIdListing($listing_id);
                                $featured_category_id = $listing_sql_row['category_id'];

                                $popular_business_category_sql_row = getCategory($featured_category_id);

                                // List Rating. for Rating of Star
                                foreach (getListingReview($listing_id) as $star_rating_row) {
                                    if ($star_rating_row["rate_cnt"] > 0) {
                                        $star_rate_times = $star_rating_row["rate_cnt"];
                                        $star_sum_rates = $star_rating_row["total_rate"];
                                        $star_rate_one = $star_sum_rates / $star_rate_times;
                                        //$star_rate_one = (($Star_rate_value)/5)*100;
                                        $star_rate_two = number_format($star_rate_one, 1);
                                        $star_rate = $star_rate_two;

                                    } else {
                                        $rate_times = 0;
                                        $rate_value = 0;
                                        $star_rate = 0;
                                    }
                                }

                                ?>
                                <li>
                                    <div class="testmo hom4-prop-box">
                                        <img
                                            src="<?php echo $webpage_full_link; ?><?php if ($listing_sql_row['profile_image'] != NULL || !empty($listing_sql_row['profile_image'])) {
                                                echo "images/listings/" . $listing_sql_row['profile_image'];
                                            } else {
                                                echo "images/listings/hot4.jpg";
                                            } ?>" alt="">
                                        <div>
                                            <h4>
                                                <a href="<?php echo $LISTING_URL . urlModifier($listing_sql_row['listing_slug']); ?>"><?php echo $listing_sql_row['listing_name']; ?></a>
                                            </h4>
                                            <?php if ($star_rate != 0) { ?>
                                                <label class="rat">
                                                    <?php
                                                    for ($i = 1; $i <= ceil($star_rate_two); $i++) {
                                                        ?>
                                                        <i class="material-icons">star</i>
                                                        <?php
                                                    }
                                                    $bal_star_rate = abs(ceil($star_rate_two) - 5);

                                                    for ($i = 1; $i <= $bal_star_rate; $i++) {
                                                        ?>
                                                        <i class="material-icons">star_border</i>
                                                        <?php
                                                    }
                                                    ?>
                                                </label>
                                            <?php } ?>
                                            <span><a
                                                    href="#"><?php echo $popular_business_category_sql_row['category_name']; ?></a></span>
                                        </div>
                                        <a href="<?php echo $LISTING_URL . urlModifier($listing_sql_row['listing_slug']); ?>"
                                           class="fclick"></a>
                                    </div>
                                </li>
                                <?php
                                $pop_bus++;
                            }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!--PRICING DETAILS-->
    <section class="<?php if ($footer_row['admin_language'] == 2) {
        echo "lg-arb";
    } ?> pri">
        <div class="container">
            <div class="row">
                <div class="tit">
                    <h2>
                        <span><?php echo $BIZBOOK['CHOOSE_YOUR_PLAN']; ?></span></h2>
                </div>
                <div>
                    <ul>
                        <?php
                        $si = 1;
                        foreach (getAllPlanType() as $plan_type_row) {
                            ?>
                            <li>
                                <div class="pri-box">
                                    <div class="c2">
                                        <h4><?php echo $plan_type_row['plan_type_name']; ?> plan</h4>

                                        <?php if ($plan_type_row['plan_type_id'] == 1) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_GETTING_STARTED']; ?></p>
                                        <?php } elseif ($plan_type_row['plan_type_id'] == 2) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_PERFECT_SMALL_TEAMS']; ?></p>
                                        <?php } elseif ($plan_type_row['plan_type_id'] == 3) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_BEST_VALUE_LARGE']; ?></p>
                                        <?php } else { ?>
                                            <p><?php echo $BIZBOOK['PRICING_MADE_ENTERPRISES']; ?></p>
                                            <?php
                                        } ?>

                                    </div>
                                    <div class="c3">
                                        <h2><span></span><?php if ($plan_type_row['plan_type_price'] == 0) {
                                                echo $BIZBOOK['FREE'];
                                            } else {
                                                echo $footer_row['currency_symbol'] . '' . $plan_type_row['plan_type_price'];
                                            } ?></h2>
                                        <?php if ($plan_type_row['plan_type_id'] == 1) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_SINGLE_USER']; ?></p>
                                        <?php } elseif ($plan_type_row['plan_type_id'] == 2) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_STARTUP_BUSINESS']; ?></p>
                                        <?php } elseif ($plan_type_row['plan_type_id'] == 3) { ?>
                                            <p><?php echo $BIZBOOK['PRICING_MEDIUM_BUSINESS']; ?></p>
                                        <?php } else { ?>
                                            <p><?php echo $BIZBOOK['PRICING_MADE_ENTERPRISES']; ?></p>
                                            <?php
                                        } ?>

                                    </div>
                                    <div class="c5">
                                        <a href="<?php
                                        if (isset($_SESSION['user_id'])) {
                                            echo "db-plan-change";
                                        } else {
                                            echo "login";
                                        } ?>" class="cta1"><?php echo $BIZBOOK['PRICING_GET_START']; ?></a>
                                        <a href="pricing-details" class="cta2"
                                           target="_blank"><?php echo $BIZBOOK['HOM-VI-KNOW-MORE']; ?></a>
                                    </div>
                                </div>
                            </li>
                            <?php
                            $si++;
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--END PRICING DETAILS-->

    <!-- START -->
    <section class="news-hom-ban-sli">
        <div class="home-tit">
            <h2><span><?php echo $BIZBOOK['HOM-EVE-TIT']; ?></span> <?php echo $BIZBOOK['HOM-EVE-TIT1']; ?></h2>
            <p><?php echo $BIZBOOK['HOM-EVE-SUB-TIT']; ?></p>
        </div>

        <div class="news-hom-ban-sli-inn">
            <ul class="multiple-items2">
                <?php

                foreach (getAllTopEvents() as $topeventrow_1) { //To Fetch Top Events First Two Rows using position Id

                    $event_name = $topeventrow_1['event_name'];

                    $event_sql_row = getEvent($event_name);

                    $user_id = $event_sql_row['user_id'];

                    $user_details_row = getUser($user_id);

                    ?>
                    <li>
                        <div class="news-hban-box">
                            <div class="im">
                                <img loading="lazy"
                                     src="<?php echo $webpage_full_link; ?>images/events/<?php echo $event_sql_row['event_image']; ?>"
                                     alt="">
                            </div>
                            <div class="txt">
                                <span
                                    class="news-cate"><?php echo dateMonthFormatconverter($event_sql_row['event_start_date']); ?><?php echo dateDayFormatconverter($event_sql_row['event_start_date']); ?></span>
                                <h2><?php echo $event_sql_row['event_name']; ?></h2>
                                <span class="news-date"><?php echo $BIZBOOK['HOM3-OW-POSTED-ON']; ?>
                                    : <?php echo dateFormatconverter($event_sql_row['event_cdt']); ?></span>
                            </div>
                            <a href="<?php echo $EVENT_URL . urlModifier($event_sql_row['event_slug']); ?>"
                               class="fclick"></a>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </section>
    <!--END-->

    <!-- START -->
    <section>
        <div class="str hom2-cus">
            <div class="container">
                <div class="row">
                    <div class="home-tit">
                        <h2><span><?php echo $BIZBOOK['HOM3-OW-USER-REVIEW']; ?></span></h2>
                        <p><?php echo $BIZBOOK['HOM3-OW-TIT-SUB']; ?></p>
                    </div>
                    <div class="hom2-cus-sli">
                        <ul class="multiple-items">
                            <?php
                            foreach (getTenActiveReviews() as $reviewss_row) {

                                $review_user_id = $reviewss_row['review_user_id'];

                                $listing_id = $reviewss_row['listing_id'];

                                $listing_sql_row = getIdListing($listing_id);

                                $user_details_row = getUser($review_user_id);

                                $featured_category_id = $listing_sql_row['category_id'];

                                $popular_business_category_sql_row = getCategory($featured_category_id);

                                // List Rating. for Rating of Star

                                if ($reviewss_row['price_rating'] > 0) {

                                    $star_rate = $reviewss_row['price_rating'];

                                } else {
                                    $star_rate = 0;
                                }

                                ?>
                                <li>
                                    <div class="testmo">
                                        <img
                                            src="<?php echo $webpage_full_link; ?>images/user/<?php if (($user_details_row['profile_image'] == NULL) || empty($user_details_row['profile_image'])) {
                                                echo "1.jpg";
                                            } else {
                                                echo $user_details_row['profile_image'];
                                            } ?>" alt="">
                                        <h4><?php echo $user_details_row['first_name']; ?></h4>
                                    <span><?php echo $BIZBOOK['SERVICE-EXPERT-WRITTEN-REVIEW-TO']; ?> <a
                                            href="<?php echo $LISTING_URL . urlModifier($listing_sql_row['listing_slug']); ?>"><?php echo $listing_sql_row['listing_name']; ?></a></span>

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
                                                    <i class="material-icons">star_border</i>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                            <?php
                                        } ?>
                                        <p><?php echo $reviewss_row['review_message']; ?></p>
                                    </div>
                                </li>
                                <?php
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- START -->
    <section>
        <div class="str count">
            <div class="container">
                <div class="row">

                    <div class="how-wrks">
                        <div class="home-tit">
                            <h2><span><?php echo $BIZBOOK['HOM-HOW-TIT']; ?></span></h2>
                            <p><?php echo $BIZBOOK['HOM-HOW-SUB-TIT']; ?></p>
                        </div>
                        <div class="how-wrks-inn">
                            <ul>
                                <li>
                                    <div>
                                        <span>1</span>
                                        <img loading="lazy" src="<?php echo $webpage_full_link; ?>images/icon/how1.png"
                                             alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-1']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-1']; ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <span>2</span>
                                        <img loading="lazy" src="<?php echo $webpage_full_link; ?>images/icon/how2.png"
                                             alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-2']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-2']; ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <span>3</span>
                                        <img loading="lazy" src="<?php echo $webpage_full_link; ?>images/icon/how3.png"
                                             alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-3']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-3']; ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <span>4</span>
                                        <img loading="lazy" src="<?php echo $webpage_full_link; ?>images/icon/how4.png"
                                             alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-4']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-4']; ?></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php if ($footer_row['admin_mobile_app_feature'] == 1) { ?>
                        <div class="mob-app">
                            <div class="lhs">
                                <img loading="lazy" src="<?php echo $webpage_full_link; ?>images/mobile.png" alt="">
                            </div>
                            <div class="rhs">
                                <h2><?php echo $BIZBOOK['HOM-APP-TIT']; ?>
                                    <span><?php echo $BIZBOOK['HOM-APP-TIT-SUB']; ?></span></h2>
                                <ul>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-1']; ?></li>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-2']; ?></li>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-3']; ?></li>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-4']; ?></li>
                                </ul>
                                <span><?php echo $BIZBOOK['HOM-APP-SEND']; ?></span>
                                <form>
                                    <ul>
                                        <li>
                                            <input type="email" placeholder="Enter email id" required></li>
                                        <li>
                                            <input type="submit" value="Get App Link"></li>
                                    </ul>
                                </form>
                                <a href="#"><img loading="lazy"
                                                 src="<?php echo $webpage_full_link; ?>images/android.png" alt=""> </a>
                                <a href="#"><img loading="lazy" src="<?php echo $webpage_full_link; ?>images/apple.png"
                                                 alt=""> </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->


    <?php
} elseif ($current_home_page == '4' || $current_home_page == '5' || $current_home_page == '6' || $current_home_page == '7' || $current_home_page == '8' || $current_home_page == '9') {
    ?>


    <!-- START -->
    <section>
        <div class="str hom2-cus hom4-fea">
            <div class="container">
                <div class="row">
                    <div class="home-tit">
                        <h2>
                            <span><?php echo $BIZBOOK['HOM-BEST-TIT']; ?></span> <?php echo $BIZBOOK['HOM-BEST-TIT1']; ?>
                        </h2>
                        <p><?php echo $BIZBOOK['HOM-BEST-SUB-TIT']; ?></p>
                    </div>

                    <!-- NEW FEATURE SERVICES -->
                    <div class="hom2-cus-sli">
                        <ul class="multiple-items1">
                            <?php
                            $pop_bus = 1;
                            foreach (getAllFeaturedListing() as $row) {

                                $listing_id = $row['listing_id'];

                                $listing_sql_row = getIdListing($listing_id);
                                $featured_category_id = $listing_sql_row['category_id'];

                                $popular_business_category_sql_row = getCategory($featured_category_id);

                                // List Rating. for Rating of Star
                                foreach (getListingReview($listing_id) as $star_rating_row) {
                                    if ($star_rating_row["rate_cnt"] > 0) {
                                        $star_rate_times = $star_rating_row["rate_cnt"];
                                        $star_sum_rates = $star_rating_row["total_rate"];
                                        $star_rate_one = $star_sum_rates / $star_rate_times;
                                        //$star_rate_one = (($Star_rate_value)/5)*100;
                                        $star_rate_two = number_format($star_rate_one, 1);
                                        $star_rate = $star_rate_two;

                                    } else {
                                        $rate_times = 0;
                                        $rate_value = 0;
                                        $star_rate = 0;
                                    }
                                }

                                ?>
                                <li>
                                    <div class="testmo hom4-prop-box">
                                        <img
                                            src="<?php echo $webpage_full_link; ?><?php if ($listing_sql_row['profile_image'] != NULL || !empty($listing_sql_row['profile_image'])) {
                                                echo "images/listings/" . $listing_sql_row['profile_image'];
                                            } else {
                                                echo "images/listings/hot4.jpg";
                                            } ?>" alt="">
                                        <div>
                                            <h4>
                                                <a href="<?php echo $LISTING_URL . urlModifier($listing_sql_row['listing_slug']); ?>"><?php echo $listing_sql_row['listing_name']; ?></a>
                                            </h4>
                                            <?php if ($star_rate != 0) { ?>
                                                <label class="rat">
                                                    <?php
                                                    for ($i = 1; $i <= ceil($star_rate_two); $i++) {
                                                        ?>
                                                        <i class="material-icons">star</i>
                                                        <?php
                                                    }
                                                    $bal_star_rate = abs(ceil($star_rate_two) - 5);

                                                    for ($i = 1; $i <= $bal_star_rate; $i++) {
                                                        ?>
                                                        <i class="material-icons">star_border</i>
                                                        <?php
                                                    }
                                                    ?>
                                                </label>
                                            <?php } ?>
                                            <span><a
                                                    href="#"><?php echo $popular_business_category_sql_row['category_name']; ?></a></span>
                                        </div>
                                        <a href="<?php echo $LISTING_URL . urlModifier($listing_sql_row['listing_slug']); ?>"
                                           class="fclick"></a>
                                    </div>
                                </li>
                                <?php
                                $pop_bus++;
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- END NEW FEATURE SERVICES -->
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- START -->
    <section>
        <div class="str">
            <div class="container">
                <div class="row">
                    <div class="home-tit">
                        <h2><span><?php echo $BIZBOOK['HOM3-OW-TIT']; ?></span></h2>
                        <p><?php echo $BIZBOOK['HOM3-OW-TIT-SUB']; ?></p>
                    </div>
                    <div class="hom2-hom-ban-main">
                        <div class="hom2-hom-ban hom2-hom-ban1">
                            <h2><?php echo $BIZBOOK['HOM3-OW-LHS-TIT']; ?></h2>
                            <p><?php echo $BIZBOOK['HOM3-OW-LHS-SUB']; ?></p>
                            <a href="pricing-details"><?php echo $BIZBOOK['HOM3-OW-LHS-CTA']; ?></a>
                        </div>
                        <div class="hom2-hom-ban hom2-hom-ban2">
                            <h2><?php echo $BIZBOOK['HOM3-OW-RHS-TIT']; ?></h2>
                            <p><?php echo $BIZBOOK['HOM3-OW-RHS-SUB']; ?></p>
                            <a href="login?login=register"><?php echo $BIZBOOK['HOM3-OW-RHS-CTA']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <!-- START -->
    <section>
        <div class="str hom2-cus">
            <div class="container">
                <div class="row">
                    <div class="home-tit">
                        <h2><span><?php echo $BIZBOOK['HOM3-OW-USER-REVIEW']; ?></span></h2>
                        <p><?php echo $BIZBOOK['HOM3-OW-TIT-SUB']; ?></p>
                    </div>

                    <div class="hom2-cus-sli">
                        <ul class="multiple-items">
                            <?php
                            foreach (getTenActiveReviews() as $reviewss_row) {

                                $review_user_id = $reviewss_row['review_user_id'];

                                $listing_id = $reviewss_row['listing_id'];

                                $listing_sql_row = getIdListing($listing_id);

                                $user_details_row = getUser($review_user_id);

                                $featured_category_id = $listing_sql_row['category_id'];

                                $popular_business_category_sql_row = getCategory($featured_category_id);

                                // List Rating. for Rating of Star

                                if ($reviewss_row['price_rating'] > 0) {

                                    $star_rate = $reviewss_row['price_rating'];

                                } else {
                                    $star_rate = 0;
                                }

                                ?>
                                <li>
                                    <div class="testmo">
                                        <img
                                            src="<?php echo $webpage_full_link; ?>images/user/<?php if (($user_details_row['profile_image'] == NULL) || empty($user_details_row['profile_image'])) {
                                                echo "1.jpg";
                                            } else {
                                                echo $user_details_row['profile_image'];
                                            } ?>" alt="">
                                        <h4><?php echo $user_details_row['first_name']; ?></h4>
                                    <span><?php echo $BIZBOOK['SERVICE-EXPERT-WRITTEN-REVIEW-TO']; ?> <a
                                            href="<?php echo $LISTING_URL . urlModifier($listing_sql_row['listing_slug']); ?>"><?php echo $listing_sql_row['listing_name']; ?></a></span>

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
                                                    <i class="material-icons">star_border</i>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                            <?php
                                        } ?>
                                        <p><?php echo $reviewss_row['review_message']; ?></p>
                                    </div>
                                </li>
                                <?php
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->


    <!-- START -->
    <section>
        <div class="str count">
            <div class="container">
                <div class="row">

                    <div class="how-wrks">
                        <div class="home-tit">
                            <h2><span><?php echo $BIZBOOK['HOM-HOW-TIT']; ?></span></h2>
                            <p><?php echo $BIZBOOK['HOM-HOW-SUB-TIT']; ?></p>
                        </div>
                        <div class="how-wrks-inn">
                            <ul>
                                <li>
                                    <div>
                                        <span>1</span>
                                        <img loading="lazy" src="<?php echo $webpage_full_link; ?>images/icon/how1.png"
                                             alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-1']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-1']; ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <span>2</span>
                                        <img loading="lazy" src="<?php echo $webpage_full_link; ?>images/icon/how2.png"
                                             alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-2']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-2']; ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <span>3</span>
                                        <img loading="lazy" src="<?php echo $webpage_full_link; ?>images/icon/how3.png"
                                             alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-3']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-3']; ?></p>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <span>4</span>
                                        <img loading="lazy" src="<?php echo $webpage_full_link; ?>images/icon/how4.png"
                                             alt="">
                                        <h4><?php echo $BIZBOOK['HOM-HOW-P-TIT-4']; ?></h4>
                                        <p><?php echo $BIZBOOK['HOM-HOW-P-SUB-4']; ?></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <?php if ($footer_row['admin_mobile_app_feature'] == 1) { ?>
                        <div class="mob-app">
                            <div class="lhs">
                                <img loading="lazy" src="<?php echo $webpage_full_link; ?>images/mobile.png" alt="">
                            </div>
                            <div class="rhs">
                                <h2><?php echo $BIZBOOK['HOM-APP-TIT']; ?>
                                    <span><?php echo $BIZBOOK['HOM-APP-TIT-SUB']; ?></span></h2>
                                <ul>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-1']; ?></li>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-2']; ?></li>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-3']; ?></li>
                                    <li><?php echo $BIZBOOK['HOM-APP-PO-4']; ?></li>
                                </ul>
                                <span><?php echo $BIZBOOK['HOM-APP-SEND']; ?></span>
                                <form>
                                    <ul>
                                        <li>
                                            <input type="email" placeholder="Enter email id" required></li>
                                        <li>
                                            <input type="submit" value="Get App Link"></li>
                                    </ul>
                                </form>
                                <a href="#"><img loading="lazy"
                                                 src="<?php echo $webpage_full_link; ?>images/android.png" alt=""> </a>
                                <a href="#"><img loading="lazy" src="<?php echo $webpage_full_link; ?>images/apple.png"
                                                 alt=""> </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- END -->

    <?php
}
?>