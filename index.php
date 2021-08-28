<?php
include_once 'navbar/navbar.php';
include_once 'footer/footer.php';
?>

<!--https://mdbootstrap.com/support/other/video-background-with-parallax-effect/-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACodemia</title>

    <link rel="stylesheet" href="http://localhost:8012/Acodemia/Media/media.css">
    <link rel="stylesheet" href="http://localhost:8012/Acodemia/Media/card.css">
    <script src="http://localhost:8012/Acodemia/Media/media.js"></script>
</head>
<body style="margin: 0px;">
    
    <section>
        <div class="view" style="background-image: none; z-index: 0; height: 800px;">
            <div class="full-bg-img">
                    <div class="container flex-center text-center">
                        <div class="row mt-5 py-5">
                            <div class="col-md-12 wow fadeIn mb-3"
                                 style="animation-name: none; visibility: visible;">
                                <div class="text-center">
                                    <h1 style="color: whitesmoke;" class="display-2 mb-2 wow fadeInDown green-text" data-wow-delay="0.3s">
                                        A <a  class="white-text font-bold">Codemia</a>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="video-parallax">
                        
                        <video class="video-parall" src="http://localhost:8012/Acodemia/Media/videoplayback.mp4"  autoplay loop muted>
                        </video>
                    </div>
               
            </div>
    </section>


    <div style="height:600px; background-color:rgb(167, 220, 255);font-size:36px">
      Aqui van las cards de los mas vendidos
    </div>      
           


      <div class="bgimg-2">
        <div class="caption">
        <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;">Texto 1</span>

        </div>
      </div>
      
      <div style="position:relative;">
        <div style="color:#ddd;background-color:#282E34;text-align:center;padding:50px 80px;text-align: justify; height: 10px;">
        </div>
      </div>
      
      <div class="bgimg-3">
        <div class="caption">
        <span class="border" style="background-color:transparent;font-size:25px;color: #f7f7f7;">Texto 2</span>
        </div>
      </div>
      
      <div style="position:relative;">
        <div style="color:#ddd;background-color:#282E34;text-align:center;padding:50px 80px;text-align: justify;  height: 600px;">
       
            <div class="container">
               
                <div class="col-4"></div>

                <!--https://codepen.io/Jhonierpc/pen/MWgBJpy-->
                <div class="col-4">
                    <div class="card">
                        <div class="face face1">
                            <div class="content">
                                <img src="https://github.com/Jhonierpc/WebDevelopment/blob/master/CSS%20Card%20Hover%20Effects/img/code_128.png?raw=true">
                      
                            </div>
                        </div>
                        <div class="face face2">
                            <div class="content">
                                <p style="color: black;">Registrate poder tomar los cursos </p>

                                <button type="button" class="btn btn-primary" style="margin: 1%;" data-toggle="modal" data-target="#exampleModalCenter">Registrarse ahora</button>
                          
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
               
            </div>
            
        </div>
      </div>
      
      <div class="bgimg-1">
        <div class="caption">
        <span class="border">Texto 3</span>
        </div>
      </div>

</body>
</html>