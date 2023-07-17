<?php
require_once("./db_connect_camp-YU.php");

$id = $_GET["id"];
$sql = "SELECT * FROM db ";
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
    <title>edit-category</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>

    <div class="container">

        <table class="table table-bordered p-3">
            <thead>
                <tr>
                    <th>category_id</th>
                    <th>category_name</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <?php foreach ($rows as $name) : ?>

                <tbody>
                    <tr>
                        <?php if ($name["category_id"] == $id) : ?>
                            <form action="doEdit-Ting.php" method="post">
                                <input type="hidden" name="id" value="<?= $name["category_id"] ?>">
                                <td><?= $name["category_id"] ?></td>
                                <td><input type="text" class="form-control" value="<?= $name["category_name"] ?>" name="updateName"></td>
                                <td>
                                    <button class="btn btn-success" type="submit">確認編輯</button>
                                    <a href="../category_list-LIN.php" class="btn btn-danger">取消變更</a>
                                </td>
                            </form>
                        <?php else : ?>
                            <td><?= $name["category_id"] ?></td>
                            <td><?= $name["category_name"] ?></td>
                            <td>
                            </td>
                        <?php endif; ?>
                    </tr>
                </tbody>

            <?php endforeach ?>

        </table>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>