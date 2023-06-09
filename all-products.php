<?php
include "header.php";
if ($footer_row['admin_product_show'] != 1) {
    header("Location: " . $webpage_full_link . "dashboard");
}
if (isset($_SESSION['user_id'])) {
    $session_user_id = $_SESSION['user_id'];
}
//Pagination Code Starts Here
$numberOfPages = 8;
$limit = 15;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};
$start_from = ($page - 1) * $limit;
//Pagination Code Ends Here
?>
<?php
if (isset($_GET['category'])) {

    $category_search_slug1 = str_replace('-', ' ', $_GET['category']);
    $category_search_slug = str_replace('.php', '', $category_search_slug1);
    $cat_search_row = getSlugProductCategoryLike($category_search_slug);  //Fetch Category Id using category name
    if ($cat_search_row['category_id'] == "") {
        $category_id = 0;
    } else {
        $category_id = $cat_search_row['category_id'];
    }
    $category_search_name = $cat_search_row['category_name'];
    $category_search_query = "AND category_id in ($category_id) or product_name like '%$category_search_slug%' or product_description like '%$category_search_slug%'";
}

?>
<!-- START -->
<section>
    <div class="all-list-bre all-pro-bre">
        <div class="container sec-all-list-bre">
            <div class="row">
                <?php
                if (isset($_GET['category'])) {
                ?>
                    <h1><?php echo $category_search_name; ?></h1>
                <?php
                } else {
                ?>
                    <h1><?php echo $BIZBOOK['ALL_CATEGORIES']; ?></h1>
                <?php
                }
                ?>
                <ul>
                    <li><a href="<?php echo $webpage_full_link; ?>"><?php echo $BIZBOOK['HOME']; ?></a></li>
                    <li><a href="<?php echo $webpage_full_link . 'all-products'; ?>"><?php echo $BIZBOOK['ALL_CATEGORY']; ?></a></li>
                    <?php
                    if (isset($_GET['category'])) {
                    ?>
                        <li>
                            <a href="<?php echo $ALL_PRODUCTS_URL . urlModifier($category_search_slug); ?>"><?php echo $category_search_name; ?></a>
                        </li>
                    <?php
                    } ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- END -->
