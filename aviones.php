<?php

require_once 'autoload.php';
$acts=DB::avionAct();

$pageTitle = 'home';
require_once 'partials/head.php';
require_once 'partials/navbar.php';
?>
   <section>
  <?php   require_once 'partials/subNav.php' ?>
  <div class="busca">
    <div class="forms">
      <form class="" action="allTask.php" method="post">
        <label for="estado">Estado</label>
        <select class="" name="estado">
          <option value="pendiente">Pendiente</option>
          <option value="tomado">Tomado</option>
          <option value="finalizado">Finalizado</option>

        </select>
        <input type="hidden" name="form" value="1">
        <button type="submit" name="button">Buscar</button>
      </form>
      <form class="" action="allTask.php" method="post">
        <label for="prioridad">Prioridad</label>
        <select class="" name="prioridad">
          <option value="baja">Baja</option>
          <option value="media">Media</option>
          <option value="alta">Alta</option>
          <option value="urgente">Urgente</option>

        </select>
        <input type="hidden" name="form" value="2">
        <button type="submit" name="button">Buscar</button>
      </form>
      <form class="" action="allTask.php" method="post">
        <label for="Bti">Buscar por Titulo</label>
        <input type="text" name="Bti" value="" placeholder="Buscar por titulo">
        <input type="hidden" name="form" value="3">
        <button type="submit" name="button">Buscar</button>
      </form>
      <form class="" action="allTask.php" method="post">
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
      <form class="" action="edit.php" method="post">

      <button type="submit" name="button">Editar Tarea</button>

      <?php foreach ($acts as $act): ?>

        <?php



        $tarea=DB::getTaskById($act['idtarea']);

        $avion=DB::getPlaneById($act['idavion']);

         ?>
        <tr>
          <td style='text-align:center'><?php echo $tarea['titulo']; ?></td>
          <td style='text-align:center'><?php echo $avion['Matricula'] ;?> </td>
          <?php if ($act['actualizado']!='1'): ?>
            <td style='text-align:center'><?php echo 'pendiente'; ?> </td>
          <?php else: ?>
            <td style='text-align:center'><?php echo 'actualizado'; ?> </td>
          <?php endif; ?>
          <?php if ($act['idusuario']!=0): ?>
            <td style='text-align:center'><?php $user=DB::getUserById($act['idusuario']);
            echo $user['Nombre']; ?></td>

          <?php else: ?>
            <td style='text-align:center'><?php echo 'sin tomar'; ?> </td>
          <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </form>
      </table>
    </div>






</div>
