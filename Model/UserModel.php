<?php


class UserModel
{
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
            ['_id' => $_id]
            );
    }
    public static function FindUser($email,$password)
    {
        $db = connect();
        return $db->User->findOne(
            ['Email'=>$email,
              'Password' =>$password]
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