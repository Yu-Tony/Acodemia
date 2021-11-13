<?php

    require_once '../api/config/database.php'; 

    $data = json_decode(file_get_contents("php://input"));


    $database = new Database();
    $db = $database->getConnection();



    ////////////////////////////

    $comment = $_POST['comment'];
    $stars = $_POST['stars'];
    $userMail = $_POST['mail'];
    $cursoId = $_POST['id'];
    $username = $_POST['username'];

    $userId =0;

    if($userMail!=0)
    {
        $call = 'call userGetId(?,@idUser)';
    
		// prepare
		$stmt = $db->prepare($call);
	

		$stmt->bindParam(1, $userMail);
	
	
		// execute
		
		if($stmt->execute())
		{
			$sql = "SELECT @idUser";
			$stmt = $db->prepare($sql);
			$stmt->execute();
	
			list($userId) = $stmt->fetch(PDO::FETCH_NUM);
 					
		}
    }

    //print_r($_POST);

    /*
    delimiter &ZV
    create procedure comentarioCreate(in p_contenido varchar(500), in p_calif int, in p_cursoid int, in p_userid int)
    begin
        insert into Comentario(comentarioContenido, comentarioCalificacion, usuarioId, cursoId) 
        values (p_contenido, p_calif, p_cursoid, p_userid);
    end &ZV
    */

    $call =  $db->prepare('CALL comentarioCreate(:p_contenido, :p_calif, :p_cursoid, :p_userid)');
    $call->bindParam(':p_contenido', $comment, PDO::PARAM_STR); 
    $call->bindParam(':p_calif', $stars, PDO::PARAM_INT);
    $call->bindParam(':p_cursoid', $cursoId, PDO::PARAM_INT);
    $call->bindParam(':p_userid', $userId, PDO::PARAM_INT);
    
    
    if($call->execute())
    {
             
        echo "<!-- COMMENT 1 - START -->";
        echo "<div class=\"container\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-xl-12\">";
        echo "<div class=\"blog-comment\">";
        echo "";
        echo "<ul class=\"comments\">";
        echo "";
        echo "<li class=\"clearfix\">";
        echo "<div class=\"post-comments\">";
        echo "<p > <a> $username</a>: <i class=\"pull-right\"></i></p>";
        echo "<p>";
        echo $comment;
        echo "</p>";
        echo "</div>";
        echo "</li>";
        echo "";
        echo "";
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "<!-- COMMENT 1 - END -->";
        echo "";

    }
    else{
        print_r("Error al agregar curso. Intente de nuevo");
        return false;
    }


?>