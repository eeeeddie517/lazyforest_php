<?php
session_start();
require_once("../db_connect.php");


if (!isset($_SESSION["admin"]) && !isset($_SESSION["camp"]) && !isset($_SESSION["brand"])) {
    header("location: 404.php");
}
if (isset($_GET["camp_name"])) {
    $camp_name = $_GET["camp_name"];
    // require_once("../db_connect.php");
    if(isset($_SESSION["camp"])){
    $currentCampID = $_SESSION["camp"]["camphost_id"];
    $sql = "SELECT camp_id, camp_name, camp_address, camp_phone, camp_altitude FROM camp_info WHERE camp_name LIKE '%$camp_name%' AND valid=1 AND camp_host_id = '$currentCampID'";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $camp_count = $result->num_rows;
    }elseif(isset($_SESSION["admin"])){
    $sql = "SELECT camp_id, camp_name, camp_address, camp_phone, camp_altitude FROM camp_info WHERE camp_name LIKE '%$camp_name%' AND valid=1 ";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $camp_count = $result->num_rows;
    }
    
} else {
    $camp_count = 0;
}

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
            <a href="../logout.php" class="btn btn-dark me-3">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </div>
    </header>
    <aside class="main-aside position-fixed bg-light vh-100 border-end">
        <nav class="">
            <ul class="list-unstyled">
                <?php if (isset($_SESSION["admin"])) { ?>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../camp_home-LIN.php">
                            <i class="fa-solid fa-house-chimney fa-fw me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../camp_info-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            營地資訊
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../camp_ground-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            營位預定
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../category_list-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            類別管理
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../member_list-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            會員清單
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../brand-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            品牌資訊
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../product_list-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            商品資訊
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../camphost_list-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            營主名單
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../brand_list-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            品牌名單
                        </a>
                    </li>
                <?php } ?>
                <?php if (isset($_SESSION["camp"])) { ?>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../camp_home-LIN.php">
                            <i class="fa-solid fa-house-chimney fa-fw me-2"></i>
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../camp_info-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            營地資訊
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../camp_ground-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            營位預定
                        </a>
                    </li>
                <?php } ?>
                <?php if (isset($_SESSION["brand"])) { ?>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../camp_home-LIN.php">
                            <i class="fa-solid fa-house-chimney fa-fw me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../brand-LIN.php">
                            <i class="fa-solid fa-clipboard-list fa-fw me-2"></i></i>
                            品牌資訊
                        </a>
                    </li>
                    <li>
                        <a class="d-block py-2 px-3 text-decoration-none" href="../product_list-LIN.php">
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
    <div class="px-3">
            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                <h1>營地資訊</h1>
            </div>
        <div class="container">
            <div class="py-2">
                <a class="btn btn-primary" href="../camp_info-LIN.php">回營地列表</a>
            </div>
            <div class="py-2">
                <form action="search-LIN.php">
                    <div class="row gx-2">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="搜尋營地名稱" name="camp_name">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" type="submit">搜尋</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="py-2 d-flex justify-content-between align-items-center">
                <?php if (isset($_GET["camp_name"])) : ?>
                    <div>
                        搜尋 <?= $camp_name ?> 的結果，
                        共有 <?= $camp_count ?> 筆符合的資料
                    </div>
                <?php endif ?>
            </div>
            <?php if ($camp_count != 0) : ?>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>camp_id</th>
                            <th>營地名稱</th>
                            <th>營地地址</th>
                            <th>營主電話</th>
                            <th>海拔</th>
                            <th>詳細資訊</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td><?= $row["camp_id"] ?></td>
                                <td><?= $row["camp_name"] ?></td>
                                <td><?= $row["camp_address"] ?></td>
                                <td><?= $row["camp_phone"] ?></td>
                                <td><?= $row["camp_altitude"] ?> 公尺</td>
                                <td>
                                    <!-- <a class="btn btn-primary">顯示</a>
                                href="user.php?id=<?= $row["id"] ?>" -->
                                    <a class="btn btn-primary" href="camp-LIN.php?camp_id=<?= $row["camp_id"] ?>">顯示</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
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