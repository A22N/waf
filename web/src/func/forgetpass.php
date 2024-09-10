<?php
session_start();
include_once('../DB_Config/connectDB.php');
if (
    isset($_POST['uname']) &&
    isset($_POST['email'])
) {
    $uname = $_POST['uname'];
    $email = $_POST['email'];

    $data = "uname=" . $uname;

    if (empty($uname)) {
        $em = "Tên đăng nhập trống!";
        header("Location: ../forgetpass.php?error=" . urldecode($em));
        exit;
    } else if (empty($email)) {
        $em = "Địa chỉ email trống";
        header("Location: ../forgetpass.php?error=" . urldecode($em));
        exit;
    } else {
        $sql = "SELECT * FROM account WHERE Username = ? AND Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $email]);
        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            $username = $user['Username'];
            $email1 = $user['Email'];
            if ($username === $uname && $email === $email1) {
                $_SESSION["Username"] = $username;
                header("Location: ../changepass1.php");
                exit;
            } else {
                $em = "Sai tên đăng nhập hoặc địa chỉ email!";
                header("Location: ../forgetpass.php?error=" . base64_encode($em));
                exit;
            }
        } else {
            $em = "Sai tên đăng nhập hoặc địa chỉ email!";
            header("Location: ../forgetpass.php?error=" . base64_encode($em));
            exit;
        }
    }
} else {
    header("Location: ../forgetpass.php?error=" . base64_encode("error"));
    exit;
}