<!-- START -->
<section>
    <div class="all-listing all-products">
        <!--FILTER ON MOBILE VIEW-->
        <div class="fil-mob fil-mob-act">
            <h4><?php echo $BIZBOOK['ALL-PRODUCTS-PRODUCT-FILTERS']; ?> <i class="material-icons">filter_list</i></h4>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 fil-mob-view">
                    <div class="all-filt">
                        <span class="fil-mob-clo"><i class="material-icons">close</i></span>


                        <!--START-->
                        <div class="filt-com lhs-ads">
                            <ul>
                                <li>
                                    <div class="ads-box">
                                        <?php
                                        $ad_position_id = 2;   //Ad position on All Listing page Top
                                        $get_ad_row = getAds($ad_position_id);
                                        $ad_enquiry_photo = $get_ad_row['ad_enquiry_photo'];
                                        ?>
                                        <a href="<?php echo stripslashes($get_ad_row['ad_link']); ?>">
                                            <span><?php echo $BIZBOOK['AD']; ?></span>
                                            <img src="<?php echo $slash; ?>images/ads/<?php if ($ad_enquiry_photo != NULL || !empty($ad_enquiry_photo)) {
                                                                                            echo $ad_enquiry_photo;
                                                                                        } else {
                                                                                            echo "ads1.jpg";
                                                                                        } ?>" alt="">
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="ads-box">
                                        <?php
                                        $ad_position_id = 3;   //Ad position on All Listing page Bottom
                                        $get_ad_row = getAds($ad_position_id);
                                        $ad_enquiry_photo = $get_ad_row['ad_enquiry_photo'];
                                        ?>
                                        <a href="<?php echo stripslashes($get_ad_row['ad_link']); ?>">
                                            <span><?php echo $BIZBOOK['AD']; ?></span>
                                            <img src="<?php echo $slash; ?>images/ads/<?php if ($ad_enquiry_photo != NULL || !empty($ad_enquiry_photo)) {
                                                                                            echo $ad_enquiry_photo;
                                                                                        } else {
                                                                                            echo "ads2.jpg";
                                                                                        } ?>" alt="">
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--END-->
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="all-list-sh all-product-total">
                        <ul class="products-wrapper">
                            <?php
                            $productsql = "SELECT * FROM " . TBL . "products  WHERE product_status= 'Active' $category_search_query $city_search_query ORDER BY product_id DESC";

                            $productrs = mysqli_query($conn, $productsql);
                            if (mysqli_num_rows($productrs) > 0) {
                                while ($productrow = mysqli_fetch_array($productrs)) {
                                    $product_id = $productrow['product_id'];
                                    $list_user_id = $productrow['user_id'];
                                    $usersqlrow = getUser($list_user_id); // To Fetch particular User Data

                                    //Likes Query Ends
                            ?>
                                    <li class="products-item">
                                        <div class="all-pro-box">
                                            <div class="all-pro-img">
                                                <img loading="lazy" src="<?php echo $slash; ?><?php if ($productrow['gallery_image'] != NULL || !empty($productrow['gallery_image'])) {
                                                                                                    echo "images/products/" . array_shift(explode(',', $productrow['gallery_image']));
                                                                                                } else {
                                                                                                    echo "images/products/hot4.jpg";
                                                                                                } ?>">
                                            </div>
                                            <div class="all-pro-aut">
                                                <div class="auth">
                                                    <?php
                                                    //To Check whether listing owner made profile is visible
                                                    $setting_profile_show = $usersqlrow['setting_profile_show'];
                                                    if ($setting_profile_show == 0) {
                                                    ?>
                                                        <img src="<?php echo $slash; ?>images/user/<?php if (($usersqlrow['profile_image'] == NULL) || empty($usersqlrow['profile_image'])) {
                                                                                                        echo $footer_row['user_default_image'];
                                                                                                    } else {
                                                                                                        echo $usersqlrow['profile_image'];
                                                                                                    } ?>" alt="">
                                                        <a target="_blank" href="<?php echo $PROFILE_URL . urlModifier($usersqlrow['user_slug']); ?>" class="fclick"></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="all-pro-txt">
                                                <h4><?php echo $productrow['product_name']; ?></h4>
                                                <span class="pri"><b class="pro-off"><?php echo $footer_row['currency_symbol']; ?><?php echo $productrow['product_price']; ?></b>
                                                    <?php if ($productrow['product_price_offer'] != NULL) { ?>
                                                        <?php echo $productrow['product_price_offer']; ?>% off<?php } ?>
                                                </span>
                                                <div class="links">
                                                    <?php if ($session_user_id != NULL || !empty($session_user_id)) {
                                                    ?>
                                                        <a href="#" data-toggle="modal" <?php
                                                                                        if ($list_user_id != 1) { ?> data-target="#quote<?php echo $product_id ?>" <?php
                                                                                                                                                                }
                                                                                                                                                                    ?>><?php echo $BIZBOOK['LEAD-GET-QUOTE']; ?></a>
                                                    <?php
                                                    } else { ?>
                                                        <a href="login"><?php echo $BIZBOOK['LEAD-GET-QUOTE']; ?></a>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <a href="<?php echo $PRODUCT_URL . urlModifier($productrow['product_slug']); ?>" class="pro-view-full"></a>
                                        </div>
                                    </li>

                                    <!--  Get Quote Pop up box starts  -->
                                    <section>
                                        <div class="pop-ups pop-quo">
                                            <!-- The Modal -->
                                            <div class="modal fade" id="quote<?php echo $product_id ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="log-bor">&nbsp;</div>
                                                        <span class="udb-inst"><?php echo $BIZBOOK['LEAD-SEND-ENQUIRY']; ?></span>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <!-- Modal Header -->
                                                        <div class="quote-pop">
                                                            <h4><?php echo $BIZBOOK['LEAD-GET-QUOTE']; ?></h4>
                                                            <div id="enq_success" class="log" style="display: none;">
                                                                <p><?php echo $BIZBOOK['ENQUIRY_SUCCESSFUL_MESSAGE']; ?></p>
                                                            </div>
                                                            <div id="enq_fail" class="log" style="display: none;">
                                                                <p><?php echo $BIZBOOK['OOPS_SOMETHING_WENT_WRONG']; ?></p>
                                                            </div>
                                                            <div id="enq_same" class="log" style="display: none;">
                                                                <p><?php echo $BIZBOOK['ENQUIRY_OWN_PRODUCT_MESSAGE']; ?></p>
                                                            </div>
                                                            <form method="post" name="all_product_enquiry_form" class="all_product_enquiry_form">
                                                                <input type="hidden" class="form-control" name="product_id" value="<?php echo $product_id ?>" placeholder="" required>
                                                                <input type="hidden" class="form-control" name="product_user_id" value="<?php echo $list_user_id; ?>" placeholder="" required>
                                                                <input type="hidden" class="form-control" name="enquiry_sender_id" value="<?php echo $session_user_id; ?>" placeholder="" required>
                                                                <input type="hidden" class="form-control" name="enquiry_source" value="<?php if (isset($_GET["src"])) {
                                                                                                                                            echo $_GET["src"];
                                                                                                                                        } else {
                                                                                                                                            echo "Website";
                                                                                                                                        }; ?>" placeholder="" required>
                                                                <div class="form-group">
                                                                    <input type="text" name="enquiry_name" value="<?php echo $user_details_row['first_name'] ?>" required="required" class="form-control" placeholder="<?php echo $BIZBOOK['LEAD-NAME-PLACEHOLDER']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="email" class="form-control" placeholder="<?php echo $BIZBOOK['ENTER_EMAIL_STAR']; ?>" value="<?php echo $user_details_row['email_id'] ?>" name="enquiry_email" pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$" title="<?php echo $BIZBOOK['LEAD-INVALID-EMAIL-TITLE']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" value="<?php echo $user_details_row['mobile_number'] ?>" name="enquiry_mobile" placeholder="<?php echo $BIZBOOK['LEAD-MOBILE-PLACEHOLDER']; ?>" pattern="[7-9]{1}[0-9]{9}" title="<?php echo $BIZBOOK['LEAD-INVALID-MOBILE-TITLE']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <textarea class="form-control" rows="3" name="enquiry_message" placeholder="<?php echo $BIZBOOK['LEAD-MESSAGE-PLACEHOLDER']; ?>"></textarea>
                                                                </div>
                                                                <input type="hidden" id="source">
                                                                <button type="submit" id="all_product_enquiry_submit" name="enquiry_submit" class="all_product_enquiry_submit btn btn-primary"><?php echo $BIZBOOK['SUBMIT']; ?></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!--  Get Quote Pop up box ends  -->

                                <?php
                                }
                            } else {
                                ?>
                                <span style="font-size: 21px;
                                            color: #bfbfbf;
                                            letter-spacing: 1px;
                                            /* background: #525252; */
                                            text-shadow: 0px 0px 2px #fff;
                                            text-transform: uppercase;
                                            margin-top: 5%;"><?php echo $BIZBOOK['PRODUCTS_NO_PRODUCTS_MESSAGE']; ?></span>
                            <?php
                            }
                            ?>
                        </ul>
                        <div id="product-pagination-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->
