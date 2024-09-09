<?php
session_start();
include_once('./DB_Config/connectDB.php');
include_once('./func/profile.php');
include_once('./inc/menu.php');
if ($_SESSION['User']) {
    $profile = getInfoUser($conn, $_SESSION['ID']);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Trang cá nhân</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/profile.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="my-5">
                        <h3>Trang cá nhân</h3>
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
                    <form class="file-upload" action="./func/profilechange.php" method="post" enctype="multipart/form-data">
                        <div class="row mb-5 gx-5">
                            <div class="col-xxl-8 mb-5 mb-xxl-0">
                                <div class="bg-secondary-soft px-4 py-5 rounded">
                                    <div class="row g-3">
                                        <h4 class="mb-4 mt-0">Thay đổi ảnh đại diện</h4>
                                        <div class="text-center">
                                            <div class="square position-relative display-2 mb-3">
                                                <img id="thumbnil" style="width:250 ;height :250" src="upload/user/<?php echo $_SESSION['Avatar'] ?>" alt="image" />
                                            </div>
                                            <input type="file" accept="image/*" onchange="showMyImage(this) " name="file" />
                                            <br />
                                            <script>
                                                function showMyImage(fileInput) {
                                                    var files = fileInput.files;
                                                    for (var i = 0; i < files.length; i++) {
                                                        var file = files[i];
                                                        var imageType = /image.*/;
                                                        if (!file.type.match(imageType)) {
                                                            continue;
                                                        }
                                                        var img = document.getElementById("thumbnil");
                                                        img.file = file;
                                                        var reader = new FileReader();
                                                        reader.onload = (function(aImg) {
                                                            return function(e) {
                                                                aImg.src = e.target.result;
                                                            };
                                                        })(img);
                                                        reader.readAsDataURL(file);
                                                    }
                                                }
                                            </script>
                                            <p class="text-muted mt-3 mb-0"><span class="me-1">Note:</span>Minimum size 300px x 300px</p>
                                        </div>
                                        <h4 class="mb-4 mt-0">Thông tin cơ bản</h4>
                                        <div class="col-md-6">
                                            <label class="form-label">Tên Đầy Đủ</label>
                                            <input type="text" class="form-control" placeholder aria-label="Tên Đầy Đủ" name="fullname" value="<?php echo $profile['Fullname'] ?>">
                                        </div>
                                        <br>
                                        <div class="col-md-6">
                                            <label class="form-label">Tên đăng nhập</label>
                                            <input type="text" class="form-control" placeholder aria-label="Tên đăng nhập" value="<?php echo $profile['Username'] ?>" readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" placeholder aria-label="Số điện thoại" name="phonenumber" value="<?php echo $profile['Phone'] ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputEmail4" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $profile['Email'] ?> ">
                                            <br>
                                            <div class="gap-3 d-md-flex justify-content-md-end text-center" style="text-align: center;">
                                                <button type="submit" class="btn btn-primary btn-lg">Cập Nhật</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
?>
    <script>
        alert("Không có quyền vào trang này khi chưa đăng nhập!");
        setTimeout(function() {
            window.location.href = "../index.php";
        }, 0)
    </script>
<?php
}
?>