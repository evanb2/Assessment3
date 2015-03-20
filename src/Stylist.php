<?php
    class Stylist
    {
      private $name;
      private $id;

      function __construct($name, $id = null)
      {
        $this->name = $name;
        $this->id = $id;
      }

      //setters
      function setName($new_name)
      {
        $this->name = (string) $new_name;
      }

      function setId($new_id)
      {
        $this->id = (int) $new_id;
      }

      //getters
      function getName()
      {
        return $this->name;
      }

      function getId()
      {
        return $this->id;
      }

      //save function
      function save()
      {
        $statement = $GLOBALS['DB']->query("INSERT INTO stylist (name) VALUES ('{$this->getName()}') RETURNING id;");
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $this->setId($result['id']);
      }

      //update function
      function update($new_name)
      {
        $GLOBALS['DB']->exec("UPDATE stylist SET name = '{$new_name}' WHERE id = {$this->getId()};");
        $this->setName($new_name);
      }

      //connect to Client class
      function getClients()
      {
        $clients = array();
        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM client WHERE stylist_id = {$this->getId()};");
        foreach($returned_clients as $client) {
          $name = $client['name'];
          $phone = $client['phone'];
          $email = $client['email'];
          $id = $client['id'];
          $stylist_id = $client['stylist_id'];
          $new_client = new Client($name, $phone, $email, $id, $stylist_id);
          array_push($clients, $new_client);
        }
        return $clients;
      }

      //static functions
      static function getAll()
      {
        $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylist;");
        $stylists = array();
        foreach($returned_stylists as $stylist) {
          $name = $stylist['name'];
          $id = $stylist['id'];
          $new_stylist = new Stylist($name, $id);
          array_push($stylists, $new_stylist);
        }
        return $stylists;
      }

      static function find($search_id)
      {
        $found_stylist = null;
        $stylists = Stylist::getAll();
        foreach($stylists as $stylist) {
          $stylist_id = $stylist->getId();
          if ($stylist_id == $search_id) {
            $found_styist = $stylist;
          }
        }
        return $found_stylist;
      }

      static function deleteAll()
      {
        $GLOBALS['DB']->exec("DELETE FROM stylist *;");
      }

      static function delete()
      {
        $GLOBALS['DB']->exec("DELETE FROM stylist WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM client WHERE stylist_id = {$this->getId()};");
      }

    }
?>
