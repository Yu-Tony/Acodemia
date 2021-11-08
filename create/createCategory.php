
<?php 

// Include the database configuration file  
require_once '../api/config/database.php'; 
 
$data = json_decode(file_get_contents("php://input"));





// If file upload form is submitted 
$status = $statusMsg = $mail= ''; 


    $database = new Database();
    $db = $database->getConnection();

    ////////////////////////////

    $catName = $data->CategoryName;
    $catDesc = $data->categoryDesc;    
    $catPer = $data->MailCategory;

    $call =  $db->prepare('CALL userGetId(:p_email, @p_id)');
    $call->bindParam(':p_email', $catPer, PDO::PARAM_STR); 


    if($call->execute())
    { 
        $select = $db->query('SELECT @p_id');
        $result = $select->fetch(PDO::FETCH_ASSOC);
    
        //var_dump($result);

        if($result['@p_id']!=null)
        {
            $catPerId = $result['@p_id'];
        }
        else
        { 
            echo("No hay resultados con ese correo");
            return false;
        }

    }
    else{
        echo("Error al correr el procedure");
        return false;
    }
     
    // sanitize
    //https://www.php.net/manual/en/function.htmlspecialchars.php
    $catName=htmlspecialchars(strip_tags($catName));
    $catDesc=htmlspecialchars(strip_tags($catDesc));


    /*delimiter &ZV 
    create procedure 
    categoriaValidName(
        in p_nombre varchar(30)) 

        begin select categoriaId from categorias where categoriaNombre = p_nombre limit 0, 1; 
    end &ZV*/
    $call =  $db->prepare('CALL categoriaValidName(:p_nombre)');
    $call->bindParam(':p_nombre', $catName, PDO::PARAM_STR); 
    // execute the query
    $call->execute();

    // get number of rows
    $num = $call->rowCount();

    // si ya existe una categoria con ese nombre
    if($num==0){

        $call =  $db->prepare('CALL categoriaCreate(:p_nombre, :p_desc, :p_user, @p_lastid)');
        $call->bindParam(':p_nombre', $catName, PDO::PARAM_STR); 
        $call->bindParam(':p_desc', $catDesc, PDO::PARAM_STR);     
        $call->bindParam(':p_user', $catPerId, PDO::PARAM_INT);     
              

        if($call->execute())
        {
                 
            $select = $db->query('SELECT @p_lastid');
            $result = $select->fetch(PDO::FETCH_ASSOC);
        
            //var_dump($result);
  
            if($result['@p_lastid']!=null)
            {
                $catID = $result['@p_lastid'];

                echo json_encode(array($catID, $catName));
                //echo $catName;

                return true;
            }
            else
            { 
                return false;}

        }
        else{
            return false;}


    }
    else
    {
        header("HTTP/1.0 403 Forbidden");
        print 'Bad user name / password';
    }

   


    ////////////////////////////
	/*$mail = $_POST["SecretMail"];


 
    $idProfileQuery = $conn->query("SELECT usuarioId FROM usuario WHERE usuarioEmail = '".$mail."'"); 

    while ($row = $idProfileQuery->fetch_assoc()) {
        $idProfile= $row['usuarioId'];
        //echo '<script type="text/javascript">alert("'.$idProfile.'");</script>';
    }*/



 
 
?>

