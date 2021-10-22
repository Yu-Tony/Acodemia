
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
require_once 'db_conn.php'; 
 
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
         
            // Insert image content into database 
			// $insert = $db->query("INSERT into testtable (image, uploaded) VALUES ('$imgContent', NOW())"); 
		

			//echo "<script type='text/javascript'>alert(\"Wrong Username or Password\")</script>";
			

			$idProfileQuery = $conn->query("SELECT id FROM testtable WHERE email = '".$mail."'"); 

			while ($row = $idProfileQuery->fetch_assoc()) {
				$idProfile= $row['id'];
				//echo '<script type="text/javascript">alert("'.$idProfile.'");</script>';
			}



            $insert = $conn->query("UPDATE testtable SET image_url = '$imgContent' WHERE id = '".$idProfile."' "); 

	

             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
				header("Location: http://localhost:8012/Acodemia/profile.php");
				exit();
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg; 
?>

