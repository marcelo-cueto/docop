<?php
require('../tareas.php');
  if($_POST){
    $tarea=new Tarea($_POST['nombre'],$_POST['priority'],$_POST['fecha_creacion']);
    $tarea->creacion();
    header('Location:../home.php');
    exit();
  }else{
    header('Location: ../home.php');
  }

 ?>
