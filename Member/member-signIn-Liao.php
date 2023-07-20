<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
	<title>Member-SignIn</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.2.1 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<style>
		.sign-in-panel {
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
	<div class="container vh-100 d-flex justify-content-center align-items-center sign-up-panel">
		<div class="sign">
			<nav>
				<ul class="nav nav-tabs d-flex justify-content-center">
					<li class="nav-item flex-growth"><a class="nav-link" href="member-signUp-Liao.php">會員註冊</a></li>
					<li class="nav-item flex-growth"><a class="nav-link" href="">會員登入</a></li>
				</ul>
			</nav>
			
			<?php if (isset($_SESSION["error"]["times"]) && $_SESSION["error"]["times"] > 5) : ?>
				<div class="logo">
					<img class="object-fit-contain" src="https://cdn-bastani.stunning.kr/prod/portfolios/2e57fdd0-63cf-4f59-9445-d034c4fcf4a6/contents/84b9a3627bf92ae75527c680642ac1e51d3b349b2f7fd9e55b7f7b38871181b7_v2.gif" alt="">
				</div>
				<div class="d-flex justify-content-center">
					<h4 class="h6">錯誤次數太多了，等等再試</h4>
				</div>

			<?php else : ?>
				<form action="do-sign-in-Liao.php" method="post" class="sign-in-panel">

					<div class="logo">
						<img class="object-fit-contain" src="https://cdn.dribbble.com/users/17243/screenshots/11643378/media/09c00588d9a7cef3dedd09b528c6de9f.png?compress=1&resize=1600x1200&vertical=center" alt="">
					</div>


					<div class="form-group mb-2">
						<label for="account" class="form-label">帳號</label>
						<input name="account" type="account" class="form-control" id="account" placeholder="example@mail.com">
					</div>
					<div class="form-group mb-2">
						<label for="password" class="form-label">密碼</label>
						<input name="password" type="password" class="form-control" id="password" placeholder="請輸入密碼">
					</div>
					<?php if (isset($_SESSION["error"])&& isset($_SESSION["error"]["message"])) : ?>
						<div class="text-danger">
							<?= $_SESSION["error"]["message"]; ?>
						</div>
					<?php unset($_SESSION["error"]["message"]);
					endif;  ?>
					<div class="d-flex justify-content-center">
						<button class="mt-3 btn btn-dark" type="submit">登入</button>
					</div>
				</form>
			<?php endif; ?>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
		</script>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
		</script>
</body>

</html>