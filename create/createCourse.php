<?php
/*
https://stackoverflow.com/questions/10899384/uploading-both-data-and-files-in-one-form-using-ajax*/ 
/*if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "db_conn.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];

	$imgData = addslashes(file_get_contents($_FILES['my_image']['tmp_name']));

	$error = $_FILES['my_image']['error'];

	

	if ($error === 0) {
		if ($img_size > 125000) {
			$em = "Sorry, your file is too large.";
		    header("Location: index.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database


				$sql = "INSERT INTO testtable(image_url)
        		VALUES('{$imgData}')";


				//$sql = "INSERT INTO testtable(image_url) 
				      //  VALUES('$new_img_name')";

				mysqli_query($conn, $sql);
				header("Location: view.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: index.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: index.php?error=$em");
	}

}else {
	header("Location: index.php");
}*/

require_once '../api/config/database.php'; 
$database = new Database();
$db = $database->getConnection();


$cursoNombre = $_POST['tituloCreate'];
$cursoDescripcion = $_POST['descCreate'];
$cursoCosto=$_POST['costoCreate'];
$cursoNiveles=$_POST['nivelesCreate'];
$cursoVideoIntroductorio = 0;
$cursoMiniatura=0;
$cursoEstado = 0;
$cursoProfesorMail=$_POST['usuarioCreate'];
$cursoProfesorId=0;

$call = 'call userGetId(?,@idUser)';
$stmt = $db->prepare($call);
$stmt->bindParam(1, $cursoProfesorMail);
if($stmt->execute())
{
	$sql = "SELECT @idUser";
	$stmt = $db->prepare($sql);
	$stmt->execute();

	list($idUser) = $stmt->fetch(PDO::FETCH_NUM);
	$cursoProfesorId = $idUser;
			
	
}

$img_name = $_FILES['imagenPrincipal']['name'];
$img_size = $_FILES['imagenPrincipal']['size'];
$tmp_name = $_FILES['imagenPrincipal']['tmp_name'];
//$cursoMiniatura = addslashes(file_get_contents($_FILES['imagenPrincipal']['tmp_name']));
$error = $_FILES['imagenPrincipal']['error'];

if ($error === 0) {
	if ($img_size > 125000) {
		$em = "Sorry, your file is too large.";
		header("Location: ../create.php?error=$em");
	}else {
		$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
		$img_ex_lc = strtolower($img_ex);

		$allowed_exs = array("jpg", "jpeg", "png"); 

		if (in_array($img_ex_lc, $allowed_exs)) {
			$cursoMiniatura = uniqid("IMG-", true).'.'.$img_ex_lc;
			$img_upload_path = '../uploads/'.$cursoMiniatura;
			move_uploaded_file($tmp_name, $img_upload_path);

			// Insert into Database
			/*$sql = "INSERT INTO images(image_url) 
					VALUES('$cursoMiniatura')";
			mysqli_query($conn, $sql);
			header("Location: view.php");*/
		}else {
			$em = "You can't upload files of this type";
			//header("Location: ../create.php?error=$em");
		}
	}
}else {
	$em = "unknown error occurred!";
	//header("Location: ../create.php?error=$em");
}

$vid_name = $_FILES['videoPrincipal']['name'];
$vid_size = $_FILES['videoPrincipal']['size'];
$tmpVid_name = $_FILES['videoPrincipal']['tmp_name'];
//$cursoMiniatura = addslashes(file_get_contents($_FILES['imagenPrincipal']['tmp_name']));
$error = $_FILES['videoPrincipal']['error'];

if ($error === 0) {
	if ($vid_size > 125000) {
		$em = "Sorry, your file is too large.";
		header("Location: ../create.php?error=$em");
	}else {
		$img_ex = pathinfo($vid_name, PATHINFO_EXTENSION);
		$img_ex_lc = strtolower($img_ex);

		$allowed_exs = array("mp4", "m4v"); 

		if (in_array($img_ex_lc, $allowed_exs)) {
			$cursoVideoIntroductorio = uniqid("VID-", true).'.'.$img_ex_lc;
			$img_upload_path = '../uploads/'.$cursoVideoIntroductorio;
			move_uploaded_file($tmpVid_name, $img_upload_path);

			// Insert into Database
			/*$sql = "INSERT INTO images(image_url) 
					VALUES('$cursoMiniatura')";
			mysqli_query($conn, $sql);
			header("Location: view.php");*/
		}else {
			$em = "You can't upload files of this type";
			//header("Location: ../create.php?error=$em");
		}
	}
}else {
	$em = "unknown error occurred!";
	//header("Location: ../create.php?error=$em");
}








$query = "INSERT INTO curso
SET
cursoNombre = :cursoNombre,
cursoDescripcion = :cursoDescripcion,
cursoCosto  = :cursoCosto ,
cursoNiveles = :cursoNiveles,
cursoEstado = :cursoEstado,
cursoMiniatura = :cursoMiniatura,
cursoVideoIntroductorio = :cursoVideoIntroductorio,
cursoProfesorId = :cursoProfesorId";


// prepare the query
$stmt = $db->prepare($query);

// bind the values
$stmt->bindParam(':cursoNombre', $cursoNombre);
$stmt->bindParam(':cursoDescripcion', $cursoDescripcion);
$stmt->bindParam(':cursoCosto',  $cursoCosto);
$stmt->bindParam(':cursoNiveles',  $cursoNiveles);
//$stmt->bindParam(':cursoVideoIntroductorio',  $catDate);
$stmt->bindParam(':cursoMiniatura',  $cursoMiniatura);
$stmt->bindParam(':cursoVideoIntroductorio',  $cursoVideoIntroductorio);
$stmt->bindParam(':cursoEstado',  $cursoEstado);
$stmt->bindParam(':cursoProfesorId',  $cursoProfesorId);




/*$categArray = $_POST['categoriaCreate'];

foreach($categArray as $categValue) {

   $qtyOut = $categValue;

}*/


if($stmt->execute()){


	print_r($cursoNombre);

	return true;
}
else
{
	print_r("Error al agregar curso. Intente de nuevo");
   return false;
}



    
print_r($cursoProfesorId);



?>