<!doctype html>
<html lang="en">

<head>
    <title>Create Camp</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-info" href="camp_ground-LIN.php">回使用者列表</a>
        </div>
        <form action="doCreate.php" method="post">
            <div class="mb-2">
                <label for="">camp_id</label>
                <input type="text" class="form-control" name="camp_id">
            </div>
            <div class="mb-2">
                <label for="">分區</label>
                <input type="text" class="form-control" name="part">
            </div>
            <div class="mb-2">
                <label for="">帳數</label>
                <input type="text" class="form-control" name="amount">
            </div>
            <div class="mb-2">

                <label for="">選取圖片</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="mb-2">
                <label for="">價錢</label>
                <input type="text" class="form-control" name="price">
            </div>
            <div class="mb-2">
                <label for="">簡介</label>
                <input type="text" class="form-control" name="description">
            </div>
            <button class="btn btn-info" type="submit">送出</button>
        </form>
    </div>
</body>

</html>