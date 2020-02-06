
<?php
	$user = 'root';
	$pass = 'root';
	try {
		$connection = new PDO(
			"mysql:host=localhost; dbname=docpriority; charset=utf8mb4",
			$user,
			$pass,
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
		);
	} catch (PDOException $exception) {
		echo $exception->getMessage();
	}
