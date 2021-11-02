

<?php 
// Include the database configuration file  
require_once '../api/config/database.php'; 
 
// Get image data from database 

$resultado = $_POST['valorID']; 

$database = new Database();
$db = $database->getConnection();


if (!$db->query("SELECT usuarioFotoPerfil FROM usuario WHERE usuarioId = '".$resultado."'")) {
    echo("Error description: " . $db -> error);
  }
  else{
    $result = $db->query("SELECT usuarioFotoPerfil FROM usuario WHERE usuarioId = '".$resultado."'"); 
  }


?>



<?php if($result->rowCount() > 0){ ?> 
    <div class="gallery"> 
        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)){
            if($row['usuarioFotoPerfil']!=null)
            {?> 
                <img alt="Imagen de perfil" class="rounded-circle p-1 bg-primary" width="110"  src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['usuarioFotoPerfil']); ?>" /> 
            <?php } 
            else{?> 
                <img src="https://www.edmundsgovtech.com/wp-content/uploads/2020/01/default-picture_0_0.png" alt="Imagen de perfil no encontrada" class="rounded-circle p-1 bg-primary" width="110">
                        
              <?php } ?> 
        <?php } ?> 
    </div> 
<?php }else{ ?> 
    <img src="https://www.edmundsgovtech.com/wp-content/uploads/2020/01/default-picture_0_0.png" alt="Imagen de perfil no encontrada" class="rounded-circle p-1 bg-primary" width="110">
<?php } ?>