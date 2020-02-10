<?php
  require_once 'autoload.php';
  $sectores=DB::getSectors();
  $users=DB::getAllUsers();
  $versiones=DB::getVersion();
  $motores=DB::getMotor();
  $u=DB::getUserByLeg($_SESSION['legajo']);
	$us=$u['idSector'];

  if($_POST){
    $fecha= date("Y-m-d H:i:s", strtotime($_POST['fecha_creacion']));
    $tarea=$_POST['tarea'];
    $piority=$_POST['priority'];
    $titulo=$_POST['titulo'];
    $sector=$_POST['sector'];
    $usuario=$_POST['usuario'];

    switch ($usuario) {
      case 'null':
        $algo=new Tarea($tarea,$piority,$fecha,$titulo,$sector);
        break;

      default:
      $algo=new Tarea($tarea,$piority,$fecha,$titulo,$sector);
      $algo->setUsuario($usuario);
        break;

    }
    $save=DB::saveTarea($algo);
    if (isset($_FILES)) {
    $idtarea=DB::getLastTaskById();
    $id=$idtarea['idtareas'];
    $num=count($_FILES['archivos']['name']);

        for ($i=0; $i <$num ; $i++) {


            $rutanueva='archivos/'.$_FILES['archivos']['name'][$i];

            $rutaactual=$_FILES['archivos']['tmp_name'][$i];

            move_uploaded_file($rutaactual,$rutanueva);

            $arch=$_FILES['archivos']['name'][$i];
            $img=new Imagen($arch,$id);

            DB::saveImages($img);
          }

    }
    if (isset($_POST['plane'])){
      $idtarea=DB::getLastTaskById();
      var_dump($idtarea);
      $id=$idtarea['idtareas'];
      DB::modifyTaskAvion($id);
      $tipo=$_POST['Tipo'];
      if ($tipo!='All') {
        $aviones=DB::getPlane($tipo);
      } else {
        $aviones=DB::getAllPlane();
      }


      foreach ($aviones as $avion) {
       $new=new Tareavion($id,$avion['idAviones']);
       DB::savePlane($new);
      }

    }

header('Location: home.php');








	}
	$pageTitle = 'home';
	require_once 'partials/head.php';
	require_once 'partials/navbar.php';
?>
     <section>
    <?php   require_once 'partials/subNav.php' ?>
       <div class="tra">
         <form class="" action="newJob.php" method="post" enctype="multipart/form-data">

           <label for="titulo">Titulo</label>
           <input type="text" name="titulo" value="" placeholder="Ingrese aqui el titulo">
           <label for="tarea">Tarea</label>
           <textarea name="tarea" rows="8" cols="50" placeholder="Indique aqui la tarea a realizar"></textarea>
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

           </select><br>
           <input type="file" name="archivos[]" value="" multiple=''>
           <?php if ($us==1):?>
             <label for="plane">Aeronave</label>
             <input type="checkbox" id='check'  name="plane" value="1" onchange="javascript:showContent()">
            <?php endif; ?>
            <select class="" id='plane' style="display: none;" name="Tipo">
              <option value="All">Todos</option>
              <option value="B737">B737</option>

              <option value="A330">A330</option>

            </select>

           <input name="fecha_creacion" type="hidden"  value="<?php echo date("Y-m-d H:i:s"); ?>" />
           <button type="submit" name="button">Crear tarea</button>
         </form>
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
