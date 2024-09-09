<?php
$comment = $_POST['comment'];
$idPost = $_POST['idPost'];
$idUser = $_POST['idUser'];
$connect  = new mysqli(getenv('MYSQL_HOSTNAME'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), getenv('MYSQL_DATABASE'), 3306);
$sql = "INSERT INTO comment (ID, User_ID, Post_ID, Comment, Time_Create, ID_Reply) VALUES (NULL, $idUser, $idPost, '$comment', current_timestamp(), NULL)";
$rs = $connect->query($sql);
if ($rs === TRUE) {
    echo 1;
}
