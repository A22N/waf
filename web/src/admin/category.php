<?php
session_start();
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin"
) {
    include_once("./inc/side-nav.php");
    include_once("./func/category.php");
    include_once("../DB_Config/connectDB.php");
    $category = getAllCategory($conn);
?>
    <!DOCTYPE html>
    <html lang="vi">

    <head>
        <meta charset="UTF-8">
        <title>Tất Cả Danh Mục</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/side-bar.css">
        <link rel="stylesheet" href="../css/style.css">
        <style>
            body {
                background-color: #f8f9fa;
            }
        </style>
    </head>

    <body>
        <div class="container mt-5">
            <h3 class="mb-4 text-center">Tất Cả Danh Mục</h3>
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
            <div class="text-center mb-4">
                <a href="category-add.php" class="btn btn-success btn-custom">Thêm Danh Mục mới</a>
            </div>
            <?php if ($category && count($category) > 0) { // Kiểm tra nếu có danh mục 
            ?>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col" class="text-center">Tên Danh Mục</th>
                            <th scope="col" class="text-center">Thời gian tạo</th>
                            <th scope="col" class="text-center">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1; // Bắt đầu từ 1 cho ID
                        foreach ($category as $cat) { ?>
                            <tr>
                                <th scope="row" class="text-center"><?php echo $count++ ?></th>
                                <td class="text-center">
                                    <a href="single-category.php?ID=<?php echo $cat["ID"] ?>" class="text-decoration-none">
                                        <?php echo $cat["Category_Name"] ?>
                                    </a>
                                </td>
                                <td class="text-center"><?php echo date("d/m/Y H:i", strtotime($cat["Time_Create"])) ?></td>
                                <td class="text-center">
                                    <a href="category-edit.php?ID=<?php echo $cat["ID"] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                    <a href="./func/category-delete.php?ID=<?php echo $cat["ID"] ?>" class="btn btn-danger btn-sm">Xóa</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-warning text-center">
                    Trống!
                </div>
            <?php } ?>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location:404.php");
    exit;
}
?>