<?php
if (!isset($_GET["camp_id"])) {
    // die("資料不存在");
    header("location: ../404.php");
}
$camp_id = $_GET["camp_id"];

require_once("./db_connect_camp-YU.php");

$sql = "SELECT * FROM camp_info WHERE camp_id=$camp_id AND  valid=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// var_dump($row);


// $sqllike=
// "SELECT user_like.*, product.name AS product_name
//  FROM user_like 
//  JOIN product ON product.id = user_like.product_id
//  WHERE user_like.user_id = $id
// ";
// $resultLike = $conn->query($sqllike);
// $rowsLike = $resultLike->fetch_all(MYSQLI_ASSOC);

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
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">訊息</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確認刪除?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a href="doDelete-LIN.php?camp_id=<?= $camp_id ?>" class="btn btn-danger">確認</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-primary" href="../camp_info-LIN.php">回營地列表</a>
        </div>
        <table class="table table-bordered ">
            <tr>
                <th class="text-nowrap">營地名稱</th>
                <td><?= $row["camp_name"] ?></td>
            </tr>
            <tr>
                <th>營地地址</th>
                <td><?= $row["camp_address"] ?></td>
            </tr>
            <tr>
                <th>營主電話</th>
                <td><?= $row["camp_phone"] ?></td>
            </tr>
            <tr>
                <th>海拔</th>
                <td><?= $row["camp_altitude"] ?></td>
            </tr>
            <tr>
                <th>營區介紹</th>
                <td><?= $row["camp_introduce"] ?></td>
            </tr>
            <tr>
                <th>注意事項</th>
                <td><?= $row["camp_notice"] ?></td>
            </tr>
        </table>
        <div class="py-2">
            <a class="btn btn-primary" href="camp-edit-LIN.php?camp_id=<?= $row["camp_id"] ?>">編輯</a>
            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">下架</button>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>