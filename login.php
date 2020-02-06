<?php
require_once 'autoload.php';

if($_POST){
  $legajo=$_POST['legajo'];
  $pass=$_POST['password'];




  $save=DB::loger($legajo, $pass);
  header("location:home.php");exit;





}


  $pageTitle = 'Login';
  require_once 'partials/head.php';
  require_once 'partials/navbar.php';
?>
   <section>
     <div class="sectionMenu">

     </div>
     <div class="login">
       <form class="" action="login.php" method="post">
         <div class="">
           <label for="legajo">Legajo</label>
           <input type="text" name="legajo" value="" placeholder="Ingrese su legajo aqui">
         </div>
         <div class="">
           <label for="password">Contraseña</label>
           <input type="password" name="password" value="" placeholder="Ingrese su Contraseña Aqui">
         </div>
         <button type="submit" name="button">Ingresar</button>
       </form>
     </div>
   </section>
 </body>

</html>
