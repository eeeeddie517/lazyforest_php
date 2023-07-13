<?php
if (!isset($_GET["id"])) {
    // die("資料不存在");
    header("location: /404.php");
}
$id = $_GET["id"];

require_once("../db_connect_camp.php");
$sql = "SELECT * FROM camps WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// var_dump($row);

?>

<!doctype html>
<html lang="en">

<head>
    <title>camp edit</title>
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
                    確認刪除？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a href="doDelete.php?id=<?= $id ?>" class="btn btn-danger">確認</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-3">
        <form action="doUpdate.php" method="post">
            <table class="table table-bordered">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <tr>
                    <th>分區</th>
                    <td> <input type="text" class="form-control" value="<?= $row["part"] ?>" name="part"></td>
                </tr>
                <tr>
                    <th>數量</th>
                    <td><input type="text" class="form-control" value="<?= $row["amount"] ?>" name="amount"></td>
                </tr>
                <tr>
                    <th>圖片</th>
                    <td><input type="file" name="image" class="form-control" required></td>
                </tr>
                <tr>
                    <th>價錢</th>
                    <td><input type="text" class="form-control" value="<?= $row["price"] ?>" name="price"></td>
                </tr>
                <tr>
                    <th>簡介</th>
                    <td><input type="text" class="form-control " value="<?= $row["description"] ?>" name="description"></td>
                </tr>
            </table>
            <div class="py-2 d-flex justify-content-between">
                <div>
                    <button class="btn btn-info" type="submit">儲存</button>
                    <a class="btn btn-info" href="camp.php?id=<?= $row["id"] ?>">取消</a>
                </div>
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">刪除</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>

    </script>
</body>

</html>