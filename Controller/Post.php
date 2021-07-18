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

}
/*var_dump(PostModel::listAll());*/
?>