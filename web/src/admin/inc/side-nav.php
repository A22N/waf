<?php
session_start();
?>
<input type="checkbox" id="checkbox">
<header class="header">
    <h2 class="u-name link-secondary"><a href="../admin/dashboard.php"><b>MyBlog
                (ADMIN Panel)</b></a>
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
        <!-- <div class="user-p">
            <img src="../upload/user/<?php echo $_SESSION['Avatar'] ?>">
            <h4><?php echo $_SESSION['User'] ?></h4>
        </div> -->
        <ul class="navList">
            <li>
                <a href="../index.php">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="../admin/user.php">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>Người Dùng</span>
                </a>
            </li>
            <li>
                <a href="../admin/post.php">
                    <i class="fa fa-wpforms" aria-hidden="true"></i>
                    <span>Bài Viết</span>
                </a>
            </li>
            <li>
                <a href="../admin/category.php">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span>Danh Mục</span>
                </a>
            </li>
            <!-- <li>
                <a href="../admin/statistics.php">
                    <i class="fa fa-area-chart" aria-hidden="true"></i>
                    <span>Thống Kê</span>
                </a>
            </li> -->
            <li>
                <a href="../admin/censorship.php">
                    <i class="fa fa-flag-checkered" aria-hidden="true"></i>
                    <span>Kiểm duyệt </span>
                </a>
            </li>
            <li>
                <a href="../admin/history.php">
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