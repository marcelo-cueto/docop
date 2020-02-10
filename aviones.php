<?php

require_once 'autoload.php';

if ($_POST) {
  if ($_POST['form']=='1') {
    $estado=$_POST['estado'];

    $acts=DB::getPlaneByEstado($estado);


  }elseif ($_POST['form']=='3') {
    $acts=DB::getPlaneByTitulo($_POST['Bti']);


  }else {
    $leg=$_POST['Bus'];

    $user=DB::getUserByLeg($leg);


    $acts=DB::avionActByUser($user['idUsuarios']);
  }

}else{
  $acts=DB::avionAct();
}

$pageTitle = 'home';
require_once 'partials/head.php';
require_once 'partials/navbar.php';
?>
   <section>
  <?php   require_once 'partials/subNav.php' ?>
  <div class="busca">
    <div class="forms">



      <form class="" action="aviones.php" method="post">
        <label for="estado">Estado</label>
        <select class="" name="estado">
          <option value=1>Actualizado</option>
          <option value=0>Pendiente</option>
        </select>
        <input type="hidden" name="form" value="1">
        <button type="submit" name="button">Buscar</button>

      </form>

      <form class="" action="aviones.php" method="post">
        <label for="Bti">Buscar por Titulo</label>
        <input type="text" name="Bti" value="" placeholder="Buscar por titulo">
        <input type="hidden" name="form" value="3">
        <button type="submit" name="button">Buscar</button>
      </form>



      <form class="" action="aviones.php" method="post">
        <label for="Bus">Ingrese Legajo</label>
        <input type="text" name="Bus" value="" placeholder="Buscar por Usuario">
        <input type="hidden" name="form" value="4">
        <button type="submit" name="button">Buscar</button>
      </form>

  </div>
    <table style='width:70%'>
      <tr>
        <td ><strong style='text-align:center'><p>Titulo</p></strong> </td>
        <td><strong style='text-align:center'><p>Matricula</p></strong> </td>
        <td><strong style='text-align:center'><p>Actualizado</p></strong> </td>
        <td><strong style='text-align:center'><p>Usuario</p></strong> </td>

      </tr>


      <?php foreach ($acts as $act): ?>

        <?php



        $tarea=DB::getTaskById($act->getTarea());

        $avion=DB::getPlaneById($act->getAvion());

         ?>
        <tr>
          <td style='text-align:center'><?php echo $tarea['titulo']; ?></td>
          <td style='text-align:center'><?php echo $avion['Matricula'] ;?> </td>
          <?php if ($act->getActualizado()=='0'): ?>
            <td style='text-align:center'><?php echo 'pendiente'; ?> </td>
          <?php else: ?>
            <td style='text-align:center'><?php echo 'actualizado'; ?> </td>
          <?php endif; ?>
          <?php if ($act->getUser()!='0'): ?>
            <td style='text-align:center'><?php
            $idU=$act->getUser();

             $user=DB::getUserById($idU);

            echo $user['Nombre']; ?></td>

          <?php else: ?>
            <td style='text-align:center'><?php echo 'sin tomar'; ?> </td>
          <?php endif; ?>
        </tr>
        <?php endforeach; ?>

      </table>
    </div>






</div>
