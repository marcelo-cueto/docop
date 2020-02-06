<?php
  require_once 'autoload.php';

	$u=$_SESSION['legajo'];
  $us=DB::getUserByLeg($u);


  $tareas=DB::getTaskPlane();
  if($_POST){
    if($_POST['form']=='form2') {
      $carga=$_POST;
      DB::TaskDo($carga);
      header('Location: home.php');
  }elseif($_POST['form']=='3') {

    DB::endTaskPlane($_POST);
    header('Location: home.php');

  }else{
    $acts=DB::avionActById($_POST['idT']);
  }


  }
	$pageTitle = 'home';
	require_once 'partials/head.php';
	require_once 'partials/navbar.php';
?>
     <section>
    <?php   require_once 'partials/subNav.php' ?>

   <div class="busca">

         <table style='width:50%'>
           <tr>
             <td ><strong style='text-align:center'><p>Aeronave</p></strong> </td>
             <td ><strong style='text-align:center'><p>Version</p></strong> </td>
             <td ><strong style='text-align:center'><p>Motor</p></strong> </td>
             <td><strong style='text-align:center'><p>Check</p></strong> </td>


           </tr>
         <form class="" action="cargaAviones.php" method="post">
           <input type="hidden" name="form" value='form2'>
           <input type="hidden" name="user" value=<?php echo $us['idUsuarios'] ; ?>>
         <button type="submit" name="button">Guardar Aviones</button>

         <?php foreach ($acts as $act): ?>



           <tr>
             <td style='text-align:center'><?php

             $idAvion=$act->getAvion();

              $avion=DB::getPlaneById($idAvion);

              echo $avion['Matricula'];?></td>
              <td style='text-align:center'><?php echo $avion['Version'] ?></td>
              <td style='text-align:center'><?php echo $avion['Motor'] ?></td>
             <td style='text-align:center' ><input   type="checkbox" name="hecho[]" value=<?php echo $act->getId(); ?>> </td>

           </tr>

           <?php endforeach; ?>


       </form>

         </table>
         <?php
            if (empty($acts)): ?>
           <form class="" action="cargaAviones.php" method="post">
             <input type="hidden" name="form" value="3">
             <input type="hidden" name="id" value=<?php echo $_POST['idT'] ;?>>
             <input type="hidden" name="fecha" value='<?php echo date("Y-m-d H:i:s"); ?>'>
             <button type="submit" name="button">Finalizar Tarea</button>
           </form>
         <?php endif;
         ?>
       </div>
     </section>
     <script type="text/javascript">
       function showContent() {
             element = document.getElementById("plane");

             check = document.getElementById("check");

             if (check.checked) {
                 element.style.display='block';

             }
             else {
                 element.style.display='none';

             }


         }
     </script>
   </body>

 </html>
