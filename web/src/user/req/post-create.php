<?php
session_start();
include_once('../DB_Config/connectDB.php');

if (isset($_POST['title']) && isset($_POST['text']) && isset($_POST['category'])) {
    $title = $_POST['title'];
    $text = $_POST['text'];
    $category = $_POST['category'];
    $user = $_SESSION["User"];
    $cover = null;

    // Kiểm tra và xử lý ảnh bìa
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === 0) {
        $cover_name = uniqid("USER-", true) . '.' . pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        $cover_path = '../../upload/user/' . $cover_name;
        if (move_uploaded_file($_FILES['cover']['tmp_name'], $cover_path)) {
            $cover = $cover_name;
        } else {
            $em = "Không thể tải ảnh bìa lên.";
            header("Location: ../post.php?error=" . base64_encode($em));
            exit;
        }
    }

    // Lưu thông tin bài viết vào bảng "posts" với trạng thái "Chờ duyệt"
    $status_id = 0; // Giả sử 1 là ID của trạng thái "Chờ duyệt"
    $sql = "INSERT INTO posts (Post_Tittle, Content, Category_ID, User_ID, Cover_Image, Status_ID) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$title, $text, $category, $user, $cover, $status_id]);

    if ($result) {
        $sm = "Bài viết của bạn đã được gửi và đang chờ duyệt!";
        header("Location: ../post.php?success=" . base64_encode($sm));
        exit;
    } else {
        $em = "Đã xảy ra lỗi khi gửi bài viết.";
        header("Location: ../post.php?error=" . base64_encode($em));
        exit;
    }
} else {
    $em = "Vui lòng điền đầy đủ thông tin.";
    header("Location: ../post.php?error=" . base64_encode($em));
    exit;
}
?>
