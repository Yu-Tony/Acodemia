<?php
    require_once '../api/config/database.php'; 
    
    $data = json_decode(file_get_contents("php://input"));


    $database = new Database();
    $db = $database->getConnection();

    ////////////////////////////

    $searchWord = $_POST['level'];
    //print_r($_POST);

    /*
        delimiter &ZV
        create procedure showNivel(in p_cursoid int)
        begin
            select nivelId, nivelNumero, nivelNombre, nivelCosto, nivelContenido, nivelVideo, nivelPDF
            from Curso where cursoId = p_cursoid;
        end &ZV 
    */
    /*
     delimiter &ZV
        create procedure showNivel(in p_nivelid int)
       begin
            select nivelId, nivelNumero, nivelNombre, nivelCosto, nivelContenido, nivelVideo, nivelPDF
            from nivel where nivelId = p_nivelid;
        end &ZV 
    */

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
                echo "<button class=\"btn btn-primary\" style=\"width: 100%;\">Terminar Curso</button>";
                

                                            
            } 
        }
    }
    else
    {
       
    }


?>