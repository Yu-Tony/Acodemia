<?php

$call =  $db->prepare('CALL showComentarios(:p_cursoid)');
$call->bindParam(':p_cursoid', $searchWord, PDO::PARAM_INT); 

if($call->execute())
{
    $comentariosCurso = $call->fetchAll(PDO::FETCH_ASSOC);
    
    if($comentariosCurso!=null)
    {
        foreach ($comentariosCurso as $comentarios) 
        { 

            $comentarioId= $comentarios['comentarioId'];
            $comentarioContenido= $comentarios['comentarioContenido'];
            $comentarioCalificacion= $comentarios['comentarioCalificacion'];
            $usuarioNombre= $comentarios['usuarioNombre'];
    
            echo "<!-- COMMENT 1 - START -->";
            echo "<div class=\"container\">";
                echo "<div class=\"row\">";
                    echo "<div class=\"col-xl-12\">";
                        echo "<div class=\"blog-comment\">";
                            echo "<ul class=\"comments\">";
                                echo "<li class=\"clearfix\">";
                                    echo "<div class=\"post-comments\" style=\"padding-left:2%\">";
                                        echo "<p > <a> $usuarioNombre</a>: <i class=\"pull-right\"></i></p>";
                                        echo "<p>$comentarioContenido</p>";
                                    echo "</div>";
                                 echo "</li>";
                            echo "</ul>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            echo "<!-- COMMENT 1 - END -->";
                                       
        } 
    }
}
else
{

}
?>