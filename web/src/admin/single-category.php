<?php
session_start();
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin" &&
    $_GET['ID']
) {
    include_once "../DB_Config/connectDB.php";
    include_once('./func/category.php');
    $id = $_GET['ID'];
    $category = getCategoryNamebyID($conn, $id);
    $post = getByIdDeep($conn, $id);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Bài Viết Của Danh Mục <?php echo $category ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/side-bar.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <?php
        include_once('inc/side-nav.php');
        ?>
        <h3 class="mb-3 text-center">
            Bài Viết Của Danh Mục <?php echo $category ?>
            <br>
            <a href="post-add.php" class="btn btn-success">Thêm Bài Viết Mới</a>
            &nbsp;&nbsp;&nbsp;
            <a href="category.php" class="btn btn-success">Tất cả danh mục</a>
        </h3>
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
        <?php if ($post != 0) {
            $count = 0 ?>
            <table class="table t1 table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID </th>
                        <th class="text-center" scope="col">Người Viết</th>
                        <th class="text-center" scope="col">Ảnh bìa</th>
                        <th class="text-center" scope="col">Tiêu đề</th>
                        <th class="text-center" scope="col">Phân loại</th>
                        <th class="text-center" scope="col">Thời gian viết</th>
                        <th class="text-center" scope="col">Hành động</th>
                        <th class="text-center" scope="col">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($post as $post) {
                    ?>
                        <tr>
                            <td class="text-center" scope="row"><?php echo ($count++) ?></td>
                            <td class="text-center"><?php echo $post["Username"] ?></td>
                            <td class="text-center"><img src="../upload/blog/<?php echo $post["Cover_Url"] ?>" width="50%" height="50%"></td>
                            <td class="text-center"><a href="single-post.php?ID=<?php echo $post["Post_ID"] ?>"> <?php echo $post["Post_Tittle"] ?> </td>
                            <td class="text-center"><?php echo $post["Category_Name"] ?></td>
                            <td class="text-center"><?php echo $post["Time_Create"] ?></td>
                            <td class="text-center">
                                <a href="post-edit.php?ID=<?php echo $post["Post_ID"] ?>" class="btn btn-success">Sửa</a>
                                <br>
                                <br>
                                <a href="post-delete.php?ID=<?php echo $post["Post_ID"] ?>" class="btn btn-danger">Xóa</a>
                            </td>
                            <td class="text-center"><?php echo $post["Status_Name"] ?> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning">
                Trống!
            </div>
        <?php } ?>
        </div>
        </section>
        <!-- <script>
            var navList = document.getElementById('navList').children;
            navList.item(1).classList.add("active");
        </script> -->
    </body>

    </html>
<?php } else {
    header("Location:404.php");
    exit;
}
?>