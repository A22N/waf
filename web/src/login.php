<?php
session_start();
if (isset($_SESSION['User'])) {
?>
	<script>
		alert("Bạn đã đăng nhập rồi!");
		setTimeout(function() {
			window.location.href = "../index.php";
		}, 0)
	</script>
<?php
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Đăng Nhập</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
        body {
            background-image: url('images/login.jpg');
        }
    </style>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

	<div class="d-flex justify-content-center align-items-center vh-100">

		<form class="shadow w-450 p-3" action="./func/login.php" method="post">

			<h4 class="display-4  fs-1">Đăng Nhập</h4><br>
			<?php if (isset($_GET['error'])) { ?>
				<div class="alert alert-danger" role="alert">
					<?php echo base64_decode($_GET['error']); ?>
				</div>
			<?php } ?>

			<div class="mb-3">
				<label class="form-label">Tên Đăng Nhập</label>
				<input type="text" class="form-control" name="uname" value="<?php echo (isset($_GET['uname'])) ? base64_decode($_GET['uname']) : "" ?>">
			</div>

			<div class="mb-3">
				<label class="form-label">Mật Khẩu</label>
				<input type="password" class="form-control" name="pass">
			</div>

			<button type="submit" class="btn btn-primary">Đăng Nhập</button>
			&nbsp;
			<a href="index.php" class="link-secondary">Trang Chủ</a>
			&nbsp;
			<a href="forgetpass.php" class="link-secondary">Quên Mật Khẩu</a>
			&nbsp;
			<a href="register.php" class="link-secondary">Đăng Kí </a>
		</form>
	</div>
</body>

</html>