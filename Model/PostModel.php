<?php


class PostModel
{
    public $_id;
    public $header;
    public $detail;
    public $id_User;
    public $date_created;
    public $categories;
    public $Tags;
    public $like;
    public $unlike;
    public $Answer;
    function __construct()
    {
        $this->_id = "";
        $this->header = "";
        $this->detail = "";
        $this->id_User = "";
        $this->date_created = "";
        $this->categories = "";
        $this->Tags = "";
        $this->like = "";
        $this->unlike = "";
        $this->Answer="";
    }
    public static function AllQuestion() {
        $db = connect();
        $result = $db->Post->aggregate([
            ['$lookup' => [
                'from' => 'User',
                'localField' => 'id_User',
                'foreignField' => '_id',
                'as' => 'Infor_User'
            ]],
             ['$sort' => [ 'date_created' => -1 ]]
        ]);
        return $result;
    }
    public static function addPost($header,$idUser,$categories,$tags,$detail)
    {
        $db = connect();
        $result = $db->Post->insertOne([
            'header'=> $header,
            'id_User'=> $idUser ,
            'date_created'=>date("Y-m-d"),
            'categories'=>$categories,
            'Tags'=>[$tags],
            'detail'=>$detail,
            'like'=>0,
            'unlike'=>0,
            'Answer'=>[]
        ]);
        return $result;
    }
    public static function filterCategories($catName)
    {
        $db = connect();
        $result = $db->Post->aggregate([
            ['$lookup' => [
                'from' => 'User',
                'localField' => 'id_User',
                'foreignField' => '_id',
                'as' => 'Infor_User'
            ]],
            ['$sort' => [ 'date_created' => -1 ]],
            ['$match' => [ 'categories'=> $catName]]
        ]);
        return $result;
    }
    public static function filterTags($tagName)
    {
        $db = connect();
        $result = $db->Post->aggregate([
            ['$lookup' => [
                'from' => 'User',
                'localField' => 'id_User',
                'foreignField' => '_id',
                'as' => 'Infor_User'
            ]],
            ['$sort' => [ 'date_created' => -1 ]],
            ['$match' => [ 'Tags'=> $tagName]]
        ]);
        return $result;
    }
    public static function getDetail($_id)
    {
        $db = connect();
        $result = $db->Post->aggregate([
            ['$lookup' => [
                'from' => 'User',
                'localField' => 'id_User',
                'foreignField' => '_id',
                'as' => 'Infor_User'
            ]],
            ['$lookup' => [
                'from' => 'User',
                'localField' => 'Answer.IDUser',
                'foreignField' => '_id',
                'as' => 'Infor_User_Comment'
            ]],
            ['$match' => [ '_id'=> new MongoDB\BSON\ObjectId("$_id")]]
        ]);
        return $result;
    }
    /*public static function get($_id)
{
    $db = connect();
    $result = $db->Post->findOne([
        '_id'=> new MongoDB\BSON\ObjectId("$_id")
    ]);
    return $result;
}*/
/*
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
*/
}
class Answer
{
    public $IDUser;
    public $Answer;
    public $date;
    public $like;
    public $unlike;
    function __construct()
    {
        $this->IDUser="";
        $this->Answer="";
        $this->date="";
        $this->like="";
        $this->unlike="";

    }
}

?>