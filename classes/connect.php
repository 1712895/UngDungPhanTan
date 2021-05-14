<?php
//goi namespace
//goi namespace
use MongoDB\Client;

//require autoload
require_once "vendor/autoload.php";

$conn = new Client("mongodb://127.0.0.1:27017");

$db = $conn->listDatabases();

foreach ($db as $databaseInfo) {
    echo $databaseInfo->getName();
}
?>

