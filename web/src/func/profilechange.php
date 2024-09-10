<?php
session_start();
include_once('../DB_Config/connectDB.php');
include_once('../func/profile.php');
if (
    isset($_SESSION["ID"]) &&
    $_POST['fullname'] &&
    $_POST['phonenumber'] &&
    $_POST['email']
) {
    $fullname = $_POST['fullname'];
    $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
    if (empty($fullname)) {
        $em = "Vui lòng nhập tên đầy đủ!";
        header("Location: ../profile.php?error=" . base64_encode($em));
        exit;
    } else if (empty($phonenumber)) {
        $em = "Vui lòng nhập số điện thoại";
        header("Location: ../profile.php?error=" . base64_encode($em));
        exit;
    } else if (empty($email)) {
        $em = "Vui lòng nhập địa chỉ email!";
        header("Location: ../profile.php?error=" . base64_encode($em));
        exit;
    } else {
        $image_name = $_FILES['file']['name'];
        if ($image_name != "") {
            $image_size = $_FILES['file']['size'];
            $image_temp = $_FILES['file']['tmp_name'];
            $error = $_FILES['file']['error'];
            if ($error === 0) {
                if ($image_size > 20971520) {
                    $em = "Xin Lỗi, File Tải Lên lớn hơn 20MB";
                    header("Location: ../profile.php?error=" . base64_encode($em));
                    exit;
                } else {
                    $image_ex = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_ex = strtolower($image_ex);
                    $new_image_name = uniqid("USER-", true) . '.' . $image_ex;
                    $image_path = '../upload/user/' . $new_image_name;
                    move_uploaded_file($image_temp, $image_path);
                    $sql = "UPDATE account SET Fullname = ? , Phone = ? , Email = ? , Avatar = ? WHERE ID =?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$fullname, $phonenumber, $email, $new_image_name, $_SESSION["ID"]]);
                    $_SESSION["Avatar"] = $new_image_name;
                    $sql1 = "INSERT INTO history(User_ID, Event_ID) VALUES (?,?)";
                    $stmt1 = $conn->prepare($sql1);
                    $stmt1->execute([$_SESSION["ID"], 1]);
                    $sm = "Đã thay đổi thông tin cá nhân thành công!";
                    header("Location: ../profile.php?success=" . base64_encode($sm));
                    exit;
                }
            } else {
                $em = "Lỗi Không xác định!";
                header("Location: ../profile.php?error=$em");
                exit;
            }
        } else {
            $sql = "UPDATE account SET Fullname = ? , Phone = ? , Email = ? WHERE ID =?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fullname, $phonenumber, $email, $_SESSION["ID"]]);
            $sql1 = "INSERT INTO history(User_ID, Event_ID) VALUES (?,?)";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->execute([$_SESSION["ID"], 1]);
            $sm = "Đã thay đổi thông tin cá nhân thành công!";
            header("Location: ../profile.php?success=" . base64_encode($sm));
            exit;
        }
    }
?>
    <script>
        alert("Bạn chưa đăng nhập!");
        setTimeout(function() {
            window.location.href = "../index.php";
        }, 0)
    </script>
<?php
}
?>