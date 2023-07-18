<?php

if (isset($_GET["brand_name"])) {

    $brand_name = $_GET["brand_name"];
    require_once("../db_connect.php");

    $sql = "SELECT brand_id, brand_name, brand_intro, brand_logo FROM brand_info WHERE brand_name LIKE '%$brand_name%' AND valid = 1";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $brand_count = $result->num_rows;
} else {
    $brand_count = 0;
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Brand Search</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS -->
    <link rel="stylesheet" href="all.css">

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a href="../brand-LIN.php" class="btn btn-warning"><i class="fa-regular fa-circle-left"></i>返回
            </a>
        </div>
        <div class="py-2">
            <form action="brand-search.php">
                <div class="row gx-2">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="搜尋商家" name="brand_name">
                    </div>
                    <div class="col-auto"><button class="btn btn-warning" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="py-2 d-flex justify-content-between align-items-center">
            <?php if (isset($_GET["brand_name"])) : ?>
                <div>
                    搜尋 <?= $brand_name ?> 的結果，
                    共有 <?= $brand_count ?> 筆符合的資料
                </div>
            <?php endif; ?>
        </div>
        <?php if ($brand_count != 0) : ?>
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
                                        確認刪除"<?= $row["brand_name"] ?>"?
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
                                <figure><img src="brand_logo/<?= $row["brand_logo"] ?>" alt="" class="object-fit-cover"></figure>
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
        <?php endif; ?>
    </div>

      <!-- JS -->
      <?php include("js.php") ?>
</body>

</html>