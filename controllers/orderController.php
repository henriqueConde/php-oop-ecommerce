<?php
require_once 'models/order.php';
require_once 'vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
class orderController{
    public function index(){
        echo "Order Controller, Action index";
    }

    public function order(){
        require_once 'views/order/order.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $state = isset($_POST['state']) ? $_POST['state'] : false;
            $city = isset($_POST['city']) ? $_POST['city'] : false;
            $address = isset($_POST['address']) ? $_POST['address'] : false;
            $userId = $_SESSION['identity']->id;
            $vals = Utils::valsCart();
            $totalPrice = $vals['total'];
            // save order in DB
            if($state && $city && $address){
                $order = new Order();
                $order->setState($state);
                $order->setCity($city);
                $order->setAddress($address);
                $order->setUser_id($userId);
                $order->setTotal_price($totalPrice);
                $save = $order->save();
                

                // save order in ordersProducts table
                $saveOrderProducts = $order->saveOrderProducts();
                
                if($save && $saveOrderProducts){
                    $_SESSION['order'] = "completed";
                } else{
                    $_SESSION['order'] = "failed";
                }
            } else{
                $_SESSION['order'] = "failed";
            }

        }else{
            header("Location: ".base_url);
        }

        header("Location: ".base_url."order/confirmed");
     
    }


    public function confirmed(){
        $order = new Order();
        $lastOrder = $order->getLastOrder();
        require_once 'views/order/confirmed.php';
    }


    public function toDownload(){
        $order = new Order();
        $toFetch = $order->getLastOrder();
        $html2pdf = new Html2Pdf();
        ob_start();
        require_once 'views/order/confirmDownload.php';
        $html = ob_get_clean();
        $html2pdf->writeHTML($html);
        ob_end_clean();
        $html2pdf->output();
        unset($_SESSION['cart']);
    }


    public function myOrders(){
       Utils::isLoggedIn();
       $allOrders = new Order();
       $userId = $_SESSION['identity']->id;
       $allOrders->setUser_id($userId);
       $res = $allOrders->getAllByUser();
       require_once 'views/order/myOrders.php';
    }


    public function orderDetails(){
        Utils::isLoggedIn();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $userId = $_SESSION['identity']->id;
            $order = new Order();
            $order->setId($id);
            $lastRes = $order->getSpecificOrder();
            $products = $order->getProductsByOrder();
            $order->setUser_id($userId);
            $test = $order->getOneByUser();
            require_once 'views/order/orderDetails.php';
        }else{
            header("Location: ".base_url."order/myOrders");
        }
    }


    public function manage(){
        Utils::isAdmin();
        $admin = true;
        $order = new Order();
        $res = $order->getProducts();
        require_once 'views/order/myOrders.php';
    }

    public function status(){
        Utils::isAdmin();
        if(isset($_POST['orderId']) && isset($_POST['status'])){
        // Update order
            $order = new Order();
            $order->setId($_POST['orderId']);
            $order->setStatus($_POST['status']);
            $order->update();
            header("Location: ".base_url."order/orderDetails&id=".$_POST['orderId']);
        }else{
            header("Location: ".base_url);
        }
    }

}