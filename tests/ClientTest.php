<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $DB = new PDO('pgsql:host=localhost;dbname=hair_salon_test');

    class ClientTest extends PHPUnit_Framework_TestCase
    {
      protected function tearDown()
      {
        Client::deleteAll();
      }

      function test_getId()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name = "Ken Kesey";
        $phone = "8473453801";
        $email = "sometimes@greatnotion.com";
        $id = 2;
        $stylist_id = $test_stylist->getId();
        $test_client = new Client($name, $phone, $email, $id, $stylist_id);
        $test_client->save();

        //Act
        $result = $test_client->getId();

        //Assert
        $this->assertEquals(true, is_numeric($result));
      }

      function test_getStylist_id()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name = "Ken Kesey";
        $phone = "8473453801";
        $email = "sometimes@greatnotion.com";
        $id = 2;
        $stylist_id = $test_stylist->getId();
        $test_client = new Client($name, $phone, $email, $id, $stylist_id);
        $test_client->save();

        //Act
        $result =$test_client->getStylistId();

        //Assert
        $this->assertEquals(true, is_numeric($result));
      }



      function test_setId()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name = "Ken Kesey";
        $phone = "8473453801";
        $email = "sometimes@greatnotion.com";
        $id = 2;
        $stylist_id = $test_stylist->getId();
        $test_client = new Client($name, $phone, $email, $id, $stylist_id);
        $test_client->save();

        //Act
        $test_client->setId(2);

        //Assert
        $result = $test_client->getId();
        $this->assertEquals(2, $result);
      }

      function test_save()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name = "Ken Kesey";
        $phone = "8473453801";
        $email = "sometimes@greatnotion.com";
        $id = null;
        $stylist_id = $test_stylist->getId();
        $test_client = new Client($name, $phone, $email, $id, $stylist_id);

        //Act
        $test_client->save();

        //Assert
        $result = Client::getAll();
        $this->assertEquals($test_client, $result[0]);
      }

      function test_getAll()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name = "Ken Kesey";
        $phone = "8473453801";
        $email = "sometimes@greatnotion.com";
        $id = 1;
        $stylist_id = $test_stylist->getId();
        $test_client = new Client($name, $phone, $email, $id, $stylist_id);
        $test_client->save();

        $name2 = "Cormac McCarthy";
        $phone2 = "6667778899";
        $email2 = "thekid@bloodmeridian.com";
        $id2 = 2;
        $test_client2 = new Client($name2, $phone2, $email2, $id2, $stylist_id);
        $test_client2->save();

        //Act
        $result = Client::getAll();

        //Assert
        $this->assertEquals([$test_client, $test_client2], $result);

      }

      function test_deleteAll()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name = "Ken Kesey";
        $phone = "8473453801";
        $email = "sometimes@greatnotion.com";
        $id = 1;
        $stylist_id = $test_stylist->getId();
        $test_client = new Client($name, $phone, $email, $id, $stylist_id);
        $test_client->save();

        $name2 = "Cormac McCarthy";
        $phone2 = "6667778899";
        $email2 = "thekid@bloodmeridian.com";
        $id2 = 2;
        $test_client2 = new Client($name2, $phone2, $email2, $id2, $stylist_id);
        $test_client2->save();

        //Act
        Client::deleteAll();

        //Assert
        $result = Client::getAll();
        $this->assertEquals([], $result);
      }

      function test_find()
      {
        //Arrange
        $name = "Stylist Jane";
        $id = null;
        $test_stylist = new Stylist($name, $id);
        $test_stylist->save();

        $name = "Ken Kesey";
        $phone = "8473453801";
        $email = "sometimes@greatnotion.com";
        $id = 1;
        $stylist_id = $test_stylist->getId();
        $test_client = new Client($name, $phone, $email, $id, $stylist_id);
        $test_client->save();

        $name2 = "Cormac McCarthy";
        $phone2 = "6667778899";
        $email2 = "thekid@bloodmeridian.com";
        $id2 = 2;
        $test_client2 = new Client($name2, $phone2, $email2, $id2, $stylist_id);
        $test_client2->save();

        //Act
        $result = Client::find($test_client->getId());

        //Assert
        $this->assertEquals($test_client, $result);
      }


    }
?>
