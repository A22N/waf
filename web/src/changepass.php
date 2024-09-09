<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include_once('inc/menu.php')
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay Đổi Mật Khẩu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="my-5">
                    <h3>Thay đổi mật khẩu</h3>
                    <hr>
                </div>
                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-warning">
                        <?= base64_decode($_GET['error']) ?>
                    </div>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success">
                        <?= base64_decode($_GET['success']) ?>
                    </div>
                <?php } ?>
                <form action="./func/changepass.php" method="post">
                    <div class="col-md-12">
                        <label class="form-label">Mật khẩu cũ *</label>
                        <input type="password" class="form-control" name="passwordold">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Mật khẩu mới *</label>
                        <input type="password" class="form-control" name="passwordnew">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Nhập lại mật khẩu mới *</label>
                        <input type="password" class="form-control" name="passwordnew1">
                    </div>
                    <br>
                    <div class="gap-3 d-md-flex justify-content-md-end text-center" style="text-align: center;">
                        <button type="submit" class="btn btn-primary btn-lg">Thay đổi mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>