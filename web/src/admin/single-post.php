<?php
session_start();
if (
    isset($_SESSION["User"]) &&
    $_SESSION["Role"] === "Admin" &&
    $_GET['ID']
) {
    $post_id = $_GET['ID'];
    include_once "./inc/side-nav.php";
    include_once("./func/post.php");
    include_once("../DB_Config/connectDB.php");
    $post = getByIdDeep($conn, $post_id);
    $category = getCategoryById($conn, $post_id);
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Nội Dung Của Bài Viết <?php echo $post['Post_Tittle'] ?> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/side-bar.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>

    <body>
        <?php
        ?>
        <h3 class="mb-3 text-center">
            <a href="./post.php" class="btn btn-secondary">Tất cả Bài Viết</a>
            &nbsp;
            <a href="./category.php" class="btn btn-secondary">Tất cả Danh Mục</a>
        </h3>
        &nbsp;
        <div>
            <div class="card mb-5">
                <br>
                <img src="../upload/blog/<?php echo $post['Cover_Url'] ?>" class="card-img-top text-center rounded mx-auto d-block" alt="..." style="height: 75%; width:75%">
                &nbsp;
                <div class="card-body">
                    <h2 class="card-title text-center fw-bolder"><?php echo $post['Post_Tittle'] ?></h2>
                    &nbsp;&nbsp;
                    <div class="text-break">
                        <?php echo $post['Post_Content'] ?>
                    </div>
                    <hr>
                    <p class="card-text d-flex justify-content-between">
                        <b>Danh Mục: <?php echo $post['Category_Name'] ?></b> &nbsp;&nbsp;
                        <small>Người Viết: <?php echo $post['Username'] ?></small>
                        <small class="text-body-secondary">Thời gian tạo bài viết: <?php echo date($post['Time_Create']) ?></small>
                    </p>
                </div>
            </div>
        </div>
        </section>
        <!-- <script>
            var navList = document.getElementById('navList').children;
            navList.item(1).classList.add("active");
        </script> -->
    </body>

    </html>

<?php } else {
    header("Location: 404.php");
    exit;
} ?>