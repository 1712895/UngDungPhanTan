<?php


class UserController
{
    public function login()
    {
        if(isset($_REQUEST['sign_in']))
        {
            $page="";
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            console_log($email);
            console_log($password);
            $currentUser = UserModel::SignUp($email, $password);
            if(!empty($currentUser))
            {
                PostController::index();
            }
        }
        require("./View/login.phtml");
    }
    public function profile()
    {
        $data = UserModel::listOne();
        require("./View/timeline-about.phtml");
    }
}
?>

