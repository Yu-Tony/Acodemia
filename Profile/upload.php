
<?php 


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

