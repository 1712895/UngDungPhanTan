<?php


class PostModel
{
    public $header;
    public $detail;
    public $id_User;
    function __construct()
    {
        $this->header = "";
        $this->detail = "";
        $this->id_User = "";
    }
    public static function listAll() {
        $db = connect();
        $result = $db->Post->findOne();
        return $result;
    }

}

/*var_dump(PostModel::listAll());*/
?>