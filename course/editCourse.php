<?php
//print_r($_POST);

/*CURSO UPDATE
delimiter &ZV
create procedure cursoUpdate(in p_curso int, in p_nombre varchar(100), in p_desc varchar(255))
begin
    update Curso set cursoNombre = p_nombre, cursoDescripcion = p_desc where cursoId = p_curso;
end &ZV */

require_once '../api/config/database.php'; 
    
$data = json_decode(file_get_contents("php://input"));


$database = new Database();
$db = $database->getConnection();

$name = $_POST['name'];
$desc = $_POST['desc'];
$idCurso = $_POST['idCurso'];

$call =  $db->prepare('CALL cursoUpdate(:p_curso, :p_nombre, :p_desc)');
$call->bindParam(':p_curso', $idCurso, PDO::PARAM_INT); 
$call->bindParam(':p_nombre', $name, PDO::PARAM_STR); 
$call->bindParam(':p_desc', $desc, PDO::PARAM_STR); 





if($call->execute())
{
  
             
}
else
{
    http_response_code(410);
}



?>