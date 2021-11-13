<?php


//print_r($_POST);

require_once '../api/config/database.php'; 
    
$data = json_decode(file_get_contents("php://input"));


$database = new Database();
$db = $database->getConnection();

////////////////////////////

$searchTextTo = $_POST['searchTextTo'];
$searchTextFrom = $_POST['searchTextFrom'];
$page = $_POST['page'];

$limitFrom = 0;

if($page!=1)
{
    $page = ($page - 1);
    $limitFrom = (9*$page);
}


/*

delimiter &ZV
create procedure searchByFecha(in p_date1 date, in p_date2 date)
begin
    select cursoId, cursoNombre, cursoMiniatura, cursoDescripcion, cursoCosto, cursoNiveles 
    from Curso where cursoFechaPublicacion 
    between if(p_date1 = '', '2000-01-01', p_date1) and if(p_date2 = '', current_date(), p_date2) limit 10;
end &ZV

*/

    $call =  $db->prepare('CALL searchByFecha(:p_date1, :p_date2, :p_limitFrom)');
    $call->bindParam(':p_date1', $searchTextFrom, PDO::PARAM_STR); 
    $call->bindParam(':p_date2', $searchTextTo, PDO::PARAM_STR); 
    $call->bindParam(':p_limitFrom', $limitFrom, PDO::PARAM_INT); 


    $numero = 1;


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
                $cursoDescripcion = $result['cursoDescripcion'];
                $cursoCosto = $result['cursoCosto'];
                $cursoNiveles = $result['cursoNiveles'];
                $cursoEstado = $result['cursoEstado'];

                if($cursoEstado==1)
                {
                    if(($numero == 1)||($numero == 4)||($numero == 7))
                    {
                        echo "<div class=\"card-deck\" style=\"margin-bottom: 5%;\">";
                        //echo "<h5 class=\"font-weight-normal\">I think about you all the time</h5>";
                    }
                    echo "<div class=\"card\">";
                    echo "<img src=\"uploads/$cursoMiniatura\" class=\"card-img-top\" alt=\"...\">";
                    echo "<div class=\"card-body\">";
                    echo "<a href=\"http://localhost:8012/Acodemia/course.php?course=$cursoId\">";
                    echo "<h5 class=\"font-weight-normal\">$cursoNombre</h5>";
                    echo "</a>";
                    echo "<div class=\"post-meta\"><span class=\"small lh-120\">$cursoDescripcion</span></div>";
                    echo "<div class=\"d-flex my-4\">";
                    echo "</div>";
                    echo "<div class=\"d-flex justify-content-between\">";
                    echo "<div class=\"col pl-0\"><span class=\"text-muted font-small d-block mb-2\">Precio</span> <span class=\"h5 text-dark font-weight-bold\">$cursoCosto</span></div>";
                    echo "<div class=\"col pr-0\"><span class=\"text-muted font-small d-block mb-2\">Niveles</span> <span class=\"h5 text-dark font-weight-bold\">$cursoNiveles</span></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    if(($numero == 3)||($numero == 6)||($numero == 9))
                    {
                        //echo "<h5 class=\"font-weight-normal\">give me the night and day</h5>";
                        echo " </div>";
                    }
            
                    $numero = $numero + 1;
                }
        
 
        
            }
        
            if(($numero==1)||($numero==2)||($numero==4)||($numero==5)||($numero==7)||($numero==8))
            {
                    echo " </div>";
            }
    

            return true;
        }
        else
        {
            if($page==1)
            {
                echo "<div style=\"color:#FFFFFF\">No hay resultados para este termino</div>";
            
            }
            else
            {
                echo "<div style=\"color:#FFFFFF\">No hay mas resultados para este termino</div>";
            }
        
        }
    

        
    }
    else
    {
        return false;
    }

?>