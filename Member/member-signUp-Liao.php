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
	<!-- 已經被註冊過的提示訊息 -->






	<div class="container d-flex justify-content-center align-items-center">
		<div class="sign">
			<nav class="container">
				<ul class="nav nav-tabs d-flex justify-content-center">
					<li class="nav-item flex-growth"><a class="nav-link" href="">會員註冊</a></li>
					<li class="nav-item flex-growth"><a class="nav-link" href="member-signIn-Liao.php">會員登入</a></li>
				</ul>
			</nav>
			<form class="container sign-up-panel" action="do-Sign-up-Liao.php" method="post">
				<div class="logo">
					<img class="object-fit-contain" src="https://cdn.dribbble.com/users/17243/screenshots/11643378/media/09c00588d9a7cef3dedd09b528c6de9f.png?compress=1&resize=1600x1200&vertical=center" alt="">
				</div>
				<!-- class="bs-stepper" -->
				<div class="">

					<!-- STEP1 -->
					<div class="form-group mb-2">
						<label for="name" class="form-label">姓名</label>
						<input name="name" type="text" class="form-control" id="name" placeholder="王小胖">
					</div>
					<div class="mb-2">
						<label for="phone" class="form-label">聯絡電話</label>
						<input name="phone" type="phone" class="form-control" id="phone" placeholder="0928123456">
					</div>
					<div class="form-group mb-2">
						<label for="">您的居住地</label>
						<select name="city" class="form-select mt-1" aria-label="Default select example">
							<option value="1">基隆市</option>
							<option value="2">台北市</option>
							<option value="3">新北市</option>
							<option value="4">桃園市</option>
							<option value="5">新竹市</option>
							<option value="6">新竹縣</option>
							<option value="7">苗栗縣</option>
							<option value="8" selected>台中市</option>
							<option value="9">彰化縣</option>
							<option value="10">南投縣</option>
							<option value="11">雲林縣</option>
							<option value="12">嘉義市</option>
							<option value="13">嘉義縣</option>
							<option value="14">台南市</option>
							<option value="15">高雄市</option>
							<option value="16">屏東縣</option>
							<option value="17">台東縣</option>
							<option value="18">花蓮縣</option>
							<option value="19">宜蘭縣</option>
							<option value="20">澎湖縣</option>
							<option value="21">金門縣</option>
							<option value="22">連江縣</option>
						</select>
					</div>
					<div class="mb-2">
						<label for="account" class="form-label">信箱（帳號）</label>
						<input name="account" type="account" class="form-control" id="account" placeholder="example@mail.com">
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


		<!-- 已經被註冊過的提示訊息 -->

		<!-- <?php var_dump($_SESSION["error"]); ?> -->
		<!-- <?php if (isset($_SESSION["error"])) : ?>
			<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="exampleModalLabel">小提醒</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							這個帳號已經被註冊過囉！
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">重新設定</button>
							<a href="member-signIn-Liao.php" type="button" class="btn btn-primary">立即登入</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?> -->
		</form>
	</div>
	</div>










	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bs-stepper@1.7.0/dist/js/bs-stepper.min.js"></script>
	<!-- <script>
		var stepperElem = document.querySelector('.bs-stepper');
		var stepper = new Stepper(stepperElem);
		var done = false;
		var currStep = 1;
		history.pushState(currStep, '');
		//切換到步驟前觸發，呼叫e.preventDefault()可阻止切換
		stepperElem.addEventListener("show.bs-stepper", function(e) {
			if (done) { //若程序完成，不再切換
				e.preventDefault();
				return;
			}
		});
		//切換到步驟後觸發，e.detail.indexStep為目前步驟序號(從0開始)
		stepperElem.addEventListener("shown.bs-stepper", function(e) {
			var idx = e.detail.indexStep + 1;
			currStep = idx;
			//pushState()記下歷程以支援瀏覽器回上頁功能
			history.pushState(idx, '');
		})
		//瀏覽器上一頁下一頁觸發
		window.onpopstate = function(e) {
			if (e.state && e.state != currStep)
				stepper.to(e.state);
		};
		//模擬送出表單，註記已完成，不再允許切換步驟
		function simulateSubmit() {
			stepper.next();
			done = true;
		}
	</script> -->
</body>

</html>