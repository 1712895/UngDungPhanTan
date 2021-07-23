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
        $notice = 'Comment your thinking about this post <3';
        if(isset($_REQUEST['_id'])) {
            $_id = $_REQUEST['_id'];
            console_log($_id);
        }
        if(isset($_REQUEST['add_comment']))
        {
            UserController::authentication();
            $comment = $_REQUEST['comment'];
            if(empty(PostModel::notice_addcomment($_SESSION["IDUser"],$_id)))
            {

                $notice = "Comment Sucessful !!!";
                PostModel::addComment($comment,$_SESSION["IDUser"],$_id);
            }
            else
            {
                $notice = "You already comment in this post. You can't comment this post !!!";
            }

        }
        $data = PostModel::getDetail($_id);
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

// like unlike
    public static function Like($_id)
        {
        if (isset($_POST['action'])) {
            $post_id = $_POST['post_id'];
            $action = $_POST['action'];

            switch ($action) {
                case 'like':
                    //thay doi luot like Mongo DB
                    break;
                case 'unlike':
                    //thay doi luot like Mongo DB
                    break;
                default:
                    break;
                }

            // execute query to effect changes in the database ...
            exit(0);
            }
        }


}
/*var_dump(PostModel::listAll());*/
?>