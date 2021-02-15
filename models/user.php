<?php


class User{
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $role;
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
     * Get the value of first_name
     */ 
    public function getFirst_name()
    {
        return $this->first_name;
    }

    /**
     * Set the value of first_name
     *
     * @return  self
     */ 
    public function setFirst_name($first_name)
    {
        $this->first_name = $this->db->real_escape_string($first_name);

        return $this;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */ 
    public function setLast_name($last_name)
    {
        $this->last_name = $this->db->real_escape_string($last_name);

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost'=>4]);
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->db->real_escape_string($this->role);
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->db->real_escape_string($this->image);
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

    public function save(){
        $sql = "INSERT INTO users VALUES(NULL, '{$this->getFirst_name()}', '{$this->getLast_name()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', NULL)";
        $save = $this->db->query($sql);

        $result = false;

        if($save){
            $result = true;
        }

        return $result;
    }


    public function login(){
        $result = false;

        $email = $this->email;
        $password = $this->password;
        // check if the user exists
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){            
            $user = $login->fetch_object(); // This converts the DB response into an Object

            //check password
            $verify = password_verify($password, $user->password);
            if($verify){
                $result = $user;
            } 
        } 

        return $result;
    }
}