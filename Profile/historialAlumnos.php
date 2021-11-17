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
create procedure perfilHistoriales(in p_user int, in p_limit int)
begin
	create or replace view Historiales as 
    select c.cursoId as hCursoId, c.cursoNombre as hCursoNombre, (hc.historialCursoNivelesC/c.cursoNiveles) * 100 as hPorcentaje,  
    hc.historialCursoFechaInicio as hFechaInicio, hc.historialCursoFechaFinal as hFechaFinal, hc.usuarioId as usuarioId
    from Historial_curso as hc inner join Curso as c on hc.cursoId = c.cursoId;
    
    select hCursoId, hCursoNombre, hPorcentaje, hFechaInicio, hFechaInicio from Historiales where usuarioId = p_user limit 3 offset p_limit;
    drop view Historiales;
end &ZV */

$call =  $db->prepare('CALL perfilHistoriales(:p_user, :p_limit)');
$call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
$call->bindParam(':p_limit', $limitFrom, PDO::PARAM_INT); 


if($call->execute())
{
    $busqueda = $call->fetchAll(PDO::FETCH_ASSOC);

    if($busqueda!=null)
        {
            foreach ($busqueda as $result) 
            {

               $cursoId = $result['hCursoId'];
               $cursoNombre = $result['hCursoNombre'];
               $cursoPorcentaje = $result['hPorcentaje'];
               $cursoFechaInicio = $result['hFechaInicio'];
               $cursoFechaFinal= $result['hFechaFinal'];
               $cursoMiniatura= $result['hMiniatura'];

               

               echo "<div class=\"row\" style=\"padding-bottom: 2%;\">";
               echo "<div class=\"col-sm-12\">";
               echo "<div class=\"card\" style=\"background-color:#9ed5fb;\">";
               echo "<div class=\"card-body\" style=\"margin-left:3%;\">";
               echo "<div class=\"row\">";
               echo "<div class=\"col-sm-4\" style=\"margin-right: 3%;\">";
               if($cursoMiniatura!=null)
               {
                echo "<div class=\"row\" style=\"margin-bottom: 3%;\"> <img src=\"uploads/$cursoMiniatura\" class=\"card-img\" alt=\"...\"></div>";
               }
               echo "<div class=\"row\"><a href=\"http://localhost:8012/Acodemia/course.php?course=$cursoId\">$cursoNombre</a></div>";
               echo "</div>";
               echo "<div class=\"col-sm-6\" >";
               echo "<div class=\"row\">Progreso $cursoPorcentaje%</div>";
               echo "<div class=\"row\">Fecha de inscripción $cursoFechaInicio</div>";
               if($cursoFechaFinal!=null)
               {
                echo "<div class=\"row\">Fecha de terminación del curso $cursoFechaFinal</div>";
               }
               echo "</div>";
               echo "</div>";
               echo "</div>";
               echo "</div>";
               echo "</div>";
               echo "";
               echo "</div>";
          

            
            }

            
            return true;
        }
        else
        {
            if($page==1)
            {
                http_response_code(404);
               
               
            }
            else
            {
                http_response_code(404);

            }
           
           
            //return false;
        }


    
}
else
{
    return false;
}


//print_r($_POST);

/*



 */
?>

