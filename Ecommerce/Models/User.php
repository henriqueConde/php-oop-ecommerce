<?php

namespace Ecommerce\Models;

class User{

    public $firstName;
    public $age;

    public function setfirstName($firstName){
        $this->firstName = $firstName;
    }

    public function getFirstName(){
        return 'Billy';
    }


    public function setAge($curYear, $birthYear){
        $this->age = $curYear - $birthYear;
    }

    public function getAge(){
        return $this->age;
    }

}