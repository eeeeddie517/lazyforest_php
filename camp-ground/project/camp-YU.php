<?php
if (!isset($_GET["id"])) {
    // die("資料不存在");
    header("location: /404.php");
}
$id = $_GET["id"];

require_once("../db_connect_camp.php");
$sql = "SELECT * FROM camps WHERE id=$id ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// var_dump($row);


?>

<!doctype html>
<html lang="en">

<head>
    <title>Camp</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-info" href="camp-list.php">回使用者列表</a>
        </div>
        <table class="table table-bordered ">
            <tr>
                <th>分區</th>
                <td><?= $row["part"] ?></td>
            </tr>
            <tr>
                <th>數量</th>
                <td><?= $row["amount"] ?></td>
            </tr>
            <tr>
                <th>圖片</th>
                <td><?= $row["image"] ?></td>
            </tr>
            <tr>
                <th>價錢</th>
                <td><?= $row["price"] ?></td>
            </tr>
            <tr>
                <th>簡介</th>
                <td><?= $row["description"] ?></td>
            </tr>
            <tr>
                <th>更新時間</th>
                <td><?= $row["created_at"] ?></td>
            </tr>
        </table>
        <div class="py-2">
            <a class="btn btn-info" href="camp-edit.php?id=<?=$row["id"]?>">編輯</a>
        </div>
    </div>
</body>

</html>