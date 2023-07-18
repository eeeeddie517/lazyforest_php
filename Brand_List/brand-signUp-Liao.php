<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
	<title>Member sign</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.2.1 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper@1.7.0/dist/css/bs-stepper.min.css">
	<style>
		.sign-up-panel {
			width: 500px;
		}

		.logo {
			height: 200px;
		}

		.object-fit-contain {
			width: 100%;
			height: 100%;
			object-fit: contain;
		}
	</style>
</head>

<body>
	<div class="container d-flex justify-content-center align-items-center">
		<div class="sign">
			<nav class="container">
				<ul class="nav nav-tabs d-flex justify-content-center">
					<li class="nav-item flex-growth"><a class="nav-link" href="">品牌註冊</a></li>
					<li class="nav-item flex-growth"><a class="nav-link" href="brand-signIn-Liao.php">品牌登入</a></li>
				</ul>
			</nav>
			<form class="container sign-up-panel" action="brand-do-Sign-up-Liao.php" method="post">
				<div class="logo">
					<img class="object-fit-contain" src="https://cdn.dribbble.com/users/17243/screenshots/11643378/media/09c00588d9a7cef3dedd09b528c6de9f.png?compress=1&resize=1600x1200&vertical=center" alt="">
				</div>
				
				<div class="">
					<div class="form-group mb-2">
						<label for="name" class="form-label">聯絡人姓名</label>
						<input name="name" type="text" class="form-control" id="name" placeholder="王小胖">
					</div>
					<div class="mb-2">
						<label for="phone" class="form-label">聯絡電話</label>
						<input name="phone" type="phone" class="form-control" id="phone" placeholder="0928123456">
					</div>
					<div class="mb-2">
						<label for="address" class="form-label">地址</label>
						<input name="address" type="text" class="form-control" id="address" placeholder="台中市西屯區中港路168號">
					</div>
					<div class="mb-2">
						<label for="vat" class="form-label">統一編號</label>
						<input name="vat" type="text" class="form-control" id="vat" placeholder="12345678">
					</div>
					<div class="mb-2">
						<label for="account" class="form-label">信箱（帳號）</label>
						<input name="account" type="email" class="form-control" id="account" placeholder="example@mail.com">
					</div>
					<div class="mb-2">
						<label for="password" class="form-label">密碼</label>
						<input name="password" type="password" class="form-control" id="password" placeholder="請自行設定密碼">
					</div>
					<div class="mb-2">
						<label for="repassword" class="form-label">再次輸入密碼</label>
						<input name="repassword" type="password" class="form-control" id="repassword" placeholder="請輸入與上面相同的密碼">
					</div>
					<?php if (isset($_SESSION["error"])) : ?>
						<div class="text-danger">
							<?= $_SESSION["error"]["again"] ?>
						</div>
					<?php unset($_SESSION["error"]);
					endif; ?>
					<div class="d-flex justify-content-center">
						<button class="btn btn-dark mt-3" type="submit">註冊</button>
					</div>

				</div>
		</div>
		</form>
	</div>
	</div>


	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bs-stepper@1.7.0/dist/js/bs-stepper.min.js"></script>

</body>

</html>