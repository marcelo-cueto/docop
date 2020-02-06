<?php


  require_once 'controllers/conexion.php';
  require_once 'controllers/sector.php';
  require_once 'controllers/usuario.php';
  require_once 'controllers/tarea.php';
  require_once 'controllers/imagen.php';
  require_once 'controllers/tareavion.php';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  session_start();

  if (isset($_COOKIE["legajo"]) && !isset($_SESSION["legajo"])) {
  $_SESSION["legajo"] = $_COOKIE["legajo"];}
    require_once 'controllers/DB.php';
