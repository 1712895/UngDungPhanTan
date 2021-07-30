<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once("../config/config1.php");
$db =connect();
$records = $db->Post->find();
echo json_encode(iterator_to_array(($records)));


$fp = fopen('Post.json', 'w');
fwrite($fp,json_decode(($records)));
fclose($fp);
?>