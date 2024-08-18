
<?php
//$con = new mysqli("localhost","root","","web",3306);
//build docker dùng dòng 5
$con = new mysqli("db","melp","P8NhrX2ZRWICk29A3rERbfCUgZhWHdBy","web",3306);
if($con->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
