<?php
require_once 'autoload.php';
$sectores=DB::getSectors();
$users=DB::getAllUsers();

$u=DB::getUserByLeg($_SESSION['legajo']);
$us=$u['idSector'];


if($_POST){
  $tarea=DB::getTaskById($_POST['tarea']);

}

$pageTitle = 'home';
require_once 'partials/head.php';
require_once 'partials/navbar.php';
?>
<section>
<?php   require_once 'partials/subNav.php' ?>
  <div class="edit">
    <form class="" action="endEdit.php" method="post">
      <label for="titulo">Titulo</label>
      <input type="text" name="titulo" value=<?php echo $tarea['titulo']; ?> >
      <label for="tarea">Tarea</label>
      <textarea name="tarea" rows="8" cols="50" ><?php echo $tarea['tarea']; ?></textarea>
      <label for="priority">Prioridad</label>
      <div class="radio">
        <label for="priority">Baja</label>
        <input type="radio" name="priority" value="baja">
      </div>
      <div class="radio">
        <label for="priority">Media</label>
        <input type="radio" name="priority" value="media">
      </div>
      <div class="radio">
        <label for="priority">Alta</label>
        <input type="radio" name="priority" value="alta">
      </div>
      <div class="radio">
        <label for="priority">Urgente</label>
        <input type="radio" name="priority" value="urgente">
      </div>
      <label for="Sector">Sector</label> <br>
      <select class="" name="sector" placeholder='Sector al que pertenece'>

        <?php foreach ($sectores as $sector): ?>

               <option value="<?=$sector->getId(); ?>"><?=$sector->getNombre(); ?></option>
         <?php endforeach; ?>
      </select><br>
      <label for="Sector">Usuario</label> <br>
      <select class="" name="usuario">
        <option value='null'></option>
        <?php foreach ($users as $user): ?>
          <?php if ($user->getSector()==$us): ?>
               <option value="<?php echo $user->getId(); ?>"><?=$user->getNombre(); ?></option>
           <?php endif; ?>
         <?php endforeach; ?>
         <input type="hidden" name="id" value="<?php echo $tarea['idtareas'] ?>">

      </select><br>
      <button type="submit" name="button">Modificar tarea</button>
    </form>

  </div>
</section>
</body>

</html>
