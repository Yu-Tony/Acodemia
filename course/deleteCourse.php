<?php

require_once '../api/config/database.php'; 
    
$data = json_decode(file_get_contents("php://input"));


$database = new Database();
$db = $database->getConnection();

////////////////////////////

$searchWord = $_POST['course'];

/*delimiter &ZV
create procedure bestSellers(in p_cursoid )
begin
update curso set cursoEstado = 0 where cursoId = p_cursoid;
end &ZV
 */

$call =  $db->prepare('CALL deleteCurso(:p_cursoid)');
$call->bindParam(':p_cursoid', $searchWord, PDO::PARAM_INT); 


if($call->execute())
{ 
    //header("Location: http://localhost:8012/Acodemia/index.php", true, 301);
    http_response_code(410);

}

?>