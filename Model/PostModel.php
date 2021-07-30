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
    public $check;
    public $img;
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
        $this->check="";
        $this->img="";
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
             ['$sort' => [ 'date_created' => -1 ]],
            ['$match' => [ 'check' => true]]
        ]);
        return $result;
    }
    public static function addPost($header,$idUser,$categories,$tags,$detail,$img)
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
            'Answer'=>[],
            'check' => true,
            'img' => $img
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
            ['$match' =>  [ '$and' => [['categories'=> $catName],['check'=> true]]]]
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
            ['$match' =>  [ '$and' => [['Tags'=> $tagName],['check'=> true]]]]
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
            ['$match' =>  [  '_id'=> new MongoDB\BSON\ObjectId("$_id")]]
        ]);
        return $result;
    }
    public static function addComment($comment,$UserID,$IDPost,$nameUser,$avatarUser,$img)
    {
        $db=connect();
        $result = $db->Post->findOneAndUpdate(
            ['_id'=> new MongoDB\BSON\ObjectId("$IDPost")],
            ['$push' => ['Answer' => [
                'IDUser' => $UserID,
                'Answer' => $comment,
                'date' => date("Y-m-d"),
                'like' => 0,
                'unlike' => 0,
                'Name' => $nameUser,
                'Avatar' => $avatarUser,
                'check' => true,
                'img' => $img
            ]]]
        );
    }

    public static function updateLike($IDPost)
    {
        $db = connect();
        return $db->Post->updateOne(
            ['_id'=>new MongoDB\BSON\ObjectId("$IDPost")],
            [ '$inc' => [ 'like' => 1 ]]
        );
    }

    public static function updateUnlike($IDPost)
    {
        $db = connect();
        return $db->Post->updateOne(
            ['_id'=>new MongoDB\BSON\ObjectId("$IDPost")],
            [ '$inc' => [ 'like' => -1 ]]
        );
    }
    public static function addReport($UserID,$IDPost,$Detail)
    {
        $db = connect();
        $result = $db->Report->insertOne(
        [
            'IDUser'=> $UserID ,
            'IDPost'=> $IDPost,
            'Detail'=>$Detail
        ]);
        return $result;
    }

/*    public static function notice_addcomment($UserID,$IDPost)
    {
        $db=connect();
        $result = $db->Post->findOne([
            '_id'=> new MongoDB\BSON\ObjectId("$IDPost"),
            'Answer.IDUser' => $UserID
        ]);
        return $result;
    }*/
    /*public static function get($_id)
{
    $db = connect();
    $result = $db->Post->findOne([
        '_id'=> new MongoDB\BSON\ObjectId("$_id")
    ]);
    return $result;
}*/

}
class Answer
{
    public $IDUser;
    public $Answer;
    public $date;
    public $like;
    public $unlike;
    public $Name;
    public $Avatar;
    public $check;
    function __construct()
    {
        $this->IDUser="";
        $this->Answer="";
        $this->date="";
        $this->like="";
        $this->unlike="";
        $this->Name="";
        $this->Avatar="";
        $this->check="";
    }
}

?>