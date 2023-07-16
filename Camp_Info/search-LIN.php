<?php
if (isset($_GET["camp_name"])) {
    $camp_name = $_GET["camp_name"];
    require_once("../db_connect.php");

    $sql = "SELECT camp_id, camp_name, camp_address, camp_phone, camp_altitude FROM camp_info WHERE camp_name LIKE '%$camp_name%' AND valid=1 ";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $camp_count = $result->num_rows;
} else {
    $camp_count = 0;
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Search</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-primary" href="../camp_info-LIN.php">回營地列表</a>
        </div>
        <div class="py-2">
            <form action="search-LIN.php">
                <div class="row gx-2">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="搜尋營地名稱" name="camp_name">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" type="submit">搜尋</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="py-2 d-flex justify-content-between align-items-center">
            <?php if (isset($_GET["camp_name"])) : ?>
                <div>
                    搜尋 <?= $camp_name ?> 的結果，
                    共有 <?= $camp_count ?> 筆符合的資料
                </div>
            <?php endif ?>
        </div>
        <?php if ($camp_count != 0) : ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>camp_id</th>
                        <th>營地名稱</th>
                        <th>營地地址</th>
                        <th>營主電話</th>
                        <th>海拔</th>
                        <th>詳細資訊</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row["camp_id"] ?></td>
                            <td><?= $row["camp_name"] ?></td>
                            <td><?= $row["camp_address"] ?></td>
                            <td><?= $row["camp_phone"] ?></td>
                            <td><?= $row["camp_altitude"] ?> 公尺</td>
                            <td>
                                <!-- <a class="btn btn-primary">顯示</a>
                                href="user.php?id=<?= $row["id"] ?>" -->
                                <a class="btn btn-primary" href="camp-LIN.php?camp_id=<?= $row["camp_id"] ?>">顯示</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>
</body>

</html>