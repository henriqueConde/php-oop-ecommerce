<?php

class Order{
    private $id;
    private $user_id;
    private $state;
    private $city;
    private $address;
    private $total_price;
    private $status;
    private $date;
    private $time;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

        /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }


        /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $this->db->real_escape_string($state);

        return $this;
    }

        /**
     * Get the value of city
     */ 
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */ 
    public function setCity($city)
    {
        $this->city = $this->db->real_escape_string($city);

        return $this;
    }


        /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $this->db->real_escape_string($address);

        return $this;
    }

        /**
     * Get the value of total_price
     */ 
    public function getTotal_price()
    {
        return $this->total_price;
    }

    /**
     * Set the value of total_price
     *
     * @return  self
     */ 
    public function setTotal_price($total_price)
    {
        $this->total_price = $total_price;

        return $this;
    }


        /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }



       /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

        /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

   

    public function getProducts(){
        $orders = $this->db->query("SELECT * FROM orders ORDER BY id DESC");
        return $orders;
    }

    public function save(){
        $sql = "INSERT INTO orders VALUES(NULL, '{$this->getUser_id()}', '{$this->getState()}', '{$this->getCity()}', '{$this->getAddress()}', '{$this->getTotal_price()}', 'confirmed', CURDATE(), CURTIME())";
        $save = $this->db->query($sql);
    
        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }
    

    public function getCurProduct(){
        $order = $this->db->query("SELECT * FROM orders WHERE id={$this->id}");
        return $order->fetch_object();
    }


    public function saveOrderProducts(){
        // Get ID of the last order
        $sql = "SELECT LAST_INSERT_ID() as 'order';";
        $query = $this->db->query($sql);

        $orderId = $query->fetch_object()->order;

        //Insert last order in ordersProducts table
        foreach($_SESSION['cart'] as $index=>$value){
            $product = $value['product'];

            $insert = "INSERT INTO ordersProducts VALUES(NULL, {$orderId}, {$product->id}, {$value['unities']})";
            $save = $this->db->query($insert);
        }

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }


    public function getLastOrder(){
        //get last order
        $lastOrder = $this->db->query("SELECT * FROM orders ORDER BY id DESC LIMIT 1;");
        return $lastOrder;
    }

    public function getAllByUser(){
        //get all orders by a specific user        
        $sql = "SELECT o.* FROM orders AS o "
                ."WHERE o.user_id= {$this->getUser_id()} ORDER BY id DESC";
        $order = $this->db->query($sql);
        return $order;
    }


    public function getSpecificOrder(){
        $sql = "SELECT * FROM orders WHERE id= {$this->getId()}";
        $order = $this->db->query($sql);
        return $order;
    }

    public function getOneByUser(){
        $sql = "SELECT * FROM orders AS o "
                . "WHERE user_id={$this->getUser_id()} ORDER BY id DESC LIMIT 1";

        $product = $this->db->query($sql);
        return $product;
    }


    public function getProductsByOrder(){      
        $sql = "SELECT p.*, op.unities FROM products p "
                . "INNER JOIN ordersProducts op ON p.id = op.product_id "
                . "WHERE op.order_id={$this->getId()}";
        $products = $this->db->query($sql);
        return $products;
    }


    public function getUnities(){
        $sql = "SELECT *, COUNT(unities) AS cnt FROM ordersProducts WHERE order_id= {$this->getId()} HAVING cnt > 1";
        $unities = $this->db->query($sql);
        return $unities;
    }


    public function update(){
        $sql = "UPDATE orders SET status='{$this->getStatus()}' "; 
        $sql .= "WHERE id={$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }
}




// Debugg Mysql

// echo $this->db->error;
// die();