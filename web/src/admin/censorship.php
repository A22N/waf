<?php
session_start();
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin"
) {
    include_once("./func/post.php");
    include_once("../DB_Config/connectDB.php");
    include_once("./inc/side-nav.php");
    $post = getAllPost($conn);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Kiểm Duyệt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/side-bar.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div>
            <br>
            <h4 class="mb-3 text-center">Bài Viết Đang Chờ</h4>
            <br>
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
            <?php if ($post != 0) {
                $count = 0 ?>
                <table class="table t1 table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">ID </th>
                            <th scope="col" class="text-center">Người Viết</th>
                            <th scope="col" class="text-center">Tiêu đề</th>
                            <th scope="col" class="text-center">Danh Mục</th>
                            <th scope="col" class="text-center">Thời Gian Tạo</th>
                            <th scope="col" class="text-center">Hành Động</th>
                            <th scope="col" class="text-center">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($post as $post) {
                            if (isset($post["Status_ID"])) {
                        ?>
                                <tr>
                                    <th scope="row" class="text-center"><?php echo ($count++) ?></th>
                                    <td scope="row" class="text-center"><?php echo $post["Username"] ?></td>
                                    <td scope="row" class="text-center"><a href="single-post.php?ID=<?php echo $post["Post_ID"] ?>"> <?php echo $post["Post_Tittle"] ?> </td></a>
                                    <td scope="row" class="text-center"><?php echo $post["Category_Name"] ?></td>
                                    <td scope="row" class="text-center"><?php echo $post["Time_create"] ?></td>
                                    <td scope="row" class="text-center">
                                        <a href="./func/censorship.php?ID=<?php echo $post["Post_ID"] ?>&action=accept" class="btn btn-success">Đồng Ý</a>
                                        &nbsp;
                                        <a href="./func/censorship.php?ID=<?php echo $post["Post_ID"] ?>&action=deny" class="btn btn-danger">Từ chối</a>
                                    </td>
                                    <td scope="row" class="text-center" scope="row"><?php echo $post['Status_Name'] ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            <?php
            } else { ?>
                <div class="alert alert-warning">
                    Trống!
                </div>
            <?php } ?>
        </div>
        <br>
        <br>
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