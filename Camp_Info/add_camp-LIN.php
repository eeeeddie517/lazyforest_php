<?php
session_start();
require_once("../db_connect.php");


if (!isset($_SESSION["admin"]) && !isset($_SESSION["camp"]) && !isset($_SESSION["brand"])) {
  header("location: 404.php");
}
?>
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
        <?php if (isset($_SESSION["camp"])) { ?>
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
  <div class="px-3">
    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
      <h1>營地資訊</h1>
    </div>
    <div class="container">
      <div class="py-2">
        <a class="btn btn-primary" href="../camp_info-LIN.php">回營地列表</a>
      </div>
      <form action="doCreate-LIN.php" method="post">
        <div class="mb-2">
          <label class="fw-bolder" for="">營地名稱</label>
          <input type="text" class="form-control" name="camp_name">
        </div>
        <div class="mb-2">
          <label class="fw-bolder" for="">營地地址</label>
          <input type="text" class="form-control" name="camp_address">
        </div>
        <div class="mb-2">
          <label class="fw-bolder" for="">營主電話</label>
          <input type="tel" class="form-control" name="camp_phone">
        </div>
        <div class="mb-2">
          <label class="fw-bolder" for="">海拔(公尺)</label>
          <input type="number" class="form-control" name="camp_altitude">
        </div>
        <div class="mb-2">
          <label class="fw-bolder" for="">營地介紹</label>
          <br>
          <textarea name="camp_introduce" id="" cols="50" rows="5"></textarea>
        </div>
        <div class="mb-2">
          <label class="fw-bolder" for="">營地注意事項</label>
          <br>
          <textarea name="camp_notice" id="" cols="50" rows="5"></textarea>
        </div>

        <button class="btn btn-primary my-2" type="submit">送出</button>
      </form>
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