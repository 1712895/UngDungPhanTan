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
        $notice1 = '';
        if(isset($_REQUEST['_id'])) {
            $_id = $_REQUEST['_id'];
            console_log($_id);
        }
        if(isset($_REQUEST['add_comment']))
        {
            UserController::authentication();
            $comment = $_REQUEST['comment'];
            $usercurrent = UserModel::findbyID($_SESSION["IDUser"]);
            $notice = "Comment Sucessful !!!";
            $fileDestination = '';
            /*bat dau tu day*/
            $file = $_FILES['file'];
            $fileExt = explode('.',$file['name']);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg','jpeg','png','pdf');
            if(in_array($fileActualExt,$allowed))
            {
                if($file['error'] === 0)
                {
                    if($file['size'] < 1000000)
                    {
                        $notice1 = "";
                        $fileNameNew = uniqid('',true).".".$fileActualExt;
                        $fileDestination = 'images/uploads/'.$fileNameNew;
                        move_uploaded_file($file['tmp_name'],$fileDestination);

                    }
                    else
                    {
                        $notice1 = "But your image is too big !!! ";
                    }
                }
                else
                {
                    $notice1 = "But There was an error uploading your picture ";
                }

            } else
            {
                $notice1 = "But you cant upload your picture of this type!";
            }
            /*ket thuc o day*/
            PostModel::addComment($comment,$_SESSION["IDUser"],$_id,$usercurrent->Name,$usercurrent->Avatar,$fileDestination);

        }
        $data = PostModel::getDetail($_id);
        require ("./View/newsfeed-detail.phtml");
    }

    public function addPost()
    {
        UserController::authentication();
        $notice = "Import your picture below !!! ";
        if(isset($_REQUEST['add_post']))
        {
    $header = $_REQUEST['header'];
    $categories = $_REQUEST['categories'];
    $tags = $_REQUEST['tags'];
    $detail = $_REQUEST['detail'];
    $fileDestination = "";

            /*upload anh bat dau tu day*/
            $file = $_FILES['file'];
            $fileExt = explode('.',$file['name']);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg','jpeg','png','pdf');
            if(in_array($fileActualExt,$allowed))
            {
                if($file['error'] === 0)
                {
                    if($file['size'] < 1000000)
                    {
                        $notice = "Your image upload successful !!! ";
                        $fileNameNew = uniqid('',true).".".$fileActualExt;
                        $fileDestination = 'images/uploads/'.$fileNameNew; /*nho doi duong dan toi file anh user*/
                        move_uploaded_file($file['tmp_name'],$fileDestination);

                    }
                    else
                    {
                        $notice = "Your image is too big !!! ";
                    }
                }
                else
                {
                    $notice = "There was an error uploading ";
                }

            } else
            {
                $notice = "You cant upload file of this type!";
            }
            /*upload anh ket thuc o day*/
            PostModel::addPost($header,$_SESSION["IDUser"],$categories,$tags,$detail,$fileDestination);
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