<?php
session_start();
include_once "../../DB_Config/connectDB.php";
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin"
) {
    if (
        isset($_POST['category'])
    ) {
        $category = $_POST['category'];
        if (empty($category)) {
            $em = "Tên Danh Mục Trống";
            header("Location: ../category-add.php?error=" . base64_encode($em));
            exit;
        } else {
            $sql = "INSERT INTO category(Category_Name)VALUES(?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$category]);
            if ($res) {
                $sql1 = "INSERT INTO history(User_ID,Category_Name,Event_ID) VALUES (?,?,?)";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->execute([$_SESSION["ID"], $category, 8]);
                $sm = "Thêm Danh Mục Mới Thành Công!";
                header("Location: ../category-add.php?success=" . base64_encode($sm));
                exit;
            } else {
                $em = "Lỗi Không Xác Định";
                header("Location: ../category-add.php?error=" . base64_encode($em));
                exit;
            }
        }
    } else {
        header("Location: ../category-add.php?error=" . base64_encode("Lỗi không xác định"));
        exit;
    }
} else {
    header("Location: ../404.php");
    exit;
}
