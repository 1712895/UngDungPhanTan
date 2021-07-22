<?php

class PostController
{
    public function index()
    {   $catName='';
        $tagName='';
        console_log($_SESSION["IDUser"]);
        $dataUser = PostModel::AllQuestion();
        if(isset($_REQUEST['catName'])){
            $catName= $_REQUEST['catName'];
            console_log($catName);
            $dataUser = PostModel::filterCategories($catName);
        }
        if(isset($_REQUEST['tagName'])){
            $tagName= $_REQUEST['tagName'];
            console_log($tagName);
            $dataUser = PostModel::filterTags($tagName);
        }
        require("./View/newsfeed.phtml");
    }

    public function detail()
    {
        $_id = '';
        if(isset($_REQUEST['_id'])) {
            $_id = $_REQUEST['_id'];
            console_log($_id);
            $data = PostModel::getDetail($_id);
        }
        require ("./View/newsfeed-detail.phtml");
    }
    public function addPost()
    {
        UserController::authentication();
        if(isset($_REQUEST['add_post']))
        {
    $header = $_REQUEST['header'];
    $categories = $_REQUEST['categories'];
    $tags = $_REQUEST['tags'];
    $detail = $_REQUEST['detail'];
    PostModel::addPost($header,$_SESSION["IDUser"],$categories,$tags,$detail);
        }
        require("./View/newsfeed-add.phtml");
    }
    public function addComment()
    {
        UserController::authentication();
        require ("./View/newsfeed-comment.phtml");
    }


}
/*var_dump(PostModel::listAll());*/
?>