<?php
include "footer.php";
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
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/product_filter.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script src="<?php echo $slash; ?>js/jquery.simplePagination.min.js"></script>
<script>
    var items = $(".products-wrapper .products-item");
    var numItems = items.length;
    var perPage = 20;
    items.slice(perPage).hide();
    $('#product-pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function(pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
            $("html, body").animate({
                scrollTop: 0
            }, "fast");
            return false;
        }
    });
</script>
<script>
    <?php foreach (getAllProduct() as $rowq) { ?>
        $('.qvv<?php echo $rowq['product_code'] ?>').on('click', function() {
            $('.list-qview<?php echo $rowq['product_code'] ?>').addClass('qview-show');
        });
        $('.list-qview<?php echo $rowq['product_code'] ?>').on('mouseleave', function() {
            $('.list-qview<?php echo $rowq['product_code'] ?>').removeClass('qview-show');
        });
    <?php
    }
    ?>
</script>
<script>
    function ProductSubcategoryFilter(val) {
        //        alert(val);
        //        $(".sub_cat_section").remove();
        Productbreadcrumbs(val); //Function call to change breadcrumb
        $(".sub_cat_section").css("opacity", 0);
        $.ajax({
            type: "POST",
            url: "<?php echo $slash; ?>product_sub_category_filter.php",
            data: 'category_id=' + val,
            success: function(data) {
                if (data == null) {
                    $(".sub_cat_section").remove();
                } else {
                    $(".sub_cat_section").html(data);
                    $(".sub_cat_section").css("opacity", 1);
                }
            }
        });
    }
</script>
<script>
    function Productbreadcrumbs(val) {
        $(".sec-all-list-bre").css("opacity", 0);
        $.ajax({
            type: "POST",
            url: "<?php echo $slash; ?>product_category_filter_breadcrumb.php",
            data: 'category_id=' + val,
            success: function(data) {
                if (data == null) {
                    $(".sec-all-list-bre").css("opacity", 1);
                } else {
                    $(".sec-all-list-bre").html(data);
                    $(".sec-all-list-bre").css("opacity", 1);
                }
            }
        });
    }
</script>
</body>

</html>