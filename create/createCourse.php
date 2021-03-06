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
		$error = $_FILES['imagenPrincipal']['error'];

		if ($error === 0) {
	
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$cursoMiniatura = uniqid("IMG-COURSE-", true).'.'.$img_ex_lc;
				$img_upload_path = '../uploads/'.$cursoMiniatura;
				move_uploaded_file($tmp_name, $img_upload_path);


			}else {
				$em = "You can't upload files of this type";
				//header("Location: ../create.php?error=$em");
			}
		
		}else {
			$em = "unknown error occurred!";
			//header("Location: ../create.php?error=$em");
		}

		//https://stackoverflow.com/questions/14758191/how-to-use-filesfilesize/14758827
		define('MB', 1048576);

		$allowedExts = array("mp4", "wma");
		$extension = pathinfo($_FILES['videoPrincipal']['name'], PATHINFO_EXTENSION);

		if ((($_FILES["videoPrincipal"]["type"] == "video/mp4")|| ($_FILES["videoPrincipal"]["type"] == "audio/wma"))&& ($_FILES["videoPrincipal"]["size"] < 10*MB)&& in_array($extension, $allowedExts))
		{
			if ($_FILES["videoPrincipal"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["videoPrincipal"]["error"] . "<br />";
			}
			else
			{

				$img_ex_lc = strtolower($_FILES["videoPrincipal"]["name"]);
				$cursoVideoIntroductorio = uniqid("VID-COURSE-", true).'.'.$img_ex_lc;
				$img_upload_path = '../uploads/'.$cursoVideoIntroductorio;
				move_uploaded_file($_FILES["videoPrincipal"]["tmp_name"], $img_upload_path);

			}
		}


        $call =  $db->prepare('CALL cursoCreate(:p_nombre, :p_desc, :p_costo, :p_niveles,:p_imagen,:p_video,:p_user, @p_lastid)');
        $call->bindParam(':p_nombre', $cursoNombre, PDO::PARAM_STR); 
        $call->bindParam(':p_desc', $cursoDescripcion, PDO::PARAM_STR);  
		
		if(($cursoCosto == null) || ($cursoCosto == 0))
		{
			$cursoCosto = 0;
		}

        $call->bindParam(':p_costo', $cursoCosto, PDO::PARAM_INT);  
		$call->bindParam(':p_niveles', $cursoNiveles, PDO::PARAM_INT); 
		$call->bindParam(':p_imagen', $cursoMiniatura, PDO::PARAM_STR); 
		$call->bindParam(':p_video', $cursoVideoIntroductorio, PDO::PARAM_STR); 
		$call->bindParam(':p_user', $cursoProfesorId, PDO::PARAM_INT);    
              

        if($call->execute())
        {
                 
            $select = $db->query('SELECT @p_lastid');
            $result = $select->fetch(PDO::FETCH_ASSOC);
        
            //var_dump($result);
  
            if($result['@p_lastid']!=null)
            {
                $idCourse = $result['@p_lastid'];

				$categArray = $_POST['categoriaCreate'];

				foreach($categArray as $categValue) {
		
					$qtyOut = $categValue;
				
					$query = "INSERT INTO categoria_curso
					SET
					categoriaId = :categoriaId,
					cursoId = :cursoId";

		

					// prepare the query
					$stmt = $db->prepare($query);

					// bind the values
					$stmt->bindParam(':categoriaId', $qtyOut);
					$stmt->bindParam(':cursoId',  $idCourse);
					$stmt->execute();				
					
		
				}

                echo $idCourse;
                //echo $catName;

                return true;
            }
            else
            { 
                return false;}

        }
        else{
			print_r("Error al agregar curso. Intente de nuevo");
            return false;
		}






    




?>