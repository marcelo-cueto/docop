<?php


 Class Tarea {
   private $id;
   private $tarea;
   private $estado;
   private $prioridad;
   private $fecha_creacion;
   private $fecha_finalizacion;
   private $fecha_toma;
   private $usuario;
   private $titulo;
   private $sector;
   private $avion;


   public function __construct($tarea, $prioridad, $fecha_creacion,$titulo,$sector,$estado='pendiente', $id=null, $usuario=null, $avion=null) {
      $this->tarea = $tarea;
      $this->estado = $estado;
      $this->id = $id;
      $this->prioridad=$prioridad;
      $this->fecha_creacion=$fecha_creacion;
      $this->titulo = $titulo;
      $this->sector = $sector;
      $this->usuario=$usuario;
      $this->avion=$avion;


   }
   public function getId() {
      return $this->id;
   }
   public function getTarea() {
      return $this->tarea;
   }
   public function getEstado() {
      return $this->estado;
   }
   public function getPrioridad() {
      return $this->prioridad;
   }
   public function getFecha_creacion() {
      return $this->fecha_creacion;
   }
   public function getFecha_finalizacion() {
      return $this->fecha_finalizacion;
   }
   public function getFecha_toma() {
      return $this->fecha_toma;
   }
   public function getUsuario() {
      return $this->usuario;
   }
   public function setId($id) {
      $this->id = $id;
   }
   public function setTarea($tarea) {
      $this->tarea = $tarea;
   }
   public function setEstado($estado) {
      $this->estado = $estado;
   }
   public function setPrioridad($prioridad) {
      $this->prioridad= $prioridad;
   }
   public function setFecha_creacion($fecha_creacion) {
      $this->fecha_creacion = $fecha_creacion;
   }
   public function setFecha_finalizacion($fecha_finalizacion) {
      $this->fecha_finalizacion = $fecha_finalizacion;
   }
   public function setFecha_toma($fecha_toma) {
      $this->fecha_toma = $fecha_toma;
   }
   public function setUsuario($usuario) {
      $this->usuario = $usuario;
   }
   public function getTitulo() {
      return $this->titulo;
   }
   public function setTitulo($titulo) {
      $this->titulo = $titulo;
    }
    public function getSector() {
       return $this->sector;
    }
    public function setSector($sector) {
       $this->sector = $sector;
    }
    public function getAvion() {
       return $this->avion;
    }
    public function setAvion($avion) {
       $this->avion = $avion;
    }



 }
