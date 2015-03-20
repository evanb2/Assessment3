<?php
    class Client
    {
      private $name;
      private $phone;
      private $email;
      private $id;
      private $stylist_id;

      function __construct($name, $phone, $email, $id = 1, $stylist_id)
      {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->id = $id;
        $this->stylist_id = $stylist_id;
      }

      //setters
      function setName($new_name)
      {
        $this->name = (string) $new_name;
      }

      function setPhone($new_phone)
      {
        $this->phone = (string) $new_phone;
      }

      function setEmail($new_email)
      {
        $this->email = (string) $new_email;
      }

      function setId($new_id)
      {
        $this->id = (int) $new_id;
      }

      function setStylistId($new_stylist_id)
      {
        $this->stylist_id = (int) $new_stylist_id;
      }

      //getters
      function getName()
      {
        return $this->name;
      }

      function getPhone()
      {
        return $this->phone;
      }

      function getEmail()
      {
        return $this->email;
      }

      function getId()
      {
        return $this->id;
      }

      function getStylistId()
      {
        return $this->stylist_id;
      }

      //save
      function save()
      {
        $statement = $GLOBALS['DB']->query("INSERT INTO clients (name, phone, email, stylist_id)
          VALUES ('{$this->getName()}', '{$this->getPhone()}', '{$this->getEmail()}', {$this->getStylistId()}) RETURNING id;");
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $this->setId($result['id']);
      }

      //static functions
      static function getAll()
      {
        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
        $clients = array();
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

      static function find($search_id)
      {
        $found_client = null;
        $clients = Client::getAll();
        foreach($clients as $client) {
          $client_id = $client->getId();
          if ($client_id == $search_id) {
            $found_client = $client;
          }
        }
        return $found_client;
      }

      static function deleteAll()
      {
        $GLOBALS['DB']->exec("DELETE FROM clients *;");
      }


    }
?>
