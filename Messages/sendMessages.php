<?php


require_once '../api/config/database.php'; 
    

    $database = new Database();
    $db = $database->getConnection();

    ////////////////////////////

    $mensaje = $_POST['mensaje'];
    $userMail = $_POST['mail'];
    $usuarioDestino = $_POST['usuarioDestino'];
    $nombre = $_POST['nombre'];
    
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

    /*delimiter &ZV
create procedure mensajeEnviar(in p_remitente int, in p_destino int, in p_mensaje varchar(255))
begin
    insert into Chat (usuarioId1, usuarioId2) select p_remitente, p_destino 
    where (select count(chatId) from Chat where usuarioId1 = p_remitente and usuarioId2 = p_destino) > 0 
    or (select count(chatId) from Chat where usuarioId1 = p_maestro and p_destino = p_remitente) > 0;

    set @chatid = (select chatId from Chat where (usuarioId1 = p_remitente and usuarioId2 = p_destino)
    or (usuarioId1 = p_destino and usuarioId2 = p_remitente) limit 1);

    insert into Mensaje_chat(mensajeContenido, mensajeFecha, chatId, usuarioId) 
    values (p_mensaje, current_timestamp(), @chatid, p_remitente);
end &ZV */

    $call =  $db->prepare('CALL mensajeEnviar(:p_remitente, :p_destino, :p_mensaje)');
    $call->bindParam(':p_remitente', $userId, PDO::PARAM_INT); 
    $call->bindParam(':p_destino', $usuarioDestino, PDO::PARAM_INT);
    $call->bindParam(':p_mensaje', $mensaje, PDO::PARAM_STR);
    $date = date('Y-m-d H:i:s');

    if($call->execute())
    {
       
        echo "<div class=\"outgoing_msg\">";
        echo "<div class=\"sent_msg\">";
        echo "$nombre";
        echo "<p> $mensaje</p>";
        echo "<span class=\"time_date\"> $date</span> </div>";
        echo "</div>";


    }
    else
    {
        http_response_code(404);
    }

?>