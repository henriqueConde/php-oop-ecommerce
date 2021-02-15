<?php
require_once 'models/product.php';

class cartController{
    public function index(){
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
        }
        require_once "views/cart/cart.php";
    }

    public function add(){
        if(isset($_GET['id'])){
            $productId = $_GET['id'];
        } else{
            header('Location: '.base_url);
        }

       
        if(isset($_SESSION['cart'])){
            $counter = 0;
            foreach($_SESSION['cart'] as $index => $value){
                if($value['productId'] == $productId){
                    $_SESSION['cart'][$index]['unities']++;
                    $counter++;
                }
            }
        }

        if(!isset($counter) || $counter == 0){

            // get product
           $product = new Product();
           $product->setId($productId);
           $product = $product->getCurProduct();

           if(is_object($product)){
               $_SESSION['cart'][] = array(
                   "productId" => $product->id,
                   "price" => $product->price,
                   "unities" => 1,
                   "product" => $product
               );
           }
        }


        header("Location: ".base_url."cart/index");
    }

    public function delete(){
        unset($_SESSION['cart']);
        header("Location: ".base_url."cart/index");
    }


    public function remove(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            unset($_SESSION['cart'][$index]);
        }
        header("Location: ".base_url."cart/index");
    }

    public function plus(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['cart'][$index]['unities']++;
        }
        header("Location: ".base_url."cart/index");
    }


    public function minus(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['cart'][$index]['unities']--;
            if($_SESSION['cart'][$index]['unities'] == 0){
                unset($_SESSION['cart'][$index]);
            }
            
        }
        header("Location: ".base_url."cart/index");
    }
}