<?php
require_once("../db_connect.php");

if(isset($_GET["name"])){
    $name=$_GET["name"];
    $sql = "SELECT * FROM camp_list WHERE camp_hostName LIKE '%$name%' AND valid=1";
    $result=$conn->query($sql);
    $rows=$result->fetch_all(MYSQLI_ASSOC);
    $campCount=$result->num_rows;
}else{
    $campCount=0;
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Do Search</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <form action="do-search-Liao.php">
            <div class="row mt-3">
                <div class="col">
                    <input class="form-control" type="text" name="name" placeholder="搜尋營地主">
                </div>
                <div class="col-auto">
                    <button class="btn btn-dark" type="submit">搜尋</button>
                </div>
            </div>
        </form>
        <div class="mt-3 d-flex justify-content-between align-items-center">
            <a class="btn btn-dark mb-3" href="../camphost_list-Lin.php">回使用者列表</a>
            <h6>共 <?= $campCount ?> 筆 </h6>
        </div>
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
                    <?php foreach ($rows as $camp) : ?>
                    <tr>
                        <td><?= $camp["camp_id"] ?></td>
                        <td><?= $camp["camp_hostName"] ?></td>
                        <td><?= $camp["camp_email"] ?></td>
                        <td><?= $camp["camp_phone"] ?></td>
                        <td><a class="btn btn-primary" href="camp-detail-Liao.php?id=<?= $camp["camp_id"] ?>">顯示</a></td>

                    </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
    </div>








    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>