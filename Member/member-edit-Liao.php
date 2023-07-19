<?php
session_start();

$id = $_GET["id"];
require_once("../db_connect.php");
$sql = "SELECT member_list.* , member_city.* FROM member_list 
JOIN member_city ON city_id = user_city
WHERE user_id=$id AND valid=1";
$result = $conn->query($sql);
$member = $result->fetch_assoc();

$sqlCity = "SELECT * FROM member_city";
$resultCity = $conn->query($sqlCity);
$cities = $resultCity->fetch_all(MYSQLI_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
    <title>森懶腰</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            height: 2000px;
        }

        :root {
            --aside-width: 300px;
            --page-spacing-top: 56px;
        }

        .brand-name {
            width: var(--aside-width);
        }

        .main-aside {
            width: var(--aside-width);
            padding-top: calc(var(--page-spacing-top) + 10px);
        }

        .main-content {
            margin-left: var(--aside-width);
            padding-top: calc(var(--page-spacing-top) + 10px);
        }

        /* .chart{
            height: 400px;
        } */
    </style>
</head>

<body>
    <header class="text-bg-dark d-flex shadow fixed-top justify-content-between align-items-center">
        <a class="bg-black py-3 px-3 text-decoration-none link-light brand-name" href="/">森懶腰 <i class="fa-solid fa-tree" style="color: #ffffff;"></i></a>
        <div class="d-flex align-items-center">
            <div class="me-3">
                Hi,
                <?php
                if (isset($_SESSION["admin"])) {
                    echo $_SESSION["admin"]["name"];
                } elseif (isset($_SESSION["camp"])) {
                    echo $_SESSION["camp"]["camp_hostName"];
                } elseif (isset($_SESSION["brand"])) {
                    echo $_SESSION["brand"]["brand_hostName"];
                }
                ?>
            </div>
            <a href="logout.php" class="btn btn-dark me-3">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </div>
    </header>
    <aside class="main-aside position-fixed bg-light vh-100 border-end">
        <nav class="">
            <ul class="list-unstyled">
                <!-- if ($_SESSION['user']['name'] !== 'Joe'): 
                endif;  用session判斷哪些要讓user看到的寫法! -->
                <?php if (isset($_SESSION["admin"])) { ?>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="camp_home-LIN.php">
                            <i class="fa-solid fa-house-chimney fa-fw me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="camp_info-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            營地資訊
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="camp_ground-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            營位預定
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="category_list-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            類別管理
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="member_list-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            會員清單
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="brand-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            品牌資訊
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="product_list-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            商品資訊
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="camphost_list-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            營主名單
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="brand_list-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            品牌名單
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <ul class="list-unstyled">
                <hr>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="">
                        <i class="fa-solid fa-gear fa-fw me-2"></i>
                        Setting
                    </a>
                </li>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="">
                        <i class="fa-solid fa-door-closed fa-fw me-2"></i>
                        Sign out
                    </a>
                </li>
        </nav>

    </aside>
    <main class="main-content ">
        <div class="px-3">
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <h1>Member List</h1>
                <!-- <h6>共 <?= $totalMember ?> 筆，第<?= $page ?> 頁</h6> -->
            </div>
            <div class="container">
                <form action="do-edit-Liao.php" method="post">
                    <table class="table table-bordered">
                        <input name="id" type="hidden" value="<?= $member["user_id"] ?>">
                        <tr>
                            <th>id</th>
                            <td> <?= $member["user_id"] ?> </td>
                        </tr>
                        <tr>
                            <th>使用者名稱</th>
                            <td><input name="name" type="text" class="form-control" value="<?= $member["user_name"] ?>"></td>
                        </tr>
                        <tr>
                            <th>帳號（信箱）</th>
                            <td><input name="account" type="email" class="form-control" value="<?= $member["user_email"] ?>"></td>
                        </tr>
                        <tr>
                            <th>電話</th>
                            <td><input name="phone" type="tel" class="form-control" value="<?= $member["user_phone"] ?>"></td>
                        </tr>
                        <tr>
                            <th>居住城市</th>

                            <td>

                                <select name="city" class="form-select mt-1" aria-label="Default select example">
                                    <?php foreach ($cities as $city) : ?>
                                        <option value="<?= $city["city_id"] ?>" <?php if ($member["user_city"] == $city["city_id"]) {
                                                                                    echo "selected";
                                                                                } ?>><?= $city["city_name"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>


                            <!-- <td>
                        <select name="city" class="form-select mt-1" aria-label="Default select example">
							<option value="1">基隆市</option>
							<option value="2">台北市</option>
							<option value="3">新北市</option>
							<option value="4">桃園市</option>
							<option value="5">新竹市</option>
							<option value="6">新竹縣</option>
							<option value="7">苗栗縣</option>
							<option value="8">台中市</option>
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
                    </td> -->

                        </tr>
                    </table>

                    <!-- 編輯＆刪除按鈕 -->
                    <div class="btn-group">
                        <button type="submit" class="btn btn-dark">儲存</button>
                        <a href="member-detail-Liao.php?id=<?= $member["user_id"] ?>" class="btn btn-light">取消</a>
                    </div>

                </form>
            </div>
        </div>
    </main>









    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>