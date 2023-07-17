<?php
if (!isset($_GET["camp_id"])) {
    // die("資料不存在");
    header("location: ../404.php");
}
$camp_id = $_GET["camp_id"];

require_once("./Camp_Ground/db_connect_camp-YU.php");

$sql = "SELECT * FROM camp_info WHERE camp_id=$camp_id AND valid=1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Camp Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <form action="doUpdate-LIN.php" method="post">
            <table class="table table-bordered ">
                <input type="hidden" name="camp_id" value="<?= $row["camp_id"] ?>">
                <tr>
                    <th>營地名稱</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["camp_name"] ?>" name="camp_name">
                    </td>
                </tr>
                <tr>
                    <th>營地地址</th>
                    <td>
                        <input type="text" class="form-control" value="<?= $row["camp_address"] ?>" name="camp_address">
                    </td>
                </tr>
                <tr>
                    <th>營主電話</th>
                    <td>
                        <input type="tel" class="form-control" value="<?= $row["camp_phone"] ?>" name="camp_phone">
                    </td>
                </tr>
                <tr>
                    <th>海拔</th>
                    <td>
                        <input type="number" class="form-control" value="<?= $row["camp_altitude"] ?>" name="camp_altitude">
                    </td>
                </tr>
                <tr>
                    <th>營區介紹</th>
                    <td>
                        <textarea name="camp_introduce" id="" cols="50" rows="5"><?= $row["camp_introduce"]; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>注意事項</th>
                    <td>
                        <textarea name="camp_notice" id="" cols="50" rows="5"><?= $row["camp_notice"] ?></textarea>
                    </td>
                </tr>
            </table>
            <div class="py-2 d-flex justify-content-between">
                <div>
                    <button class="btn btn-primary" type="submit">儲存</button>
                    <a class="btn btn-primary" href="camp-LIN.php?camp_id=<?= $row["camp_id"] ?>">取消</a>
                </div>
            </div>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>