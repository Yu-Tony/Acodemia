
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
    $catPer = "1";

     
    // sanitize
    //https://www.php.net/manual/en/function.htmlspecialchars.php
    $catName=htmlspecialchars(strip_tags($catName));
    $catDesc=htmlspecialchars(strip_tags($catDesc));


    $query = "SELECT categoriaId 
    FROM  categorias 
    WHERE categoriaNombre = ?
    LIMIT 0,1";

               

    // prepare the query
    $stmt = $db->prepare( $query );

    // bind given email value
    $stmt->bindParam(1, $catName);

    // execute the query
    $stmt->execute();

    // get number of rows
    $num = $stmt->rowCount();

    // si ya existe una categoria con ese nombre
    if($num==0){
        $query = "INSERT INTO categorias
        SET
        categoriaNombre = :categoriaNombre,
        categoriaDescripcion = :categoriaDescripcion,
        categoriaPersona = :categoriaPersona";
    
        // prepare the query
        $stmt = $db->prepare($query);
    
    
    
    
    
    
        // bind the values
        $stmt->bindParam(':categoriaNombre', $catName);
        $stmt->bindParam(':categoriaDescripcion', $catDesc);
        $stmt->bindParam(':categoriaPersona',  $catPer);
    
         
    
    
    
        // execute the query, also check if query was successful
        if($stmt->execute()){

           
            $i = 5;
            //echo '<option value="10">'.$catName.'</option>';
        echo $catName;

            return true;
        }
        else
        {
            echo  "Error al agregar categoria. Intente de nuevo";
           return false;
        }
    }
    else
    {
        echo  "Esa categoria ya existe. Favor de escribir una nueva o seleccionar una de las ya existentes";
        return false;
    }

   


    ////////////////////////////
	/*$mail = $_POST["SecretMail"];


 
    $idProfileQuery = $conn->query("SELECT usuarioId FROM usuario WHERE usuarioEmail = '".$mail."'"); 

    while ($row = $idProfileQuery->fetch_assoc()) {
        $idProfile= $row['usuarioId'];
        //echo '<script type="text/javascript">alert("'.$idProfile.'");</script>';
    }*/



 
 
?>

