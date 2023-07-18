<!doctype html>
<html lang="en">

<head>
    <title>Brand Create</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.3.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS -->
    <link rel="stylesheet" href="all.css">

</head>

<body>
    <div class="container">
        <div class="py-4">
            <a href='javascript:window.history.back();' class="btn btn-warning"><i class="fa-regular fa-circle-left"></i>返回</a>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-6 mt-2">
                        <figure>
                            <img src="https://i.pinimg.com/564x/48/36/e6/4836e649af2a8e30a50f2e3c5d4d5bbf.jpg" alt="" class="img-fluid rounded-5">
                        </figure>
                    </div>
                    <div class="col-lg-6 mt-2">
                        <form action="brand-doCreate.php" method="POST" enctype="multipart/form-data">
                            <label for="brand_name">品牌名稱：</label>
                            <input class="form-control" type="text" name="brand_name" id="brand_name" required>
                            <br>

                            <label for="brand_intro">品牌介紹：</label>
                            <textarea class="form-control" name="brand_intro" id="brand_intro" style="height: 300px;" required></textarea>
                            <br>

                            <label for="brand_logo">品牌Logo圖片：</label>
                            <input class="form-control" type="file" name="brand_logo" id="brand_logo" required>
                            <br>

                            <label for="brand_img">品牌相關圖片：</label>
                            <input class="form-control" type="file" name="brand_img" id="brand_img">
                            <br>


                            <button class="btn btn-warning" type="submit">
                                提交
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- JS -->
        <?php include("js.php") ?>
</body>

</html>