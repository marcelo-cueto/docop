<?php
    Class Sector {
      private $id;
      private $nombre;


      public function __construct($nombre ) {
         $this->nombre = $nombre;

         $this->id = $id;

      }
      public function getId() {
         return $this->id;
      }
      public function getNombre() {
         return $this->nombre;
      }

      public function setId($id) {
         $this->id = $id;
      }
      public function setNombre($nombre) {
         $this->nombre = $nombre;
      }
      



    }
?>
