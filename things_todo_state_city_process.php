<?php
if (file_exists('config/info.php')) {
    include('config/info.php');
}
$state_id = safe_input_Text($_POST['state_id']);
$city_ids = safe_input_Text($_POST['city_ids']);

if (!empty($city_ids)) {
    $extra_query = "and city in ($city_ids)";
}

$sql_query = "SELECT * FROM " . TBL . "places where todo_name != '' and state = $state_id $extra_query";
$res = mysqli_query($conn, $sql_query);

if ($res) {
    while ($todo_place = mysqli_fetch_assoc($res)) {
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
}
?>