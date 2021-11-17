<?php
include_once 'navbar/navbar.php';
//include_once 'footer/footer.php';
?>

<!--https://mdbootstrap.com/support/other/video-background-with-parallax-effect/-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACodemia</title>

    <script> 
        $(document).ready()
        {  
            $.ajax({
                url: "Main/bestCourse.php",
                type : "POST",
                success : function(result) {

                    //alert(result);
                    $("#bestCourses").html(result);                         
                    
                },
                error: function(xhr, resp, text){
                    // on error, tell the user sign up failed
                    window.location = ' error/404.html';
                    console.log("Error al crear cuenta  " + text);
                    console.log("Response text  " + xhr.responseText);
                    //$('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
                }
            });

            $.ajax({
                url: "Main/topSeller.php",
                type : "POST",
                success : function(result) {

                    //alert(result);
                    $("#topSeller").html(result);                         
                    
                },
                error: function(xhr, resp, text){
                    // on error, tell the user sign up failed
                    window.location = ' error/404.html';
                    console.log("Error al crear cuenta  " + text);
                    console.log("Response text  " + xhr.responseText);
                    //$('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
                }
            });

            getMessagesChat();
        }

        
        function getMessagesChat()
        {
            var jwt = getCookie('jwt');
                $.post("api/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) 
                {
                  var MailAccount = result.data.email;
                  $.ajax({
                    url: "NavBar/getUsersMessages.php",
                    type : "POST",
                    data: {'mail': MailAccount}, 
                    success : function(result) {
                      
                      $("#messageChats").html(result);
                   
                     
                        
                    },
                    error: function(xhr, resp, text){
                        // on error, tell the user sign up failed
                        //window.location = ' error/404.html';
                        console.log("Error al crear cuenta  " + text);
                        console.log("Response text  " + xhr.responseText);
                        //$('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
                    }
                  });
                });
        }

    </script>

</head>
<body style="margin: 0px;">
    
<!--Video Principal-->
    <section>
        <div class="view" style="background-image: none; z-index: 0; height: 800px;">
            <div class="full-bg-img">
                    <div class="container flex-center text-center">
                        <div class="row mt-5 py-5">
                            <div class="col-md-12 wow fadeIn mb-3"
                                 style="animation-name: none; visibility: visible;">
                                <div class="text-center " style="padding-top:20%">
                                    <h1 style="color: whitesmoke;" class="display-2 mb-2 wow fadeInDown title-text" data-wow-delay="0.3s">
                                        A <a  class="title-text">Codemia</a>
                                    </h1>
                                    <h4 style="color: whitesmoke;" class="title-text">Aprende a programar</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="video-parallax">
                        
                        <video class="video-parall" src="Media/videoplayback.mp4"  autoplay loop muted>
                        </video>
                    </div>
               
            </div>
    </section>

    
<!--Mejores cursos-->
    <div style="height:700px; background-color:#5c89b0;">
      
        <!--Tab 1-->
        <!-- https://jsfiddle.net/bootstrapious/rb3e10jk/ -->
        <ul id="myTab2" role="tablist" class="nav nav-tabs nav-pills with-arrow text-center nav-justified">
            <li class="nav-item flex-sm-fill">
              <a id="home2-tab" data-toggle="tab" href="#home2" role="tab" aria-controls="home2" aria-selected="true" class="nav-link text-uppercase mr-sm-3 rounded-0 active">Cursos Mejor Calificados</a>
            </li>

            <li class="nav-item flex-sm-fill">
              <a id="profile2-tab" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile2" aria-selected="false" class="nav-link text-uppercase mr-sm-3 rounded-0">Cursos Mas Vendidos</a>
            </li>
          
        </ul>

          <div id="myTab2Content" class="tab-content">
            <div id="home2" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-4 py-5 show active">
                   <!-- ---------------Carousel------------------------------>
                   <!--https://codingyaar.com/bootstrap-4-carousel-multiple-items-responsive/-->
                   <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style=" padding-left: 5%; padding-right: 5%;">
                        <div class="carousel-inner" id="bestCourses">

              

                        </div>

                        <!--Controles carrusel-->
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="margin-left: 2%;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>

                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="margin-right: 2%;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>

                    </div>
            </div>

            <!--Tab 2-->
            <div id="profile2" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-4 py-5">

                   <!-- ---------------Carousel------------------------------>
                   <!--https://codingyaar.com/bootstrap-4-carousel-multiple-items-responsive/-->
                   <div id="carouselExampleControls2" class="carousel slide" data-ride="carousel" style=" padding-left: 5%; padding-right: 5%;">
                        <div class="carousel-inner" id="topSeller" >
                        </div>

                        <!--Controles carrusel-->
                        <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev" style="margin-left: 2%;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>

                        <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next" style="margin-right: 2%;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>

                   </div>
            </div>

          
          </div>




    </div>      
           
