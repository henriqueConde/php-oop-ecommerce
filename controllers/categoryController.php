<?php
require_once 'models/category.php';
require_once 'models/product.php';

class categoryController{
    public function index(){
        Utils::isAdmin();
        $category = new Category();
        $categories = $category->getCategories();
        require_once 'views/categories/index.php';
    }

    public function create(){
        require_once 'views/categories/create.php';
    }
    public function save(){        
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['name'])){
            //Save category in database
            $category = new Category();
            $category->setName($_POST['name']);

            if(isset($_GET['id'])){
                $category->setId($_GET['id']);
                $category->update();

            } else{
                $category->save();
            }
        }

        header("Location:".base_url."category/index");
    }

    public function display(){
        if(isset($_GET['id'])){

            // Find Category
            $category = new Category();
            $category->setId($_GET['id']);
            $category = $category->getSingleCategory();


            // Get all products from category
            $product = new Product();
            $product->setCategory_id($_GET['id']);
            $products = $product->getCatProducts();
        }

        require_once 'views/categories/display.php';
    }

    public function delete(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $category = new Category();
            $category->setId($_GET['id']);
            $delete = $category->delete();

            if($delete){
                $_SESSION['deletedCat'] = "completed";
            } else{
                $_SESSION['deletedCat'] = "failed";
            }
        }else{
            $_SESSION['deletedCat'] = "failed";
        }

        header("Location:".base_url."category/index");

    }// end delete


    public function edit(){
        Utils::isAdmin();
        
        if(isset($_GET['id'])){
            $edit = true;
            $category = new Category();
            $category->setId($_GET['id']);
            $editCategory = $category->getCurCategory();

            require_once 'views/categories/create.php';
        } else{
            header("Location:".base_url."product/manage");
        }

    }// end edit


}