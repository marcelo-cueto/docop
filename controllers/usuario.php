<?php


 Class Usuario {
   private $id;
   private $nombre;
   private $legajo;
   private $admin;
   private $password;
   private $email;
   private $sector;

   public function __construct($nombre, $legajo, $password, $admin=0,$email, $sector, $id=null) {
      $this->nombre = $nombre;
      $this->legajo = $legajo;
      $this->admin = $admin;
      $this->id = $id;
      $this->password=$password;
      $this->email = $email;
      $this->sector = $sector;
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
   public function getAdmin() {
      return $this->admin;
   }
   public function getPassword() {
      return $this->password;
   }
   public function setId($id) {
      $this->id = $id;
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
   public function getSector() {
      return $this->sector;
   }
   public function setSector($sector) {
      $this->sector = $sector;
   }


 }
