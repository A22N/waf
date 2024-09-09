<?php
session_start();
if (isset($_SESSION['User'])) {
?>
    <script>
        alert("Bạn đã đăng nhập rồi!");
        setTimeout(function() {
            window.location.href = "../index.php";
        }, 0)
    </script>
<?php
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Đăng kí</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">

        <form class="shadow w-450 p-3" action="./func/register.php" method="post">

            <h4 class="display-4  fs-1">Tạo tài khoản mới</h4><br>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo base64_decode($_GET['error']); ?>
                </div>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo base64_decode($_GET['success']); ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label class="form-label">Tên đầy đủ</label>
                <input type="text" class="form-control" name="fname" value="<?php echo (isset($_GET['fname'])) ? base64_decode($_GET['fname']) : "" ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo (isset($_GET['email'])) ? base64_decode($_GET['email']) : "" ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="<?php echo (isset($_GET['phone'])) ? base64_decode($_GET['phone']) : "" ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Tên Đăng Nhập</label>
                <input type="text" class="form-control" name="uname" value="<?php echo (isset($_GET['uname'])) ? base64_decode($_GET['uname']) : "" ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Mật Khẩu</label>
                <input type="password" class="form-control" name="pass">
            </div>

            <div class="mb-3">
                <label class="form-label">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" name="repass">
            </div>


            <button type="submit" class="btn btn-primary">Đăng Kí</button>
            &nbsp;
            <a href="login.php" class="link-secondary">Đăng Nhập</a>
            &nbsp;
            <a href="index.php" class="link-secondary">Về trang chủ</a>
        </form>
    </div>
</body>

</html>