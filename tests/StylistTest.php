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
        $name = "Stylist Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);

        //Act
        $result = $test_stylist->getName();

        //Assert
        $this->assertEquals($name, $result);
      }

      function test_getId()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = 1;
        $test_stylist = new Stylist($name, $id);

        //Act
        $result = $test_stylist->getId();

        //Assert
        $this->assertEquals(1, $result);
      }

      function test_setId()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);

        //Act
        $test_stylist->setId(2);

        //Assert
        $result = $test_stylist->getId();
        $this->assertEquals(2, $result);
      }

      function test_save()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        //Act
        $result = Stylist::getAll();

        //Assert
        $this->assertEquals($test_stylist, $result[0]);
      }

      function test_getAll()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = null;
        $name2 = "Stylist Bob";
        $id2 = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();
        $test_stylist2 = new Stylist($name2, $id2);
        $test_stylist2->save();

        //Act
        $result = Stylist::getAll();

        //Assert
        $this->assertEquals([$test_stylist, $test_stylist2], $result);
      }



    }
?>
