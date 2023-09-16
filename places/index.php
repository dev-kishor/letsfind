<?php
include "places-config-info.php";
include "../header.php";
if (file_exists('../config/places_page_authentication.php')) {
    include('../config/places_page_authentication.php');
}
?>
<?php
if (isset($_GET['category'])) {
    $category_search_slug1 = str_replace('-', ' ', $_GET['category']);
    $category_search_slug = str_replace('.php', '', $category_search_slug1);
    $cat_search_row = getSlugPlaceCategoryLike($category_search_slug);  //Fetch Category Id using category name
    if ($cat_search_row['category_id'] == "") {
        $category_id = 0;
    } else {
        $category_id = $cat_search_row['category_id'];
    }
    $category_search_name = $cat_search_row['category_name'];
    $category_search_query = "category_id in ($category_id) or";
}
?>
<style>
    .hom-head .container {
        display: none
    }

    .hom-top {
        transition: all .5s ease;
        background: #000;
        box-shadow: none
    }

    .hom-head {
        background: none !important;
        padding: 0;
        margin: 0
    }

    .hom-head .hom-top .container {
        display: block
    }

    .hom-top {
        background: #292c2e;
    }
</style>
<!-- START -->
<section>
    <div class="plac-hom-ban">
        <div class="container">
            <div class="row">
                <div class="plac-hom-ban-inn">
                    <h1><?php echo $BIZBOOK['PLACE-HOME-H-1']; ?></h1>
                    <p><?php echo $BIZBOOK['PLACE-HOME-P-1-1']; ?> <b><?php echo $BIZBOOK['PLACE-HOME-B-1-1']; ?></b>. <?php echo $BIZBOOK['PLACE-HOME-P-1-2']; ?></p>
                    <div class="plac-hom-search">
                        <div class="job-sear">
                            <form class="place_filter_form">
                                <ul>
                                    <li class="sr-sea">
                                        <input type="text" class="place-text-search" id="place-text-search" placeholder="<?php echo $BIZBOOK['PLACE-HOME-SEARCH-OPTION-1']; ?>">
                                    </li>
                                    <li class="sr-btn">
                                        <button id="place_filter_sbmit" type="submit"><i class="material-icons">search</i></button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
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
                <div class="plac-hom-tit plac-hom-tit-ic-pla">
                    <h2><?php echo $BIZBOOK['PLACE-HOME-H-2-1']; ?></h2>
                    <p><?php echo $BIZBOOK['PLACE-HOME-P-2-1']; ?> <b><?php echo $BIZBOOK['PLACE-HOME-B-2-1']; ?></b></p>
                </div>
                <div class="col-md-2 fil-mob-view">
                    <div class="all-filt">
                        <span class="fil-mob-clo"><i class="material-icons">close</i></span>
                        <div class="filt-alist-near">
                            <div class="tit">
                                <h4>Filter By City</h4>
                            </div>
                            <div class="near-ser-list top-ser-secti-prov cutmstateslt">
                                <div class="how-to-coll">
                                    <ul>
                                        <?php foreach (getAllPlaceWhoHaveState() as $state_row) {
                                        ?>
                                            <li>
                                                <h4 class="selected_state" id="selected_state<?php echo $state_row['state'] ?>" value="<?php echo $state_row["state"] ?>">+<?php echo $state_row["state_name"] ?></h4>

                                                <div class="muslertlkjh">
                                                    <?php foreach (getAllPlaceCatWhoHaveCityForState($state_row["state"]) as $cat_row) {
                                                    ?>
                                                        <div class="dbhf">
                                                            <input type="checkbox" class="selected_cat" name="selected_cat<?php echo $state_row["state"] ?>" value="<?php echo $cat_row["category_id"] ?>" checked><?php echo $cat_row["category_name"] ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </li>
                                        <?php
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!--START-->
                        <div class="filt-com lhs-ads">
                            <ul>
                                <li>
                                    <div class="ads-box">
                                        <?php
                                        $ad_position_id = 4;   //Ad position on All Listing page Left
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
                            </ul>
                        </div>

                        <!-- END -->
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="plac-hom-all-pla">
                        <ul id="dimyhjgh">
                            <?php
                            $si = 1;
                            $placesql = "SELECT p.place_id,p.category_id,p.place_name,p.place_gallery_image,p.place_slug,s.state_name,c.city_name FROM " . TBL . "places as p join " . TBL . "states as s on s.state_id = p.state join " . TBL . "cities as c on c.city_id = p.city WHERE $category_search_query place_name like '%$category_search_slug%' ORDER BY place_id DESC";
                            $placers = mysqli_query($conn, $placesql);
                            if (mysqli_num_rows($placers) > 0) {
                                while ($placerow = mysqli_fetch_array($placers)) {
                                    $place_id = $placerow['place_id'];
                                    $category_id = $placerow['category_id'];
                                    $category_row = getPlaceCategory($category_id);
                            ?>
                                    <li class="list-plac-hom-box">
                                        <div class="plac-hom-box">
                                            <div class="plac-hom-box-im">
                                                <img loading="lazy" src="<?php echo $slash; ?>places/images/places/<?php echo explode(',', $placerow['place_gallery_image'])[0]; ?>" alt="">
                                                <h4><?php echo stripslashes($placerow['place_name']); ?></h4>
                                            </div>
                                            <div class="plac-hom-box-txt">
                                                <span><?php echo $category_row['category_name']; ?></span>
                                                <span><?php echo $BIZBOOK['PLACE-MORE-DETAILS']; ?></span>
                                            </div>
                                            <a href="<?php echo $PLACE_DETAIL_URL . urlModifier($placerow['place_slug']); ?>" class="fclick"></a>
                                        </div>
                                    </li>
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
                                        margin-top: 5%;"><?php echo $BIZBOOK['PLACES_NO_PLACES_MESSAGE']; ?></span>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div id="all-list-pagination-container"></div>
            </div>
        </div>
    </div>
</section>
<!--END-->
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
                                                                                                                                                                                                ?> <?php echo $BIZBOOK['LOG_IN_TO_SUBMIT']; ?> <?php } else { ?><?php echo $BIZBOOK['SUBMIT']; ?> <?php } ?></button>
                    </form>
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
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/thingstodo.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script src="<?php echo $slash; ?>js/jquery.simplePagination.min.js"></script>
<script>

$(".selected_state").on("click", function () {
  let state_id = $(this).attr("id").replace(/selected_state/g, "");
  let city_ids = [];
  $(`input[name=selected_cat${state_id}]:checked`).map(function () {
    city_ids.push($(this).val());
  });
  const queryData = { stateid: state_id, cat_ids: city_ids.join() };
  getPlaceWithStateCat(queryData);
});

$(".selected_cat").on("change", function () {
  let state_id = this.name.replace(/selected_cat/g, "");
  let city_id = this.value;
  console.log(state_id);
  document.querySelector("#selected_state" + state_id).click();
});

function getPlaceWithStateCat({ stateid, cat_ids }) {
  $.ajax({
    type: "POST",
    url: "../place_state_and_cat_process.php",
    data: "state_id=" + stateid + "&cat_ids=" + cat_ids,
    success: function (data) {
      $("#dimyhjgh").html(data);
      loadPagi()
      //   $("#sub_category_id").trigger("chosen:updated");
    },
  });
}


    function loadPagi() {
        var items = $(".list-plac-hom-box");
        console.log(items);
        var numItems = items.length;
        var perPage = 6;
        items.slice(perPage).hide();
        $('#all-list-pagination-container').pagination({
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
    }
    loadPagi()
</script>
</body>

</html>