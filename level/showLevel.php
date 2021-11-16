<?php
    require_once '../api/config/database.php'; 
    
    $data = json_decode(file_get_contents("php://input"));


    $database = new Database();
    $db = $database->getConnection();

    ////////////////////////////

    $searchWord = $_POST['level'];
    $course = $_POST['course'];
    $mail = $_POST['mail'];
    $NivelComprado = 0;
    $userId =0;


    if($mail!=0)
    {
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
	
			list($userId) = $stmt->fetch(PDO::FETCH_NUM);
 					
		}
    }

    $call =  $db->prepare('CALL compraCursoVerificar(:p_user, :p_curso)');
    $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
    $call->bindParam(':p_curso', $course, PDO::PARAM_INT);

    if($call->execute())
    {
        $comentariosCurso = $call->fetchAll(PDO::FETCH_ASSOC);
        
        if($comentariosCurso!=null)
        {
            foreach ($comentariosCurso as $comentarios) 
            { 

                $existe= $comentarios['count(ventaCursoId)'];

                if($existe==0)
                {
                    //VER SI EL NIVEL ESTA COMPRADO
                    $call =  $db->prepare('CALL compraNivelVerificar(:p_user, :p_nivel)');
                    $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
                    $call->bindParam(':p_nivel', $searchWord, PDO::PARAM_INT);

                    if($call->execute())
                    {
                        $comentariosCurso = $call->fetchAll(PDO::FETCH_ASSOC);
                        
                        if($comentariosCurso!=null)
                        {
                            foreach ($comentariosCurso as $comentarios) 
                            { 

                                $existe= $comentarios['count(ventaNivelId)'];

                                if($existe==0)
                                {
                                    //NO ESTA COMPRADO BYE
                                    $NivelComprado=0;
                                }
                                else
                                {
                                    //SI TIENE EL LVL COMPRADO
                                    $NivelComprado=1;
                                }
                                                                                                       
                            } 
                        }
                    }
                }
                else
                {
                    //ESTA COMPRADO TODO EL CURSO ASI QUE TODO BIEN
                    $NivelComprado=1;
                }
                                                                                       
            } 
        }
    }

    
    //print_r($_POST);

    /*
        delimiter &ZV
        create procedure showNivel(in p_cursoid int)
        begin
            select nivelId, nivelNumero, nivelNombre, nivelCosto, nivelContenido, nivelVideo, nivelPDF
            from Curso where cursoId = p_cursoid;
        end &ZV 
    */
 
if( $NivelComprado==1)
{
    $call =  $db->prepare('CALL showNivel(:p_nivelid)');
    $call->bindParam(':p_nivelid', $searchWord, PDO::PARAM_INT); 
    
   if($call->execute())
    {
        $nivelesCurso = $call->fetchAll(PDO::FETCH_ASSOC);
        
        if($nivelesCurso!=null)
        {
            foreach ($nivelesCurso as $niveles) 
            { 
                $nivelId= $niveles['nivelId'];
                $nivelNumero= $niveles['nivelNumero'];
                $nivelNombre= $niveles['nivelNombre'];
                $nivelCosto= $niveles['nivelCosto'];
                $nivelContenido= $niveles['nivelContenido'];
                $nivelVideo= $niveles['nivelVideo'];
                $nivelPDF= $niveles['nivelPDF'];
                
                echo "<h4 class=\"title-text\">$nivelNombre</h4>";
                echo "<br>";
                echo "";

                echo "<video id=\"my-video\" class=\"video-js vjs-16-9 \" controls  preload=\"auto\" data-setup=\"{}\">";
                echo "<source src=\"uploads/$nivelVideo\" type=\"video/mp4\" />";
                echo "<p class=\"vjs-no-js\">To view this video please enable JavaScript, and consider upgrading to a web browser that";
                echo "<a href=\"https://videojs.com/html5-video-support/\" target=\"_blank\">supports HTML5 video</a>";
                echo "</p>";
                echo "</video>";
                echo "";
                echo "";
                echo "<br>";
                echo "<h4 >Descripción del video</h4>";
                echo "<br>";
                echo "<p>$nivelContenido</p>";
                echo "";
                echo "<hr style=\" border: 1px solid #b5d5f5; border-radius: 5px;\">";
                echo "";
                echo "";
                echo "<h4 >Archivos descargables</h4>";
                echo "";
                echo "<br>";
                if($nivelPDF!=0 && $nivelPDF!=null)
                {
                    echo "<a href=\"uploads/$nivelPDF\" download=\"Nivel-3\">PDF Nivel 3</a>";
                }
                
                echo "";
                echo "<hr style=\" border: 1px solid #b5d5f5; border-radius: 5px;\">";
                echo "<button class=\"btn btn-primary\" id=\"Terminar\" style=\"width: 100%;\">Terminar Nivel</button>";
                

                                            
            } 
        }
    }
    else
    {
       
    }
}
else
{
    http_response_code(410);
}



?>