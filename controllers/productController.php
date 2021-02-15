<?php
require_once 'models/product.php';

class productController{
    public function index(){
        // Render index
        $product = new Product();
        $products = $product->getRandom(6);
        require_once 'views/product/featured-products.php';
    }

    public function manage(){
        Utils::isAdmin();

        $product = new Product();
        $products = $product->getProducts();
        require_once 'views/product/manage.php';
    }
    
    public function create(){
        Utils::isAdmin();
        require_once 'views/product/create.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){
            $name = isset($_POST['name']) ? $_POST['name'] : false;
            $description = isset($_POST['description']) ? $_POST['description'] : false;
            $price = isset($_POST['price']) ? $_POST['price'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $category = isset($_POST['category']) ? $_POST['category'] : false;
        

            if($name && $description && $price && $stock && $category){
                $product = new Product();
                $product->setName($name);
                $product->setDescription($description);
                $product->setPrice($price);
                $product->setStock($stock);
                $product->setCategory_id($category);
                // Save image
                if(isset($_FILES['image'])){
                    $image = $_FILES['image'];
                    $imageName = $image['name'];
                    $mimeType = $image['type'];

                    if($mimeType == "image/jpg" || $mimeType == "image/jpeg" || $mimeType == "image/png" || $mimeType == "image/gif"){
                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true); //the true parameter allows you to create folders recursively
                        }

                        move_uploaded_file($image['tmp_name'], 'uploads/images/'.$imageName);
                        $product->setImage($imageName);
                    }
                }

                // Check if is Creating new Product or Updating existing product
                if(isset($_GET['id'])){
                   
                    $product->setId($_GET['id']);
                    $save = $product->update();                
                }else{
                    $save = $product->save();
                }

                
                if($save){
                    $_SESSION['product'] = "completed";
                } else{
                    $_SESSION['product'] = "failed";
                }
            } else{
                $_SESSION['product'] = "failed";
            }

        } else{
            $_SESSION['product'] = "failed";
        }

        header("Location:".base_url."product/manage");


    } // end save

    public function edit(){
        Utils::isAdmin();
        
        if(isset($_GET['id'])){
            $edit = true;
            $product = new Product();
            $product->setId($_GET['id']);
            $editProduct = $product->getCurProduct();

            require_once 'views/product/create.php';
        } else{
            header("Location:".base_url."product/manage");
        }


    }// end edit


    public function delete(){
        Utils::isAdmin();

        if(isset($_GET['id'])){
            $product = new Product();
            $product->setId($_GET['id']);
            $delete = $product->delete();

            if($delete){
                $_SESSION['deleted'] = "completed";
            } else{
                $_SESSION['deleted'] = "failed";
            }
        }else{
            $_SESSION['deleted'] = "failed";
        }

        header("Location:".base_url."product/manage");

    }// end delete


    public function singleProduct(){
        if(isset($_GET['id'])){
            $product = new Product();
            $product->setId($_GET['id']);
            $singleProduct = $product->getCurProduct();

            require_once 'views/product/single-product.php';
        } else{
            header("Location:".base_url."product/manage");
        }
    }
}