<!--Primera descripcion de la pagina-->

      <div class="bgimg-2">

        <div class="container">
            <div class="row" style="padding-top: 8%;">
                <div class="col-4">
                    <!--https://unsplash.com/photos/ipARHaxETRk?utm_source=unsplash&utm_medium=referral&utm_content=creditShareLink -->
                    <img src="Media/kobu-agency-ipARHaxETRk-unsplash.jpg" alt="" style="width: 100%;">
                </div>
                <div class=col-8 >
                    <div class="caption" >

                        <span style="background-color:transparent; font-size:25px; color: #f7f7f7; text-align: right; display:flex;">Aprende a programar de inmediato con nuestros distintos cursos </span>
                
                        </div>
                </div>
            </div>

        </div>

        
      </div>
      
      <!--Separador-->
      <div style="position:relative;">
        <div style="color:#ddd;background-color:#282E34;text-align:center;padding:50px 80px;text-align: justify; height: 10px;">
        </div>
      </div>
      
      <!--Segunda descripcion de la pagina-->
      <div class="bgimg-3">
        <div class="container">
            <div class="row" style="padding-top: 8%;">
                
                <div class=col-8 >
                    <div class="caption">

                        <span style="background-color:transparent;font-size:25px;color: #f7f7f7; text-align: left; display:flex;">Adentrate al mundo de la programacion con cursos gratuitos y de paga</span>
                
                        </div>
                </div>

                <div class="col-4" >
                    <!--https://unsplash.com/photos/idmvPhF8t4E?utm_source=unsplash&utm_medium=referral&utm_content=creditShareLink -->
                    <img src="Media/goran-ivos-idmvPhF8t4E-unsplash.jpg" alt="" style="width: 100%;">
                </div>
            </div>

        </div>

      </div>

      <!--Division para sign in-->
      
      <div style="position:relative;">
        <div style="color:#ddd;background-color:#282E34;text-align:center;padding:50px 80px;text-align: justify;  height: 600px;">
       
            <div class="container">
               
                <div class="row">
                    <div class="col-xl-4 col-sm-3"></div>

                    <!-- https://codepen.io/Jhonierpc/pen/MWgBJpy -->
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="face face1">
                                <div class="content" >
                                    <img src="https://github.com/Jhonierpc/WebDevelopment/blob/master/CSS%20Card%20Hover%20Effects/img/code_128.png?raw=true">
                          
                                </div>
                            </div>
                            <div class="face face2">
                                <div class="content">
                                    <p style="color: black;">Registrate poder tomar los cursos </p>
    
                                    <button type="button" class="btn btn-primary" style="margin: 1%;" data-toggle="modal" data-target="#ModalSign" >Registrarse ahora</button>
                              
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-sm-3"></div>                
                </div>
                     
            </div>
            
        </div>
      </div>
      
      <div class="bgimg-1">
        <div class="caption">
        <span class="border">Comienza ahora a aprender</span>
        </div>
      </div>


</body>
</html>