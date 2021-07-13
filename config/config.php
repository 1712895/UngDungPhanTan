<?php
//use MongoDB\Client;
function connect()
{
//require autoload
/*require_once('../vendor/autoload.php');*/
    define('DRUPAL_ROOT', getcwd());
    require_once DRUPAL_ROOT . '../vendor/autoload.php';

//$conn = new Client("mongodb+srv://mongo-user:12345678910@cluster0.ibwll.mongodb.net/?ssl=true&authSource=admin&serverSelectionTryOnce=false&serverSelectionTimeoutMS=15000");
//$db = $conn->test;

    $client = new MongoDB\Client(
        'mongodb+srv://mongo-user:12345678910@cluster0.ibwll.mongodb.net/?retryWrites=true&w=majority'
    );

    $db = $client->UDPT_DB;

    if (!$client->connected )
    {
        echo ( "Couldn't connect to Database" );
    }

/*$result = $db->listCollections();

foreach ($result as $item) {
    var_dump($item->getName());
}*/
    return $db;
}

?>

