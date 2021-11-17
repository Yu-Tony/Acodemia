<?php

require_once '../api/config/database.php'; 

$database = new Database();
$db = $database->getConnection();

////////////////////////////

$userMail = $_POST['mail'];
$page = $_POST['page'];
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

$limitFrom = 0;

if($page!=1)
{
     $page = ($page - 1);
     $limitFrom = (3*$page);
}

/**delimiter &ZV
create procedure historialMaestroAlumnos(in p_user int)
begin
	select c.cursoNombre, c.cursoMiniatura, count(hc.historialCursoId), sum(hc.historialCursoNivelesC)/sum(c.cursoNiveles)
    from Curso as c inner join Historial_curso as hc on c.cursoId = hc.cursoId 
    where c.cursoProfesorId = p_user group by c.cursoNombre order by c.cursoFechaPublicacion;
end &ZV */
?>