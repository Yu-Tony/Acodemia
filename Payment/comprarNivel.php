<?php
 
    require_once '../api/config/database.php'; 
        
    $data = json_decode(file_get_contents("php://input"));


    $database = new Database();
    $db = $database->getConnection();

    

    ////////////////////////////

    //print_r($_POST);

    /*
    delimiter &ZV
    create procedure nivelComprar(in p_nivelid int, in p_userid int, in p_method int)
    begin
        insert into ventas_nivel(ventaNivelMonto, ventaNivelFecha, ventaNivelFormaPago, usuarioId, cursoId, nivelId) 
        values ((select nivelCosto from Nivel where nivelId = p_nivelid), current_timestamp(), 
        p_method, p_userid, (select cursoId from nivel where nivelId = p_nivelid ), p_nivelid);

        set @cursoid = (select cursoId from nivel where nivelId = p_nivelid);

        insert into Historial_curso(historialAdquirido, historialCursoNivelesC, historialCursoFechaInicio, 
        historialCursoConcluido, cursoId, usuarioId) 
        select false, 0, current_date(), false, @cursoid, p_userid
        where (select count(historialCursoId) from Historial_curso where cursoId = @cursoid and usuarioId = p_userid) > 0;

        set @historialcid = (select historialCursoId from Historial_curso where cursoId = @cursoid and usuarioId = p_userid);

        insert into Historial_nivel(historialNivelCompletado, nivelId, historialCursoId) 
        values (false, p_nivelid, historialcid);

        update Historial_curso set historialAdquirido = true 
        where historialCursoId = @historialcid and 
        (select count(historialNivelId) from Historial_nivel where historialCursoId = @historialcid) = (select cursoNiveles from Curso where cursoId = @cursoid);
    end &ZV */

    $idCurso = $_POST['idNivel'];
    $mail = $_POST['mail'];
    $metodo = $_POST['metodo'];

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
    

    $call =  $db->prepare('CALL nivelComprar(:p_nivelid, :p_userid, :p_method)');
    $call->bindParam(':p_nivelid', $idCurso, PDO::PARAM_INT); 
    $call->bindParam(':p_userid', $userId, PDO::PARAM_INT); 
    $call->bindParam(':p_method', $metodo, PDO::PARAM_INT); 


 

    if($call->execute())
    {

    }
    else
    {
        http_response_code(410);
    }

?>