<?php

class Category{
    private $id;
    private $name;
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

    public function getCategories(){
        $categories = $this->db->query("SELECT * FROM categories ORDER BY id DESC");
        return $categories;
    }

    public function getSingleCategory(){
    $category = $this->db->query("SELECT * FROM categories WHERE id={$this->getId()}");
        return $category->fetch_object();
    }

    public function save(){
        $sql = "INSERT INTO categories VALUES(NULL, '{$this->getName()}')";
        $save = $this->db->query($sql);

        $result = false;

        if($save){
            $result = true;
        }

        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM categories WHERE id={$this->id}";
        $delete = $this->db->query($sql);
 
        $result = false;
        if($delete){
            $result = true;
        }

        return $result;
    }


    public function getCurCategory(){
        $category = $this->db->query("SELECT * FROM categories WHERE id={$this->id}");
        return $category->fetch_object();
    }


    public function update(){
        $sql = "UPDATE categories SET id='{$this->getId()}', name='{$this->getName()}'"; 
        $sql .= " WHERE id={$this->id};";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }

        return $result;
    }

}