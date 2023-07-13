<?php

require_once("../db_connect.php");

$page = $_GET["page"] ?? 1;
$type = $_GET["type"] ?? 1;

$sqlTotal = "SELECT id FROM camps WHERE valid=1";
$resultTotal = $conn->query($sqlTotal);
$totalCamps = $resultTotal->num_rows;

$perPage = 8;
$starItem = ($page - 1) * $perPage;
$totalPage = ceil($totalCamps / $perPage);

if ($type == 1) {
    $orderBy = "ORDER BY id ASC";
} elseif ($type == 2) {
    $orderBy = "ORDER BY id DESC";
} elseif ($type == 3) {
    $orderBy = "ORDER BY price ASC";
} elseif ($type == 4) {
    $orderBy = "ORDER BY price DESC";
} else {
    header("location:../404.php");
}


$sql = "SELECT * FROM camps WHERE valid=1 $orderBy LIMIT $starItem, $perPage";
$result = $conn->query($sql);
$campRows = $result->fetch_all(MYSQLI_ASSOC);

?>


<!doctype html>
<html lang="en">

<head>
    <title>camp-list</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <div class="container">

        <div class="py-2 d-flex justify-content-between align-items-center">
            <div>
                共 <?= $totalCamps ?>筆，第<?= $page ?>頁
            </div>
        </div>

        <div class="py-2 d-flex justify-content-end">
            <div class="dropdown">
                <a class="btn btn-info" href="create-camp.php">新增營地</a>
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    排序
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="camp-list.php?page=<?= $page ?>&type=1"><?php if ($type == 1) echo ""; ?>id <i class="fa-solid fa-arrow-down-short-wide"></i></a></li>

                    <li><a class="dropdown-item" href="camp-list.php?page=<?= $page ?>&type=2"><?php if ($type == 2) echo ""; ?>id <i class="fa-solid fa-arrow-down-wide-short"></i></a></li>
                    <li><a class="dropdown-item" href="camp-list.php?page=<?= $page ?>&type=3"> <?php if ($type == 3) echo ""; ?>價錢 <i class="fa-solid fa-arrow-down-a-z"></i></a></li>
                    <li><a class="dropdown-item" href="camp-list.php?page=<?= $page ?>&type=4"><?php if ($type == 4) echo ""; ?>價錢 <i class="fa-solid fa-arrow-down-z-a"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="row g-3  py-3">
            <?php foreach ($campRows as $camps) : ?>
                <div class="col-lg-3 col-md-6 ">
                    <div class="card">
                        <a href="camp.php?id=<?= $camps["id"] ?>">
                            <figure class="ratio ratio-1x1">
                                <img class="object-fit-cover card-img-top" src="../camp_img/<?= $camps["image"] ?>" alt="<?= $camps["name"] ?>">
                            </figure>
                        </a>

                        <div class="px-3 mb-3">
                            <h3 class="h4 "><?= $camp_info["name"] ?></a></h3>
                            <h3 class="h6 "><?= $camps["part"] ?></a></h3>
                            <div class="price text-end h5 text-success">$<?= $camps["price"] ?></div>
                            <div class="d-grid py-2">
                                <a href="camp.php?id=<?= $camps['id'] ?>" class="btn btn-secondary">更新資料</data-id=></a>
                            </div>
                            <div class="d-grid">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                    <li class="page-item 
                    <?php if ($i == $page) echo "active"; ?>">
                        <a class="page-link" href="camp-list.php?page=<?= $i ?>&type=<?= $type ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <script>
            let camps = <?= json_encode($rows) ?>;
            console.log(camps);
        </script>


        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>

</body>

</html>