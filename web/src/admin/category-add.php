<?php
session_start();
include('./inc/side-nav.php');
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin"
) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Thêm Danh Mục</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/side-bar.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div>
            <h3 class="mb-3 text-center">Tạo Danh Mục Mới
                <br>
                <a href="category.php" class="btn btn-secondary">Tất Cả Danh Mục</a>
            </h3>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-warning text-center">
                    <?= base64_decode($_GET['error']) ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success text-center">
                    <?= base64_decode($_GET['success']) ?>
                </div>
            <?php } ?>
            <form class="shadow p-3" action="./func/category-create.php" method="post">
                <div class="mb-3">
                    <label class="form-label">Tên Danh Mục Mới</label>
                    <input type="text" class="form-control" name="category">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary text-center">Thêm</button>
                </div>
            </form>
        </div>.
        </section>
        </div>
    </body>

    </html>
<?php } else {
    header("Location:404.php");
    exit;
}
?>