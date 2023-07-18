<?php
session_start();
require_once("db_connect.php");


if (!isset($_SESSION["user"])) {
    header("location: Member/member-signIn-Liao.php");
}

$page = $_GET["page"] ?? 1;
$type = $_GET["type"] ?? 1;

// 找出所有使用者
$sqlTotal = "SELECT * FROM camp_list WHERE valid=1";
$resultTotal = $conn->query($sqlTotal);

//計算品牌總量
$totalCamp = $resultTotal->num_rows;


//排序id,name
if ($type == 1) {
    $ORDERBY = "ORDER BY camp_id ASC";
} elseif ($type == 2) {
    $ORDERBY = "ORDER BY camp_id DESC";
} elseif ($type == 3) {
    $ORDERBY = "ORDER BY camp_email ASC";
} else {
    $ORDERBY = "ORDER BY camp_email DESC";
}

//頁數
$perPage = 5;
$totalPage = ceil($totalCamp / $perPage);
$startPage = ($page - 1) * $perPage;

//品牌列表
$sql = "SELECT * FROM camp_list WHERE valid=1 $ORDERBY LIMIT $startPage,$perPage";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);


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
                Hi, <?= $_SESSION["user"]["user_name"] ?>
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
                <?php if (!isset($_SESSION["user"])) {
                ?>
                <?php
                } ?>
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
        <div class="container">
            <div class="d-flex justify-content-between align-items-center px-2">
                <h2 class="mt-3">CampHost_List</h2>
                <h6>共 <?= $totalCamp ?> 筆，第<?= $page ?> 頁</h6>
            </div>

            <div class="m-3 d-flex justify-content-between">
                <!-- 搜尋bar -->
                <form action="CampHost_List/do-search-Liao.php">
                    <div class="row">
                        <div class="col">
                            <input class="form-control" type="text" name="name" placeholder="搜尋營主">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-dark" type="submit">搜尋</button>
                        </div>
                    </div>
                </form>
                <!-- 搜尋按鈕 -->
                <div class="search-btn">
                    <div class="btn-group me-2">
                        <a href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $page ?>&type=1" class="btn btn-light"><i class="fa-solid fa-arrow-down <?php if ($type == 1) echo "active"; ?>"></i> id</a>
                        <a href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $page ?>&type=2" class="btn btn-light <?php if ($type == 2) echo "active"; ?>"><i class="fa-solid fa-arrow-up"></i> id</a>
                    </div>
                    <div class="btn-group">
                        <a href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $page ?>&type=3" class="btn btn-light"><i class="fa-solid fa-arrow-down <?php if ($type == 3) echo "active"; ?> "></i> email</a>
                        <a href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $page ?>&type=4" class="btn btn-light <?php if ($type == 4) echo "active"; ?>"><i class="fa-solid fa-arrow-up"></i> email</a>
                    </div>
                </div>

            </div>

            <!-- 表格 table -->
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>id</th>
                        <th>姓名</th>
                        <th>帳號（信箱）</th>
                        <th>電話</th>
                        <th>詳細資訊</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $camp) : ?>
                        <tr>
                            <td><?= $camp["camp_id"] ?></td>
                            <td><?= $camp["camp_hostName"] ?></td>
                            <td><?= $camp["camp_email"] ?></td>
                            <td><?= $camp["camp_phone"] ?></td>
                            <td><a class="btn btn-primary" href="CampHost_List/camp-detail-Liao.php?id=<?= $camp["camp_id"] ?>">顯示</a></td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- 分頁 -->
            <!-- 分頁 -->
            <nav aria-label="...">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?php if ($page == $i) echo "active"; ?> "><a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $i ?>&type=<?= $type ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>

        </div>
    </main>









    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>