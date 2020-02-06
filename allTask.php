<?php
require_once 'autoload.php';

$u=DB::getUserByLeg($_SESSION['legajo']);
$id=$u['idSector'];

if ($_POST) {
  if ($_POST['form']==1) {
    $estado=$_POST['estado'];

    $tareas=DB::getByEstado($estado);
  }elseif ($_POST['form']==2) {
    $prioridad=$_POST['prioridad'];

    $tareas=DB::getByPiroridad($prioridad);
  }elseif ($_POST['form']==3) {
    $tareas=DB::getTareaByTitulo($_POST['Bti']);
  }else {
    $leg=$_POST['Bus'];

    $user=DB::getUserByLeg($leg);

    $tareas=DB::getTareaByUser($user['idUsuarios']);
  }

}else{
  $tareas=DB::getAllTask();
}
$pageTitle = 'Tareas';
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
          <table>
            <tr>
              <td ><strong style='text-align:center'><p>Titulo</p></strong> </td>
              <td><strong style='text-align:center'><p>Tarea</p></strong> </td>
              <td><strong style='text-align:center'><p>Estado</p></strong> </td>
              <td><strong style='text-align:center'><p>Creado</p></strong> </td>
              <td><strong style='text-align:center'><p>Tomado</p></strong> </td>
              <td><strong style='text-align:center'><p>Finalizado</p></strong> </td>
              <td><strong style='text-align:center'><p>Usuario</p></strong> </td>
              <td><strong style='text-align:center'><p>Editar</p></strong> </td>
            </tr>
            <form class="" action="edit.php" method="post">

            <button type="submit" name="button">Editar Tarea</button>
        <?php foreach ($tareas as $tarea): ?>
          <?php if ($tarea->getSector()==$id): ?>
          <tr>
            <td style='text-align:center'><?php echo $tarea->getTitulo(); ?></td>
            <td style='text-align:center'><?php echo $tarea->getTarea() ;?> </td>
            <td style='text-align:center'><?php echo $tarea->getEstado(); ?> </td>
            <td style='text-align:center'><?php echo $tarea->getFecha_creacion(); ?> </td>
            <td style='text-align:center'><?php echo $tarea->getFecha_toma(); ?> </td>
            <td style='text-align:center'><?php echo $tarea->getFecha_finalizacion(); ?> </td>
            <td style='text-align:center'><?php $u=DB::getUserById($tarea->getUsuario());
             echo $u['Nombre'];?></td>
             <td style='text-align:center'> <input type="radio" name="tarea" value=<?php echo $tarea->getId(); ?>> </td>
          </tr>
        <?php endif; ?>
          <?php endforeach; ?>
          </form>
            </table>
          </div>






  </div>
</section>
