<?php
session_start();
?>
<input type="checkbox" id="checkbox">
<header class="header">
    <h2 class="u-name link-secondary"><a href="../user/dashboard.php"><b>MyBlog</b></a>
        <label for="checkbox">
            <i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
        </label>
    </h2>
    <div class="d-flex align-items-center">
        <i class="fa fa-user" aria-hidden="true"></i> &nbsp;
        <span><a href="../profile.php" class="link-secondary"><?php echo $_SESSION['User'] ?></a></span>
    </div>

</header>
<div class="body">
    <nav class="side-bar">
        <div class="user-p">
            <img src="../upload/user/<?php echo $_SESSION['Avatar'] ?>">
            <h4><?php echo $_SESSION['User'] ?></h4>
        </div>
        <ul class="navList">
            <li>
                <a href="../index.php">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="../user/post.php">
                    <i class="fa fa-wpforms" aria-hidden="true"></i>
                    <span>Bài Viết</span>
                </a>
            </li>
            <li>
                <a href="../user/history.php">
                    <i class="fa fa-history" aria-hidden="true"></i>
                    <span>Lịch Sử</span>
                </a>
            </li>
            <li>
                <a href="../logout.php">
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                    <span>Đăng Xuất</span>
                </a>
            </li>
        </ul>
    </nav>
    <section class="section-1">