<?php
   	include("connect.php");
   	
   	$link=Connection();

	$volt=$_POST["volt"];
	$corr=$_POST["corr"];
	$energ=$_POST["energ"];

	 
   	try {
		$sql = "INSERT INTO medidor (voltaje, corriente, energia) VALUES ('".$volt."', '".$corr."', '".$energ."')";
		$link->exec($sql);
	}catch(PDOException $e){
		echo $e->getMessage();
	}
	
	$link = null;

   	header("Location: index.php");
?>
