<?php

if (!isset($_GET["id"])) {
    // die("資料不存在");
    header("location: /404.php");
}
$id = $_GET["id"];

require_once("../Camp_Ground/db_connect_camp-YU.php");
$sql = "SELECT * FROM camps WHERE id=$id AND valid=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
// var_dump($row);

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
                Hi, <?= $_SESSION["user"]["name"] ?>
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
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">訊息</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確認刪除？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a href="doDelete-YU.php?id=<?= $id ?>" class="btn btn-danger">確認</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-3">
        <form action="doUpdate-YU.php" method="post" enctype="multipart/form-data">
            <table class="table table-bordered">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <tr>
                    <th>分區</th>
                    <td> <input type="text" class="form-control" value="<?= $row["part"] ?>" name="part"></td>
                </tr>
                <tr>
                    <th>數量</th>
                    <td><input type="text" class="form-control" value="<?= $row["amount"] ?>" name="amount"></td>
                </tr>
                <tr>
                    <th>圖片</th>
                    <td>
                        <input type="file" name="image" class="form-control" id="imageInput">
                        <?php if (!empty($row["image"])) : ?>
                            <div class="mt-2">
                                <strong>目前圖片：</strong>
                                <div id="currentImage">
                                    <img src="camp_img/<?= $row["image"] ?>" alt="Current Image" width="200">
                                </div>
                            </div>
                        <?php endif; ?>
                        <input type="hidden" name="current_image" value="<?= $row["image"] ?>">
                        <div class="mt-2" id="imagePreview"></div>
                    </td>
                </tr>
                <tr>
                    <th>價錢</th>
                    <td><input type="text" class="form-control" value="<?= $row["price"] ?>" name="price"></td>
                </tr>
                <tr>
                    <th>簡介</th>
                    <td><input type="text" class="form-control " value="<?= $row["description"] ?>" name="description"></td>
                </tr>
            </table>
            <div class="py-2 d-flex justify-content-between">
                <div>
                    <button class="btn btn-success" type="submit">儲存</button>
                    <a class="btn btn-secondary" href="camp-YU.php?id=<?= $row["id"] ?>">取消</a>
                </div>
                <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">刪除</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        // 預覽圖片
        function previewImage() {
            var input = document.getElementById('imageInput');
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                var img = document.createElement('img');
                img.src = reader.result;
                img.classList.add('img-fluid');
                img.style.maxWidth = '200px'; // 設定最大寬度
                img.style.maxHeight = '200px'; // 設定最大高度
                preview.innerHTML = '';
                preview.appendChild(img);
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
            }
        }

        // 取代目前圖片
        function replaceCurrentImage() {
            var input = document.getElementById('imageInput');
            var preview = document.getElementById('currentImage');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                var img = document.createElement('img');
                img.src = reader.result;
                img.classList.add('img-fluid');
                img.style.maxWidth = '200px'; // 設定最大寬度
                img.style.maxHeight = '200px'; // 設定最大高度
                preview.innerHTML = '';
                preview.appendChild(img);
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
            }
        }

        document.getElementById('imageInput').addEventListener('change', replaceCurrentImage);
    </script>
    </main>




    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>