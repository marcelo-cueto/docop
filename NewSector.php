<?php
require_once 'autoload.php';

if ($_POST) {
  

    $algo= new Sector($_POST['nombre']);



    $save=DB::saveSector($algo);
    header('Location: home.php');
}

	$pageTitle = 'home';
	require_once 'partials/head.php';
	require_once 'partials/navbar.php';
?>
     <section>
      <?php   require_once 'partials/subNav.php' ?>
       <div class="cargasUser">
         <form class="" action="NewSector.php" method="post">
           <label for="nombre">Nombre</label> <br>
           <input type="text" name="nombre" value="" placeholder="Inserte el nombre aqui"> <br>



           <button type="submit" name="button">Crear Sector</button><br>
         </form>
       </div>
     </section>
   </body>

 </html>
