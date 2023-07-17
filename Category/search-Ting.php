<?php

//搜尋
$name = $_GET["name"];
if (isset($_GET["name"])) {
    $name = $_GET["name"];
    require_once("./db_connect_camp-YU.php");
    $sql = "SELECT category_id,category_name FROM db WHERE category_name LIKE '%$name%'AND valid=1 ";  //LIKE '%To%' 可用來篩選符合條件的字串(有To的)

    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $user_count = $result->num_rows;
} else {
    $user_count = 0;
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
    <main class="main-content container ">
        <div class="px-3">

            <div class="d-flex justify-content-between align-items-center my-2">
                <div class="d-flex px-2">
                    <a class="btn btn-info" href="../category_list-LIN.php">返回列表</a>
                </div>

            </div>
            <div class="d-flex align-items-end justify-content-between">
                <a href="create-category-Ting.php" role="button" class="my-2 text-end btn btn-outline-secondary">新增類別</a>

            </div>
            <div class="chart">
                <?php $resultCount = $result->num_rows ?>
                <?php if (isset($_GET["name"])) : ?>
                    <div>
                        搜尋<?= $name ?>的結果,
                        共有 <?= $resultCount ?> 筆符合的資料
                    </div>
                <?php endif ?>
                <?php if (isset($_GET["name"])) : ?>

                    <table class="table table-bordered p-3">
                        <!-- <thead>
                            <tr>
                                <th>category_id</th>
                                <th>category_name</th>
                                <th>Edit</th>
                            </tr>
                        </thead> -->
                        <?php foreach ($rows as $name) : ?>
                            <tbody>
                                <tr>
                                    <td><?= $name["category_id"] ?></td>
                                    <td><?= $name["category_name"] ?></td>
                                    <td>
                                        <a href="edit-category-Ting.php?id=<?= $name["category_id"] ?>" role="button" class="btn btn-success">編輯類別</a>
                                        <button class="btn btn-danger">刪除類別</button>
                                    </td>

                                </tr>
                            </tbody>
                        <?php endforeach ?>

                    </table>
                <?php endif ?>
            </div>

        </div>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>