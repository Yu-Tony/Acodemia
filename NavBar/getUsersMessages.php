<?php

require_once '../api/config/database.php'; 

$database = new Database();
$db = $database->getConnection();

////////////////////////////


$userMail = $_POST['mail'];

$userId =0;

if($userMail!=0)
{
    $call = 'call userGetId(?,@idUser)';

    // prepare
    $stmt = $db->prepare($call);


    $stmt->bindParam(1, $userMail);


    // execute
    
    if($stmt->execute())
    {
        $sql = "SELECT @idUser";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        list($userId) = $stmt->fetch(PDO::FETCH_NUM);
                 
    }
}


$call =  $db->prepare('CALL chatGetAll(:p_user)');
$call->bindParam(':p_user', $userId, PDO::PARAM_INT); 


if($call->execute())
{
    $mensajesAll = $call->fetchAll(PDO::FETCH_ASSOC);

    if($mensajesAll!=null)
    {
        foreach ($mensajesAll as $result) 
        {
            //chatId	usuarioId1	usuarioId2	usname1	usname2
            $chatId = $result['chatId'];

            $usuarioId1 = $result['usuarioId1'];
            $usname1 = $result['usname1'];

            $usuarioId2 = $result['usuarioId2'];
            $usname2 = $result['usname2'];

            if($usuarioId1==$userId)
            {
                echo "  <li class=\"dropdown-item\"><a href=\"http://localhost:8012/Acodemia/message.php?chat=$chatId&user=$usuarioId2\">$usname2</a></li>";
            }
            else
            {
                echo "  <li class=\"dropdown-item\"><a href=\"http://localhost:8012/Acodemia/message.php?chat=$chatId&user=$usuarioId1\">$usname1</a></li>";
            }

        }
    }

}

?>