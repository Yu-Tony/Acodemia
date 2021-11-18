<?php

require_once '../api/config/database.php'; 

$database = new Database();
$db = $database->getConnection();

////////////////////////////

$userMail = $_POST['mail'];
$idChat =  $_POST['idChat'];
$idOtherUser = $_POST['idOtherUser'];
$chatExists = 0;
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
    $chatExists=1;
    $call =  $db->prepare('CALL chatGetMensajes(:p_chat)');
    $call->bindParam(':p_chat', $idChat, PDO::PARAM_INT); 
}
else
{

    
    /**delimiter &ZV
        create procedure chatGetId(in p_user int, in p_user2 int)
        begin
            select chatId from Chat where (usuarioId1 = p_user and usuarioId2 = p_user2) or (usuarioId2 = p_user and usuarioId1 = p_user2);
        end &ZV */

    $call =  $db->prepare('CALL chatGetId(:p_user, :p_user2)');
    $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
    $call->bindParam(':p_user2', $idOtherUser, PDO::PARAM_INT); 
    if($call->execute())
    {
        $busqueda = $call->fetchAll(PDO::FETCH_ASSOC);
    
        if($busqueda!=null)
        {
            foreach ($busqueda as $result) 
            {
                //			
                $chatId = $result['chatId'];

                if($chatId!=null)
                {
                    $idChat = $chatId ;
                    $call =  $db->prepare('CALL chatGetMensajes(:p_chat)');
                    $call->bindParam(':p_chat', $idChat, PDO::PARAM_INT); 
                    $chatExists=1;
                }
                else
                {
                    $chatExists=0;
                }
               

            }
        }
    }
    
    
}



echo "<div class=\"incoming_msg\" style=\"visibility: hidden\">";
echo "<div class=\"incoming_msg_img\"> <img class=\"img-msg\" src=\"https://ptetutorials.com/images/user-profile.png\" alt=\"sunil\"> </div>";
echo "<div class=\"received_msg\">";
echo "<div class=\"received_withd_msg\">";
echo "John Suh";
echo "<p>Contenido extra para hacer el suficiente espacio en caso de que solo hayan mensajes incoming muy peques y el formato no se acomode bien</p>";
echo "<span class=\"time_date\"></span></div>";
echo "</div>";
echo "</div>";
echo "";


if($chatExists==1)
{
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
                $usuarioNombre = $result['usuarioNombre'];
                
                
    
                if($userId==$usuarioId)
                {
             
                    echo "<div class=\"outgoing_msg\">";
                    echo "<div class=\"sent_msg\">";
                    echo "$usuarioNombre";
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
                    echo "$usuarioNombre";
                    echo "<p>$mensajeContenido</p>";
                    echo "<span class=\"time_date\">$mensajeFecha</span></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "";
    
                }
    
    
          
            }
        }
    }
    
}



?>