<?php require_once '../api/config/database.php';  ?>
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
		$database = new Database();
		$db = $database->getConnection();



          $idProfileQuery = $db->query("SELECT cursoMiniatura FROM curso ORDER BY cursoId DESC"); 

          while ($row = $idProfileQuery->fetch(PDO::FETCH_ASSOC)) {?>


                <div class="alb">
                    <img src="../uploads/<?=$row['cursoMiniatura']?>">
                </div>

              <?php  }?>



</body>
</html>