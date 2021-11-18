<?php

    require_once '../api/config/database.php'; 
        
    $database = new Database();
    $db = $database->getConnection();

    ////////////////////////////


    $course = $_POST['course'];
    $userMail = $_POST['mail'];
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

    $call =  $db->prepare('CALL diplomaCrear(:p_user, :p_curso)');
    $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
    $call->bindParam(':p_curso', $course, PDO::PARAM_INT);

    if($call->execute())
    {
        $comentariosCurso = $call->fetchAll(PDO::FETCH_ASSOC);
        
        if($comentariosCurso!=null)
        {
            foreach ($comentariosCurso as $comentarios) 
            { 
                //					

                $historialCursoFechaFinal= $comentarios['historialCursoFechaFinal'];
                $alumnoNombre= $comentarios['alumnoNombre'];
                $alumnoApellido= $comentarios['alumnoApellido'];
                $maestroNombre= $comentarios['maestroNombre'];
                $maestroApellido= $comentarios['maestroApellido'];
                $cursoNombre= $comentarios['cursoNombre'];

     
                echo "<h1>Certificado de finalización</h1>";
                echo "<h4>Se certifica que </h4>";
                echo "<h2>$alumnoNombre $alumnoApellido</h2>";
                echo "<h6>Ha terminado satisfactoriamente el curso de $cursoNombre el $historialCursoFechaFinal</h6>";
                echo "";
                echo "<div style=\"margin-top:8%\">";
                echo "";
                echo "<h4>$maestroNombre  $maestroApellido</h4>";
                echo "</div>";


                                                                                       
            } 
        }
    }
?>