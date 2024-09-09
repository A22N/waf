<?php
function GetPostJson($conn)
{
    $arr = [];
    $sql = "SELECT post.Status_ID,post_status.Status_Name,COUNT(*) AS total
            FROM post JOIN post_status
            ON post.Status_ID = post_status.Status_ID GROUP BY post.Status_ID;";
    $rs = $conn->query($sql);
    if ($rs->rowCount() > 0) {
        while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
            $arr[] = $row;
        }
    }
    return json_encode($arr);
}
function GetPostJson1($conn)
{
    $arr1 = [];
    $sql1 = "SELECT post.Category_ID,category.Category_Name,COUNT(*) AS total
            FROM post JOIN category
            ON post.Category_ID = category.ID GROUP BY post.Category_ID;";
    $rs1 = $conn->query($sql1);
    if ($rs1->rowCount() > 0) {
        while ($row1 = $rs1->fetch(PDO::FETCH_ASSOC)) {
            $arr1[] = $row1;
        }
    }
    return json_encode($arr1);
}
