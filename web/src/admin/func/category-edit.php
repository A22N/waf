<?php
session_start();
include_once "../../DB_Config/connectDB.php";

if (isset($_SESSION["User"]) && $_SESSION["Role"] === "Admin") {
    if (isset($_POST['category_edit'])) {
        $category_edit = $_POST['category_edit'];
        $category = $_POST['category'];
        $id = $_POST['ID'];
        if (empty($category_edit)) {
            $em = "Tên Danh Mục Trống";
            header("Location: ../category-edit.php?ID=$id&error=" . base64_encode($em));
            exit;
        } else {
            $sql = "UPDATE category SET Category_Name = ? WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$category, $id]);

            if ($res) {
                $sql1 = "INSERT INTO history (User_ID, Category_Name, Event_ID) VALUES (?, ?, ?)";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->execute([$_SESSION["ID"], $category_edit, 9]);

                $sm = "Sửa danh mục thành công";
                header("Location: ../category-edit.php?ID=$id&success= " . base64_encode($sm));
                exit;
            } else {
                $em = "Lỗi Không xác định";
                header("Location: ../category-edit.php?ID=$id&error= " . base64_encode($em));
                exit;
            }
        }
    } else {
        header("Location: ../category-edit.php?ID=$id&error=");
        exit;
    }
} else {
    header("Location: ../404.php");
    exit;
}
