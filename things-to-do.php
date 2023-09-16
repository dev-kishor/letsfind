<?php
include "header.php";
?>

<!-- START -->
<section class="sec-todo">
    <div class="all-listing all-listing-pg">
        <!--FILTER ON MOBILE VIEW-->
        <div class="fil-mob fil-mob-act">
            <h4><?php echo $BIZBOOK['ALL-LISTING-LISTING-FILTERS']; ?> <i class="material-icons">filter_list</i></h4>
        </div>
        <div class="all-list-bre">
            <div class="container sec-all-list-bre">

            </div>
        </div>
        <div class="container">
            <!-- <div class="container-fluid"> -->
            <div class="row">
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
                                                <h4><input type="radio" name="selected_state" class="selected_state" id="selected_state<?php echo $state_row['state'] ?>" value="<?php echo $state_row["state"] ?>"><?php echo $state_row["state_name"] ?></h4>
                                                <div class="muslertlkjh">
                                                    <?php foreach (getAllPlaceWhoHaveCityForState($state_row["state"]) as $city_row) {
                                                    ?>
                                                        <div class="dbhf">
                                                            <input type="checkbox" class="selected_city" name="selected_city<?php echo $state_row["state"] ?>" value="<?php echo $city_row["city"] ?>" checked><?php echo $city_row["city_name"] ?>
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
                    <div class="f2">
                        <div class="vfilter">
                            <i class="material-icons ic1 <?php if (isset($_GET['grid'])) {
                                                                echo "act";
                                                            } ?>" title="Grid view">apps</i>
                            <i class="material-icons ic2 <?php if (isset($_GET['list'])) {
                                                                echo "act";
                                                            } elseif (!isset($_GET['grid']) && !isset($_GET['list'])) {
                                                                echo "act";
                                                            } ?>" title="List view">format_list_bulleted</i>
                            <i class="material-icons ic3" title="Map view">location_on</i>
                        </div>
                    </div>
                    <!-- LISTING INN FILTER -->
                    <div class="list-filt-v2">
                        <ul>
                            <li>
                                <div class="chbox">
                                    <input type="checkbox" name="lfv2-all" class="lfv2-all" value="1" id="lfv2-all" checked="checked" />
                                    <label for="lfv2-all"><?php echo $BIZBOOK['ALL-LISTING-FILTER-ALL']; ?></label>
                                </div>
                            </li>
                            <li>
                                <div class="chbox">
                                    <input type="checkbox" name="lfv2-pop" class="lfv2-pop" id="lfv2-pop" />
                                    <label for="lfv2-pop"><?php echo $BIZBOOK['ALL-LISTING-FILTER-POPULAR']; ?></label>
                                </div>
                            </li>
                            <li>
                                <div class="chbox">
                                    <input type="checkbox" name="lfv2-op" class="lfv2-op" id="lfv2-op" />
                                    <label for="lfv2-op"><?php echo $BIZBOOK['ALL-LISTING-FILTER-OPEN']; ?></label>
                                </div>
                            </li>
                            <li>
                                <div class="chbox">
                                    <input type="checkbox" name="lfv2-tru" class="lfv2-tru" id="lfv2-tru" />
                                    <label for="lfv2-tru"><?php echo $BIZBOOK['ALL-LISTING-FILTER-VERIFIED']; ?></label>
                                </div>
                            </li>
                            <li>
                                <div class="chbox">
                                    <input type="checkbox" name="lfv2-near" class="lfv2-near" id="lfv2-near" />
                                    <label for="lfv2-near"><?php echo $BIZBOOK['ALL-LISTING-FILTER-NEARBY']; ?></label>
                                </div>
                            </li>
                            <li>
                                <div class="chbox">
                                    <input type="checkbox" name="lfv2-off" class="lfv2-off" id="lfv2-off" />
                                    <label for="lfv2-off"><?php echo $BIZBOOK['ALL-LISTING-FILTER-OFFERS']; ?></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- END LISTING INN FILTER -->
                    <!--ADS-->
                    <div class="ban-ati-com ads-all-list">
                        <?php
                        $ad_position_id = 2;   //Ad position on All Listing page Top
                        $get_ad_row = getAds($ad_position_id);
                        $ad_enquiry_photo = $get_ad_row['ad_enquiry_photo'];
                        ?>
                        <a href="<?php echo stripslashes($get_ad_row['ad_link']); ?>"><span><?php echo $BIZBOOK['AD']; ?></span><img src="<?php echo $slash; ?>images/ads/<?php if ($ad_enquiry_photo != NULL || !empty($ad_enquiry_photo)) {
                                                                                                                                                                                echo $ad_enquiry_photo;
                                                                                                                                                                            } else {
                                                                                                                                                                                echo "59040boat-728x90.png";
                                                                                                                                                                            } ?>"></a>
                    </div>
                    <!--ADS-->
                    <div id="dynmdata">
                        <?php
                        foreach (getAllPlacesWithToDo() as $todo_place) {
                        ?>
                            <div class="list-det-rel-pre todouilist">
                                <ul class="todolistul">
                                    <div class="plac-det-tit-inn">
                                        <h2>Things to do At <?php echo $todo_place["place_name"] ?></h2>
                                    </div>
                                    <?php
                                    $todo_name = $todo_place['todo_name'];
                                    $todo_url = $todo_place['todo_url'];
                                    $todo_img = $todo_place['todo_img'];
                                    $todo_name_Array = explode('|', $todo_name);
                                    $todo_url_Array = explode('|', $todo_url);
                                    $todo_img_Array = explode(',', $todo_img);
                                    $zipped = array_map(null, $todo_name_Array, $todo_url_Array, $todo_img_Array);
                                    // prx($zipped);
                                    foreach ($zipped as $tuple) {
                                    ?>
                                        <li class="todolistli">
                                            <div class="land-pack-grid">
                                                <div class="land-pack-grid-img">
                                                    <img src="<?php echo $slash; ?>places/images/todo/<?php echo $tuple[2] ?>" alt="">
                                                </div>
                                                <div class="land-pack-grid-text">
                                                    <h4><?php echo $tuple[0] ?></h4>
                                                </div>
                                                <div class="todoBtn">
                                                    <button><a target="_blank" href="<?php echo $tuple[1] ?>"></a>Explore</button>
                                                    <button><a target="_blank" href="<?php echo $todo_place["google_map"] ?>"><span class="addr"></span> View Map</a></button>
                                                </div>
                                                <!-- <a target="_blank" href="<?php echo $tuple[1] ?>" class="land-pack-grid-btn"></a> -->
                                            </div>
                                        </li>

                                    <?php } ?>
                                </ul>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div id="all-list-pagination-container"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->
<section>
    <div class="list-foot">
        <div class="container sec-all-foot-cat-info">

        </div>
    </div>
</section>
<!-- END -->
<?php
include "footer.php";
?>
<script src="<?php echo $slash; ?>js/jquery.min.js"></script>
<script src="<?php echo $slash; ?>js/popper.min.js"></script>
<script src="<?php echo $slash; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $slash; ?>js/jquery-ui.js"></script>
<script src="<?php echo $slash; ?>js/select-opt.js"></script>
<script src="<?php echo $slash; ?>js/custom.js"></script>
<script src="<?php echo $slash; ?>js/thingstodo.js"></script>
<script src="<?php echo $slash; ?>js/listing_filter.js"></script>
<script src="<?php echo $slash; ?>js/jquery.validate.min.js"></script>
<script src="<?php echo $slash; ?>js/custom_validation.js"></script>
<script src="<?php echo $slash; ?>js/jquery.simplePagination.min.js"></script>
<script>
    function loadPagi() {
        var items = $(".todouilist");
        var numItems = items.length;
        var perPage = 10;
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



    $(".selected_state").on("click", function() {
        let state_id = this.value;
        let city_ids = [];
        $(`input[name=selected_city${state_id}]:checked`).map(function() {
            city_ids.push($(this).val());
        });
        const queryData = {
            stateid: state_id,
            city_ids: city_ids.join()
        };
        getPlaceThingsToDo(queryData);
    });

    $(".selected_city").on("change", function() {
        let state_id = this.name.replace(/selected_city/g, "");
        let city_id = this.value;
        document.querySelector("#selected_state" + state_id).click();
    });

    function getPlaceThingsToDo({
        stateid,
        city_ids
    }) {
        $.ajax({
            type: "POST",
            url: "things_todo_state_city_process.php",
            data: "state_id=" + stateid + "&city_ids=" + city_ids,
            success: function(data) {
                $("#dynmdata").html(data);
                loadPagi()
            },
        });
    }
</script>
</body>

</html>