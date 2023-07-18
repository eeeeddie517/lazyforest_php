<?php
require_once("../db_connect.php");

$id = $_GET["id"];
$sql = "SELECT * FROM product_info WHERE valid = 1 AND product_info.id = $id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<!doctype html>
<html lang="en">

<head>
  <title>Product Detail</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <style>
    .table-bordered {
      width: 500px;
      margin: 0 auto;
    }

    .table-bordered tr {
      text-align: center;
    }

    .table-bordered td {
      width: 350px;
    }
  </style>
</head>

<body>

  <div class="container">
    <table class="table table-bordered my-5 w-50">
      <tbody>
        <tr>
          <th>商品編號</th>
          <td><?= $row["id"] ?></td>
        </tr>
        <tr>
          <th>圖片</th>
          <td style=" height: 100px;" class="selected_fields">
            <div id="product_img"></div>
            <img class="object-fit-cover h-100" src="images-CH/<?= $row["product_img"] ?> " alt="">
          </td>
        </tr>
        <tr>
          <th>商品名稱</th>
          <td class="selected_fields" id="product_name"><?= $row["product_name"] ?></td>
        </tr>
        <tr>
          <th>商品介紹</th>
          <td class="selected_fields" id="product_introduce"><?= $row["product_introduce"] ?></td>
        </tr>
        <tr>
          <th>商品規格</th>
          <td class="selected_fields" id="product_spec"><?= $row["product_spec"] ?></td>
        </tr>
        <tr>
          <th>售價</th>
          <td class="selected_fields" id="product_price"><?= $row["product_price"] ?></td>
        </tr>
        <tr>
          <th>庫存</th>
          <td class="selected_fields" id="product_amount"><?= $row["product_amount"] ?></td>
        </tr>
        <tr>
          <th>商品編號</th>
          <td><?= $row["product_serial"] ?></td>
        </tr>
        <tr>
          <th>新增時間</th>
          <td><?= $row["created_at"] ?></td>
        </tr>
        <tr>
          <th>最後修改時間</th>
          <td><?= $row["updated_at"] ?></td>
        </tr>
      </tbody>
    </table>
    <div class="d-flex justify-content-center mb-5">
      <button class="btn btn-secondary mx-3" id="edit_product">編輯商品</button>
      <button class="btn btn-success mx-3" id="save_product">儲存</button>
      <a href="../product_list-LIN.php" class="btn btn-dark mx-3">返回產品列表</a>
    </div>
  </div>

  <script>
    let edit_product = document.getElementById("edit_product")
    let save_product = document.getElementById("save_product")
    var product_name_orig = document.getElementById("product_name")
    var product_introduce_orig = document.getElementById("product_introduce")
    var product_spec_orig = document.getElementById("product_spec")
    var product_price_orig = document.getElementById("product_price")
    var product_amount_orig = document.getElementById("product_amount")
    let product_img_orig = document.getElementById("product_img")

    // 抓到可以被修改的東東
    edit_product.addEventListener("click", function() {

      product_name_orig.innerHTML = `<input placeholder="${product_name_orig.innerText}" class="form-control" type="text" id="input_product_name" value="">`;
      product_introduce_orig.innerHTML = `<textarea class="form-control" type="text" id="input_product_introduce" rows="4"></textarea>`;
      product_spec_orig.innerHTML = `<input placeholder="${product_spec_orig.innerText}" class="form-control" type="text" id="input_product_spec" value="">`;
      product_price_orig.innerHTML = `<input placeholder="${product_price_orig.innerText}" class="form-control" type="text" id="input_product_price" value="">`;
      product_amount_orig.innerHTML = `<input placeholder="${product_amount_orig.innerText}" class="form-control" type="text" id="input_product_amount" value="">`;
      product_img_orig.innerHTML = `<input class="form-control" type="file" id="input_product_img" value="">`
    })

    //存取
    save_product.addEventListener("click", function() {

      let input_product_name = document.getElementById("input_product_name")
      let input_product_introduce = document.getElementById("input_product_introduce")
      let input_product_img = document.getElementById("input_product_img")
      let input_product_spec = document.getElementById("input_product_spec")
      let input_product_price = document.getElementById("input_product_price")
      let input_product_amount = document.getElementById("input_product_amount")

      let formData = new FormData();
      formData.append("input_product_img", input_product_img.files[0]);

      if (input_product_name.value === "") {
        input_product_name.value = product_name_orig.innerText;
        formData.append("input_product_name", input_product_name.value);
      } else {
        formData.append("input_product_name", input_product_name.value);
      }

      if (input_product_introduce.value === "") {
        input_product_introduce.value = product_introduce_orig.innerText;
        formData.append("input_product_introduce", input_product_introduce.value);
      } else {
        formData.append("input_product_introduce", input_product_introduce.value);
      }

      if (input_product_spec.value === "") {
        input_product_spec.value = product_spec_orig.innerText;
        formData.append("input_product_spec", input_product_spec.value);
      } else {
        formData.append("input_product_spec", input_product_spec.value);
      }

      if (input_product_price.value === "") {
        input_product_price.value = product_price_orig.innerText;
        formData.append("input_product_price", input_product_price.value);
      } else {
        formData.append("input_product_price", input_product_price.value);
      }

      if (input_product_amount.value === "") {
        input_product_amount.value = product_amount_orig.innerText;
        formData.append("input_product_amount", input_product_amount.value);
      } else {
        formData.append("input_product_amount", input_product_amount.value);
      }

      formData.append("id", <?= $id ?>);

      $.ajax({
        method: "POST",
        url: "http://localhost/lazyforest/Product_Info/update-product-CH.php",
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          console.log(response)
          alert("修改資料完成, 商品編號: " + response.id);

          location.reload(true); // 從服務器強制重新加載當前頁面

        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error("修改資料錯誤: " + errorThrown);
        }

      })

    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">

  </script>
</body>

</html>