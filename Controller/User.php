<?php


class UserController
{
    public function login()
    {
        if(isset($_REQUEST['sign_in']))
        {
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            console_log($email);
            console_log($password);
            $currentUser = UserModel::SignUp($email, $password);
            if(!empty($currentUser))
            {
                $_SESSION["IsLogined"] = True;
                $_SESSION["UserName"] = $currentUser->Name;
                $_SESSION["Avatar"]=$currentUser->Avatar;
                header("Location:index.php");
            }
        }
        require("./View/login.phtml");
    }
    public function profile()
    {
        $data = UserModel::listOne();
        require("./View/timeline-about.phtml");
    }
    public function unauthorized_page()
    {
        $data = "";
        require("./View/notification.php");
    }
    //add this function at any function of controller which require to authorize
    public static function authentication()
    {
        if (!isset ($_SESSION["IsLogined"]) || $_SESSION["IsLogined"] != "true")
        {
            header("Location:index.php?action=error");
        }
    }
    public function logout()
    {
        unset($_SESSION["IsLogined"]);
        header("Location:index.php");
    }
}
?>

