<?php



class PostController
{
    public function index()
    {   $catName='';
        $tagName='';
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
        if(isset($_REQUEST['add_post']))
        {
    $header = $_REQUEST['header'];
    $categories = $_REQUEST['categories'];
    $tags = $_REQUEST['tags'];
    $detail = $_REQUEST['detail'];

    $id_User ="60dd856d5cf2404ae46f63b4";
    PostModel::addPost($header, $id_User,$categories,$tags,$detail);
        }
        require("./View/newsfeed-add.phtml");
    }


}
/*var_dump(PostModel::listAll());*/
?>