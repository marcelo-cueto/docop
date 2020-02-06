<?php

Class Tareavion {

  private $id;
  private $tarea;
  private $usuario;
  private $avion;
  private $actualizado;

  public function __construct($tarea, $avion, $usuario=0, $actualizado=0) {
     $this->tarea = $tarea;
     $this->avion = $avion;
     $this->usuario = $usuario;
     $this->actualizado=$actualizado;
     $this->id = $id;



  }
  public function getId() {
     return $this->id;
  }
  public function setId($id) {
     $this->id=$id;
  }
  public function getTarea() {
     return $this->tarea;
  }
  public function setTarea($tarea) {
     $this->tarea=$tarea;
  }
  public function getUser() {
     return $this->usuario;
  }
  public function setUser($usuario) {
     $this->usuario=$usuario;
  }
  public function getAvion() {
     return $this->avion;
  }
  public function setAvion($avion) {
     $this->avion=$avion;
  }
  public function getActualizado() {
     return $this->actualizado;
  }
  public function setActualizado($avion) {
     $this->actualizado=$actualizado;
  }
}
