<?php
session_start();
require_once("db_connect.php");


if (!isset($_SESSION["admin"]) && !isset($_SESSION["camp"]) && !isset($_SESSION["brand"])) {
    header("location: 404.php");
}


$page = $_GET["page"] ?? 1;

$type = $_GET["type"] ?? 2;

if ($type == 1) {
    $orderBY = "ORDER BY brand_id ASC";
} elseif ($type == 2) {
    $orderBY = "ORDER BY brand_id DESC";
} elseif ($type == 3) {
    $orderBY = "ORDER BY brand_name ASC";
} elseif ($type == 4) {
    $orderBY = "ORDER BY brand_name DESC";
} else {
    header("location: ../404.php");
}


$perPage = 5;
$startItem = ($page - 1) * $perPage;


if (isset($_SESSION["admin"])) {
    $sqlTotal = "SELECT brand_id FROM brand_info WHERE valid = 1";
    $resultTotal = $conn->query($sqlTotal);
    $totalBrand = $resultTotal->num_rows;
}

if (isset($_SESSION["brand"])) {
    $currentBrandID = $_SESSION["brand"]["brand_id"];
    $sqlTotal = "SELECT brand_id FROM brand_info WHERE valid = 1 AND brand_id = '$currentBrandID'";
    $resultTotal = $conn->query($sqlTotal);
    $totalBrand = $resultTotal->num_rows;
}

// $sqlTotal = "SELECT brand_id FROM brand_info WHERE valid = 1";
// $resultTotal = $conn->query($sqlTotal);
// $totalBrand = $resultTotal->num_rows;





// $sql = "SELECT brand_id, brand_name, brand_intro, brand_logo FROM brand_info WHERE valid = 1 $orderBY LIMIT $startItem, $perPage";
if (isset($_SESSION["admin"])) {
    $sql = "SELECT brand_id, brand_name, brand_intro, brand_logo FROM brand_info WHERE valid = 1 $orderBY LIMIT $startItem, $perPage";
    $result = $conn->query($sql);

}

if (isset($_SESSION["brand"])) {
    $currentBrandID = $_SESSION["brand"]["brand_id"];
    $sql = "SELECT brand_id, brand_name, brand_intro, brand_logo FROM brand_info WHERE valid = 1 AND brand_id = '$currentBrandID' $orderBY LIMIT $startItem, $perPage";
    $result = $conn->query($sql);

}

//計算總頁數，有餘數的話就需要再新增一頁 -> 無條件進位得出所需頁數
$totalPage = ceil($totalBrand / $perPage);

// $result = $conn->query($sql);

?>
<!doctype html>
<html lang="en">

<head>
    <title>森懶腰</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS -->
    <link rel="stylesheet" href="Brand/all.css">
    <style>
        body {
            height: 2000px;
            background: #ffffff;
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
                <?php if (isset($_SESSION["brand"])) { ?>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="camp_home-LIN.php">
                        <i class="fa-solid fa-house-chimney fa-fw me-2"></i>
                        Dashboard
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
        <div class="container">
            <!-- <?= $totalPage ?> -->
            <div class="py-2">
                <form action="Brand/brand-search.php">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="搜尋商家" name="brand_name">
                        </div>
                        <div class="col-auto"><button class="btn btn-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            $brand_count = $result->num_rows;
            ?>
            <div class="py-2 d-flex justify-content-between align-items-center"><a href="Brand/brand-create.php" class="btn btn-warning"><i class="fa-solid fa-file-circle-plus"></i>新增</a>
                <div>
                    共 <?= $totalBrand ?> 筆, 第 <?= $page ?> 頁
                </div>
            </div>
            <div class="py-2 d-flex justify-content-end">
                <div class="btn-group">
                    <a href="brand-LIN.php?page=<?= $page ?>& type=1" class="btn btn-dark <?php if ($type == 1) echo "active"; ?>">ID<i class="fa-solid fa-arrow-down-short-wide"></i></a>
                    <a href="brand-LIN.php?page=<?= $page ?>& type=2" class="btn btn-dark <?php if ($type == 2) echo "active"; ?>">ID<i class="fa-solid fa-arrow-down-wide-short"></i></a>
                    <a href="brand-LIN.php?page=<?= $page ?>& type=3" class="btn btn-dark <?php if ($type == 3) echo "active"; ?>">NAME<i class="fa-solid fa-arrow-down-short-wide"></i></a>
                    <a href="brand-LIN.php?page=<?= $page ?>& type=4" class="btn btn-dark <?php if ($type == 4) echo "active"; ?>">NAME<i class="fa-solid fa-arrow-down-wide-short"></i></a>
                </div>
            </div>
            <?php
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            // var_dump($rows);
            // exit;
            ?>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th class="col-0 ">id</th>
                        <th class="col-2">logo</th>
                        <th class="col-2">品牌名稱</th>
                        <th class="col-7">品牌介紹</th>
                        <th class="col-1"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <div class="modal fade" id="deleteModal<?= $row["brand_id"] ?>" tabindex="-1" aria-labelledby="" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="">警告</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        確認刪除"<?= $row["brand_name"] ?>"?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                        <a href="Brand/brand-doDelete.php?brand_id=<?= $row["brand_id"] ?>" class="btn btn-danger">確認</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <tr>
                            <td><?= $row["brand_id"] ?></td>
                            <td>
                                <figure><img src="Brand/brand_logo/<?= $row["brand_logo"] ?>" alt="" class="object-fit-cover"></figure>
                            </td>
                            <td><?= $row["brand_name"] ?></td>
                            <td><?= $row["brand_intro"] ?></td>
                            <td class="text-center py-2"><a href="Brand/brand.php?brand_id=<?= $row["brand_id"] ?>" class="btn btn-warning"><i class="fa-regular fa-eye"></i></a>
                                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $row["brand_id"] ?>"><i class="fa-regular fa-trash-can"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?php
                                                if ($i == $page) echo "active"; ?>
                "><a class="page-link" href="brand-LIN.php?page=<?= $i ?>&type=<?= $type ?>"><?= $i ?></a></li>
                    <?php endfor; ?>

                </ul>
            </nav>
        </div>
    </main>
    <!-- JS -->
    <?php include("Brand/js.php") ?>








    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>