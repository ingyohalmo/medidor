<?php
 
$servidor="localhost";
$usuario="root";
$password="yohalmo95";
$baseDatos="ebb";
try {
    $conn = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM medidor"); 
    
    $stmt->execute();
    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
echo json_encode($result);
$conn = null;
?>