<?php
require_once("../db_connect.php");

if(isset($_GET["name"])){
    $name = $_GET["name"];
    $sql = "SELECT * FROM product_info WHERE product_name LIKE '%$name%' AND valid = 1";
    $result = $conn -> query($sql);
    $rows = $result ->fetch_all(MYSQLI_ASSOC);
    $productCount = $result -> num_rows;
}else{
    $productCount = 0;
}

// var_dump($rows);

?>
<!doctype html>
<html lang="en">

<head>
  <title>Search</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        .object-fit-cover{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

</head>

<body>
    <div class="container">
    <form action="do-search-CH.php">
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="text" name="name" placeholder="搜尋商品">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-dark" type="submit">搜尋</button>
                    </div>
                </div>
            </form>
            <div class="py-2 ">
                <a class="btn btn-secondary" href="../product_list-LIN.php">回使用者列表</a>
                <h6> 共<?=$productCount?> 件商品 </h6> 
            </div>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>編號</th>
                        <th>商品名稱</th>
                        <th>商品圖片</th>
                        <th>售價</th>
                        <th>庫存數量</th>
                        <th>詳細資訊</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $product) :?>
                        <tr>
                            <td><?=$product["id"]?></td>
                            <td><?=$product["product_name"]?></td>
                            <td style="width: 150px; height: 150px;"> <img class="object-fit-cover w-100" src="images-CH/<?=$product["product_img"]?>" alt="">
                                </td>
                            <td><?=$product["product_price"]?></td>
                            <td><?=$product["product_amount"]?></td>
                            <td><a href="product-detail-CH.php?id=<?= $product["id"] ?>" class="btn btn-secondary">檢視</a></td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
    </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>