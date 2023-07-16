<?php

if (isset($_GET["brand_name"])) {

    $brand_name = $_GET["brand_name"];
    require_once("../db-connect.php");

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
    <link rel="stylesheet" href="../all.css">

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a href="brand-list.php" class="btn btn-warning">回商家列表</a>
        </div>
        <div class="py-2">
            <form action="brand-search.php">
                <div class="row gx-2">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="搜尋商家" name="brand_name">
                    </div>
                    <div class="col-auto"><button class="btn btn-warning" type="submit">搜尋</button>
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
                        <th>id</th>
                        <th>Logo</th>
                        <th>name</th>
                        <th>商家介紹</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row["brand_id"] ?></td>
                            <td><?= $row["brand_logo"] ?></td>
                            <td><?= $row["brand_name"] ?></td>
                            <td><?= $row["brand_intro"] ?></td>
                            <td><a href="brand.php? id=<?= $row["brand_id"] ?>" class="btn btn-warning">顯示</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>