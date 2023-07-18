<?php
$id = $_GET["id"];
require_once("../db_connect.php");
$sql = "SELECT * FROM brand WHERE brand_id=$id AND valid=1";
$result = $conn->query($sql);
$brand = $result->fetch_assoc();

?>

<!doctype html>
<html lang="en">

<head>
    <title>Brand Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <form action="do-edit-Liao.php" method="post">
            <table class="table table-bordered mt-4">
                <input name="id" type="hidden" value="<?= $brand["brand_id"] ?>">
                <tr>
                    <th>id</th>
                    <td> <?= $brand["brand_id"] ?> </td>
                </tr>
                <tr>
                    <th>品牌聯絡人</th>
                    <td><input name="name" type="text" class="form-control" value="<?= $brand["brand_hostName"] ?>"></td>
                </tr>
                <tr>
                    <th>聯絡信箱</th>
                    <td><input name="account" type="email" class="form-control" value="<?= $brand["brand_email"] ?>"></td>
                </tr>
                <tr>
                    <th>聯絡地址</th>
                    <td><input name="address" type="text" class="form-control" value="<?= $brand["brand_address"] ?>"></td>
                </tr>
                <tr>
                    <th>聯絡電話</th>
                    <td><input name="phone" type="phone" class="form-control" value="<?= $brand["brand_phone"] ?>"></td>
                </tr>
                <tr>
                    <th>統一編號</th>
                    <td><input name="vat" type="text" class="form-control" value="<?= $brand["brand_vat"] ?>"></td>
                </tr>
                <tr>
                    <th>創建時間</th>
                    <td><?= $brand["created_at"] ?></td>
                </tr>
                <tr>
                    <th>更新時間</th>
                    <td><?= $brand["update_at"] ?></td>
                </tr>
            </table>

            <!-- 編輯＆刪除按鈕 -->
            <div class="btn-group">
                <button type="submit" class="btn btn-dark">儲存</button>
                <a href="brand-detail-Liao.php?id=<?= $brand["brand_id"] ?>" class="btn btn-light">取消</a>
            </div>

        </form>
    </div>







    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>