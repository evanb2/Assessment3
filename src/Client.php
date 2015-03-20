<?php
    class Client
    {
      private $name;
      private $phone;
      private $email;
      private $id;

      function __construct($name, $phone, $email, $id = null)
      {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->id = $id;
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

      //save
      function save()
      {
        $statement = $GLOBALS['DB']->query("INSERT INTO client (name, phone, email)
          VALUES ('{$this->getName()}', '{$this->getPhone()}', '{$this->getEmail()}') RETURNING id;");
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $this->setId($result['id']);
      }

      //static functions
      static function getAll()
      {
        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM client;");
        $clients = array();
        foreach($returned_clients as $client) {
          $name = $client['name'];
          $phone = $client['phone'];
          $email = $client['email'];
          $id = $client['id'];
          $new_client = new Client($name, $phone, $email, $id);
          array_push($clients, $new_client);
        }
        return $clients;
      }

      static function deleteAll()
      {
        $GLOBALS['DB']->exec("DELETE FROM client *;");
      }


    }
?>
