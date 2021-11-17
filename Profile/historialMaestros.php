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
end &ZV 


Este trae la miniatura, el nombre del curso, la cantidad de alumnos y el porcentaje de progreso de los alumnos*/

// 			


$call =  $db->prepare('CALL historialMaestroAlumnos(:p_user)');
$call->bindParam(':p_user', $userId, PDO::PARAM_INT); 



if($call->execute())
{
    $busqueda = $call->fetchAll(PDO::FETCH_ASSOC);

    if($busqueda!=null)
        {
            foreach ($busqueda as $result) 
            {

                $cursoId = $result['cursoId'];
                $cursoNombre = $result['cursoNombre'];
                $cursoMiniatura = $result['cursoMiniatura'];
                $cursoCantidadAlumnos = $result['count(hc.historialCursoId)'];
                $cursoPorcentaje= $result['sum(hc.historialCursoNivelesC)/sum(c.cursoNiveles)'];

                echo "<div class=\"col-sm-12\" style=\"margin-bottom:2%\">";
                echo " <div class=\"card\" style=\"background-color:#9ed5fb; margin: 0px;\">";
                echo"<div class=\"card-body\" style=\"margin-bottom: 3%\">";
                echo "<div class=\"row\">";
                
                echo "<!--imagen y nombre-->";
                echo "<div class=\"col-sm-4\">";

                if($cursoMiniatura!=null)
                {
                 echo "<div class=\"row\" style=\"margin-bottom: 3%;\"> <img src=\"uploads/$cursoMiniatura\" class=\"card-img\" alt=\"...\"></div>";
                }

                echo "<div class=\"row\"><a href=\"http://localhost:8012/Acodemia/course.php?course=$cursoId\">$cursoNombre</a></div>";
                echo "</div>";

            
                echo "<!--espacio-->";
                echo "<div class=\"col-sm-2\"></div>";
                echo "";

                echo "<!--datos de precio, porcentaje, etc-->";
                echo "<div class=\"col-sm-6\" style=\"text-align: right;\">";
                echo "";
                echo "<button style=\"margin-top: 6%; margin-bottom: 5%; width: 50%;\" type=\"button\" class=\"btn btn-primary VerMas\"><i class=\"fa fa-plus\"></i></button>";
                echo "<br>";
                echo "Alumnos $cursoCantidadAlumnos";
                echo "<br>";
                echo " $cursoPorcentaje% terminado";
                echo "<hr>";
                echo "<div  style=\"text-align: right;\"> Pagos con tarjeta: $2,000.00</div>";
                echo "";
                echo "<div  style=\"text-align: right;\"> Pagos con PayPal: $2,000.00</div>";
                echo "<hr>";
                echo "Total: $4,000.00";
                echo "";
                echo "";
                echo "</div>";


                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

            }
        }
}
?>