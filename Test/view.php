
<!DOCTYPE html>
<html>
<head>
	<title>View</title>
	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			min-height: 100vh;
		}
		.alb {
			width: 200px;
			height: 200px;
			padding: 5px;
		}
		.alb img {
			width: 100%;
			height: 100%;
		}
		a {
			text-decoration: none;
			color: black;
		}
	</style>
</head>
<body>
     <a href="index.php">&#8592;</a>



     <?php 
		$sname = "127.0.0.1:3307";
		$uname = "root";
		$password = "";

		$db_name = "acodemia_db";

		//https://stackoverflow.com/questions/14758191/how-to-use-filesfilesize/14758827
		define('MB', 1048576);


		$conn = mysqli_connect($sname, $uname, $password, $db_name);

		if (!$conn) {
			echo "Connection failed!";
			exit();
		}

		$sql = "SELECT `video` FROM `tablavideo` ORDER BY `idVideo` DESC";
		//$idProfileQuery= mysqli_query($conn, $sql);

		$result = mysqli_query($conn,$sql);
     	//execute SQL statement 
     
		if (!$result)     
			die("Database access failed: " . mysqli_error()); 
			//output error message if query execution failed 
			
			$rows = mysqli_num_rows($result); 
			// get number of rows returned 
		
		if ($rows) {  
		
			while ($row = mysqli_fetch_array($result)) {    ?>        

				<video width="320" height="240" controls>
				<source  src="../uploads/<?=$row['video']?>" type="video/mp4">
				Your browser does not support the video tag.
				</video>
    
		
			<?php } 
		}

		

      ?>



</body>
</html>

