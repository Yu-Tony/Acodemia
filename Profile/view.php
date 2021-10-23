

<?php 
// Include the database configuration file  
require_once 'db_conn.php'; 
 
// Get image data from database 

$resultado = $_POST['valorID']; 



if (!$conn->query("SELECT usuarioFotoPerfil FROM usuario WHERE usuarioId = '".$resultado."'")) {
    echo("Error description: " . $conn -> error);
  }
  else{
    $result = $conn->query("SELECT usuarioFotoPerfil FROM usuario WHERE usuarioId = '".$resultado."'"); 
  }


//echo $result->num_rows; //haciendo este echo estas respondiendo la solicitud ajax


?>


<?php if($result->num_rows > 0){ ?> 
    <div class="gallery"> 
        <?php while($row = $result->fetch_assoc()){
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