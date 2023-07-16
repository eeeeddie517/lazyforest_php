<?php
require_once("../db_connect.php");
$sql = "SELECT * FROM db";

$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
$totalcategory = $result->num_rows;

$page = $_GET["page"] ?? 1;  //php 7.0新增的寫法
$type = $_GET["type"] ?? 1;
// $page = $_GET["page"];




$sqlTotal = "SELECT category_id FROM db WHERE valid=1";
$resultTotal = $conn->query($sqlTotal);
$totalCategory = $resultTotal->num_rows;

$perPage = 5;
$startItem = ($page - 1) * $perPage;
$totalPage = ceil($totalCategory / $perPage);

if ($type == 1) {
  $orderBy = "ORDER BY category_id ASC";
} elseif ($type == 2) {
  $orderBy = "ORDER BY category_id DESC";
} elseif ($type == 3) {
  $orderBy = "ORDER BY category_name ASC";
} elseif ($type == 4) {
  $orderBy = "ORDER BY category_name DESC";
} else {
  header("location: ../404.php");
}


// $sqlcategory = "SELECT * FROM db WHERE valid=1 $orderBy LIMIT $startItem, $perPage";
// $resultcategory = $conn->query($sqlcategory);
// $categoryRows = $resultcategory->fetch_all(MYSQLI_ASSOC);

// $sql = "SELECT * FROM db WHERE valid=1 $orderBy LIMIT $startItem,$perPage";

// $result = $conn->query($sql);




//計算總共頁數
$tatalPage = ceil($totalcategory / $perPage);
$sqlseq = "SELECT * FROM db WHERE valid=1 $orderBy LIMIT $startItem,$perPage";
$resultseq = $conn->query($sqlseq);
$resultseqrows = $resultseq->fetch_all(MYSQLI_ASSOC);
// var_dump($resultseqrows);


?>
<!doctype html>
<html lang="en">

