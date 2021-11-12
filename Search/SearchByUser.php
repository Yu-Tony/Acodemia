<?php

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

        /*
    delimiter &ZV
    create procedure searchByUsuario(in p_useric int)
    begin
        select cursoId, cursoNombre, cursoMiniatura, cursoDescripcion, cursoCosto, cursoNiveles 
        from Curso where cursoProfesorId = p_useric limit 10;

    
        select Curso.cursoId, Curso.cursoNombre, Curso.cursoMiniatura, Curso.cursoDescripcion, Curso.cursoCosto, Curso.cursoNiveles 
        from Curso inner join Usuario on Curso.cursoProfesorId = Usuario.usuarioId 
        where Usuario.usuarioNombre like CONCAT('%',p_username,'%') order by Usuario.usuarioNombre limit 9 OFFSET p_limitFrom;


    end &ZV*/

    $call =  $db->prepare('CALL searchByUsuario(:p_useric, :p_limitFrom)');
    $call->bindParam(':p_useric', $searchWord, PDO::PARAM_STR); 
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
           
        }
      

        
    }
    else
    {
        return false;
    }

?>