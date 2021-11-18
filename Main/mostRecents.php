<?php

require_once '../api/config/database.php'; 
    
$data = json_decode(file_get_contents("php://input"));


$database = new Database();
$db = $database->getConnection();

$call = 'call mostRecents()';
    
// prepare
$stmt = $db->prepare($call);


// execute
$numero = 1;
if($stmt->execute())
{
    $busqueda = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($busqueda!=null)
    {
        foreach ($busqueda as $result) 
        {			

            $cursoId = $result['cursoId'];
            $cursoNombre = $result['cursoNombre'];
            $cursoMiniatura = $result['cursoMiniatura'];
            $cursoDescripcion = $result['cursoDescripcion'];
            $cursoCosto = $result['cursoCosto'];
            $cursoNiveles = $result['cursoNiveles'];

            //print_r($result);

            if(($numero == 1)||($numero == 4))
            {
                if(($numero == 1))
                {
                    echo "<div class=\"carousel-item active\">";
    
                }

                if(($numero == 4))
                {
                    echo "<div class=\"carousel-item\">";
                }

                echo "<!--Card-->";
                echo "<div class=\"cards-wrapper\">";
                echo "<!--card1-->";
                echo "<div class=\"card carousel\">";
            }

            else
            {
                echo "<div class=\"card carousel d-none d-md-block\">";
            }
            
            echo "<img src=\"uploads/$cursoMiniatura\" class=\"card-img-top\" alt=\"...\" >";
            echo "<div class=\"card-body\">";
            echo "<a href=\"http://localhost:8012/Acodemia/course.php?course=$cursoId\">";
            echo "<h5 class=\"font-weight-normal\">$cursoNombre</h5>";
            echo "</a>";
            echo "<div class=\"post-meta\"><span class=\"small lh-120\">$cursoDescripcion</span></div>";
            echo "<div class=\"d-flex my-4\">";

            /*delimiter &ZV
            create procedure valoracionGet(in p_cursoid int, out p_valoracion float)
            begin
                set @tempval = (select SUM(comentarioCalificacion) from Comentarios where cursoId = p_cursoid) / (select COUNT(comentarioId) from Comentarios where cursoId = p_cursoid);
                select @tempval into p_valoracion;
            end &ZV */
            $call = 'call valoracionGet(?,@p_valoracion)';
            $stmt = $db->prepare($call);
            $stmt->bindParam(1, $cursoId);
            if($stmt->execute())
            {
                $sql = "SELECT @p_valoracion";
                $stmt = $db->prepare($sql);
                $stmt->execute();
        
                list($calificacionCourse) = $stmt->fetch(PDO::FETCH_NUM);
                         
            }
            
            echo "<div class=\"col pl-0\"><span class=\"text-muted font-small d-block mb-2\">Calificacion: <b> $calificacionCourse</b></span></div>";
            echo "</div>";
            echo "<div class=\"d-flex justify-content-between\">";
            echo "<div class=\"col pl-0\"><span class=\"text-muted font-small d-block mb-2\">Precio</span> <span class=\"h5 text-dark font-weight-bold\">$$cursoCosto</span></div>";
            echo "<div class=\"col pr-0\"><span class=\"text-muted font-small d-block mb-2\">Niveles</span> <span class=\"h5 text-dark font-weight-bold\">$cursoNiveles</span></div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

            
            if(($numero == 3)||($numero == 6))
            {
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }

            $numero = $numero + 1;

        }
    }
			
}


?>