<?php
session_start();
require_once("db_connect.php");


if (!isset($_SESSION["user"])) {
    header("location: ../admin/sign-in.php");
}

$page = $_GET["page"] ?? 1;
$type = $_GET["type"] ?? 1;

$sqlTotal = "SELECT id FROM camps WHERE valid=1";
$resultTotal = $conn->query($sqlTotal);
$totalCamps = $resultTotal->num_rows;

$perPage = 8;
$startItem = ($page - 1) * $perPage;
$totalPage = ceil($totalCamps / $perPage);

if ($type == 1) {
    $orderBy = "ORDER BY id ASC";
} elseif ($type == 2) {
    $orderBy = "ORDER BY id DESC";
} elseif ($type == 3) {
    $orderBy = "ORDER BY price ASC";
} elseif ($type == 4) {
    $orderBy = "ORDER BY price DESC";
} else {
    header("location:404.php");
}

$sql = "SELECT camps.*, camp_info.camp_name AS camp_name
        FROM camps
        JOIN camp_info ON camps.camp_id = camp_info.camp_id
        WHERE camps.valid = 1
        $orderBy
        LIMIT $startItem, $perPage";

$result = $conn->query($sql);
$campRows = $result->fetch_all(MYSQLI_ASSOC);
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
            <div class="py-2 d-flex justify-content-between align-items-center">
                <div>
                    共 <?= $totalCamps ?> 筆，第<?= $page ?> 頁
                </div>
            </div>

            <div class="py-2 d-flex justify-content-end">
                <div class="dropdown">
                    <a class="btn btn-info" href="Camp_Ground/create-camp-YU.php">新增營地</a>
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        排序
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="camp_ground-LIN.php?page=<?= $page ?>&type=1"><?php if ($type == 1) echo ""; ?>id <i class="fa-solid fa-arrow-down-short-wide"></i></a></li>
                        <li><a class="dropdown-item" href="camp_ground-LIN.php?page=<?= $page ?>&type=2"><?php if ($type == 2) echo ""; ?>id <i class="fa-solid fa-arrow-down-wide-short"></i></a></li>
                        <li><a class="dropdown-item" href="camp_ground-LIN.php?page=<?= $page ?>&type=3"> <?php if ($type == 3) echo ""; ?>價錢 <i class="fa-solid fa-arrow-down-a-z"></i></a></li>
                        <li><a class="dropdown-item" href="camp_ground-LIN.php?page=<?= $page ?>&type=4"><?php if ($type == 4) echo ""; ?>價錢 <i class="fa-solid fa-arrow-down-z-a"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="row g-3 py-3">
                <?php foreach ($campRows as $camps) : ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <a href="Camp_Ground/camp-YU.php?id=<?= $camps["id"] ?>">
                                <figure class="ratio ratio-1x1">
                                    <img class="object-fit-cover card-img-top" src="Camp_Ground/camp_img/<?= $camps["image"] ?>" alt="<?= $camps["camp_name"] ?>">
                                </figure>
                            </a>
                            <div class="px-3 mb-3">
                                <h3 class="h6"><?= $camps["camp_name"] ?></h3>
                                <h3 class="h6"><?= $camps["part"] ?></h3>
                                <div class="price text-end h5 text-success">$<?= $camps["price"] ?></div>
                                <div class="d-grid py-2">
                                    <a href="Camp_Ground/camp-YU.php?id=<?= $camps['id'] ?>" class="btn btn-secondary">更新資料</a>
                                </div>
                                <div class="d-grid"></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?php if ($i == $page) echo "active"; ?>">
                            <a class="page-link" href="camp_ground-LIN.php?page=<?= $i ?>&type=<?= $type ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>

            <script>
                let camps = <?= json_encode($campRows) ?>;
                console.log(camps);
            </script>
    </main>









    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>