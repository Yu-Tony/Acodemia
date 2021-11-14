<?php

require_once '../api/config/database.php'; 
    
$data = json_decode(file_get_contents("php://input"));



$database = new Database();
$db = $database->getConnection();

////////////////////////////

$searchWord = $_POST['course'];

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

         

            if( $nivelCosto==0)
            {
                echo "<div class=\"row\" style=\"color: black;\">";
                    echo "<div class=\"col-8\" style=\" background-color: #80b5e2;\">";
                        echo "<h4>$nivelNombre</h4>";
                    echo "</div>";
                    echo "<div class=\"col-4\" style=\"background-color: #80b5e2;\">";
                        echo "<button style=\"margin-top: 6%;\" type=\"button\" class=\"btn btn-primary VerMas\"><i class=\"fa fa-plus\"></i></button>";
                    echo "</div>";
                    echo "<div class=\"col-12\">";
                        echo "<div class=\"DescripcionCurso\" style=\"background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;\" >";
                            echo "<h5>$nivelContenido</h5>";
                            echo "<br>";
                            echo "<h5>Costo del nivel: $$nivelCosto</h5>";
                            echo "<button data-toggle=\"modal\" data-target=\"#modalPurchased\" class=\"btn btn-primary btn-category\" style=\"margin-top: 2%;\">Obtener este nivel</button>";
                            echo "<a class=\"btn btn-primary btn-category\" href=\"http://localhost:8012/Acodemia/level.php?course=$searchWord&level=$nivelId\">Ir al nivel</a>";
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
                        echo "<button style=\"margin-top: 6%;\" type=\"button\" class=\"btn btn-primary VerMas\"><i class=\"fa fa-plus\"></i></button>";
                    echo "</div>";
                    echo "<div class=\"col-sm-12\">";
                        echo "<div class=\"DescripcionCurso\" style=\"background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;\" >";
                            echo "<h5>$nivelContenido</h5>";
                            echo "<br>";
                            echo "<h5>Costo del nivel: $$nivelCosto</h5>";
                            echo "<button type=\"button\" class=\"btn btn-primary btn-category\" data-toggle=\"modal\" data-target=\"#ModalPay\" >Comprar este nivel</button>";
                            echo "<a class=\"btn btn-primary btn-category\" href=\"http://localhost:8012/Acodemia/level.php?course=$searchWord&level=$nivelId\">Ir al nivel</a>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            
            }

                                        
        } 
    }
}

?>


<?php








