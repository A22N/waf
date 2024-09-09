<?php
include_once('../DB_Config/db_config.php');
if (
    isset($_POST['fname']) &&
    isset($_POST['email']) &&
    isset($_POST['phone']) &&
    isset($_POST['uname']) &&
    isset($_POST['pass']) &&
    isset($_POST['repass'])
) {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];

    $data = "fname=" . $fname . "&uname=" . $uname;

    if (empty($fname)) {
        $em = "Tên đầy đủ bị trống";
        header("Location: ../register.php?error=" . base64_encode($em));
        exit;
    } else if (empty($email)) {
        $em = "Email bị trống";
        header("Location: ../register.php?error=" . base64_encode($em));
        exit;
    } else if (empty($phone)) {
        $em = "Số điện thoại trống";
        header("Location: ../register.php?error=" . base64_encode($em));
        exit;
    } else if (empty($uname)) {
        $em = "Tên đăng nhập trống";
        header("Location: ../register.php?error=" . base64_encode($em));
        exit;
    } else if (empty($pass)) {
        $em = "Mật khẩu trống";
        header("Location: ../register.php?error=" . base64_encode($em));
        exit;
    } else if (empty($repass)) {
        $em = "Nhập lại mật khẩu trống";
        header("Location: ../register.php?error=" . base64_encode($em));
        exit;
    } else if ($pass !== $repass) {
        $em = "Mật khẩu và nhập lại mật khẩu không trùng khớp";
        header("Location: ../register.php?error=" . base64_encode($em));
        exit;
    } else {
        $sql1 = "SELECT * FROM account where Username = ? ";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute([$uname]);
        if ($stmt1->rowCount() == 1) {
            $em = "UserName đã tồn tại,vui lòng tạo một tên khác!";
            header("Location: ../register.php?error=" . base64_encode($em));
            exit;
        } else {
            $sql = "INSERT INTO account(Fullname, Email, Phone, Username, Password) 
                VALUES (?,?,?,?,?) ";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$fname, $email, $phone, $uname, md5($pass)]);
            $sm = "Tài Khoản được tạo thành công, vui lòng đăng nhập để sử dụng trang web!";
            header("Location: ../register.php?success=" . base64_encode($sm));
            exit;
        }
    }
} else {
    $em = "Lỗi";
    header("Location: ../register.php?error=" . base64_encode($em));
    exit;
}
