<?php
if (!isset($_GET["brand_id"])) {
    // die("資料不存在");
    // header("location: /404.php");
}
$brand_id = $_GET["brand_id"];

require_once("../db-connect.php");
$sql = "SELECT brand_id, brand_name, brand_intro, brand_logo FROM brand_info WHERE valid = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


?>

<!doctype html>
<html lang="en">

<head>
    <title>Brand</title>
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
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="">警告</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        確認刪除?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <a href="brand_doDelete.php?brand_id=<?=$brand_id?>" class="btn btn-danger">確認</a>
      </div>
    </div>
  </div>
</div>
    <div class="container">
        <div class="py-2">
            <a href="brand-list.php" class="btn btn-warning">回商家列表</a>
        </div>
        <div class="row justify-content-center mt-4">
            <table class="table table-bordered">
                <tr>
                    <th class="col-2">ID</th>
                    <td><?= $row["brand_id"] ?></td>
                </tr>
                <tr>
                    <th>品牌名稱</th>
                    <td><?= $row["brand_name"] ?></td>
                </tr>
                <tr>
                    <th>品牌介紹</th>
                    <td><?= $row["brand_intro"] ?></td>
                </tr>
                <tr>
                    <th>品牌logo</th>
                    <td><figure style="width: fit-content;"><img src="../brand_logo/<?= $row["brand_logo"] ?>" alt="" class="object-fit-cover"></figure></td>
                </tr>
                <tr>
                    <th>品牌相關照片</th>
                    <td><?= $row["brand_img"] ?></td>
                </tr>
            </table>
            <div class="py-2 me-3">
            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">刪除</button>
                <button class="btn btn-warning" id="editButton">編輯</button>
            </div>
        </div>
        <div id="sidebar">
            <h2><?= $row["brand_name"] ?></h2>
            <form id="editForm">
                <label for="brand_name">品牌名稱：</label>
                            <input class="form-control" type="text" name="brand_name" id="brand_name">
                            <br>

                            <label for="brand_intro">品牌介紹：</label>
                            <textarea class="form-control" name="brand_intro" id="brand_intro" style="height: 300px;"></textarea>
                            <br>

                            <label for="brand_logo">品牌Logo圖片：</label>
                            <input class="form-control" type="file" name="brand_logo" id="brand_logo">
                            <br>

                            <label for="brand_img">品牌相關圖片：</label>
                            <input class="form-control" type="file" name="brand_img" id="brand_img">
                            <br>

                <button id="submitButton" class="btn btn-warning">提交</button>
            </form>
            <div class="py-2">
                <button id="closeButton" class="btn btn-danger">取消</button>
            </div>
            
        </div>


        <!-- JS -->
        <?php include("../js.php") ?>

        <script>
            $(document).ready(function() {
                $('#editButton').click(function() {
                    $('#sidebar').addClass('open');
                });

                $('#closeButton').click(function() {
                    $('#sidebar').removeClass('open');
                });

                $('#submitButton').click(function() {
                    // 获取表单数据并提交到服务器
                    var formData = $('#editForm').serialize();
                    $.ajax({
                        url: 'brand-doUpdate.php', // 将数据提交到 update.php 处理
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            // 处理服务器返回的响应
                            alert(response);
                            $('#sidebar').removeClass('open');
                        }
                    });
                });
            });
        </script>
</body>

</html>