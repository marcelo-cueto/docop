<?php
require_once 'autoload.php';
$secs=DB::getSectors();

if($_POST){
  DB::finalizarTarea($_POST);
  $tarea=DB::getTaskById($_POST['idT']);


}

$pageTitle = 'home';
require_once 'partials/head.php';
require_once 'partials/navbar.php';
?>
<section>
<?php   require_once 'partials/subNav.php' ?>
  <div class="email">
    <form class="" action="mail.php" method="post">
      <div class="sectores">


      <?php foreach ($secs as $sector): ?>

        <label for="sector"><?php echo $sector->getNombre(); ?></label>
        <input type="checkbox" name="sector" value="<?php echo $sector->getId(); ?>">
      <?php endforeach; ?>
      </div>
      <input type="hidden" name="titulo" value="<?php echo $tarea['titulo'] ;?>" >
      <label for="cuerpo">Email</label><br>
      <textarea name="cuerpo" rows="8" cols="80"></textarea><br>
      <input name="fecha_creacion" type="hidden"  value="<?php echo date("Y-m-d H:i:s"); ?>" />
      <button type="submit" name="button">Finalizar tarea</button>
    </form>
  </div>
</section>
</body>

</html>
