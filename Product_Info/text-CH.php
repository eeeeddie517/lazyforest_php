<div class="d-flex p-3 justify-content-between align-items-center">
  <label class="" for="">照片上傳</label>
  <input class="ms-3 form-control" style="width: 330px;" type="file" id="product_img">
</div>
<button type="submit" class="btn btn-primary" id="add-product" data-bs-dismiss="modal">新增商品</button>


<script>

  let product_img = document.getElementById("product_img")
  add_product.addEventListener("click", function() {

    $.ajax({
      method: "POST",
      url: "/laztforest/Product_Info/add-product-CH.php",
      dataType: "json",
      data: {
        product_img: product_img.value,
      },
      success: function(response) {
        alert("新增資料完成, 商品編號: " + response);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error("新增資料錯誤: " + errorThrown);
        // 在这里处理错误情况
      }
    })
  })
</script>