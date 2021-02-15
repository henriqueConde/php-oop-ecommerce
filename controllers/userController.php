<?php
require_once 'models/user.php';
class userController{

    public $isLoggedIn;


    public function index(){
        echo "User Controller, Action index";
    }

    public function setIsLoggedIn($isLoggedIn){
        $this->isLoggedIn = $isLoggedIn;
    }

    public function getIsLoggedIn(){
        return $this->isLoggedIn;
    }

    public function save(){
        
        if(isset($_POST)){
            $first_name = isset($_POST['first-name-register']) ? $_POST['first-name-register'] : false;
            $last_name = isset($_POST['last-name-register']) ? $_POST['last-name-register'] : false;
            $email = isset($_POST['mail-register']) ? $_POST['mail-register'] : false;
            $password = isset($_POST['password-register']) ? $_POST['password-register'] : false;
            
            if($first_name && $last_name && $email && $password){
                $user = new User();
                $user->setFirst_name($_POST['first-name-register']);
                $user->setLast_name($_POST['last-name-register']);
                $user->setEmail($_POST['mail-register']);
                $user->setPassword($_POST['password-register']);
                $save = $user->save();
                if($save){
                    $_SESSION['register'] = 'completed';
                    require_once 'views/user/registerCompleted.php';
                    //echo "Register completed";
                } else{
                    require_once 'views/user/registerCompleted.php';
                    $_SESSION['register'] = 'failed';
                }
            } else{
                require_once 'views/user/registerCompleted.php';
                $_SESSION['register'] = 'failed';
            }
        } else{
            require_once 'views/user/registerCompleted.php';
            $_SESSION['register'] = 'failed';
        }
        exit(header("Location:".base_url));
    }



    public function login(){
        // echo json_encode($_POST);
        // exit;
        if(isset($_POST)){
            //identify user
            //check database
            $user = new User();
            $user->setEmail($_POST['mail-login']);
            $user->setPassword($_POST['password']);
            
            $identity = $user->login();
            //create session to keep user logged in
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                header("Location:".base_url);
                //echo 'You are logged in!';
                if($identity->role == 'admin'){
                    $_SESSION['admin'] = true;
                }
            } else{
                $_SESSION['error_login'] = 'Identification failed';
                echo 'Identification failed!';
            }
        }

    }


    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }

        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);            
        }

        header("Location:".base_url);
    }
} //end of class




