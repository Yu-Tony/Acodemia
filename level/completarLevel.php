<?php
/**delimiter &ZV
create procedure completarNivel(in p_user int, in p_nivel int)
begin
    update Historial_nivel set historialNivelCompletado = true where usuarioId = p_user and nivelId = p_nivel;
    set @cursoid = (select cursoId from nivel where nivelId = p_nivelid limit 1);
    set @historialcid = (select historialCursoId from Historial_curso where cursoId = @cursoid and usuarioId = p_userid limit 1);

    update Historial_curso set historialCursoNivelesC = historialCursoNivelesC + 1 where historialCursoId = @historialcid;

    update Historial_curso set historialCursoConcluido = true 
    where historialCursoId = @historialcid and historialCursoNivelesC = (select cursoNiveles from Curso where cursoId = @cursoid);
end &ZV */

require_once '../api/config/database.php'; 
    

$database = new Database();
$db = $database->getConnection();

////////////////////////////

$searchWord = $_POST['level'];
$mail = $_POST['mail'];
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


$call =  $db->prepare('CALL completarNivel(:p_user, :p_nivel)');
$call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
$call->bindParam(':p_nivel', $searchWord, PDO::PARAM_INT);

if($call->execute())
{

}
else
{
    http_response_code(410);
}

?>