<?php
	require_once 'autoload.php';

	if($_SESSION['legajo']){
	$u=DB::getUserByLeg($_SESSION['legajo']);
	$idU=$u['idUsuarios'];
	$id=$u['idSector'];

	}
	$pendings=DB::getPendientes();

	$tomadas=DB::getTake();

	$finalizadas=DB::getEnd();




	$pageTitle = 'home';
	require_once 'partials/head.php';
	require_once 'partials/navbar.php';

	if ($_POST){

		if($_POST['f']=='form1'){

			DB::tomarTarea($_POST);
			header('Location: home.php');
		}else{
			DB::finalizarTarea($_POST);
			header('Location: home.php');
		}
	}
?>



    <section>
      <div class="pendiente">
				<h2>Pendientes</h2>
				<?php foreach ($pendings as $pending): ?>
					<?php if ($pending->getSector()==$id): ?>


							<div class="popup" style="<?php if ($pending->getPrioridad()=='baja'):?> background-color: #2be62b <?php elseif ($pending->getPrioridad()=='media'): ?> background-color: #f5e609	 <?php elseif ($pending->getPrioridad()=='alta'): ?> background-color: orange <?php else: ?> background-color: red <?php endif; ?>" >
								<div class="popuph">
									<p><?php echo $pending->getTitulo();?></p>
									<p class='fecha'><?php echo $pending->getFecha_creacion(); ?></p>

								</div>

											<h3><?php echo $pending->getTarea(); ?></h3>
											<div class="sub">
												<?php if ($pending->getUsuario()!=NULL): ?>
													<p class="who"><?php
													$nP=DB::getUserById($pending->getUsuario());
													$a=$nP['Nombre'];
													echo $a; ?></p>
												<?php endif; ?>
											<?php if($pending->getAvion()!=1): ?>
													<form class="" action="home.php" method="post">
														<input type="hidden" name="f" value="form1">
														<input type="hidden" name="idU" value='<?php echo $persona['idUsuarios'] ;?>'>
														<input type="hidden" name="idT" value= '<?php echo  $pending->getId(); ?>'>
														<input type="hidden" name="fecha" value='<?php echo date("Y-m-d H:i:s"); ?>'>
														<input class='submit'type="submit" class=""  value="Tomar trabajo"/>
													</form>
										<?php endif; ?>
									</div>
								</div>


				<?php endif; ?>
			<?php endforeach; ?>

      </div>
      <div class="tomado">
				<h2>Tomados</h2>
				<?php foreach ($tomadas as $tomada): ?>
					<?php if ($tomada->getSector()==$id): ?>

					<div class="popup" style="<?php if ($tomada->getPrioridad()=='baja'):?> background-color: #2be62b <?php elseif ($tomada->getPrioridad()=='media'): ?> background-color: #f5e609 <?php elseif ($tomada->getPrioridad()=='alta'): ?> background-color: orange <?php else: ?> background-color: red <?php endif; ?>" >
						<div class="popuph">
							<p><?php echo $tomada->getTitulo(); ?></p>
							 <p class='fecha'><?php $horato= $tomada->getFecha_toma();
							 $date1 = new DateTime($horato);
							 $date2 = new DateTime('now');
							 $diff = $date1->diff($date2);


							 echo ( ($diff->d * 24 ) * 60 )+($diff->H*60) + ( $diff->i ) . ' minutes'; ?> </p>

						 </div>
						<h3><?php echo $tomada->getTarea(); ?></h3>

						<div class="sub">
							<p class='who'><?php
							$nT=DB::getUserById($tomada->getUsuario());
							echo $nT['Nombre'];
							?></p>
							<?php if($tomada->getAvion()!=1): ?>
							<form class="" action="finalizar.php" method="post">
								<input type="hidden" name="f" value="form2">
								<input type="hidden" name="idT" value= <?php echo  $tomada->getId(); ?>>
								<input type="hidden" name="fecha" value='<?php echo date("Y-m-d H:i:s"); ?>'>
								<input class='submit'type="submit" class=""  value="Finalizar"/>
							</form>
						<?php else: ?>
							<form class="" action="cargaAviones.php" method="post">
								<input type="hidden" name="form" value="form0">
								<input type="hidden" name="idT" value= <?php echo  $tomada->getId(); ?>>
								<input type="hidden" name="fecha" value='<?php echo date("Y-m-d H:i:s"); ?>'>
								<input class='submit'type="submit" class=""  value="Actualizar" />
							</form>
						<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
      </div>
      <div class="finalizado">
				<h2>Finalizados</h2>
				<?php foreach ($finalizadas as $finalizada): ?>

					<?php if ($finalizada->getSector()==$id): ?>
						<div class="popup" style="<?php if ($finalizada->getPrioridad()=='baja'):?> background-color: #2be62b <?php elseif ($finalizada->getPrioridad()=='media'): ?> background-color: #f5e609 <?php elseif ($finalizada->getPrioridad()=='alta'): ?> background-color: orange <?php else: ?> background-color: red <?php endif; ?>" >
						<div class="popuph">
						<p><?php echo $finalizada->getTitulo(); ?></p>
						<p class='fecha'><?php $horafi= $finalizada->getFecha_finalizacion();
							 $horato= $finalizada->getFecha_toma();
							 $date1 = new DateTime($horato);
							 $date2 = new DateTime($horafi);
							 $diff = $date1->diff($date2);
							 echo ( ($diff->d * 24 ) * 60 )+($diff->H*60) + ( $diff->i ) . ' minutes';?></p>

						</div>
						<h3><?php echo $finalizada->getTarea(); ?></h3>
						<div class="sub">
							<p class='who'><?php
							$nT=DB::getUserById($finalizada->getUsuario());
							echo $nT['Nombre'];
							?></p>

						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
      </div>
    </section>
  </body>
</html>
