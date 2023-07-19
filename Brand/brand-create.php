<?php
session_start();
require_once("../db_connect.php");


if (!isset($_SESSION["admin"]) && !isset($_SESSION["camp"]) && !isset($_SESSION["brand"])) {
    header("location: 404.php");
}
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
    <div class="container">
        <div class="py-4">
            <a href='javascript:window.history.back();' class="btn btn-warning"><i class="fa-regular fa-circle-left"></i>返回</a>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-6 mt-2">
                        <figure>
                            <img src="https://i.pinimg.com/564x/48/36/e6/4836e649af2a8e30a50f2e3c5d4d5bbf.jpg" alt="" class="img-fluid rounded-5">
                        </figure>
                    </div>
                    <div class="col-lg-6 mt-2">
                        <form action="brand-doCreate.php" method="POST" enctype="multipart/form-data">
                            <label for="brand_name">品牌名稱：</label>
                            <input class="form-control" type="text" name="brand_name" id="brand_name" required>
                            <br>

                            <label for="brand_intro">品牌介紹：</label>
                            <textarea class="form-control" name="brand_intro" id="brand_intro" style="height: 300px;" required></textarea>
                            <br>

                            <label for="brand_logo">品牌Logo圖片：</label>
                            <input class="form-control" type="file" name="brand_logo" id="brand_logo" required>
                            <br>

                            <label for="brand_img">品牌相關圖片：</label>
                            <input class="form-control" type="file" name="brand_img" id="brand_img">
                            <br>


                            <button class="btn btn-warning" type="submit">
                                提交
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
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