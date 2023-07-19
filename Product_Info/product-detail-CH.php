<?php
require_once("../db_connect.php");

$id = $_GET["id"];
// $sql = "SELECT * FROM product_info WHERE valid = 1 AND product_info.id = $id";



$sql = "SELECT product_info.* ,db.category_name AS category_name FROM product_info JOIN db ON product_info.category_id = db.category_id WHERE product_info.valid=1 AND product_info.id = $id";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$sqlCategory="SELECT * FROM db";
$resultCategory=$conn->query($sqlCategory);
$Categories=$resultCategory->fetch_all(MYSQLI_ASSOC);



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
          <td style=" height: 100px;" class="selected_fields" id="imageInput">
            <div id="product_img"></div>
            <img class="object-fit-cover h-100" src="images-CH/<?= $row["product_img"] ?> " alt="Current Image">
          </td>
          <!-- <td>
            <input type="file" name="image" class="form-control" id="imageInput">
            <?php if (!empty($row["product_image"])) : ?>
              <div class="mt-2">
                <strong>目前圖片：</strong>
                <div id="currentImage">
                  <img src="../images-CH/<?= $row["product_img"] ?>" alt="Current Image" height="100">
                </div>
              </div>
            <?php endif; ?>
            <input type="hidden" name="current_image" value="<?= $row["product_image"] ?>">
          </td> -->
        </tr>
        <tr>
          <th>商品名稱</th>
          <td class="selected_fields" id="product_name"><?= $row["product_name"] ?></td>
        </tr>
        <tr>
          <th>商品類別</th>
          <td class="selected_fields" id="product_category"><?= $row["category_name"] ?></td>
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
      <button class="btn btn-success mx-3" id="save_product" type="button">儲存</button>
      <a href="../product_list-LIN.php" class="btn btn-dark mx-3">返回產品列表</a>
    </div>
  </div>

  <script>
    let edit_product = document.getElementById("edit_product")
    let save_product = document.getElementById("save_product")
    var product_name_orig = document.getElementById("product_name")
    var product_category_orig = document.getElementById("product_category")
    var product_introduce_orig = document.getElementById("product_introduce")
    var product_spec_orig = document.getElementById("product_spec")
    var product_price_orig = document.getElementById("product_price")
    var product_amount_orig = document.getElementById("product_amount")
    let product_img_orig = document.getElementById("product_img")

    // 抓到可以被修改的東東
    edit_product.addEventListener("click", function() {

      product_name_orig.innerHTML = `<input class="form-control" type="text" id="input_product_name" value="${product_name_orig.innerText}">`;
      
      product_category_orig.innerHTML = `<select id="input_product_category"  class="form-select"><?php foreach($Categories as $category): ?> <option value="<?= $category["category_id"] ?>"><?= $category["category_name"] ?> </option> <?php endforeach; ?> </select> `;


      product_introduce_orig.innerHTML = `<textarea class="form-control" type="text" id="input_product_introduce" rows="4">${product_introduce_orig.innerText}</textarea>`;
      product_spec_orig.innerHTML = `<input class="form-control" type="text" id="input_product_spec" value="${product_spec_orig.innerText}">`;
      product_price_orig.innerHTML = `<input class="form-control" type="text" id="input_product_price" value="${product_price_orig.innerText}">`;
      product_amount_orig.innerHTML = `<input class="form-control" type="text" id="input_product_amount" value="${product_amount_orig.innerText}">`;
      product_img_orig.innerHTML = `<input class="form-control" type="file" id="input_product_img" value="">`
    })

    // 預覽圖片
    // function previewImage() {
    //   var input = document.getElementById('imageInput');
    //   var preview = document.getElementById('imagePreview');
    //   var file = input.files[0];
    //   var reader = new FileReader();

    //   reader.onloadend = function() {
    //     var img = document.createElement('img');
    //     img.src = reader.result;
    //     img.classList.add('img-fluid');
    //     //img.style.maxWidth = '200px'; // 設定最大寬度
    //     img.style.maxHeight = '200px'; // 設定最大高度
    //     preview.innerHTML = '';
    //     preview.appendChild(img);
    //   }

    //   if (file) {
    //     reader.readAsDataURL(file);
    //   } else {
    //     preview.innerHTML = '';
    //   }
    // }
    // 取代目前圖片
    // function replaceproduct_img() {
    //   var input = document.getElementById('imageInput');
    //   var preview = document.getElementById('product_img');
    //   var file = input.files[0];
    //   var reader = new FileReader();

    //   reader.onloadend = function() {
    //     var img = document.createElement('img');
    //     img.src = reader.result;
    //     img.classList.add('img-fluid');
    //     //img.style.maxWidth = '200px'; // 設定最大寬度
    //     img.style.maxHeight = '100px'; // 設定最大高度
    //     preview.innerHTML = '';
    //     preview.appendChild(img);
    //   }

    //   if (file) {
    //     reader.readAsDataURL(file);
    //   } else {
    //     preview.innerHTML = '';
    //   }
    // }

    // document.getElementById('imageInput').addEventListener('change', replaceproduct_img);


    //存取
    save_product.addEventListener("click", function() {

      let input_product_name = document.getElementById("input_product_name")
      let input_product_category = document.getElementById("input_product_category")
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
      if (input_product_category.value === "") {
        input_product_category.value = product_category_orig.innerText;
        formData.append("input_product_category", input_product_category.value);
      } else {
        console.log(input_product_category.value);
        formData.append("input_product_category", input_product_category.value);
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

          location.reload(true); // 服務器強制重新加載當前頁面

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