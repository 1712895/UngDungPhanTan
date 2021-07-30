<?php


class UserModel
{
    public $_id;
    public $Address;
    public $Avatar;
    public $Birthday;
    public $Email;
    public $Name;
    public $Phone;
    public $Role;
    public $Password;
    public $IsBlock;

    function __construct()
    {
        $this->_id = "";
        $this->Address = "";
        $this->Avatar = "";
        $this->Birthday = date_create('now')->format('Y-m-d H:i:s');
        $this->Email = "";
        $this->Name = "";
        $this->Phone = "";
        $this->Role = "";
        $this->Password = "";
        $this->IsBlock = "";
    }
    public static function findbyID($_id) {
        $db = connect();
        return  $db->User->findOne(
            ['_id' => new MongoDB\BSON\ObjectId("$_id")]
            );
    }


    public static function countNumofPost($_id) {
        $db = connect();
        //Query
        $result = $db->Post->find(['id_User' => new MongoDB\BSON\ObjectId("$_id")]);
        $count = 0;
        foreach ($result as $row) {
            $count += 1;
        }
        return $count;
    }

    public static function countNumofAns($_id) {
        $db = connect();
        //Query
        $result = $db->Answer->find(['IDUser' => new MongoDB\BSON\ObjectId("$_id")]);
        $count = 0;
        foreach ($result as $row) {
            $count += 1;
        }
        return $count;
    }

    public static function FindUser($email,$password)
    {
        $db = connect();
        return $db->User->findOne(
            ['Email'=>$email,
              'Password' =>$password]
        );
    }
    
    public static function FindUserByEmail($email)
    {
        $db = connect();
        return $db->User->findOne(
            ['Email'=>$email]
        );
    }
    public static function updatePassword($email,$password)
    {
        $db = connect();
        return $db->User->updateOne(
            ['Email'=>$email],
            [ '$set' => [ 'Password' => $password ]]
        );
    }

    public static function SignUp($address,$avatar,$birthday,$email,$name,$phone,$password)
    {
        $db = connect();
        console_log("test");
        $result = $db->User->insertOne([
            'Address'=> $address,
            'Avatar'=> $avatar ,
            'Birthday'=>$birthday,
            'Email'=>$email,
            'Name'=>$name,
            'Phone'=>$phone,
            'Role'=>0,
            'Password'=>$password,
            'IsBlock'=>0
        ]);
        return $result;
    }
}
?>