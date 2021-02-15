<?php

// Static methods can be accessed without the need of instanciating the class

// This class is making the connection between PHP and the Database in Mysql
class Database{
    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'ecommerce');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}