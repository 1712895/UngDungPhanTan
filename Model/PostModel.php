<?php


class PostModel
{
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
    public static function listAll() {
        $db = connect();
        $result = $db->Post->find();
        return $result;
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
    public static function DetailQuestion()
    {
        $db = connect();
        $result = $db->Post->findOne();
        return $result;
    }
    public static function addPost($header,$idUser,$categories,$tags,$detail)
    {
        $db = connect();
        $result = $db->Post->insertOne([
            'header'=> $header,
            'id_User'=> new MongoDB\BSON\ObjectId("$idUser")  ,
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