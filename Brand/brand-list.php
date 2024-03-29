<?php

$page = $_GET["page"] ?? 1;

$type = $_GET["type"] ?? 2;


require_once("../db-connect.php");

$sqlTotal = "SELECT brand_id FROM brand_info WHERE valid = 1";
$resultTotal = $conn->query($sqlTotal);
$totalBrand = $resultTotal->num_rows;

$perPage = 5;
$startItem = ($page - 1) * $perPage;

//計算總頁數，有餘數的話就需要再新增一頁 -> 無條件進位得出所需頁數
$totalPage = ceil($totalBrand / $perPage);

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

$sql = "SELECT brand_id, brand_name, brand_intro, brand_logo FROM brand_info WHERE valid = 1 $orderBY LIMIT $startItem, $perPage";




$result = $conn->query($sql);

?>

<!doctype html>
<html lang="en">

<head>
    <title>Brand List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS -->
    <link rel="stylesheet" href="../all.css">

    <style>
        body {
            background: #ffffff;
        }
    </style>

</head>

<body>
    <div class="container">
        <!-- <?= $totalPage ?> -->
        <div class="py-2">
            <form action="brand-search.php">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="搜尋商家" name="brand_name">
                    </div>
                    <div class="col-auto"><button class="btn btn-warning" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        $brand_count = $result->num_rows;
        ?>
        <div class="py-2 d-flex justify-content-between align-items-center"><a href="brand-create.php" class="btn btn-warning"><i class="fa-solid fa-file-circle-plus"></i>新增</a>
            <div>
                共 <?= $totalBrand ?> 筆, 第 <?= $page ?> 頁
            </div>
        </div>
        <div class="py-2 d-flex justify-content-end">
            <div class="btn-group">
                <a href="brand-list.php?page=<?= $page ?>& type=1" class="btn btn-dark <?php if ($type == 1) echo "active"; ?>">ID<i class="fa-solid fa-arrow-down-short-wide"></i></a>
                <a href="brand-list.php?page=<?= $page ?>& type=2" class="btn btn-dark <?php if ($type == 2) echo "active"; ?>">ID<i class="fa-solid fa-arrow-down-wide-short"></i></a>
                <a href="brand-list.php?page=<?= $page ?>& type=3" class="btn btn-dark <?php if ($type == 3) echo "active"; ?>">NAME<i class="fa-solid fa-arrow-down-short-wide"></i></a>
                <a href="brand-list.php?page=<?= $page ?>& type=4" class="btn btn-dark <?php if ($type == 4) echo "active"; ?>">NAME<i class="fa-solid fa-arrow-down-wide-short"></i></a>
            </div>
        </div>
        <?php
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        // var_dump($rows);
        // exit;
        ?>
        <table class="table table-bordered">
            <thead>
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
                                    確認刪除"<?= $row["brand_name"]?>"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                    <a href="brand-doDelete.php?brand_id=<?= $row["brand_id"] ?>" class="btn btn-danger">確認</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <td><?= $row["brand_id"] ?></td>
                        <td>
                            <figure><img src="../brand_logo/<?= $row["brand_logo"] ?>" alt="" class="object-fit-cover"></figure>
                        </td>
                        <td><?= $row["brand_name"] ?></td>
                        <td><?= $row["brand_intro"] ?></td>
                        <td class="text-center py-2"><a href="brand.php?brand_id=<?= $row["brand_id"] ?>" class="btn btn-warning"><i class="fa-regular fa-eye"></i></a>
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
                "><a class="page-link" href="brand-list.php?page=<?= $i ?>&type=<?= $type ?>"><?= $i ?></a></li>
                <?php endfor; ?>

            </ul>
        </nav>
    </div>
    <!-- JS -->
    <?php include("../js.php") ?>
</body>

</html>