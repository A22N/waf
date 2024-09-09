<?php
session_start();
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin" &&
    isset($_GET['ID'])
) {
    $id = $_GET['ID'];
    include_once("./inc/side-nav.php");
    include_once("./func/category.php");
    include_once("../DB_Config/connectDB.php");
    $category = getCategoryNamebyID($conn, $id);
?>
    <!DOCTYPE html>
    <html lang="vi">

    <head>
        <title>Sửa Danh Mục</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/side-bar.css">
        <link rel="stylesheet" href="../css/style.css">
        <style>
            body {
                background-color: #f8f9fa;
            }

            .container {
                margin-top: 50px;
            }

            .form-container {
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .alert {
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h3 class="mb-4 text-center">Sửa Danh Mục</h3>
            <div class="text-center mb-4">
                <a href="category.php" class="btn btn-secondary">Tất Cả Danh Mục</a>
            </div>

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

            <div class="form-container shadow p-3">
                <form action="./func/category-edit.php" method="post">
                    <input type="hidden" name="ID" value="<?php echo $id ?>">
                    <div class="mb-3">
                        <label class="form-label">Tên Danh Mục Cũ</label>
                        <input type="text" class="form-control" name="category" value="<?php echo $category ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên Danh Mục Mới</label>
                        <input type="text" class="form-control" name="category_edit" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">Sửa</button>
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location:404.php");
    exit;
}
?>