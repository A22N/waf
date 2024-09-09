<?php
session_start();

include_once('inc/funcs.php');

if (isset($_GET['id'])) {
    $post = postDetail($_GET['id']);
    if ($post == -1) {
        header("location:blog.php");
    }
    $comments = GetComments($_GET['id']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trang chủ</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/comment.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <style>
        * {
            word-break: break-word;
        }

        #content p {
            width: 100%;
        }

        img {
            width: auto;
        }
    </style>
    <?php include_once('inc/menu.php'); ?>

    <div class="container-fluid mx-4" style="width: 100%;">
        <div class="row">
            <div class="col"></div>

            <div class="col-10 shadow mx-3" id="content">
                <h1 class="text-center" style="border-bottom: 2px solid black;"><?php echo $post['Post_Tittle']; ?></h1>
                <?php echo $post['Post_Content']; ?>
            </div>

            <div class="col"></div>
        </div>
        <br><br>
        <div class="row">
            <div class="col"></div>
            <div class="col-10 shadow">
                <br>
                <h4 class="text-center">Bình luận</h4>
                <?php if (isset($_SESSION['ID'])) { ?>
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-secondary" type="button" id="Comment">Gửi</button>
                        <textarea id="BinhLuan" class="form-control" aria-label="With textarea"></textarea>
                    </div>

                <?php } else { ?>
                    <p class="text-center">Đăng nhập để bình luận</p>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-comment">
                            <hr />
                            <ul class="comments" id="CommentsWrapper">
                                <?php foreach ($comments as $comment) {
                                    if ($comment['ID_Reply'] == null) { ?>
                                        <li class="clearfix">
                                            <div class="post-comments">
                                                <p class="meta"><?= $comment['Time_Create'] ?>
                                                    <span><?= $comment['Username'] ?></span> Bình luận:
                                                    <i class="pull-right binhluan">
                                                        <span>
                                                            <small>Trả lời</small>
                                                        </span>
                                                    </i>
                                                </p>
                                                <p>
                                                    <?= $comment['Comment'] ?>
                                                </p>
                                                <div class="reply input-group">
                                                    <textarea class="form-control" aria-label="With textarea"></textarea>
                                                    <input type="hidden" class="idpost form-control" value="<?= $comment['ID'] ?>">
                                                    <button class="btn btn-outline-secondary traloi" type="button">Trả lời</button>
                                                </div>

                                            </div>
                                            <div class="RepWrap" id="<?= $comment['ID'] ?>">
                                                <?php foreach ($comments as $reply) {
                                                    if ($reply['ID_Reply'] == $comment['ID']) { ?>
                                                        <ul class="comments">
                                                            <li class="clearfix">
                                                                <div class="post-comments">
                                                                    <p class="meta"><?= $reply['Time_Create'] ?><span><?= $reply['Username'] ?></span> Trả lời: <i class="pull-right"><span></span></i></p>
                                                                    <p><?= $reply['Comment'] ?></p>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                <?php
                                                    }
                                                } ?>
                                            </div>
                                        </li>


                                <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <script>
        $('.reply').hide()
        $('.binhluan').click(function() {
            $(this).parent().parent().find('.reply').toggle()
            // alert('aaaa')
        })
    </script>
    <script>
        $('#Comment').click(() => {
            var comment = $('#BinhLuan').val()
            // alert(comment)
            $.ajax({
                type: "POST",
                url: "./func/sendComment.php",
                data: {
                    comment: comment,
                    idPost: <?= $_GET['id'] ?>,
                    idUser: <?= $_SESSION['ID'] ?>
                },
                success: function(rp) {
                    var a = new Date()
                    $('#CommentsWrapper').append(`
                    <li class="clearfix">
                        <div class="post-comments">
                            <p class="meta">${a.getFullYear()}-0${a.getMonth()+1}-0${a.getDate()}
                                <span><?= $_SESSION['User'] ?></span> Bình luận:
                                <i class="pull-right binhluan">
                                    <span>
                                        <small>Trả lời</small>
                                    </span>
                                </i>
                            </p>
                            <p>
                                ${comment}
                            </p>
                        </div>
                    `)

                    $('#BinhLuan').val('')
                },
                error: function(xhr, status, error) {
                    // Handle error
                }
            });
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.traloi').click(function() {
                var comID = $(this).parent().find('.idpost').val()
                var content = $(this).parent().find('textarea').val()
                $.ajax({
                    type: "POST",
                    url: "./func/Rep.php",
                    data: {
                        comment: content,
                        idCom: comID,
                        idPost: <?= $_GET['id'] ?>,
                        idUser: <?= $_SESSION['ID'] ?>
                    },
                    success: function(rp) {
                        // alert(rp)s
                        var b = new Date()
                        $(this).parent().find('textarea').val('')
                        var par = $(this).parent().parent().parent()
                        $(`#${comID}`).append(`
                            <ul class="comments">
                                <li class="clearfix">
                                    <div class="post-comments">
                                        <p class="meta">${b.getFullYear()}-0${b.getMonth()+1}-0${b.getDate()}<span> <?= $_SESSION['User'] ?></span> Trả lời: <i class="pull-right"><span></span></i></p>
                                        <p>${content}</p>
                                    </div>
                                </li>
                            </ul>
                        `)

                    },
                    error: function(xhr, status, error) {
                        // Handle error
                    }
                });


            })
        })
    </script>
</body>

</html>