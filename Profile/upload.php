
<?php 

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
				        VALUES('$new_img_name')";

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


// Include the database configuration file  
require_once '../api/config/database.php'; 

$database = new Database();
$db = $database->getConnection();
 
// If file upload form is submitted 
$status = $statusMsg = $mail= ''; 
if(isset($_POST["submit"])){ 

	$mail = $_POST["SecretMail"];


    $status = 'error'; 
    if(!empty($_FILES["profile_pic"]["name"])) { 
        // Get file info 


        $fileName = basename($_FILES["profile_pic"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['profile_pic']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
		

			$call = 'call userGetId(?,@idUser)';
    
			// prepare
			$stmt = $db->prepare($call);
		

			$stmt->bindParam(1, $mail);
	
		
			// execute
			
			if($stmt->execute())
			{
				$sql = "SELECT @idUser";
				$stmt = $db->prepare($sql);
				$stmt->execute();
	
				list($idUser) = $stmt->fetch(PDO::FETCH_NUM);
						
				 $stmtUpdate = $db->query("UPDATE usuario SET usuarioFotoPerfil = '$imgContent' WHERE usuarioId = '".$idUser."' "); 
			}



			//CALL `userUpdateImg`(@p0, @p1);
      		/* $Update = 'CALL userUpdateImg(?, ?)';
    
      		 // prepare 
      		 $stmtUpdate = $db->prepare($Update);

        	// bind the values
		
			$stmtUpdate->bindParam(1, $idUser);
			$stmtUpdate->bindParam(2, $imgContent);
	
		
			// execute 
			$stmtUpdate->execute();
			//echo ($imgContent);*/

      if($stmtUpdate){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
				echo $statusMsg; 
				header("Location: http://localhost:8012/Acodemia/profile.php");
				exit();
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
				echo $statusMsg; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
			echo $statusMsg; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
		echo $statusMsg; 
    } 
} 
 
// Display status message 
echo $statusMsg; 
?>

