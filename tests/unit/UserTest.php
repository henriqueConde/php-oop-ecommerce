<?php

require _DIR_ . "/../Ecommerce/Models/User.php";



class UserTest extends \PHPUnit\Framework\TestCase
{
  public function testThatWeCanGetFirstName(){
      $user = new Ecommerce\models\User();


      $user->setFirstName('Billy');

      $this->assertEquals($user->getFirstName(), 'Billy');
  }


  public function testThatWeCanGetAge(){
    $user = new Ecommerce\models\User();


    $user->setAge(2020, 1990);

    $this->assertEquals($user->getAge(), 30);
  }

}