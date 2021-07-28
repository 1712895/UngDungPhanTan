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
            $currentUser = UserModel::FindUser($email, $password);
            if(!empty($currentUser))
            {
                $_SESSION["IsLogined"] = True;
                $_SESSION["isAdmin"] = $currentUser->Role;
                console_log($_SESSION["IsLogined"]);
                $_SESSION["UserName"] = $currentUser->Name;
                $_SESSION["Avatar"]=$currentUser->Avatar;
                $_SESSION["IDUser"]=$currentUser->_id;
                $_SESSION["Email"]=$currentUser->Email;
                header("Location:index.php");
            }
            else
            {
                $notice = 'Fail !!! Please try again.';
            }
        }
        require("./View/login.phtml");
    }

    public function signup()
    {
        if(isset($_REQUEST['sign_up']))
        {
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            $address = $_REQUEST['address'];
            $name = $_REQUEST['name'];
            $phone = $_REQUEST['phone'];
            $birthday = date_create($_REQUEST['birthday'])->format('Y-m-d H:i:s');
            $avatar = $_REQUEST['avatar'];
            $fileDestination = '';
            $file = $_FILES['avatar'];
            $fileExt = explode('.',$file['name']);
            $fileActualExt = strtolower(end($fileExt));
            $allowed = array('jpg','jpeg','png','pdf');
            if(in_array($fileActualExt,$allowed))
            {
                if($file['error'] === 0)
                {
                    if($file['size'] < 1000000)
                    {
                        $notice1 = "";
                        $fileNameNew = uniqid('',true).".".$fileActualExt;
                        $fileDestination = 'images/users/'.$fileNameNew;
                        move_uploaded_file($file['tmp_name'],$fileDestination);

                    }
                    else
                    {
                        $notice1 = "But your image is too big !!! ";
                    }
                }
                else
                {
                    $notice1 = "But There was an error uploading your picture ";
                }

            } else
            {
                $notice1 = "But you cant upload your picture of this type!";
            }

           $isSignup = UserModel::SignUp($address, $fileDestination, $birthday, $email, $name, $phone,$password);
            
            if(!empty($isSignup))
            {
                header("Location:index.php?action=login");
            }
        }
        require("./View/signup.phtml");
    }

    public function changepassword()
    {
        if (!isset ($_SESSION["IsLogined"]) || $_SESSION["IsLogined"] != "true")
        {
            header("Location:index.php?action=login");
        } else {
            if(isset($_REQUEST['change_password']))
            {
                $email = $_SESSION['Email'];
                $old_password = $_REQUEST['old_password'];
                $new_password = $_REQUEST['new_password'];
                $confirm_password = $_REQUEST['confirm_password'];
                $currentUser = UserModel::FindUser($email, $old_password);
                if(!empty($currentUser))
                {
                    if ($new_password == $confirm_password) {
                        $isChangePassword = UserModel::updatePassword($email,$new_password);
                    }
                }
            }
            require("./View/changepassword.phtml");
        }
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
    public static function isAdmin()
    {
        if (!isset ($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] != "true")
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

