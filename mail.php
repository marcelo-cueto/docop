<?php
require_once 'autoload.php';
$secs=DB::getSectors();
$loged=DB::getUserByLeg($_SESSION['legajo']);

if($_POST){
  $sectores[]=$_POST['sector'];
  $emailList=[];
  $titulo=$_POST['titulo'];
  $cuerpo=$_POST['cuerpo'];
  foreach ($sectores as $sector ) {
    $users=DB::getUsersBySector($sector);
      foreach ($users as $user) {
        $e=$user->getEmail();
        $emailList[]=$e;
      }
  }
  var_dump($emailList);
  foreach ($emailList as $email) {
    require 'vendor/autoload.php';
    DB::cmail($email,$titulo,$cuerpo);


  }

}

$pageTitle = 'home';
require_once 'partials/head.php';
require_once 'partials/navbar.php';
?>
<section>
<?php   require_once 'partials/subNav.php' ?>
  <div class="email">

    <p>Email enviado</p>
  </div>
</section>
</body>

</html>
