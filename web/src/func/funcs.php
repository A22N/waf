<?php
function GetAll_post()
{
    $connect  = new mysqli(getenv('MYSQL_HOSTNAME'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'), 3306);
    $posts = [];
    $sql = "SELECT * FROM post WHERE Status_ID = 1 ORDER BY Time_Create DESC";
    $rs = $connect->query($sql);
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $posts[] = $row;
        }
    }
    return $posts;
}

function postDetail($id)
{
    $connect  = new mysqli(getenv('MYSQL_HOSTNAME'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'), 3306);
    $sql = "SELECT * FROM post WHERE Status_ID = 1 AND Post_ID = $id ORDER BY Time_Create DESC";
    $rs = $connect->query($sql);
    if ($rs->num_rows == 1) {
        $row = $rs->fetch_assoc();
        return $row;
    } else {
        return -1;
    }
}
function GetPost_ByType($iddm)
{
    $connect  = new mysqli(getenv('MYSQL_HOSTNAME'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'), 3306);
    $posts = [];
    $sql = "SELECT * FROM post WHERE Status_ID = 1 AND Category_ID = $iddm";
    $rs = $connect->query($sql);
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $posts[] = $row;
        }
    }
    return $posts;
}
function GetAll_types()
{
    $connect  = new mysqli(getenv('MYSQL_HOSTNAME'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'), 3306);
    $types = [];
    $sql = "SELECT * FROM `category` ";
    $rs = $connect->query($sql);
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $types[] = $row;
        }
    }
    return $types;
}

function GetComments($idPost)
{
    $connect  = new mysqli(getenv('MYSQL_HOSTNAME'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'), 3306);
    $coms = [];
    $sql = "SELECT Username,comment.ID,Comment,Post_ID,Date(comment.Time_Create) as Time_Create,ID_Reply FROM comment JOIN account ON comment.User_ID = account.ID WHERE Post_ID = $idPost;";
    $rs = $connect->query($sql);
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $coms[] = $row;
        }
    } else {
        return -1;
    }
    return $coms;
}

function Search($tk)
{
    $connect  = new mysqli(getenv('MYSQL_HOSTNAME'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'), 3306);
    $arr = [];
    $sql = "SELECT * FROM post INNER JOIN category ON post.Category_ID = category.ID WHERE post.Status_ID = 1 AND (Post_Tittle LIKE '%$tk%' OR Post_Content LIKE '%$tk%' OR category.Category_Name LIKE '%$tk%');";
    $rs = $connect->query($sql);
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $arr[] = $row;
        }
    } else {
        return -1;
    }
    return $arr;
}
