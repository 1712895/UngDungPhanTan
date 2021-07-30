<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once("../config/config1.php");
$db =connect();
$records = $db->Post->find();
$array = json_decode($records, true);
$items = $array->kitNew->items;

foreach($items as $item){
    echo "<tr>";
    echo "<td>" . $item . "</td>";
    echo "<td>" . $item->killCount . "</td>";
    echo "<td>" . $item->killedByCount . "</td>";
    echo "<td>" . $item->selected . "</td>";
    echo "<td>" . $item->unlocked . "</td>";
    echo "</tr>";
}
$fp = fopen('Post.json', 'w');
fwrite($fp,json_encode(iterator_to_array(($records))));
fclose($fp);
?>