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

      //static functions
      static function deleteAll()
      {
        $GLOBALS['DB']->exec("DELETE FROM stylist *;");
      }

    }
?>
