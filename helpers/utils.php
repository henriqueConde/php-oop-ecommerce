<?php


class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }

        return $name;
    }

    public static function isAdmin(){
        if(!isset($_SESSION['admin'])){
            header('Location: '.base_url);
        }else{
            return true;
        }
    }

    public static function showCategories(){
        require_once 'models/category.php';
        $category = new Category();
        $categories = $category->getCategories();
        return $categories;
    }

    public static function valsCart(){
        $vals = array('count' => 0, 'total' => 0);
        if(isset($_SESSION['cart'])){
            $vals['count'] = count($_SESSION['cart']);

            foreach($_SESSION['cart'] as $index => $value){
                $vals['total'] += $value['price']*$value['unities'];
            }
        }

        return $vals;
    }


    public static function isLoggedIn(){
        if(!isset($_SESSION['identity'])){
            header("Location: ".base_url);
        } 
    }

}