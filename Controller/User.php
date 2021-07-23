<?php


class UserController
{
    public function login()
    {
        $notice = 'Sign in to joint with us !!!';
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
                console_log($_SESSION["IsLogined"]);
                $_SESSION["UserName"] = $currentUser->Name;
                $_SESSION["Avatar"]=$currentUser->Avatar;
                $_SESSION["IDUser"]=$currentUser->_id;
                header("Location:index.php");
            }
            else
            {
                $notice = 'Fail !!! Please try again.';
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
        require("./View/notification.phtml");
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
        $_SESSION["UserName"] = "Anonymous";
        $_SESSION["Avatar"]='images/users/avatardefault.jpg';
        $_SESSION["IDUser"]="";
        header("Location:index.php");
    }
}
?>

