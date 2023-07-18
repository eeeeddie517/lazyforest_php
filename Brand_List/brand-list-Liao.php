<?php
require_once("../db-connect.php");

$page = $_GET["page"] ?? 1;
$type = $_GET["type"] ?? 1;

// 找出所有使用者
$sqlTotal = "SELECT * FROM brand WHERE valid=1";
$resultTotal = $conn->query($sqlTotal);

//計算品牌總量
$totalBrand = $resultTotal->num_rows;


//排序id,name
if ($type == 1) {
    $ORDERBY = "ORDER BY brand_id ASC";
} elseif ($type == 2) {
    $ORDERBY = "ORDER BY brand_id DESC";
} elseif ($type == 3) {
    $ORDERBY = "ORDER BY brand_email ASC";
} else {
    $ORDERBY = "ORDER BY brand_email DESC";
}

//頁數
$perPage = 5;
$totalPage = ceil($totalBrand / $perPage);
$startPage = ($page - 1) * $perPage;

//品牌列表
$sql = "SELECT * FROM brand WHERE valid=1 $ORDERBY LIMIT $startPage,$perPage";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);


?>

<!doctype html>
<html lang="en">

<head>
    <title>Brand List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center px-2">
            <h2 class="mt-3">Brand_List</h2>
            <h6>共 <?= $totalBrand ?> 筆，第<?= $page ?> 頁</h6>
        </div>

        <div class="m-3 d-flex justify-content-between">
            <!-- 搜尋bar -->
            <form action="do-search-Liao.php">
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="text" name="name" placeholder="搜尋品牌">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-dark" type="submit">搜尋</button>
                    </div>
                </div>
            </form>
            <!-- 搜尋按鈕 -->
            <div class="search-btn">
                <div class="btn-group me-2">
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $page ?>&type=1" class="btn btn-light <?php if ($type == 1) echo "active"; ?> "><i class="fa-solid fa-arrow-down"></i> id</a>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $page ?>&type=2" class="btn btn-light <?php if ($type == 2) echo "active"; ?>"><i class="fa-solid fa-arrow-up"></i> id</a>
                </div>
                <div class="btn-group">
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $page ?>&type=3" class="btn btn-light <?php if ($type == 3) echo "active"; ?>"><i class="fa-solid fa-arrow-down"></i> email</a>
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
                <?php foreach ($rows as $brand) : ?>
                    <tr>
                        <td><?= $brand["brand_id"] ?></td>
                        <td><?= $brand["brand_hostName"] ?></td>
                        <td><?= $brand["brand_email"] ?></td>
                        <td><?= $brand["brand_phone"] ?></td>
                        <td><a class="btn btn-primary" href="brand-detail-Liao.php?id=<?= $brand["brand_id"] ?>">顯示</a></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- 分頁 -->
        <!-- 分頁 -->
        <nav aria-label="...">
            <ul class="pagination">
                <?php for($i=1; $i<=$totalPage; $i++): ?>
                <li class="page-item <?php if($page==$i) echo "active"; ?> "><a class="page-link" href="<?= $_SERVER['PHP_SELF'] ?>?page=<?= $i ?>&type=<?= $type ?>"><?= $i ?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>