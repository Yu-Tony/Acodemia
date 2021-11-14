<?php

/*
BUSCAR CURSO CORREGIDO
delimiter &ZV
create procedure cursoSearch(in p_abuscar varchar(100))
begin
    select cursoId, cursoNombre, cursoMiniatura, cursoDescripcion, cursoCosto, cursoNiveles from Curso where cursoNombre like p_abuscar limit 10;
end &ZV
*/


    // Include the database configuration file  
  require_once '../api/config/database.php'; 
    
    $data = json_decode(file_get_contents("php://input"));


    $database = new Database();
    $db = $database->getConnection();

    ////////////////////////////

    $searchWord = $_POST['searchword'];
    $page = $_POST['page'];

    $limitFrom = 0;
 
    if($page!=1)
    {
         $page = ($page - 1);
         $limitFrom = (9*$page);
    }

    //print_r($searchWord);
    $call =  $db->prepare('CALL cursoSearch(:p_abuscar, :p_limitFrom)');
    $call->bindParam(':p_abuscar', $searchWord, PDO::PARAM_STR); 
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
                        echo "<a href=\"course.php?course=$cursoId\">";
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

            $numero = $numero - 1;
            if(($numero==1)||($numero==2))
            {
                for ($i = $numero; $i < 3; $i++) {
                    echo "<div class=\"card\" style=\"visibility: hidden;\">";
                    echo "</div>";
                }
                echo " </div>";
            }

            if(($numero==4)||($numero==5))
            {
                for ($i = $numero; $i < 6; $i++) {
                    echo "<div class=\"card\" style=\"visibility: hidden;\">";
                    echo "</div>";
                }
                echo " </div>";
            }

            if(($numero==7)||($numero==8))
            {
                for ($i = $numero; $i < 9; $i++) {
                    echo "<div class=\"card\" style=\"visibility: hidden;\">";
                    echo "</div>";
                }
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