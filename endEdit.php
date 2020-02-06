<?php
require_once 'autoload.php';



if($_POST){
  DB::modifyTask($_POST);
  header('Location: home.php');

}

$pageTitle = 'home';
require_once 'partials/head.php';
require_once 'partials/navbar.php';
?>
<section>

</section>
</body>

</html>
