<?php
//database configuration
if (file_exists('config/info.php')) {
    include('config/info.php');
}


//get search term
//$searchTerm = $_GET['term'];

$display_json = array();
$display_json1 = array();
$display_json2 = array();
$display_json3 = array();
$display_json4 = array();
$display_json5 = array();
$display_json6 = array();
$display_json7 = array();
//get matched data from skills table
//$qry ="SELECT * FROM " . TBL . "listings ORDER BY listing_name ASC";

$qry = "SELECT listing_name FROM " . TBL . "listings WHERE listing_status= 'Active' AND listing_is_delete != '2'  limit 1000"; //Listing Table Fetch

$qry1 = "SELECT category_name FROM " . TBL . "categories";  //Category Table Fetch

$qry2 = "SELECT event_name FROM " . TBL . "events  WHERE event_type= 'All' AND event_status= 'Active'"; //Event Table Fetch

$qry3 = "SELECT blog_name FROM " . TBL . "blogs WHERE blog_status= 'Active'"; //Blog Table Fetch

$qry4 = "SELECT product_name FROM " . TBL . "products WHERE product_status= 'Active'"; //Product Table Fetch

$qry5 = "SELECT job_title FROM " . TBL . "jobs WHERE job_status= 'Active'"; //Job Table Fetch

$qry6 = "SELECT news_title FROM " . TBL . "news WHERE news_status = 'Active'"; //news Table Fetch

// $qry7 = "SELECT place_name FROM " . TBL . "places WHERE place_status = 'Active'"; //place Table Fetch
$qry7 = "SELECT place_name FROM " . TBL . "places"; //place Table Fetch


$query = mysqli_query($conn, $qry);
while ($row = mysqli_fetch_array($query)) {
    $display_json[] = $row['listing_name'];
}
$query1 = mysqli_query($conn, $qry1);
while ($row = mysqli_fetch_array($query1)) {
    $display_json1[] = $row['category_name'];
}

$query2 = mysqli_query($conn, $qry2);
while ($row = mysqli_fetch_array($query2)) {
    $display_json2[] = $row['event_name'];
}

$query3 = mysqli_query($conn, $qry3);
while ($row = mysqli_fetch_array($query3)) {
    $display_json3[] = $row['blog_name'];
}

$query4 = mysqli_query($conn, $qry4);
while ($row = mysqli_fetch_array($query4)) {
    $display_json4[] = $row['product_name'];
}

$query5 = mysqli_query($conn, $qry5);
while ($row = mysqli_fetch_array($query5)) {
    $display_json5[] = $row['job_title'];
}
$query6 = mysqli_query($conn, $qry6);
while ($row = mysqli_fetch_array($query6)) {
    $display_json6[] = $row['news_title'];
}

$query7 = mysqli_query($conn, $qry7);
while ($row = mysqli_fetch_array($query7)) {
    $display_json7[] = $row['place_name'];
}

echo json_encode(array_merge($display_json, $display_json1, $display_json2, $display_json3, $display_json4, $display_json5, $display_json6, $display_json7));
