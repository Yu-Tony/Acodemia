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


$call =  $db->prepare('CALL historialMaestroAlumnos(:p_user, :p_offset)');
$call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
$call->bindParam(':p_offset', $limitFrom, PDO::PARAM_INT); 




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

                
                $call =  $db->prepare('CALL historialMaestroVentas(:p_user)');
                $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 



                if($call->execute())
                {
                    $busqueda = $call->fetchAll(PDO::FETCH_ASSOC);

                    if($busqueda!=null)
                    {
                        foreach ($busqueda as $costos) 
                        {
                            
                            $costosId = $costos['cursoId'];
                            if($costosId == $cursoId)
                            {
                                $costosTarjeta = $costos['result1'];
                                $costosPaypal = $costos['result2'];
                                $costosTotal = $costos['result3'];

                                $costosTarjetaDec = number_format($costosTarjeta, 2, '.', '');
                                $costosTarjetaDec = number_format($costosTarjetaDec, 2, '.', ',');
                                
                                echo "<div  style=\"text-align: right;\"> Pagos con tarjeta: $$costosTarjetaDec</div>";
                                echo "";

                                $costosPaypalDec = number_format($costosPaypal, 2, '.', '');
                                $costosPaypalDec = number_format($costosPaypalDec, 2, '.', ',');
                                echo "<div  style=\"text-align: right;\"> Pagos con PayPal: $$costosPaypalDec</div>";
                                echo "<hr>";

                                $costosTotalDec = number_format($costosTotal, 2, '.', '');
                                $costosTotalDec = number_format($costosTotalDec, 2, '.', ',');
                                echo "Total: $$costosTotalDec";
                            }

                        }
                    }
                }

              
                echo "";
                echo "";
                echo "</div>";

                $call =  $db->prepare('CALL historialMaestroEstudiantes(:p_curso)');
                $call->bindParam(':p_curso', $cursoId, PDO::PARAM_INT); 

                echo "<!--espacio de la mini card-->";
                echo "<div class=\"col-sm-12\">";

                if($call->execute())
                {
                    $busqueda = $call->fetchAll(PDO::FETCH_ASSOC);

                    if($busqueda!=null)
                    {
                        foreach ($busqueda as $alumnos) 
                        {
                            $historialCursoFechaInicio = $alumnos['historialCursoFechaInicio'];
                            $historialCursoPorcentaje = $alumnos['hc.historialCursoNivelesC/@niveles'];
                            $ventaCursoMonto = $alumnos['ventaCursoMonto'];
                            $ventaCursoFormaPago = $alumnos['ventaCursoFormaPago'];
                            $usuarioNombre = $alumnos['usuarioNombre'];
                            $usuarioApellido = $alumnos['usuarioApellido'];

                          
                            echo "<div class=\"DescripcionCurso\" style=\"background-color: #b8d2e5; display: none; margin-bottom: 2%;\" >";
                            echo "";
                            echo "<div class=\"row p-2\">";
                            echo "";
                            echo "<div class=\"col-4 col-lg-4\">";
                            echo "<h6>$usuarioNombre $usuarioApellido</h6>";
                            echo "";
                            echo "</div>";
                            echo "";
                            echo "<div class=\"col-lg-8 col-12\" style=\"text-align: right;\">";
                            $historialCursoFechaInicioN = date("d-m-Y", strtotime($historialCursoFechaInicio));

                            $historialCursoFechaInicioN = date('d-M-Y',strtotime($historialCursoFechaInicioN));

                            echo "Fecha de inscripción: $historialCursoFechaInicioN";
                            echo "<br>";
                            echo "$historialCursoPorcentaje% completado";
                            echo "<br>";
                            $ventaCursoMontoDec = number_format($ventaCursoMonto, 2, '.', '');
                            $ventaCursoMontoDec = number_format($ventaCursoMontoDec, 2, '.', ',');
                            echo "$$ventaCursoMontoDec";
                            echo "<br>";
                            echo "Tipo de pago: $ventaCursoFormaPago";
                            echo "</div>";
                            echo "";
                            echo "</div>";
                            echo "";
                                echo "</div>";
                               
                                
                            

                        }
                    }
                }


                
                echo "</div>";

                echo "</div>";


                echo "</div>";
                echo "</div>";
                echo "</div>";


                


            }

            //----------------------------------------------------------------------------

            $call =  $db->prepare('CALL historialMaestroGanancias(:p_user)');
            $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 



            if($call->execute())
            {
                $busqueda = $call->fetchAll(PDO::FETCH_ASSOC);

                if($busqueda!=null)
                {
                    foreach ($busqueda as $costosTotal) 
                    {
                        
                     
                      
                        $costosTarjetaTotal = $costosTotal['result1'];
                        $costosPaypalTotal = $costosTotal['result2'];
                        $costosTotalTotal = $costosTotal['result3'];

                        echo "<div class=\"col-sm-12 abajo\" style=\"margin-bottom:2%\">";
                        echo "<div class=\"card\" style=\"background-color:#9ed5fb; margin: 0px;\">";
                        echo "<div class=\"card-body\" style=\"margin-bottom: 3%\">";
                        echo "<div class=\"row\">";
                        echo "";
                        echo "<div class=\"col-sm-6\"></div>";
                        echo "";
                        echo "";
                        echo "<div class=\"col-sm-6\" style=\"text-align: right;\">";
                        echo "<hr style=\" border: 1px solid #282E34; border-radius: 5px;\">";
                        $costosTarjetaTotalDec = number_format($costosTarjetaTotal, 2, '.', '');
                        $costosTarjetaTotalDec = number_format($costosTarjetaTotalDec, 2, '.', ',');
                        echo "<div  style=\"text-align: right;\"> Pagos con tarjeta: $$costosTarjetaTotalDec</div>";
                        echo "";
                        $costosPaypalTotalDec = number_format($costosPaypalTotal, 2, '.', '');
                        $costosPaypalTotalDec = number_format($costosPaypalTotalDec, 2, '.', ',');
                        echo "<div  style=\"text-align: right;\"> Pagos con PayPal: $$costosPaypalTotalDec</div>";
                        echo "<hr>";
                        $costosTotalTotalDec = number_format($costosTotalTotal, 2, '.', '');
                        $costosTotalTotalDec = number_format($costosTotalTotalDec, 2, '.', ',');
                        echo "<div  style=\"text-align: right;\"> Total: $$costosTotalTotalDec</div>";
                        echo "</div>";
                        echo "";
                        echo "";
                        echo "";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    

                    }
                }
            }


 
        }
}
?>