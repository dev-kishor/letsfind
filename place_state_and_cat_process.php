<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}
$state_id = safe_input_Text($_POST['state_id']);
$cat_ids = safe_input_Text($_POST['cat_ids']);


if (!empty($cat_ids)) {
    $extra_query = "and category_id in ($cat_ids)";
}

$sql_query = "SELECT p.place_id,p.category_id,p.place_name,p.place_gallery_image,p.place_slug,s.state_name,c.city_name FROM " . TBL . "places as p join " . TBL . "states as s on s.state_id = p.state join " . TBL . "cities as c on c.city_id = p.city where state = $state_id $extra_query";
$res = mysqli_query($conn, $sql_query);

if ($res) {
    while ($placerow = mysqli_fetch_assoc($res)) {
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
}
?>