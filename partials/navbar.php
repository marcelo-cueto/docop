<?php
if ($_SESSION) {
  $persona=DB::getUserByLeg($_SESSION['legajo']);
}


 ?>
<header>
  <div class="headimg">
    <a href="home.php"> <img src="img/logo.jpg" alt=""></a>
  </div>
  <div class="headmenu">

    <?php if ($_SESSION): ?>
      <a href="crear.php">Menu</a>
      <p>Bienvenido <?=$persona['Nombre']; ?> </p>
    <?php else: ?>
      <a href="login.php">Login</a>
    <?php endif; ?>

  </div>
</header>
