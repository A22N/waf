
<?php
$servername = "db";
$username = "melp";
$password = "P8NhrX2ZRWICk29A3rERbfCUgZhWHdBy";
$dbname = "web";

// Tạo kết nối
$con = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($con->connect_error) {
    die("Connection failed:" . $con->connect_error);
}
echo "Connection successful ";
