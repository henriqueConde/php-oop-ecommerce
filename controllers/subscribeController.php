<?php


class subscribeController{
    public function index(){
        require_once 'views/subscribe/success.php';
    }

    public function subscribe(){
        if(isset($_POST['mail'])){
            $mail = $_POST['mail'];
            var_dump($mail);
            require_once 'APIs/subscribe.php';
            header("Location:".base_url."subscribe/index");
        }
    }

}