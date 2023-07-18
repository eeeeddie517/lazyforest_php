<?php
session_start();
require_once("db_connect.php");


if (!isset($_SESSION["admin"]) && !isset($_SESSION["camp"]) && !isset($_SESSION["brand"])) {
    echo "請依正常管道登入";
}

$page = $_GET["page"] ?? 1;
$type = $_GET["type"] ?? 1;

// 排序方式
if ($type == 1) {
    $orderBy = "ORDER BY id ASC";
} elseif ($type == 2) {
    $orderBy = "ORDER BY id DESC";
} elseif ($type == 3) {
    $orderBy = "ORDER BY product_price ASC";
} elseif ($type == 4) {
    $orderBy = "ORDER BY product_price DESC";
} else {
    header("location: ../404.php");
}

$sqlTotal = "SELECT id FROM product_info WHERE valid = 1 $orderBy";

// 分頁
$perPage = 5;
$startItem = ($page - 1) * $perPage;

$sql = "SELECT * FROM product_info WHERE valid = 1 $orderBy LIMIT $startItem, $perPage";

// 獲取總品數
$resultTotal = $conn->query($sqlTotal);
$totalProduct = $resultTotal->num_rows;
$totalPage = ceil($totalProduct / $perPage);

// 獲取當前頁面的商品
$result = $conn->query($sql);
$ProductRows = $result->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <title>森懶腰</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            height: 2000px;
        }

        :root {
            --aside-width: 300px;
            --page-spacing-top: 56px;
        }

        .brand-name {
            width: var(--aside-width);
        }

        .main-aside {
            width: var(--aside-width);
            padding-top: calc(var(--page-spacing-top) + 10px);
        }

        .main-content {
            margin-left: var(--aside-width);
            padding-top: calc(var(--page-spacing-top) + 10px);
        }

        .product-edit {
            font-size: 30px;
        }

        table {
            width: 90%;
            margin: 0 auto;
        }

        table thead tr {
            border-bottom: 1px solid black;
        }

        table thead td {
            padding: 20px;
        }

        table tbody td {
            padding: 10px;
            text-align: center;
        }

        .sm-btn {
            width: 80%;
            margin: 20px;
        }

        .table-bordered td {
            text-align: center;
            margin: 0 auto;
        }

        /* .chart{
            height: 400px;
        } */
    </style>
</head>

