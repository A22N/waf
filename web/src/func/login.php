<?php
session_start();
include_once "../DB_Config/connectDB.php";
if (
    isset($_POST['uname']) &&
    isset($_POST['pass'])
) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $data = "uname=" . $uname;

    if (empty($uname)) {
        $em = "Tên đăng nhập trống!";
        header("Location: ../login.php?error=$em");
        exit;
    } else if (empty($pass)) {
        $em = "Mật khẩu trống!";
        header("Location: ../login.php?error=$em");
        exit;
    } else {
        $sql = "SELECT * FROM account WHERE Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname]);

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            $username = $user['Username'];
            $password = $user['Password'];
            $fullname = $user['Fullname'];
            $id = $user['ID'];
            $email = $user['Email'];
            $role = $user['Role'];
            $phone = $user['Phone'];
            $avatar = $user['Avatar'];
            if ($username === $uname && $password === md5($pass)) {
                $_SESSION['ID'] = $id;
                $_SESSION['User'] = $username;
                $_SESSION['Role'] = $role;
                $_SESSION['Avatar'] = $avatar;
                header("Location: ../index.php");
                exit;
            } else {
                $em = "Sai tên đăng nhập hoặc mật khẩu";
                header("Location: ../login.php?error=" . base64_encode($em));
                exit;
            }
        } else {
            $em = "Sai tên đăng nhập hoặc mật khẩu";
            header("Location: ../login.php?error=" . base64_encode($em));
            exit;
        }
    }
} else {
    header("Location: ../login.php?error=" . base64_encode("error"));
    exit;
}
