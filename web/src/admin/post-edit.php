<?php
session_start();
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin" &&
    $_GET['ID']
) {
    $id = $_GET['ID'];
    include_once("./func/post.php");
    include_once("../DB_Config/connectDB.php");
    $category = getAllCategory($conn);
    $post = getPostNamebyID($conn, $id);
    $content = getByIdDeep($conn, $id);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Sửa bài viết - <?php echo $post ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
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

        <div>
            <h3 class="mb-3 text-center">
                Sửa bài viết
                <br>
                <a href="post.php" class="btn btn-secondary">Danh Sách Bài Viết</a>
                <br>
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

            <form class="shadow p-3" action="./func/post-edit.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="ID" value="<?php echo $id ?>">
                <div class="mb-3">
                    <label class="form-label">Tiêu Đề</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $content['Post_Tittle'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tác Giả</label>
                    <input readonly type="text" class="form-control" name="user_write" value="<?php echo $content['Username'] ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Ảnh Bìa</label>
                    <input type="file" class="form-control" name="cover">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nội Dung</label>
                    <textarea class="form-control text text-break" name="text" id="content" rows="12" cols="50"><?= $content['Post_Content'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Danh Mục</label>
                    <select name="category" class="form-control">
                        <?php foreach ($category as $category) { ?>
                            <option value="<?php echo $category['ID'] ?>">
                                <?php echo $category['Category_Name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>.
        </section>
        </div>

        <script>
            var editor = ClassicEditor
                .create(document.querySelector('#content'))
                .catch(error => {
                    console.error(error);
                });
        </script>
        <!-- <script>
            var navList = document.getElementById('navList').children();
            navList.item(1).classList.add("active");
        </script> -->
    </body>

    </html>
<?php } else {
    header("Location:404.php");
    exit;
}
?>