<?php
    require_once '../api/config/database.php'; 
        
    $data = json_decode(file_get_contents("php://input"));


    $database = new Database();
    $db = $database->getConnection();

    ////////////////////////////

    //print_r($_POST);

    /*delimiter &ZV
    create procedure cursoComprar(in p_cursoid int, in p_userid int, in p_method int)
    begin	 
        insert into ventas_curso(ventaCursoMonto, ventaCursoFecha, ventaCursoFormaPago, usuarioId, cursoId) 
        values ((select cursoCosto from Curso where cursoId = p_cursoid), current_timestamp(), p_method, p_userid, p_cursoid);
        
        insert into Historial_curso(historialAdquirido, historialCursoNivelesC, historialCursoFechaInicio, 
        historialCursoConcluido, cursoId, usuarioId) 
        values (true, 0, current_date(), false, p_cursoid, p_userid);
    end &ZV*/

    $idCurso = $_POST['idCurso'];
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

    $call =  $db->prepare('CALL cursoComprar(:p_cursoid, :p_userid, :p_method)');
    $call->bindParam(':p_cursoid', $idCurso, PDO::PARAM_INT); 
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