<body>
    <header class="text-bg-dark d-flex shadow fixed-top justify-content-between align-items-center">
        <a class="bg-black py-3 px-3 text-decoration-none link-light brand-name" href="/">森懶腰 <i class="fa-solid fa-tree" style="color: #ffffff;"></i></a>
        <div class="d-flex align-items-center">
            <div class="me-3">
                Hi, 
                <?php
                if (isset($_SESSION["admin"])) {
                    echo $_SESSION["admin"]["name"];
                } elseif (isset($_SESSION["camp"])) {
                    echo $_SESSION["camp"]["camp_hostName"];
                } elseif (isset($_SESSION["brand"])) {
                    echo $_SESSION["brand"]["brand_hostName"];
                }
                ?>
            </div>
            <a href="logout.php" class="btn btn-dark me-3">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </div>
    </header>
    <aside class="main-aside position-fixed bg-light vh-100 border-end">
        <nav class="">
            <ul class="list-unstyled">
                <!-- if ($_SESSION['user']['name'] !== 'Joe'): 
                endif;  用session判斷哪些要讓user看到的寫法! -->
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="camp_home-LIN.php">
                        <i class="fa-solid fa-house-chimney fa-fw me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="camp_info-LIN.php">
                        <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                        營地資訊
                    </a>
                </li>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="camp_ground-LIN.php">
                        <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                        營位預定
                    </a>
                </li>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="category_list-LIN.php">
                        <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                        類別管理
                    </a>
                </li>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="member_list-LIN.php">
                        <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                        會員清單
                    </a>
                </li>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="brand-LIN.php">
                        <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                        品牌資訊
                    </a>
                </li>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="product_list-LIN.php">
                        <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                        商品資訊
                    </a>
                </li>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="camphost_list-LIN.php">
                        <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                        營主名單
                    </a>
                </li>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="brand_list-LIN.php">
                        <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                        品牌名單
                    </a>
                </li>
            </ul>
            <ul class="list-unstyled">
                <hr>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="">
                        <i class="fa-solid fa-gear fa-fw me-2"></i>
                        Setting
                    </a>
                </li>
                <li>
                    <a class="d-block py-2 px-3 text-decoration-none" href="">
                        <i class="fa-solid fa-door-closed fa-fw me-2"></i>
                        Sign out
                    </a>
                </li>
        </nav>

    </aside>
    <main class="main-content ">
        <div class="container">
            <div class="product-edit text-center pt-5 ">商品管理</div>
            <div class="sm-btn">
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    新增商品
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">新增商品</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- <div class="d-flex p-3 ">
                                <label for="">商品編號</label>
                                <input class="ms-3" type="text" id="product_id">
                            </div> -->
                                <!-- <div class="d-flex p-3">
                                <label for="">品牌名稱</label>
                                <input class="ms-3" type="text" id="brand_id">
                            </div> -->
                                <div class="d-flex p-3 justify-content-between align-items-center">
                                    <label for="">商品名稱</label>
                                    <input class="ms-4 form-control" type="text" id="product_name" style="width: 330px;">
                                </div>
                                <div class="d-flex p-3 justify-content-between">
                                    <label for="">商品介紹</label>
                                    <div class="form-floating">
                                        <textarea type="text" class="form-control" id="product_introduce" style="height: 150px; width: 330px;">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="d-flex p-3 justify-content-between align-items-center">
                                    <label for="">商品規格</label>
                                    <input class="ms-4 form-control" type="text" id="product_spec" style="width: 330px;">
                                </div>
                                <div class="d-flex p-3 justify-content-between align-items-center">
                                    <label for="">售價</label>
                                    <input class="ms-5 form-control" type="text" id="product_price" style="width: 330px;">
                                </div>
                                <div class="d-flex p-3 justify-content-between align-items-center">
                                    <label for="">數量</label>
                                    <input class="ms-5 form-control" type="text" id="product_amount" style="width: 330px;">
                                </div>
                                <div class="d-flex p-3 justify-content-between align-items-center">
                                    <label for="">商品編號</label>
                                    <input class="ms-3 form-control" type="text" id="product_serial" style="width: 330px;">
                                </div>
                                <div class="d-flex p-3 justify-content-between align-items-center">
                                    <label class="" for="">照片上傳</label>
                                    <input class="ms-3 form-control" style="width: 330px;" type="file" id="product_img" name="file">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="add-product" data-bs-dismiss="modal">新增商品</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-3 d-flex justify-content-end">
                <div class="btn-group">
                    <a href="product_list-LIN.php?page=<?= $page ?>&type=1" class="btn btn-dark <?php if ($type == 1) echo "active"; ?>">
                        id
                        <i class="fa-solid fa-sort-up"></i>
                    </a>
                    <a href="product_list-LIN.php?page=<?= $page ?>&type=2" class="btn btn-dark <?php if ($type == 2) echo "active"; ?>">
                        id
                        <i class="fa-solid fa-sort-down"></i>
                    </a>
                    <a href="product_list-LIN.php?page=<?= $page ?>&type=3" class="btn btn-dark <?php if ($type == 3) echo "active"; ?>">
                        價格
                        <i class="fa-solid fa-sort-up"></i>
                    </a>
                    <a href="product_list-LIN.php?page=<?= $page ?>&type=4" class="btn btn-dark <?php if ($type == 4) echo "active"; ?>">
                        價格
                        <i class="fa-solid fa-sort-down"></i>
                    </a>
                </div>
            </div>
            <!-- table -->
            <table class="table table-bordered justify-content-center">
                <thead class="table-dark w-100">
                    <tr>
                        <td>編號</td>
                        <!-- <td>品牌名稱</td> -->
                        <td>商品名稱</td>
                        <td>商品圖片</td>
                        <!-- <td>商品介紹</td> -->
                        <td>售價</td>
                        <td>庫存數量</td>
                        <td>最後修改時間</td>
                        <td>操作</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ProductRows as $products) : ?>
                        <tr>
                            <td id="product_id"><?= $products["id"] ?></td>
                            <!-- <td><?= $products["brand_id"] ?></td> -->
                            <td><?= $products["product_name"] ?></td>
                            <td style="width: 150px; height: 50px;">
                                <img class="object-fit-cover w-100" src="Product_Info/images-CH/<?= $products["product_img"] ?> " alt="">
                            </td>
                            <td><?= "NT$" . $products["product_price"] ?></td>
                            <td><?= $products["product_amount"] ?></td>
                            <td><?= $products["updated_at"] ?></td>
                            <td>
                                <a href="Product_Info/product-detail-CH.php?id=<?= $products["id"] ?>" class="btn btn-secondary">檢視</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_alert">刪除</button>
                                <div>
                                    <div class="modal" tabindex="-1" id="delete_alert">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">提醒</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>確定是否刪除</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                    <button type="button" class="btn btn-primary" id="delete_btn" data-bs-dismiss="modal">確定</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="py-2 ">
                共<?= $totalProduct ?> 件商品,第 <?= $page ?> 頁
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center p-5">
                    <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                        <li class="page-item <?php if ($i == $page) echo "active"; ?>">
                            <a class="page-link" href="product_list-LIN.php?page=<?= $i ?>&type=<?= $type ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </main>
    <script>
    
        // 新增
        let add_product = document.getElementById("add-product")
        let product_name = document.getElementById("product_name")
        let product_introduce = document.getElementById("product_introduce")
        let product_spec = document.getElementById("product_spec")
        let product_price = document.getElementById("product_price")
        let product_serial = document.getElementById("product_serial")
        let product_amount = document.getElementById("product_amount")
        let product_img = document.getElementById("product_img")

        add_product.addEventListener("click", function() {

            let formData = new FormData();
            formData.append("product_img", product_img.files[0]);
            formData.append("product_name", product_name.value);
            formData.append("product_introduce", product_introduce.value);
            formData.append("product_spec", product_spec.value);
            formData.append("product_price", product_price.value);
            formData.append("product_serial", product_serial.value);
            formData.append("product_amount", product_amount.value);


            $.ajax({
                method: "POST",
                // url: "/small-project/product-list-CH/add-product-CH.php",
                url: "http://localhost/lazyforest/Product_Info/add-product-CH.php",
                dataType: "json",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    alert("新增資料完成, 商品編號: " + response.id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("新增資料錯誤: " + errorThrown);
                }
            })
        })

        //刪除
        var delete_btn = document.getElementById("delete_btn");
        var product_id = document.getElementById("product_id").innerText;
 
        delete_btn.addEventListener("click", function() {
            
                    $.ajax({
                        method: "POST",
                        // url: "/small-project/product-list-CH/product-delete-CH.php",
                        url: "http://localhost/lazyforest/Product_Info/product-delete-CH.php",
                        dataType: "json",
                        data: {
                            id: product_id,
                            valid: "0",
                        },
                        success: function(data) {
                            if (data.success) {
                                
                                location.reload(true);
                            } else {
                            }
                        },
                })
            })

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous">
    </script>
   <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">

    </script>
</body>

</html>