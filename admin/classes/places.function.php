<?php
//Get All Places
function getAllPlaces()
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places ORDER BY place_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
//Get All Places how have todos
function getAllPlacesWithToDo()
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places  where todo_name != '' ORDER BY place_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
//Get All Trash Deleted Places
function getAllTrashPlaces()
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places ORDER BY place_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
//Get particular Places Using Places Code
function getPlaces($arg)
{
    global $conn;
    $sql = "SELECT * FROM  " . TBL . "places WHERE place_code='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
//Get particular Places Using Places Slug
function getSlugPlaces($arg)
{
    global $conn;
    $sql = "SELECT * FROM  " . TBL . "places WHERE place_slug='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
//Get particular Places Using Places Code
function getIdPlaces($arg)
{
    global $conn;
    $sql = "SELECT * FROM  " . TBL . "places WHERE place_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
//Get All Places with given User Id
function getAllPlacesUser($arg)
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places  WHERE user_id= '$arg' ORDER BY place_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
//Get All Places with given Category Id
function getAllPlacesCategory($arg)
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places  WHERE category_id= '$arg' ORDER BY place_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
//Get All Places with given Category Id and Places ID
function getAllPlacesCategoryExceptPlacesId($arg, $arg1)
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places  WHERE category_id= '$arg' AND place_id !='" . $arg1 . "' ORDER BY place_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
//Get All Places with given User Id and Places Id
function getAllPlacesUserPlaces($arg, $arg1)
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places  WHERE user_id= '$arg' AND place_id = '$arg1'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
//Get All Places with given User Id and Places Id
function getAllPlacesPlaces($arg)
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places  WHERE place_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;
}
//Get All Places Count
function getCountPlaces()
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places ORDER BY place_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;
}
//Places Count using User Id
function getCountUserPlaces($arg)
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places  WHERE user_id= '$arg' ORDER BY place_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;
}
//Places Count using Category Id
function getCountCategoryPlaces($arg)
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places WHERE category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;
}
//Places Count using Country Id
function getCountCountryPlaces($arg)
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places WHERE country_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;
}
//Places Count using City Id
function getCountCityPlaces($arg)
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places WHERE city_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;
}
//Places Count using Category Id
function getCountSubCategoryPlaces($arg)
{
    global $conn;
    $sql = "SELECT * FROM " . TBL . "places WHERE sub_category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;
}
//Get All Places except given event id
function getExceptPlaces($arg)
{
    global $conn;
    $sql = "SELECT * FROM  " . TBL . "places WHERE  place_id !='" . $arg . "' ";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
//Get All Most viewed Places limit 10
function getAllTopViewsPremiumActivePlaces()
{
    global $conn;
    $sql = "SELECT t1.*, COUNT(*) AS total_count FROM " . TBL . "places AS t1 INNER JOIN `" . TBL . "page_views` AS t2  ON t1.place_id = t2.place_id WHERE t1.place_status= 'Active' GROUP BY t1.place_id ORDER BY COUNT(*) DESC LIMIT 10";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
//Get particular Places SEO Score using Places id
function getPlacesseoScore($arg)
{
    global $conn;
    $sql = "select ( case seo_title when '' then 0 else 1 end +
        case seo_description when '' then 0 else 1 end +
        case seo_keywords when '' then 0 else 1 end )
        * 100 / 3 as complete FROM " . TBL . "places WHERE place_id = $arg";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row[0];
}
// Get all place who have state
function getAllPlaceWhoHaveState()
{
    global $conn;
    $sql = "SELECT distinct state,s.state_name FROM " . TBL . "places as p join " . TBL . "states as s on s.state_id = p.state where state != 0";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
// Get all place who have city with matching state
function getAllPlaceWhoHaveCityForState($arg)
{
    global $conn;
    $sql = "SELECT distinct city, c.city_name FROM " . TBL . "places as p join " . TBL . "cities as c on c.city_id = p.city where city != 0 and state = $arg";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
// Get all category who have city with matching state
function getAllPlaceCatWhoHaveCityForState($arg)
{
    global $conn;
    $sql = "SELECT distinct p.category_id,pc.category_name FROM " . TBL . "places as p join " . TBL . "place_categories as pc on pc.category_id = p.category_id where state = $arg";
    $rs = mysqli_query($conn, $sql);
    return $rs;
}
