<?php

require_once '../api/config/database.php'; 

$database = new Database();
$db = $database->getConnection();

////////////////////////////

$userMail = $_POST['mail'];
$idChat =  $_POST['idChat'];
$idOtherUser = $_POST['idOtherUser'];

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

if($idChat !=null)
{
    $call =  $db->prepare('CALL chatGetMensajes(:p_chat)');
    $call->bindParam(':p_chat', $idChat, PDO::PARAM_INT); 
}
else
{
    
}




if($call->execute())
{
    $busqueda = $call->fetchAll(PDO::FETCH_ASSOC);

    if($busqueda!=null)
    {
        foreach ($busqueda as $result) 
        {
            //			
            $mensajeId = $result['mensajeId'];
            $mensajeContenido = $result['mensajeContenido'];
            $mensajeFecha = $result['mensajeFecha'];
            $usuarioId = $result['usuarioId'];
            

            if($userId==$usuarioId)
            {
         
                echo "<div class=\"outgoing_msg\">";
                echo "<div class=\"sent_msg\">";
                echo "Jisung Park";
                echo "<p>$mensajeContenido</p>";
                echo "<span class=\"time_date\"> $mensajeFecha</span> </div>";
                echo "</div>";

            }
            else
            {
    
                echo "<div class=\"incoming_msg\">";
                echo "<div class=\"incoming_msg_img\"> <img class=\"img-msg\" src=\"https://ptetutorials.com/images/user-profile.png\" alt=\"sunil\"> </div>";
                echo "<div class=\"received_msg\">";
                echo "<div class=\"received_withd_msg\">";
                echo "John Suh";
                echo "<p>$mensajeContenido</p>";
                echo "<span class=\"time_date\">$mensajeFecha</span></div>";
                echo "</div>";
                echo "</div>";
                echo "";

            }


      
        }
    }
}


?>