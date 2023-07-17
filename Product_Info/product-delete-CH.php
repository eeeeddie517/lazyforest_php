<?php
require_once("../db-connect_.php");

$id = $_POST["id"];
$valid = $_POST["valid"];

$sqlDelete = "UPDATE product_info SET valid = $valid WHERE id = $id";

if ($conn->query($sqlDelete) === TRUE) {
  $response = array("success" => true, "message" => "成功");

} else {
  $response = array("success" => false, "message" => "失敗");
}

echo json_encode($response);

?>

