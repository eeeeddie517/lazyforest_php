<?php
session_start();

require_once("../db_connect.php");

$id = $_GET["id"];
$sql = "SELECT * FROM db ";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

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
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">訊息</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確定刪除?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <?php foreach ($resultseq as $name) : ?>
                        <?php $id = $name["category_id"]; ?>
                    <?php endforeach ?>
                    <a href="Category/doDelete-Ting.php?id=<?= $id ?>" class="btn btn-danger">確定</a>

                </div>
            </div>
        </div>
    </div>
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

            <table class="table table-bordered p-3">
                <thead>
                    <tr>
                        <th>類別編號</th>
                        <th>類別名稱</th>
                        <th>編輯類別</th>
                    </tr>
                </thead>
                <?php foreach ($rows as $name) : ?>

                    <tbody>
                        <tr>
                            <?php if ($name["category_id"] == $id) : ?>
                                <form action="doEdit-Ting.php" method="post">
                                    <input type="hidden" name="id" value="<?= $name["category_id"] ?>">
                                    <td><?= $name["category_id"] ?></td>
                                    <td><input type="text" class="form-control" value="<?= $name["category_name"] ?>" name="updateName"></td>
                                    <td>
                                        <button class="btn btn-success" type="submit">確認編輯</button>
                                        <a href="../category_list-LIN.php" class="btn btn-danger">取消變更</a>
                                    </td>
                                </form>
                            <?php else : ?>
                                <td><?= $name["category_id"] ?></td>
                                <td><?= $name["category_name"] ?></td>
                                <td>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </tbody>

                <?php endforeach ?>

            </table>
        </div>
    </main>









    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>