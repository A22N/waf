<?php
session_start();

// Hủy cookie và session đăng nhập
if (isset($_COOKIE['login'])) {
    setcookie("login", "", time() - 3600, "/");
}

if (isset($_COOKIE['user'])) {
    setcookie("user", "", time() - 3600, "/");
}

session_destroy();

// Điều hướng người dùng trở về trang đăng nhập
?>
<script>
    setTimeout(function () {
        window.location.href = './login.php';
    }, 0);
</script>
