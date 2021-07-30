<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once("../config/config1.php");
$db =connect();
$records = $db->Post->find();
//echo json_encode(iterator_to_array($records1));
$fp = fopen('../ExportFile/Post.json', 'w');
fwrite($fp,json_encode(iterator_to_array(($records))));
fclose($fp);
echo "Export Sucessfull !!!";
$link = "http://localhost:63342/Diendantrithuc/index.php";
?>

