<?php
//require_once("./controller/Home.php");
require_once("./Controller/Post.php");
require_once("./Model/PostModel.php");
require_once("config/config.php");


$action = "";
if (isset($_REQUEST["action"]))
{
    $action = $_REQUEST["action"];
}
switch ($action)
{
    /*case "newsfeed":
        $controller = new PostController();
        $controller->listAll();
        break;*/

    default:
        $controller = new PostController();
        $controller->index();
        break;
}

?>
