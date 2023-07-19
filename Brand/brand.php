<?php
session_start();
require_once("../db_connect.php");


if (!isset($_SESSION["admin"]) && !isset($_SESSION["camp"]) && !isset($_SESSION["brand"])) {
    header("location: 404.php");
}
if (!isset($_GET["brand_id"])) {
    // die("資料不存在");
    // header("location: /404.php");
}
$brand_id = $_GET["brand_id"];

// require_once("../db_connect.php");
$sql = "SELECT * FROM brand_info WHERE brand_id=$brand_id AND valid = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$original_brand_logo = $row["brand_logo"];
$original_brand_img = $row["brand_img"];
?>
<!doctype html>
<html lang="en">

<head>
    <title>森懶腰</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS -->
    <link rel="stylesheet" href="all.css">
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

        .hidden-info {
            display: none;
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
                <?php if (isset($_SESSION["admin"])) { ?>
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
                <?php } ?>
                <?php if (isset($_SESSION["brand"])) { ?>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="camp_home-LIN.php">
                            <i class="fa-solid fa-house-chimney fa-fw me-2"></i>
                            Dashboard
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
                <?php } ?>
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
                        <a href="brand-doDelete.php?brand_id=<?= $brand_id ?>" class="btn btn-danger">確認</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="py-2 d-flex justify-content-between">
                <a href="../brand-LIN.php" class="btn btn-warning"><i class="fa-regular fa-circle-left"></i>返回</a>
                <div class="me-3">
                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-regular fa-trash-can"></i></button>
                    <button class="btn btn-warning" id="editButton"><i class="fa-regular fa-pen-to-square"></i></button>
                </div>
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
                        <td>
                            <figure style="width: 200px"><img src="brand_logo/<?= $original_brand_logo ?>" alt="" class="object-fit-cover"></figure>
                        </td>
                    </tr>
                    <tr>
                        <th>品牌相關照片</th>
                        <td><?php if (!empty($row["brand_img"])) : ?>
                                <figure style="width: 400px">
                                    <img src="brand_img/<?= $original_brand_img ?>" alt="" class="object-fit-cover">
                                </figure>
                            <?php else : ?>
                                <i class="fa-regular fa-image"></i>尚未上傳圖片
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>

            </div>
            <div id="sidebar">
                <h2><?= $row["brand_name"] ?></h2>
                <form action="brand-doUpdate.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="brand_id" value="<?= $row["brand_id"] ?>">

                    <label for="brand_name">品牌名稱：</label>
                    <input class="form-control" type="text" name="brand_name" id="brand_name" value="<?= $row["brand_name"] ?>">
                    <br>

                    <label for="brand_intro">品牌介紹：</label>
                    <textarea class="form-control" name="brand_intro" id="brand_intro" style="height: 300px;"><?= $row["brand_intro"] ?></textarea>
                    <br>

                    <label for="brand_logo">品牌Logo圖片：</label>
                    <input class="form-control" type="file" name="brand_logo" id="brand_logo newLogo_input" data-preview="currentLogo">
                    <br>

                    <label for="brand_img">品牌相關圖片：</label>
                    <input class="form-control" type="file" name="brand_img" id="brand_img newImg_input" data-preview="currentImg">
                    <br>

                    <input type="hidden" name="original_brand_logo" value="<?php echo $original_brand_logo; ?>">
                    <input type="hidden" name="original_brand_img" value="<?php echo $original_brand_img; ?>">

                    <button class="btn btn-warning" type="submit">提交</button>
                </form>
                <div class="py-2">
                    <button id="closeButton" class="btn btn-danger">取消</button>
                </div>

            </div>


            <!-- JS -->
            <?php include("js.php") ?>

            <script>
                $(document).ready(function() {
                    $('#editButton').click(function() {
                        $('#sidebar').addClass('open');
                    });

                    $('#closeButton').click(function() {
                        $('#sidebar').removeClass('open');
                    });

                    // $('#submitButton').click(function() {
                    //     // console.log('click');
                    //     // 获取表单数据并提交到服务器
                    //     var formData = $('#editForm').serialize();
                    //     $.ajax({
                    //         url: 'brand-doUpdate.php', // 将数据提交到 update.php 处理
                    //         method: 'POST',
                    //         data: formData,
                    //         success: function(response) {
                    //             // 处理服务器返回的响应
                    //             alert(response);
                    //             $('#sidebar').removeClass('open');
                    //         }
                    //     });
                    // });
                });
            </script>
    </main>
    <!-- JS -->
    <?php include("js.php") ?>








    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>