<head>
  <title>category list</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    :root {
      --aside-width: 300px;
      --page-spacing-top: 56px
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

    /* .chart {
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
          <a href="doDelete-Ting.php?id=<?= $id ?>" class="btn btn-danger">確定</a>

        </div>
      </div>
    </div>
  </div>


  <header class="text-bg-dark d-flex shadow fixed-top justify-content-between align-items-center">
    <a class="bg-black py-3 px-3 text-decoration-none link-light brand-name" href="">Company Name</a>
    <div class="">
      <button class="btn btn-dark me-3"><i class="fa-solid fa-right-to-bracket"></i> Login</button>
      <button class="btn btn-dark me-3">Sign-up</button>
    </div>
  </header>
  <aside class="main-aside position-fixed bg-light vh-100 border-end">
    <nav>
      <ul class="list-unstyled">
        <li>
          <a class="d-block py-2 px-3 text-decoration-none" href=""><i class="fa-solid fa-house fa-fw me-2"></i>
            Dashedboard
          </a>
        </li>
        <li>
          <a class="d-block py-2 px-3  text-decoration-none" href=""><i class="fa-regular fa-folder me-2"></i>
            Orders
          </a>
        </li>
        <li>
          <a class="d-block py-2 px-3  text-decoration-none" href=""><i class="fa-solid fa-cart-shopping me-2"></i>
            Products
          </a>
        </li>
        <li>
          <a class="d-block py-2 px-3  text-decoration-none" href=""><i class="fa-solid fa-user-group me-2"></i>
            Customers
          </a>
        </li>
        <li>
          <a class="d-block py-2 px-3  text-decoration-none" href=""><i class="fa-solid fa-chart-line me-2"></i>
            Reports
          </a>
        </li>
        <li>
          <a class="d-block py-2 px-3  text-decoration-none" href=""><i class="fa-solid fa-chart-line me-2"></i>
            Intergrations
          </a>
        </li>
      </ul>
      <div class="mt-3 mb-2 d-flex justify-content-between text-secondary px-3">
        <div>
          SAVED REPORTS
        </div>
        <a href="" role="button"><i class="fa-solid fa-plus text-secondary"></i></a>
      </div>
      <ul class="list-unstyled">
        <li>
          <a class="d-block py-2 px-3 text-decoration-none" href=""><i class="fa-regular fa-file me-2"></i>
            current-month
          </a>
        </li>
        <li>
          <a class="d-block py-2 px-3 text-decoration-none" href=""><i class="fa-regular fa-file me-2"></i>
            last quarter
          </a>
        </li>
        <li>
          <a class="d-block py-2 px-3 text-decoration-none" href=""><i class="fa-regular fa-file me-2"></i>
            social engagement
          </a>
        </li>
        <li>
          <a class="d-block py-2 px-3 text-decoration-none" href=""><i class="fa-regular fa-file me-2"></i>
            year and sale
          </a>
        </li>
      </ul>
      <hr>
      <ul class="list-unstyled">
        <li>
          <a class="d-block py-2 px-3 text-decoration-none" href=""><i class="fa-solid fa-gear me-2"></i>
            setting
          </a>
        </li>
        <li>
          <a class="d-block py-2 px-3 text-decoration-none" href=""><i class="fa-solid fa-right-to-bracket me-2"></i>
            sign out
          </a>
        </li>
      </ul>
    </nav>
  </aside>
  <main class="main-content">
    <div class="px-3">

      <div class="d-flex justify-content-between align-items-center my-2">

        <form action="search-Ting.php">
          <div class="d-flex px-2">
            <input type="text" class="col-6 form-control" placeholder="搜尋類別" name="name">
            <button class="btn btn-info col-3 mx-1" type="submit">搜尋</button>
          </div>
        </form>

      </div>
      <div class="d-flex align-items-end justify-content-between">
        <a href="create-category-Ting.php" role="button" class="my-2 text-end btn btn-outline-secondary">新增類別</a>

        <div class="p-3 d-flex justify-content-end">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            排序
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="category-list-Ting.php?page=<?= $page ?>&type=1"><?php if ($type == 1) echo ""; ?>id <i class="fa-solid fa-arrow-down-short-wide"></i></a></li>

            <li><a class="dropdown-item" href="category-list-Ting.php?page=<?= $page ?>&type=2"><?php if ($type == 2) echo ""; ?>id <i class="fa-solid fa-arrow-down-wide-short"></i></a></li>
            <li><a class="dropdown-item" href="category-list-Ting.php?page=<?= $page ?>&type=3"> <?php if ($type == 3) echo ""; ?>類別 <i class="fa-solid fa-arrow-down-a-z"></i></a></li>
            <li><a class="dropdown-item" href="category-list-Ting.php?page=<?= $page ?>&type=4"><?php if ($type == 4) echo ""; ?>類別 <i class="fa-solid fa-arrow-down-z-a"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="chart">

        <table class="table table-bordered p-3">
          <thead>
            <tr>
              <th>category_id</th>
              <th>category_name</th>
              <th>Edit</th>
            </tr>
          </thead>
          <?php foreach ($resultseqrows as $name) : ?>
            <tbody>
              <tr>
                <td><?= $name["category_id"] ?></td>
                <td><?= $name["category_name"] ?></td>
                <td>
                  <a href="edit-category-Ting.php?id=<?= $name["category_id"] ?>" role="button" class="btn btn-success">編輯類別</a>
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">刪除類別</button>
                </td>

              </tr>
            </tbody>
          <?php endforeach ?>

        </table>
        <?php $resultCount = $resultTotal->num_rows ?>
        <div class="d-flex">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <?php for ($i = 1; $i <= $tatalPage; $i++) : ?>
                <li class="page-item <?php if ($i == $page) echo "active" ?>"><a class="page-link " href="category-list-Ting.php?page=<?= $i ?>&type=<?= $type ?>"><?= $i ?></a></li>
              <?php endfor; ?>
            </ul>
          </nav>
          <div class="text-end p-3">
            共有<?= $resultCount ?>筆資料
          </div>
        </div>
      </div>

    </div>
  </main>


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script>

  </script>
</body>

</html>