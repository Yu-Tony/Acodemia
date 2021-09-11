<?php
include_once 'navbar/navbar.php';
//include_once 'footer/footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    
        <!--Toggle de los cursos-->
        <script> 
            $(function(){ /* DOM ready */ 
                $('.VerMas').click(function(){ 
                    if ( $(this).parent().parent().find('.DescripcionCurso').css('display') == 'none' ) 
                        $(this).parent().parent().find('.DescripcionCurso').css('display','block'); 
                    else $(this).parent().parent().find('.DescripcionCurso').css('display','none'); 
                }); 
            }); 
            </script>

</head>
<body style="background-color: #0b1925;">

    <div class="row">
        <!--Espacio izq-->
        <div class="col-2"></div>

        <!--Principal-->
        <div class="col-8" style="background-color: #073352; padding:1%; color: whitesmoke; ">
            <div class="row">
                <div class="col-sm-8 col-12" >
   
                    <h4 class="title-text">Titulo del nivel</h4>
                    <br>

                    <video id="my-video" class="video-js vjs-16-9 " controls  preload="auto" poster="http://localhost:8012/Acodemia/Media/david-schultz-SrewPUfo2c0-unsplash.jpg" data-setup="{}">  
                      <source src="http://localhost:8012/Acodemia/Media/videoplayback.mp4" type="video/mp4" />
                      <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
                          <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                      </p>
                    </video>

                  
                  <br>
                  <h4 >Descripción del video</h4>
                  <br>
                  <p>Mucho texto</p>

                  <hr style=" border: 1px solid #b5d5f5; border-radius: 5px;">


                  <h4 >Archivos descargables</h4>
                  <p>Imagenes</p>

                  <a href="http://localhost:8012/Acodemia/Media/david-schultz-SrewPUfo2c0-unsplash.jpg" download="image-prueba">
                    <img src="http://localhost:8012/Acodemia/Media/david-schultz-SrewPUfo2c0-unsplash.jpg" alt="image-prueba" width="142" height="142">
                  </a>

                  <a href="http://localhost:8012/Acodemia/Media/david-schultz-SrewPUfo2c0-unsplash.jpg" download="image-prueba">
                    <img src="http://localhost:8012/Acodemia/Media/david-schultz-SrewPUfo2c0-unsplash.jpg" alt="image-prueba" width="142" height="142">
                  </a>
                  
                  <br>
                  <br>
                  <p>PDF</p>
                  <a href="./directory/yourfile.pdf" download="Nivel-3">PDF Nivel 3</a>

                  <hr style=" border: 1px solid #b5d5f5; border-radius: 5px;">
                  <button class="btn btn-primary" style="width: 100%;">Terminar Curso</button>

              </div>
                
              <div class="col-sm-4 col-12">
                <h4 style="color: whitesmoke; " class="title-text">Niveles</h4>
                <br>

                <div class="row" style="color: black;">
        
                    <div class="col-8" style=" background-color: #80b5e2;">
                    <h4>
                        Nivel 1
                    </h4>               
                    </div>
            
                    <div class="col-4" style="background-color: #80b5e2;">
                        <button style="margin-top: 6%;" type="button" class="btn btn-primary VerMas"><i class="fa fa-plus"></i></button>
                    </div>
            
            
                    <div class="col-12">
                        <div class="DescripcionCurso" style="background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;" >
                            <h5>Descripcion del nivel 1</h5>
                            <br>
                            <h5>Costo del nivel: $0.00</h5>
                            <button type="button" class="btn btn-primary btn-category" data-toggle="modal" data-target="#ModalPay" >Comprar este nivel</button>
    
                        </div>
                    </div>
            
                </div>
    
                <div class="row" style="color: black;">
            
                        <div class="col-8" style=" background-color: #80b5e2;">
                        <h4>
                            Nivel 2
                        </h4>               
                        </div>
    
                        <div class="col-4" style="background-color: #80b5e2;">
                            <button style="margin-top: 6%;" type="button" class="btn btn-primary VerMas"><i class="fa fa-plus"></i></button>
                        </div>

    
                        <div class="col-sm-12">
                            <div class="DescripcionCurso" style="background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;" >
                                <h5>Descripcion del nivel 2</h5>
                                <br>
                                <h5>Costo del nivel: $400.00</h5>
                                <button type="button" class="btn btn-primary btn-category" data-toggle="modal" data-target="#ModalPay" >Comprar este nivel</button>
    
                            </div>
                        </div>
    
                </div>
    
                <div class="row" style="color: black;">
            
                        <div class="col-8" style=" background-color: #80b5e2;">
                        <h4>
                            Nivel 3
                        </h4>               
                        </div>
    
                        <div class="col-4" style="background-color: #80b5e2;">
                            <button style="margin-top: 6%;" type="button" class="btn btn-primary VerMas"><i class="fa fa-plus"></i></button>
                        </div>

    
                        <div class="col-sm-12">
                            <div class="DescripcionCurso" style="background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;" >
                                <h5>Descripcion del nivel 3</h5>
                                <br>
                                <button type="button" onClick="window.location.href='http://localhost:8012/Acodemia/level.php';" class="btn btn-primary btn-category" >Ir al nivel</button>
    
                            </div>
                        </div>
    
                </div>


              </div>
            </div>
           

            
        </div>
        
        <!--Espacio der-->
        <div class="col-2"></div>
    </div>
    
</body>
</html>