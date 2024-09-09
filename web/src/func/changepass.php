<?php
session_start();
if (
    isset($_SESSION['ID']) &&
    $_POST['passwordold'] &&
    $_POST['passwordnew'] &&
    $_POST['passwordnew1']
) {
    include_once "../DB_Config/connectDB.php";
    include_once('./func/profile.php');
    $passwordold = $_POST['passwordold'];
    $passwordnew = $_POST['passwordnew'];
    $passwordnew1 = $_POST['passwordnew1'];
    $status = checkPass($conn, $_SESSION["ID"], $passwordold);
    if (empty($passwordold)) {
        $em = "Vui lòng điền mật khẩu cũ!";
        header("Location: ../changepass.php?error=" . base64_encode($em));
        exit;
    } else if (empty($passwordnew)) {
        $em = "Vui lòng điền mật khẩu mới";
        header("Location: ../changepass.php?error=" . base64_encode($em));
        exit;
    } else if (empty($passwordnew1)) {
        $em = "Vui lòng nhập lại mật khẩu mới";
        header("Location: ../changepass.php?error=" . base64_encode($em));
        exit;
    } else if ($passwordnew !== $passwordnew1) {
        $em = "Mật khẩu mới và nhập lại mật khẩu không giống nhau!";
        header("Location: ../changepass.php?error=" . base64_encode($em));
        exit;
    } else if ($status === 0) {
        $em = "Nhập sai mật khẩu cũ!";
        header("Location: ../changepass.php?error=" . base64_encode($em));
        exit;
    } else {
        $sql = "UPDATE account SET Password = ? WHERE ID = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->execute([md5($passwordnew), $_SESSION["ID"]]);
        $sql1 = "INSERT INTO history(User_ID,Event_ID) VALUES (?,?)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute([$_SESSION['ID'], 2]);
        $sm = "Thay đổi mật khẩu thành công!";
        header("Location: ../changepass.php?success=" . base64_encode($sm));
        exit;
    }
} else {
?>
    <script>
        alert("Bạn chưa đăng nhập!");
        setTimeout(function() {
            window.location.href = "../index.php";
        }, 0)
    </script>
<?php
}
