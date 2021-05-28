<?php

class PostController
{
    public function index()
    {
        $data = PostModel::listAll();

        require("./View/newsfeed.phtml");
    }

}
/*var_dump(PostModel::listAll());*/
?>