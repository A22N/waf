<?php
session_start();
include_once('inc/menu.php');
include_once('func/funcs.php');
if (!isset($_POST['search']) || $_POST['search'] == '') {
    echo "<script>
            window.location.href = 'index.php';
        </script>";
}
$posts = Search($_POST['search']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bài Viết</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid mx-5">
        <section>
            <main class="main-blog row ">

                <?php
                if ($posts != -1) {
                    foreach ($posts as $post) { ?>
                        <div class="col-12 p-1">
                            <div class="card mb-3" style="width: 100%; height: 280px;">
                                <div class="row g-0" style=" height: 100%;">
                                    <div class="col-md-5" style=" height: 100%;">
                                        <img style=" height: 100%;width: 100%;" src="upload/blog/<?php echo $post['Cover_Url'] ?>" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $post['Post_Tittle'] ?></h5>
                                            <p class="card-text"><small class="text-muted">Ngày đăng <?php echo $post['Time_Create'] ?></small></p>
                                            <a href="single-blog.php?id=<?php echo $post['Post_ID'] ?>" class="btn btn-primary">Đọc thêm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                } else { ?>
                    <h1 class="text-center">Không tìm thấy</h1>
                <?php } ?>
            </main>
        </section>
    </div>


</body>

</html>