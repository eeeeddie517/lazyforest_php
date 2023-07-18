<?php
require_once("../db_connect.php");

$sql = "SELECT * FROM db WHERE valid=0";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
    <title>隱藏清單</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <div class="container p-5">

        <div class="py-2">
            <a href="../category_list-LIN.php" class="btn btn-info">返回列表</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>類別編號</th>
                    <th>類別名稱</th>
                    <th>編輯類別</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $hidden) : ?>
                    <!-- Modal-start -->
                    <div class="modal fade" id="cancelHiddenModal<?= $hidden["category_id"]  ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalLabel">訊息</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    確定取消隱藏?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                    <a href="cancelHidden-Ting.php?category_id=<?= $hidden["category_id"]  ?>" class="btn btn-danger">確定</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Moadal-end -->

                    <tr>
                        <td><?= $hidden["category_id"] ?></td>
                        <td><?= $hidden["category_name"] ?></td>
                        <td> <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#cancelHiddenModal<?= $hidden["category_id"]  ?>">取消隱藏</button></td>
                    </tr>
                <?php endforeach ?>
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