<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    // require_once "src/Client.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class StylistTest extends PHPUnit_Framework_TestCase
    {
      protected function tearDown()
      {
        Stylist::deleteAll();
        // Restaurant::deleteAll();
      }

      function test_getName()
      {
        //Arrange
        $name = "Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);

        //Act
        $result = $test_stylist->getName();

        //Assert
        $this->assertEquals($name, $result);
      }


    }
?>
