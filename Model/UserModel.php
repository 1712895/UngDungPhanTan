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
        $this->Birthday = "";
        $this->Email = "";
        $this->Name = "";
        $this->Phone = "";
        $this->Role = "";
        $this->Password = "";
        $this->IsBlock = "";
    }
    public static function listOne() {
        $db = connect();
            return  $db->User->findOne();
    }
}
?>