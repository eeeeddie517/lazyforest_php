<!doctype html>
<html lang="en">

<head>
  <title>Create Camp</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
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
</body>

</html>