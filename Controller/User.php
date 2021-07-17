<?php


class UserController
{
    public function login()
    {
        $data = UserModel::listOne();

        require("./View/login.phtml");
    }
    public function profile()
    {
        $data = UserModel::listOne();
        require("./View/timeline-about.phtml");
    }
}
?>

