<?php
session_start();
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">MyBlog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.php">Trang chủ</a>
                </li>
                &nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                    <a class="nav-link" href="../blog.php">Bài Viết</a>
                </li>
                &nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                    <a class="nav-link" href="../about.php">Về Chúng tôi</a>
                </li>
                &nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                    <a class="nav-link" href="../contact.php">Liên hệ</a>
                </li>
                &nbsp;&nbsp;&nbsp;
                <?php
                if (isset($_SESSION["User"])) {
                    echo <<<PHP
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome {$_SESSION["User"]}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
PHP;
                    if ($_SESSION["Role"] === "Admin") {
                        echo '<li><a class="dropdown-item" href="../admin/dashboard.php">Trang ADMIN</a></li>';
                    } else if ($_SESSION['Role'] === "User") {
                        echo '<li><a class="dropdown-item" href="../user/dashboard.php">Quản Lý Bài Viết</a></li>';
                    }
                    echo '<li><a class="dropdown-item" href="profile.php">Trang cá nhân</a></li>';
                    echo '<li><a class="dropdown-item" href="changepass.php">Thay đổi mật khẩu</a></li>';
                    echo '<li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>';
                    echo '</ul></div>';
                } else {
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="login.php">Đăng Nhập</a>';
                    echo '</li>';
                }
                ?>
            </ul>
            <form class="d-flex" method="post" action="search.php" role="search">
                <input class="form-control me-3" type="search" placeholder="Tìm kiếm" aria-label="Search" require name="search">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-outline-success" style="font-size: 13px" type="submit">Tìm Kiếm</button>
            </form>
        </div>
    </div>
</nav>