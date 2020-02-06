<?php
require_once 'autoload.php';

  $sectores=DB::getSectors();

if($_POST){
  $nombre=$_POST['nombre'];
  $legajo=$_POST['legajo'];
  $email=$_POST['email'];
  $sector=$_POST['sector'];

  $pass=password_hash($_POST['password'],PASSWORD_DEFAULT);

  $admin=$_POST['admin'];


  $algo= new Usuario($nombre,$legajo,$pass,$admin,$email,$sector);



  $save=DB::saveUser($algo);
  header('Location: home.php');




}
	$pageTitle = 'home';
	require_once 'partials/head.php';
	require_once 'partials/navbar.php';
?>
     <section>
      <?php   require_once 'partials/subNav.php' ?>
       <div class="cargasUser">
         <form class="" action="newUser.php" method="post">
           <label for="nombre">Nombre</label> <br>
           <input type="text" name="nombre" value="" placeholder="Inserte el nombre aqui"> <br>
           <label for="legajo">Legajo</label> <br>
           <input type="text" name="legajo" value="" placeholder="Inserte el legajo aqui"> <br>
           <label for="email">Email</label> <br>
           <input type="email" name="email" value="" placeholder="Inserte el Email aqui"> <br>
           <label for="password">Contraseña</label><br>
           <input type="password" name="password" value=""><br>
           <label for="admin">Es Admin?</label> <br>
           <div class="priority">
             <label for="admin"> Si</label>
             <input type="radio" name="admin" value="1"> <br>
           </div>
           <div class="priority">
             <label for="admin"> No</label>
             <input type="radio" name="admin" value="0"> <br>
           </div>
           <label for="Sector">Sector al que pertenece</label> <br>
           <select class="" name="sector" placeholder='Sector al que pertenece'>

             <?php foreach ($sectores as $sector): ?>

                    <option value="<?=$sector->getId(); ?>"><?=$sector->getNombre(); ?></option>
              <?php endforeach; ?>
           </select><br>

           <button type="submit" name="button">Crear Usuario</button><br>
         </form>
       </div>
     </section>
   </body>

 </html>
