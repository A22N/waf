<?php
session_start();
include_once "../../DB_Config/db_config.php";
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "User"
) {
    if (
        isset($_POST['title']) &&
        isset($_FILES['cover']) &&
        isset($_POST['category']) &&
        isset($_POST['text'])
    ) {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $category = $_POST['category'];
        $id = $_POST['ID'];
        if (empty($title)) {
            $em = "Tên Tiêu Đề Bị Trống";
            header("Location: ../post-edit.php?error=$em");
            exit;
        } else if (empty($category)) {
            $category = 0;
        }
        $image_name = $_FILES['cover']['name'];
        if ($image_name != "") {
            $image_size = $_FILES['cover']['size'];
            $image_temp = $_FILES['cover']['tmp_name'];
            $error = $_FILES['cover']['error'];
            if ($error === 0) {
                if ($image_size > 20971520) {
                    $em = "Xin Lỗi, File Tải Lên lớn hơn 20MB";
                    header("Location: ../post-edit.php?error=$em");
                    exit;
                } else {
                    $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_ex = strtolower($image_ex);
                    $new_image_name = uniqid("BLOG-", true) . '.' . $image_ex;
                    $image_path = '../../upload/blog/' . $new_image_name;
                    move_uploaded_file($image_temp, $image_path);
                    $_SESSION['Image'] = $new_image_name;
                    $sql = "UPDATE post SET Post_Tittle = ?, Post_Content = ?, Category_ID = ?, Cover_Url = ?, Status_ID = ? WHERE Post_ID = ?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$title, $text, $category, $new_image_name, 0, $id]);
                    if ($res) {
                        $sql1 = "INSERT INTO history(User_ID, Post_Tittle, Event_ID) VALUES (?,?,?)";
                        $stmt1 = $conn->prepare($sql1);
                        $stmt1->execute([$_SESSION['ID'], $title, 6]);
                        $sm = "Sửa Bài Viết Thành Công!";
                        header("Location: ../post-edit.php?ID=$id&success=" . urldecode($sm));
                        exit;
                    } else {
                        $em = "Lỗi Không Xác Định!";
                        header("Location: ../post-edit.php?ID=$id&error=" . base64_encode($em));
                        exit;
                    }
                }
            }
        } else {
            $sql = "UPDATE post SET Post_Tittle = ?, Post_Content = ?, Category_ID = ?, Status_ID = ? WHERE Post_ID = ?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$title, $text, $category, 0, $id]);
            if ($res) {
                $sql1 = "INSERT INTO history(User_ID, Post_Tittle, Event_ID) VALUES (?,?,?)";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->execute([$_SESSION['ID'], $tittle, 6]);
                $sm = "Sửa Bài Viết Thành Công!";
                header("Location: ../post-edit.php?ID=$id&success=" . base64_encode($sm));
                exit;
            } else {
                $em = "Lỗi Không xác định";
                header("Location: ../post-edit.php?ID=$id&error=" . base64_encode($em));
                exit;
            }
        }
    } else {
        header("Location: ../post-edit.php");
        exit;
    }
} else {
    header("Location: ../404.php");
    exit;
}
