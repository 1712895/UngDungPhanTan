<?php



class PostController
{
    public function index()
    {
        $dataUser = PostModel::AllQuestion();
        require("./View/newsfeed.phtml");
    }
    public function detail()
    {
        $data = PostModel::DetailQuestion();
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