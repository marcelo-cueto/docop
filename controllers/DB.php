<?php
	abstract class DB
	{
 //**grabar archivos**//
		public static function saveTarea(Tarea $tarea)
		{
			global $connection;
			try {
				$stmt = $connection->prepare("
					INSERT INTO tareas (tarea, estado, prioridad, fecha_creacion,titulo, fecha_finalizacion,fecha_toma, idUsuario,idSector)
					VALUES(:tarea, :estado, :prioridad, :fecha_creacion,:titulo, :fecha_finalizacion, :fecha_toma,:idUsuario,:idSector)
				");
				$stmt->bindValue(':tarea', $tarea->getTarea());
				$stmt->bindValue(':prioridad', $tarea->getPrioridad());
				$stmt->bindValue(':estado', $tarea->getEstado());
				$stmt->bindValue(':fecha_creacion', $tarea->getFecha_creacion());
				$stmt->bindValue(':titulo', $tarea->getTitulo());
        $stmt->bindValue(':fecha_finalizacion', $tarea->getFecha_finalizacion());
        $stmt->bindValue(':fecha_toma', $tarea->getFecha_toma());
				$stmt->bindValue(':idUsuario', $tarea->getUsuario());
				$stmt->bindValue(':idSector', $tarea->getSector());

				$stmt->execute();
				return true;
			} catch (PDOException $exception) {
				return false;
			}
		}

		public static function saveUser(Usuario $user)
		{
			global $connection;
			try {
				$stmt = $connection->prepare("
					INSERT INTO Usuarios (Nombre, Legajo, admin, password, email, idSector)
					VALUES(:nombre, :legajo, :admin, :password, :email, :idSector)
				");
				$stmt->bindValue(':nombre', $user->getNombre());
				$stmt->bindValue(':legajo', $user->getLegajo());
				$stmt->bindValue(':admin', $user->getAdmin());
				$stmt->bindValue(':password', $user->getPassword());
				$stmt->bindValue(':email', $user->getEmail());
				$stmt->bindValue(':idSector', $user->getSector());

				$stmt->execute();
				return true;
			} catch (PDOException $exception) {
				return false;
			}
		}
		public static function saveSector(Sector $sector)
		{
			global $connection;
			try {
				$stmt = $connection->prepare("
					INSERT INTO sectores (nombre)
					VALUES(:nombre)
				");
				$stmt->bindValue(':nombre', $sector->getNombre());


				$stmt->execute();
				return true;
			} catch (PDOException $exception) {
				return false;
			}
		}
		public static function saveImages(Imagen $imagen )
		{
			 		global $connection;
					try {
						$stmt = $connection->prepare("
							INSERT INTO imagenes (imagen, idtarea)
							VALUES(:imagen, :idtarea)
						");
						$stmt->bindValue(':imagen', $imagen->getImagen());
						$stmt->bindValue(':idtarea', $imagen->getTarea());

						$stmt->execute();
						return true;
					} catch (PDOException $exception) {
						return false;
					}

				}
				public static function modifyTask( $tarea)
				{
					global $connection;
					try {
						$stmt = $connection->prepare("
							UPDATE tareas
							SET tarea=:tarea , titulo=:titulo, prioridad=:prioridad, idUsuario=:idUsuario, idSector=:idSector
							WHERE idtareas=:idTarea
						");
						$stmt->bindValue(':tarea', $tarea['tarea']);
						$stmt->bindValue(':prioridad', $tarea['priority']);
						$stmt->bindValue(':titulo', $tarea['titulo']);
						$stmt->bindValue(':idUsuario', $tarea['usuario']);
						$stmt->bindValue(':idSector', $tarea['sector']);
						$stmt->bindValue(':idTarea', $tarea['id']);

						$stmt->execute();
						return true;
					} catch (PDOException $exception) {
						return false;
					}
				}
				public static function endTaskPlane( $tarea)
				{
					var_dump($tarea);
					global $connection;
					try {
						$stmt = $connection->prepare("
							UPDATE tareas
							SET fecha_finalizacion=:fecha, estado=:estado
							WHERE idtareas=:idTarea
						");
						$stmt->bindValue(':fecha', $tarea['fecha']);
						$stmt->bindValue(':idTarea', $tarea['id']);
						$stmt->bindValue(':estado', 'finalizado');

						$stmt->execute();
						return true;
					} catch (PDOException $exception) {
						return false;
					}
				}
				public static function modifyTaskAvion( $tarea)
				{
					global $connection;
					try {
						$stmt = $connection->prepare("
							UPDATE tareas
							SET avion=:tarea , estado=:estado, fecha_toma=:fecha_toma, idUsuario=:id
							WHERE idtareas=:idTarea
						");
						$stmt->bindValue(':tarea', '1');
						$stmt->bindValue(':estado', 'tomado');
						$stmt->bindValue(':fecha_toma', date("Y-m-d H:i:s"));
						$stmt->bindValue(':idTarea', $tarea);
						$stmt->bindValue(':id', '8');

						$stmt->execute();
						return true;
					} catch (PDOException $exception) {
						return false;
					}
				}
				public static function TaskDo( $tarea)

				{

					$num=count($tarea['hecho']);

					for ($i=0; $i < $num ; $i++) {

						global $connection;

							$stmt = $connection->prepare("
								UPDATE tareavion
								SET actualizado=:tarea , idusuario=:idusuario
								WHERE idtareavion=:idTarea

							");

							$stmt->bindValue(':tarea', 1);
							$stmt->bindValue(':idusuario', $tarea['user']);
							$stmt->bindValue(':idTarea', $tarea['hecho'][$i]);


							$stmt->execute();

					}

				}
				public static function savePlane(Tareavion $new)
				{


					global $connection;

					try {
						$stmt = $connection->prepare("
							INSERT INTO tareavion (idtarea, idavion, actualizado, idusuario)
							VALUES(:idtarea, :idavion, :idusuario, :actualizado )
						");
						$stmt->bindValue(':idtarea', $new->getTarea());
						$stmt->bindValue(':idavion', $new->getAvion());
						$stmt->bindValue(':idusuario',$new->getUser());
						$stmt->bindValue(':actualizado', $new->getActualizado());


						$stmt->execute();
						return true;
					} catch (PDOException $exception) {
						return false;
					}
				}



		//** buscar por estado**//
		public static function getPendientes()
		{
			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM tareas
				WHERE estado = 'pendiente'

				ORDER BY fecha_creacion;
			");
			$stmt->execute();
			$pendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$pendientesObject = [];
			foreach ($pendientes as $pendiente) {
				$finalpendientes = new Tarea($pendiente['tarea'], $pendiente['prioridad'], $pendiente['fecha_creacion'],$pendiente['titulo'], $pendiente['idSector']);

				$finalpendientes->setId($pendiente['idtareas']);

				$finalpendientes->setUsuario($pendiente['idUsuario']);
				$finalpendientes->setAvion($pendiente['avion']);

				$pendientesObject[] = $finalpendientes;

			}
			return $pendientesObject;
		}
		public static function getTaskPlane()
		{
			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM tareas
				WHERE avion = 1
				AND estado != 'finalizado'
				ORDER BY fecha_creacion
			");

			$stmt->execute();
			$pendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$pendientesObject = [];
			foreach ($pendientes as $pendiente) {
				$finalpendientes = new Tarea($pendiente['tarea'], $pendiente['prioridad'], $pendiente['fecha_creacion'],$pendiente['titulo'], $pendiente['idSector']);

				$finalpendientes->setId($pendiente['idtareas']);

				$finalpendientes->setUsuario($pendiente['idUsuario']);
				$finalpendientes->setAvion($pendiente['avion']);

				$pendientesObject[] = $finalpendientes;

			}
			return $pendientesObject;
		}
		public static function getVersion()
		{
			global $connection;
			$stmt = $connection->prepare("
				SELECT DISTINCT Version
				FROM aviones



			");
			$stmt->execute();
			$pendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);


			return $pendientes;
		}

		public static function getPlane($tipo)
		{


				global $connection;
				$stmt = $connection->prepare("
					SELECT *
					FROM aviones
					WHERE modelo='$tipo'

				");


			$stmt->execute();
			$pendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$pendientessObject = [];


			return $pendientes;
		}
		public static function getAllPlane()
		{


				global $connection;
				$stmt = $connection->prepare("
					SELECT *
					FROM aviones
					

				");


			$stmt->execute();
			$pendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$pendientessObject = [];


			return $pendientes;
		}
		public static function avionAct(){
			global $connection;

			$stmt = $connection->prepare("
			   SELECT *
				 FROM tareavion
				 ORDER BY idtareavion
				 ");
			$stmt->execute();
			$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $tareas;



		}
		public static function avionActById($id){
			global $connection;

			$stmt = $connection->prepare("
			   SELECT *
				 FROM tareavion
				 WHERE idtarea='$id'
				 AND actualizado!=1
				 ");


			$stmt->execute();
			$pendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$pendientesObject = [];
			foreach ($pendientes as $pendiente) {
				$finalpendientes = new Tareavion($pendiente['idtarea'], $pendiente['idavion']);

				$finalpendientes->setId($pendiente['idtareavion']);



				$pendientesObject[] = $finalpendientes;

			}
			return $pendientesObject;
		}


		public static function getMotor()
		{
			global $connection;
			$stmt = $connection->prepare("
				SELECT DISTINCT Motor
				FROM aviones



			");
			$stmt->execute();
			$pendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);


			return $pendientes;
		}
		public static function getTake()
		{
			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM tareas
				WHERE estado = 'tomado'

				ORDER BY fecha_toma;
			");
			$stmt->execute();
			$tomados = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$tomadosObject = [];
			foreach ($tomados as $tomado) {

				$finaltomados = new Tarea($tomado['tarea'], $tomado['prioridad'], $tomado['fecha_creacion'],$tomado['titulo'],$tomado['idSector']);

				$finaltomados->setId($tomado['idtareas']);
				$finaltomados->setFecha_toma($tomado['fecha_toma']);
				$finaltomados->setUsuario($tomado['idUsuario']);
				$finaltomados->setAvion($tomado['avion']);


				$tomadosObject[] = $finaltomados;

			}
			return $tomadosObject;
		}
		public static function getEnd()
		{
			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM tareas
				WHERE estado = 'finalizado'
				AND fecha_finalizacion>= date_sub(curdate(), interval 1 day)

				ORDER BY fecha_toma;
			");
			$stmt->execute();
			$tomados = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$tomadosObject = [];
			foreach ($tomados as $tomado) {

				$finaltomados = new Tarea($tomado['tarea'], $tomado['prioridad'], $tomado['fecha_creacion'],$tomado['titulo'],$tomado['idSector']);

				$finaltomados->setId($tomado['idtareas']);
				$finaltomados->setFecha_toma($tomado['fecha_toma']);
				$finaltomados->setUsuario($tomado['idUsuario']);
				$finaltomados->setFecha_finalizacion($tomado['fecha_finalizacion']);
				$finaltomados->setUsuario($tomado['avion']);


				$tomadosObject[] = $finaltomados;

			}
			return $tomadosObject;
		}

	//**loguer**//
		public static function loger($legajo, $pass)
		{
			global $connection;
			$query = $connection->prepare("
				SELECT *
				FROM Usuarios
				WHERE Legajo = '$legajo'



			");

			$query->execute();

			$info=$query->fetch();

			if(password_verify($pass,$info['password'])){


					$_SESSION['legajo']=$info['Legajo'];

					setcookie("legajo", $_SESSION['Legajo'], time() + 60 * 60 * 24 * 30);
				}else{
					echo '<p> Esta mal logueado</p>';

				 }
		}

		//**Buscar Usuario**//
		public static function getUserByLeg($leg)
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM Usuarios
				WHERE Legajo = $leg
			");
			$stmt->execute();
			$usuario = $stmt->fetch();


			return $usuario;
		}
		public static function getUserById($id)
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM Usuarios
				WHERE idUsuarios = $id
			");

			$stmt->execute();

			$usuario = $stmt->fetch();


			return $usuario;
		}
		public static function getAllUsers()
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM Usuarios
			");
			$stmt->execute();
			$users = $stmt->fetchAll();

			$usersObject = [];
			foreach ($users as $user) {

				$finalusers = new Usuario($user['Nombre'], $user['Legajo'], $user['password'],$user['admin'],$user['email'],$user['idSector']);
				$finalusers->setId($user['idUsuarios']);



				$usersObject[] = $finalusers;

			}

			return $usersObject;
		}
		//**Buscar Sector**//
		public static function getSectoById($id)
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM Sectores
				WHERE Legajo = $id
			");
			$stmt->execute();
			$usuario = $stmt->fetch();


			return $usuario;
		}
		public static function getSectors()
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM sectores
			");

			$stmt->execute();
			$sectores = $stmt->fetchAll();

			$sectorObject = [];
			foreach ($sectores as $sector) {

				$finalsector = new Sector($sector['nombre']);

				$finalsector->setId($sector['idsectores']);



				$sectorObject [] = $finalsector;

			}
			return $sectorObject;
		}
		//**Buscar tareas**//
		public static function getTareaByTitulo($titulo)
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM tareas
				WHERE titulo LIKE '%$titulo%'
				ORDER BY fecha_creacion
			");
			$stmt->execute();
			$tareas = $stmt->fetchAll();
			$tareasObject = [];
			foreach ($tareas as $tarea) {

				$finaltomados = new Tarea($tarea['tarea'], $tarea['prioridad'], $tarea['fecha_creacion'],$tarea['titulo'],$tarea['idSector']);

				$finaltomados->setId($tarea['idtareas']);
				$finaltomados->setEstado($tarea['estado']);
				$finaltomados->setFecha_toma($tarea['fecha_toma']);
				$finaltomados->setUsuario($tarea['idUsuario']);
				$finaltomados->setFecha_finalizacion($tarea['fecha_finalizacion']);


				$tareasObject[] = $finaltomados;

			}
			return $tareasObject;
		}
		public static function getTareaByUser($id)
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM tareas
				WHERE idUsuario = $id
				ORDER BY fecha_creacion
			");
			$stmt->execute();
			$tareas = $stmt->fetchAll();
			$tareasObject = [];
			foreach ($tareas as $tarea) {

				$finaltomados = new Tarea($tarea['tarea'], $tarea['prioridad'], $tarea['fecha_creacion'],$tarea['titulo'],$tarea['idSector']);

				$finaltomados->setId($tarea['idtareas']);
				$finaltomados->setEstado($tarea['estado']);
				$finaltomados->setFecha_toma($tarea['fecha_toma']);
				$finaltomados->setUsuario($tarea['idUsuario']);
				$finaltomados->setFecha_finalizacion($tarea['fecha_finalizacion']);


				$tareasObject[] = $finaltomados;

			}
			return $tareasObject;


			return $tareas;
		}
		public static function getAllTask()
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM tareas
				ORDER BY fecha_creacion
			");
			$stmt->execute();
			$tareas = $stmt->fetchAll();
			$tareasObject = [];
			foreach ($tareas as $tarea) {

				$finaltomados = new Tarea($tarea['tarea'], $tarea['prioridad'], $tarea['fecha_creacion'],$tarea['titulo'],$tarea['idSector']);

				$finaltomados->setId($tarea['idtareas']);
				$finaltomados->setEstado($tarea['estado']);
				$finaltomados->setFecha_toma($tarea['fecha_toma']);
				$finaltomados->setUsuario($tarea['idUsuario']);
				$finaltomados->setFecha_finalizacion($tarea['fecha_finalizacion']);


				$tareasObject[] = $finaltomados;

			}
			return $tareasObject;



		}
		public static function getByEstado($estado)
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM tareas
				WHERE estado = '$estado'
				ORDER BY fecha_creacion
			");

			$stmt->execute();
			$tareas = $stmt->fetchAll();

			$tareasObject = [];
			foreach ($tareas as $tarea) {

				$finaltomados = new Tarea($tarea['tarea'], $tarea['prioridad'], $tarea['fecha_creacion'],$tarea['titulo'],$tarea['idSector']);

				$finaltomados->setId($tarea['idtareas']);
				$finaltomados->setEstado($tarea['estado']);
				$finaltomados->setFecha_toma($tarea['fecha_toma']);
				$finaltomados->setUsuario($tarea['idUsuario']);
				$finaltomados->setFecha_finalizacion($tarea['fecha_finalizacion']);


				$tareasObject[] = $finaltomados;

			}
			return $tareasObject;



		}
		public static function getByPiroridad($prioridad)
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM tareas
				WHERE prioridad = '$prioridad'
				ORDER BY fecha_creacion
			");

			$stmt->execute();
			$tareas = $stmt->fetchAll();

			$tareasObject = [];
			foreach ($tareas as $tarea) {

				$finaltomados = new Tarea($tarea['tarea'], $tarea['prioridad'], $tarea['fecha_creacion'],$tarea['titulo'],$tarea['idSector']);

				$finaltomados->setId($tarea['idtareas']);
				$finaltomados->setEstado($tarea['estado']);
				$finaltomados->setFecha_toma($tarea['fecha_toma']);
				$finaltomados->setUsuario($tarea['idUsuario']);
				$finaltomados->setFecha_finalizacion($tarea['fecha_finalizacion']);


				$tareasObject[] = $finaltomados;

			}
			return $tareasObject;



		}
		public static function getLastTaskById()
		{

			global $connection;
			$stmt = $connection->prepare("
			SELECT  *
			FROM tareas
			ORDER BY idtareas DESC
			");

			$stmt->execute();

			$tarea = $stmt->fetch();



			return $tarea;
		}
		public static function getTaskById($id)
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM tareas
				WHERE idtareas = $id
			");

			$stmt->execute();

			$tarea = $stmt->fetch();



			return $tarea;
		}
		public static function getPlaneById($id)
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM aviones
				WHERE idaviones = $id
			");

			$stmt->execute();

			$avion = $stmt->fetch();



			return $avion;
		}
		public static function getUsersBySector($id)
		{

			global $connection;
			$stmt = $connection->prepare("
				SELECT *
				FROM Usuarios
				WHERE IdSector= $id
			");

			$stmt->execute();
			$users = $stmt->fetchAll();

			$usersObject = [];
			foreach ($users as $user) {

				$finalusers = new Usuario($user['Nombre'], $user['Legajo'], $user['password'],$user['admin'],$user['email'],$user['idSector']);
				$finalusers->setId($user['idUsuarios']);



				$usersObject[] = $finalusers;

			}

			return $usersObject;
		}
		//**Operaciones sobre estado**//
		public static function tomarTarea($toma)
		{
			$fecha=$toma['fecha'];
			$us=$toma['idU'];
			$idT=$toma['idT'];

			global $connection;
			try {
				$stmt = $connection->prepare("
					UPDATE tareas
					SET fecha_toma='$fecha', idUsuario=$us, estado='tomado'
					 	WHERE idtareas=$idT
				");

				$stmt->execute();

				return true;
			} catch (PDOException $exception) {
				return false;
			}
		}

		public static function finalizarTarea($finalizar)
		{
			$fecha=$finalizar['fecha'];
			$idT=$finalizar['idT'];

			global $connection;
			try {
				$stmt = $connection->prepare("
					UPDATE tareas
					SET fecha_finalizacion='$fecha', estado='finalizado'
					WHERE idtareas=$idT
				");

				$stmt->execute();

				return true;
			} catch (PDOException $exception) {
				return false;
			}
		}
		/** Mail**/
		public static function cmail($email, $titulo, $cuerpo){

			$mail = new PHPMailer(true);

			try {
			    //Server settings
			    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			    $mail->isSMTP();                                            // Send using SMTP
			    $mail->Host       = 'smtp.office365.com';
					$mail->SMTPAuth   = true;
			    $mail->SMTPSecure   = 'tls';                                   // Enable SMTP authentication
			    $mail->Username   = 'marcelo.cueto@aerolineas.com.ar';                     // SMTP username
			    $mail->Password   = 'Inicio10*';                               // SMTP password
			    $mail->Port       = 587;                                    // TCP port to connect to

			    //Recipients
			    $mail->setFrom('marcelo.cueto@aerolineas.com.ar', 'Mailer');
			    $mail->addAddress($email, 'toEmail');     // Add a recipient



			    // Content
			    $mail->isHTML(true);                                  // Set email format to HTML
			    $mail->Subject = $titulo;
			    $mail->Body    = $cuerpo;


			    $mail->send();

			    echo 'Message has been sent';
			} catch (Exception $e) {
			    echo "Message could not be sent. Mailer Error: $mail->ErrorInfo";
			}
		}







	}
