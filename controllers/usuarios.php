<?php


 Class Usuario {
   private $id;
   private $nombre;
   private $legajo;
   private $admin;
   private $password;
   private $email;

   public function __construct($nombre, $legajo, $id=null, $admin=0, $password, $email) {
      $this->nombre = $nombre;
      $this->legajo = $legajo;
      $this->id = $id;
      $this->password=$password;
      $this->email=$email;
   }
   public function getId() {
      return $this->id;
   }
   public function getNombre() {
      return $this->nombre;
   }
   public function getLegajo() {
      return $this->legajo;
   }
   public function getadmin() {
      return $this->admin;
   }
   public function getPassword() {
      return $this->password;
   }
   public function setNombre($nombre) {
      $this->nombre = $nombre;
   }
   public function setLegajo($legajo) {
      $this->legajo = $legajo;
   }
   public function setAdmin($admin) {
      $this->admin = $admin;
   }
   public function setPassword($password) {
      $this->password = $password;
   }
   public function getEmail() {
      return $this->email;
   }
   public function setEmail($email) {
      $this->email = $email;
   }




 }
