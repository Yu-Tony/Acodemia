<?php

require_once '../api/config/database.php'; 
    
$data = json_decode(file_get_contents("php://input"));



$database = new Database();
$db = $database->getConnection();

////////////////////////////

$searchWord = $_POST['course'];
$mail = $_POST['mail'];
$tipo = $_POST['tipo'];
$cursoComprado = 0;
$userId =0;


if($mail!=0)
{
    $call = 'call userGetId(?,@idUser)';

    // prepare
    $stmt = $db->prepare($call);


    $stmt->bindParam(1, $mail);


    // execute
    
    if($stmt->execute())
    {
        $sql = "SELECT @idUser";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        list($userId) = $stmt->fetch(PDO::FETCH_NUM);
                 
    }
}


$call =  $db->prepare('CALL compraCursoVerificar(:p_user, :p_curso)');
$call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
$call->bindParam(':p_curso', $searchWord, PDO::PARAM_INT);

if($call->execute())
{
    $comentariosCurso = $call->fetchAll(PDO::FETCH_ASSOC);
    
    if($comentariosCurso!=null)
    {
        foreach ($comentariosCurso as $comentarios) 
        { 

            $existe= $comentarios['count(ventaCursoId)'];

            if($existe==0)
            {
                $cursoComprado = 0;
            }
            else
            {
                $cursoComprado = 1;
            }
                                                                                   
        } 
    }
}

//print_r($_POST);

$call =  $db->prepare('CALL showNiveles(:p_cursoid)');
$call->bindParam(':p_cursoid', $searchWord, PDO::PARAM_INT); 

if($call->execute())
{
    $nivelesCurso = $call->fetchAll(PDO::FETCH_ASSOC);
    
    if($nivelesCurso!=null)
    {
        echo "<h4 style=\"color: whitesmoke; \" class=\"title-text\">Niveles</h4>";
        echo "<br>";
        
        foreach ($nivelesCurso as $niveles) 
        { 
            $nivelId= $niveles['nivelId'];
            $nivelNumero= $niveles['nivelNumero'];
            $nivelNombre= $niveles['nivelNombre'];
            $nivelCosto= $niveles['nivelCosto'];
            $nivelContenido= $niveles['nivelContenido'];
            $nivelVideo= $niveles['nivelVideo'];
            $nivelPDF= $niveles['nivelPDF'];

         

            if( $nivelCosto==0|| ($cursoComprado==1))
            {
                echo "<div class=\"row\" style=\"color: black;\">";
                    echo "<div class=\"col-8\" style=\" background-color: #80b5e2;\">";
                        echo "<h4>$nivelNombre</h4>";
                    echo "</div>";
                    echo "<div class=\"col-4\" style=\"background-color: #80b5e2;\">";
                    if(($mail!=0))
                    {
                        echo "<button style=\"margin-top: 6%;\" type=\"button\" class=\"btn btn-primary VerMas\"><i class=\"fa fa-plus\"></i></button>";
                    }         
                    echo "</div>";
                    echo "<div class=\"col-12\">";
                        echo "<div class=\"DescripcionCurso\" style=\"background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;\" >";
                            echo "<h5>$nivelContenido</h5>";
                            echo "<br>";
                            echo "<h5>Costo del nivel: $$nivelCosto</h5>";
                            if($tipo==0)
                            {
                              echo "<a class=\"btn btn-primary btn-category\" href=\"http://localhost:8012/Acodemia/level.php?course=$searchWord&level=$nivelId\">Ir al nivel</a>";

                            }
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
            else
            {

                echo "<div class=\"row\" style=\"color: black;\">";
                    echo "<div class=\"col-8\" style=\" background-color: #80b5e2;\">";
                        echo "<h4>$nivelNombre</h4>";
                    echo "</div>";
                    echo "<div class=\"col-4\" style=\"background-color: #80b5e2;\">";
                    if(($mail!=0))
                    {
                        echo "<button style=\"margin-top: 6%;\" type=\"button\" class=\"btn btn-primary VerMas\"><i class=\"fa fa-plus\"></i></button>";
                    }                             echo "</div>";
                    echo "<div class=\"col-sm-12\">";
                        echo "<div class=\"DescripcionCurso\" style=\"background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;\" >";
                            echo "<h5>$nivelContenido</h5>";
                            echo "<br>";
                            echo "<h5>Costo del nivel: $$nivelCosto</h5>";

                             /*delimiter &ZV
                create procedure compraNivelVerificar(in p_user int, in p_nivel int)
                begin
                    select count(ventaNivelId) from Ventas_nivel where usuarioId = p_user and nivelId = p_nivel;
                end &ZV
                */

                
                $call =  $db->prepare('CALL compraNivelVerificar(:p_user, :p_nivel)');
                $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
                $call->bindParam(':p_nivel', $nivelId, PDO::PARAM_INT);

                if($call->execute())
                {
                    $comentariosCurso = $call->fetchAll(PDO::FETCH_ASSOC);
                    
                    if($comentariosCurso!=null)
                    {
                        foreach ($comentariosCurso as $comentarios) 
                        { 

                            $existe= $comentarios['count(ventaNivelId)'];

                            if($tipo == 0)
                            {
                                if($existe==0)
                                {
                                    echo "<button type=\"button\" class=\"btn btn-primary btn-category btnNivel btnComprar\" data-toggle=\"modal\" data-target=\"#ModalPay\" >Comprar este nivel</button>";
                                }
                                else
                                {
                                    echo "<a class=\"btn btn-primary btn-category\" href=\"http://localhost:8012/Acodemia/level.php?course=$searchWord&level=$nivelId\">Ir al nivel</a>";
    
                                }
                            }
                                                                      
                        } 
                    }
                }


                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            
            }

                                        
        } 
    }
}


?>


<?php








