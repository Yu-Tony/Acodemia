<?php

/*
delimiter &ZV
create procedure searchByCategoria(in p_catid int)
begin
    select Curso.cursoId, Curso.cursoNombre, Curso.cursoMiniatura, Curso.cursoDescripcion, Curso.cursoCosto, Curso.cursoNiveles 
    from Curso inner join Categoria_curso on Curso.cursoId = Categoria_curso.cursoId where Curso.cursoId= p_catid limit 10;
end &ZV
*/

require_once '../api/config/database.php'; 
    
$data = json_decode(file_get_contents("php://input"));


$database = new Database();
$db = $database->getConnection();

////////////////////////////

$searchWord = $_POST['searchword'];
$page = (int)$_POST['page'];


$limitFrom = 0;

if($page!=1)
{
     $page = ($page - 1);
     $limitFrom = (9*$page);
}

/***************************************************************** */

if (is_numeric($searchWord)) {
    $idCateg = $searchWord;
    
} else {

    $call = 'CALL categoryGetId(?,@idCateg)'; 
    $stmt = $db->prepare($call);
    $stmt->bindParam(1, $searchWord);
    if($stmt->execute())
    {
        $sql = "SELECT @idCateg";
        $stmt = $db->prepare($sql);
        $stmt->execute();
    
        list($idCateg) = $stmt->fetch(PDO::FETCH_NUM);               
        
    }
    
}

/***************************************************************** */

//print_r($searchWord);

$call =  $db->prepare('CALL searchByCategoria(:p_abuscar, :p_limitFrom)');
$call->bindParam(':p_abuscar', $idCateg, PDO::PARAM_INT); 
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
           
           
            //return false;
        }


    
}
else
{
    return false;
}

?>