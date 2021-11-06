<?php

require_once '../api/config/database.php'; 
$database = new Database();
$db = $database->getConnection();

$nivelNumero=$_POST['numeroNivel'];
$nivelNombre = $_POST['tituloNivel'];
$nivelCosto=$_POST['costoNivel'];
$nivelContenido=$_POST['descNivel'];
//$nivelVideo = 0;
//$nivelPDF = 0;
$cursoId = $_POST['idCourse'];

$query = "INSERT INTO nivel
SET
nivelNumero = :nivelNumero,
nivelNombre = :nivelNombre,
nivelCosto  = :nivelCosto ,
nivelContenido = :nivelContenido,
cursoId = :cursoId";


// prepare the query
$stmt = $db->prepare($query);

// bind the values
$stmt->bindParam(':nivelNumero', $nivelNumero);
$stmt->bindParam(':nivelNombre', $nivelNombre);
$stmt->bindParam(':nivelCosto', $nivelCosto);
$stmt->bindParam(':nivelContenido', $nivelContenido);
$stmt->bindParam(':cursoId', $cursoId);



if($stmt->execute()){


	print_r($nivelNombre);

	return true;
}
else
{
	print_r("Error al agregar curso. Intente de nuevo");
   return false;
}


?>











