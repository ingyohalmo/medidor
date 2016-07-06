<?php

	function Connection(){
		$servidor="localhost";
		$usuario="root";
		$password="yohalmo95";
		$baseDatos="ebb";

		try {
			$conn = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $password);
		}catch(PDOException $e){
			echo $e->getMessage();
		}

		return $conn;
	}
?>
