<?php

require_once '../api/config/database.php'; 
$database = new Database();
$db = $database->getConnection();

$nivelNumero=$_POST['numeroNivel'];
$nivelNombre = $_POST['tituloNivel'];
$nivelCosto=$_POST['costoNivel'];
$nivelContenido=$_POST['descNivel'];
$nivelVideo = 0;
$nivelPDF = 0;
$cursoId = $_POST['idCourse'];

//https://stackoverflow.com/questions/14758191/how-to-use-filesfilesize/14758827
define('MB', 1048576);

$allowedExts = array("mp4");
$extension = pathinfo($_FILES['videoNivel']['name'], PATHINFO_EXTENSION);

if ((($_FILES["videoNivel"]["type"] == "video/mp4")) && ($_FILES["videoNivel"]["size"] < 10*MB) && in_array($extension, $allowedExts))
{
  if ($_FILES["videoNivel"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["videoNivel"]["error"] . "<br />";
    }
  else
    {

	$img_ex_lc = strtolower($_FILES["videoNivel"]["name"]);
	$nivelVideo = uniqid("VID-LEVEL-", true).'.'.$img_ex_lc;
	$img_upload_path = '../uploads/'.$nivelVideo;
	move_uploaded_file($_FILES["videoNivel"]["tmp_name"], $img_upload_path);

    }
  }
else
{
  echo "Invalid file";
}

$allowedExtsP = array("pdf");
$extensionP = pathinfo($_FILES['pdfNivel']['name'], PATHINFO_EXTENSION);

if ((($_FILES["pdfNivel"]["type"] == "application/pdf")) && in_array($extensionP, $allowedExtsP))
{
  if ($_FILES["pdfNivel"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["pdfNivel"]["error"] . "<br />";
    }
  else
    {

	$img_ex_lc = strtolower($_FILES["pdfNivel"]["name"]);
	$nivelPDF = uniqid("PDF-LEVEL-", true).'.'.$img_ex_lc;
	$img_upload_path = '../uploads/'.$nivelPDF;
	move_uploaded_file($_FILES["pdfNivel"]["tmp_name"], $img_upload_path);

    }
  }
else
{
  echo "Invalid file";
}





$query = "INSERT INTO nivel
SET
nivelNumero = :nivelNumero,
nivelNombre = :nivelNombre,
nivelCosto  = :nivelCosto,
nivelVideo = :nivelVideo,
nivelPDF = :nivelPDF,
nivelContenido = :nivelContenido,
cursoId = :cursoId";


// prepare the query
$stmt = $db->prepare($query);

// bind the values
$stmt->bindParam(':nivelNumero', $nivelNumero);
$stmt->bindParam(':nivelNombre', $nivelNombre);
$stmt->bindParam(':nivelCosto', $nivelCosto);
$stmt->bindParam(':nivelContenido', $nivelContenido);
$stmt->bindParam(':nivelVideo', $nivelVideo);
$stmt->bindParam(':nivelPDF', $nivelPDF);
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











