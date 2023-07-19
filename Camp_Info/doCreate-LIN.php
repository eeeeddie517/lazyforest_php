<?php
session_start();

if (!isset($_POST["camp_name"])) {
    die("請依正常管道到此頁");
}

require_once("../db_connect.php");

$camp_name = $_POST["camp_name"];
$camp_address = $_POST["camp_address"];
$camp_introduce = $_POST["camp_introduce"];
$camp_notice = $_POST["camp_notice"];
$camp_phone = $_POST["camp_phone"];
$camp_altitude = $_POST["camp_altitude"];
$camp_host_id = $_SESSION["camp"]["camphost_id"];

// 代辦事項:
// JOIN CampHost_List > 抓登入進來的CampHost 的ID > 然後再insert

// echo "$camp_name, $camp_address, $camp_introduce, $camp_notice,  $camp_phone, $camp_altitude";

$sql = "INSERT INTO camp_info (camp_name, camp_address, camp_introduce, camp_notice, camp_phone, camp_altitude, camp_host_id, valid) VALUES ('$camp_name', '$camp_address', '$camp_introduce', '$camp_notice', '$camp_phone', '$camp_altitude','$camp_host_id', 1)";

// echo $sql;


if ($conn->query($sql) === TRUE) {

    $latestId = $conn->insert_id;
    echo "資料表 camp_info 新增資料完成, id 為 $latestId";
    // header("location: user-list.php");
    echo "<br>";
    echo '<a href="../camp_info-LIN.php" class="btn btn-primary p-2 m-2">回營地列表</a>';


} else {
    echo "新增資料錯誤: " . $conn->error;
}

$conn->close();
?>

<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>