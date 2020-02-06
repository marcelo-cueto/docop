<?php
    Class Imagen {
      private $id;
      private $imagen;
      private $idtarea;

      public function __construct($imagen,$idtarea ) {
         $this->imagen = $imagen;
         $this->idtarea = $idtarea;
         $this->id = $id;

      }
      public function getId() {
         return $this->id;
      }
      public function getImagen() {
         return $this->imagen;
      }

      public function setId($id) {
         $this->id = $id;
      }
      public function setImagen($imagen) {
         $this->nombre = $imagen;
      }
      public function getTarea() {
         return $this->idtarea;
      }

      public function setTarea($idtarea) {
         $this->idtarea = $idtarea;
      }




    }
?>
