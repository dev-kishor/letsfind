<?php

//Get All Cities
function getAllCities()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "cities GROUP BY city_name ORDER BY city_id  DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All city with given city Id
function getCity($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "cities where city_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}
//Get All city with given city Id with state and country details
function getCityWithDetails($arg)
{
    global $conn;

    $sql = "SELECT c.city_id,city_name,s.state_id,s.state_name,ctry.country_id,ctry.country_name FROM " . TBL . "cities as c join " . TBL . "states as s on c.state_id = s.state_id join " . TBL . "countries as ctry on s.country_id = ctry.country_id where c.city_id = '" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All city with given city name
function getCityName($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "cities where city_name='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}
//Get All City Count
function getCountCity()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "cities ORDER BY city_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}