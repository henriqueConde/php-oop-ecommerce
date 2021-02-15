<?php


class Product{
    private $id;
    private $category_id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $discount;
    private $date;
    private $image;
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
     * Get the value of category_id
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */ 
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $this->db->real_escape_string($name);

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $this->db->real_escape_string($description);

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $this->db->real_escape_string($price);

        return $this;
    }

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);

        return $this;
    }

    /**
     * Get the value of discount
     */ 
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set the value of discount
     *
     * @return  self
     */ 
    public function setDiscount($discount)
    {
        $this->discount = $this->db->real_escape_string($discount);

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
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getProducts(){
        $products = $this->db->query("SELECT * FROM products ORDER BY id DESC");
        return $products;
    }

    public function save(){
        $sql = "INSERT INTO products VALUES(NULL, '{$this->getCategory_id()}', '{$this->getName()}', '{$this->getDescription()}', '{$this->getPrice()}', '{$this->getStock()}', NULL, CURDATE(), '{$this->getImage()}')";
        $save = $this->db->query($sql);

    
        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

    public function update(){
        $sql = "UPDATE products SET category_id='{$this->getCategory_id()}', name='{$this->getName()}', description='{$this->getDescription()}', price='{$this->getPrice()}', stock='{$this->getStock()}' "; 
        if($this->getImage() != null){
            $sql .= ", image='{$this->getImage()}'";
        }
        $sql .= " WHERE id={$this->id};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }
    

    public function delete(){
        $sql = "DELETE FROM products WHERE id={$this->id}";
        $delete = $this->db->query($sql);
        
        $result = false;
        if($delete){
            $result = true;
        }

        return $result;
    }


    public function getCurProduct(){
        $product = $this->db->query("SELECT * FROM products WHERE id={$this->id}");
        return $product->fetch_object();
    }



    public function getRandom($limit){
        $products = $this->db->query("SELECT * FROM products ORDER BY RAND() LIMIT $limit");
        return $products;
    }

    public function getCatProducts(){
        $sql = "SELECT p.*, c.name AS 'catName' FROM products p "
                . "INNER JOIN categories c ON c.id = p.category_id "
                . "WHERE p.category_id={$this->getCategory_id()} "
                . "ORDER BY id DESC";
        $products = $this->db->query($sql);
        return $products;
    }


}




// Debugg Mysql

// echo $this->db->error;
// die();