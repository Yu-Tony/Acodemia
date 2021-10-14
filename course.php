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

        <script src="https://www.paypal.com/sdk/js?client-id=AXzXMA6dPo-ziWAA-D7i-6ON8yxv5j0chRAwEISbmc2dVwWESiFkZdhsrDzRjcRBj-oYQCflacN0Qjyx&currency=MXN"></script>
   

        <link rel="stylesheet" href="http://localhost:8012/Acodemia/course/comments.css">
        <link rel="stylesheet" href="http://localhost:8012/Acodemia/course/star.css">
        <link rel="stylesheet" href="http://localhost:8012/Acodemia/course/buttons.css">
        <script src="http://localhost:8012/Acodemia/Payment/payment.js"></script>
        <link rel="stylesheet" href="http://localhost:8012/Acodemia/Payment/pay.css">
        <link rel="stylesheet" href="http://localhost:8012/Acodemia/diploma/diploma.css">

    
</head>
<body style="background-color: #0b1925;">
    <div class="row">
        <!--Espacio izq-->
        <div class="col-2"></div>

        <!--Principal-->
        <div class="col-8" style="background-color: #073352; padding:0px">

            <div class="row" >
                <div class="col-lg-8"></div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="card card-desc buy-card" >

                        <video id="my-video" class="video-js vjs-16-9 " controls  preload="auto" poster="http://localhost:8012/Acodemia/Media/david-schultz-SrewPUfo2c0-unsplash.jpg" data-setup="{}">  
                        <source src="http://localhost:8012/Acodemia/Media/videoplayback.mp4" type="video/mp4" />
                        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                        </p>
                        </video>

                        <div class="card-body" style="padding-left: 10%;">
                            
                            <div class="row">
                                <span class="text-muted font-small d-block mb-2">Categorias</span>
                               
                            </div>
                            <button class="btn btn-primary btn-category">HTML</button>
   
                            <div class="row" style="margin-top: 4%">
                                <span class="text-muted font-small d-block mb-2">Calificacion del curso: </span>
    
                            </div>

                            <span class="text-muted font-small d-block mb-2">5.0</span>
                            
                            <!--
                            <div class="d-flex my-4" style="margin-top: 0px !important;">
                                <i class="star fas fa-star text-warning"></i>
                                <i class="star fas fa-star text-warning"></i>
                                <i class="star fas fa-star text-warning"></i>
                                <i class="star fas fa-star text-warning"></i>
                                <i class="star fas fa-star text-warning"></i>
                            </div>-->
 
                            <section class='rating-widget'>
   
                                 <!-- Rating Stars Box -->
                                 <!--https://codepen.io/depy/pen/vEWWdw -->
                                 <div class='rating-stars text-left'>
                                   <ul id='stars'>
                                     <li class='star' title='Poor' data-value='1'>
                                       <i class='fa fa-star fa-2x'></i>
                                     </li>
                                     <li class='star' title='Fair' data-value='2'>
                                       <i class='fa fa-star fa-fw'></i>
                                     </li>
                                     <li class='star' title='Good' data-value='3'>
                                       <i class='fa fa-star fa-fw'></i>
                                     </li>
                                     <li class='star' title='Excellent' data-value='4'>
                                       <i class='fa fa-star fa-fw'></i>
                                     </li>
                                     <li class='star' title='WOW!!!' data-value='5'>
                                       <i class='fa fa-star fa-fw'></i>
                                     </li>
                                   </ul>
                                 </div>
                                
                                 
                                 
                            </section>
   
 
                            <div class="d-flex justify-content-between">
                                 <div class="col pl-0"><span class="text-muted font-small d-block mb-2">Precio</span> <span class="h5 text-dark font-weight-bold">$800.00</span></div>
                                 <div class="col pr-0"><span class="text-muted font-small d-block mb-2">Niveles</span> <span class="h5 text-dark font-weight-bold">3</span></div>
                            </div>
 
                            <button type="button" class="btn btn-primary" style="margin-top: 10%;" data-toggle="modal" data-target="#ModalPay" >Comprar</button>
                            <button class="btn btn-secondary" style="margin-top: 2%;">Editar</button>


                            <button data-toggle="modal" data-target="#modalDelete" class="btn btn-danger" style="margin-top: 2%;">Eliminar</button>


 
                        </div>
                    </div>

                                                   <!-- Modal Eliminar -->
                        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">    
  
                                            <div class="modal-header">
             
                                            <h4 class="modal-title">Eliminar curso</h4>
                                            </div>
                                            <div class="modal-body">
                                            ¿Borrar este curso?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-danger" >Eliminar</button>

                                            </div>
                                        </div>
                                        
                                        </div>
                        </div>

                         <!-- Modal Comprar -->
                         <div class="modal fade" id="modalPurchased" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">    
  
                                                <div class="modal-header">
             
                                                    <h4 class="modal-title">Comprar curso</h4>
                                                </div>

                                                <div class="modal-body">
                                                    Curso comprado con exito
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                                                </div>

                                            </div>
                                        
                                        </div>
                        </div>
                </div>
            </div>
           

            <!--Titulo del curso-->
            <div class="bgimg-4" style="background-image: url('https://i.ytimg.com/vi/rbuYtrNUxg4/maxresdefault.jpg'); min-height: 400px;">

                <div class="container" style=" background-color: rgba(0, 0, 0, 0.705);">
                    <div class="row" style="padding-top: 8%; color: whitesmoke;">

                        <!--Descripcion curso-->
                        <div class="col-xl-8 col-sm-8 col-12">
                            <div class="text-left " style="padding-top:2%; ">
                                <h1  class="subtitle-text">Desarrollo Web Completo con HTML5</h1>
                             </div>
                             <div class="text-left " style="padding-top:2%; ">
                                <h4 class="subtitle-text">Aprende Desarrollo Web con este curso 100% práctico, paso a paso y sin conocimientos previos</h4>
                             </div>
                             <div class="text-left " style="padding-top:20%; ">
                                <h6 class="subtitle-text">Yuta Nakamoto 
                                    <button onClick="window.location.href='http://localhost:8012/Acodemia/message.php';" style="width: 10%; margin-left: 2%; margin-top: 0px;" class="btn btn-secondary"><i class="fas fa-envelope"></i></button>
                                </h6>
                             </div>
                        </div>
                        <!--Card-->
                        
                        <div class="col-12 col-sm-4" >
                            
                          
                         

                           
                        </div>

                        
                    </div>
        
                </div>
        
                
            </div>

            <div class="col-12" style="padding-left: 10%; padding-right: 4%; ">
              
                <div class="row" style="padding-bottom: 2%;">
                    <div class="col-lg-12 col-12 text-left" style="padding-top:2%; ">
                    
                    <h5 style="color: whitesmoke;" class="subtitle-text">Progreso del curso : 75%</h5>
                        
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="progress" style="z-index: 5px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>

                        <button type="button" class="btn btn-primary" style="margin-top: 10%; width: 30%;" data-toggle="modal" data-target="#ModalDip" >Obtener diploma</button>
                            
                    </div>

                </div>

               <div class="row" style="padding-bottom: 2%;">
                   <div class="text-left " style="padding-top:2%; ">
                       <h5 style="color: whitesmoke;" class="subtitle-text">Contenido del curso</h5>
                   </div>
               </div>
        
               <!--Nivel-->
               <div class="row" style="color: black;">
        
                <div class="col-lg-5 col-8" style=" background-color: #80b5e2;">
                <h4>
                    Nivel 1
                </h4>               
                </div>
        
                <div class="col-lg-1 col-4" style="background-color: #80b5e2;">
                    <button style="margin-top: 6%;" type="button" class="btn btn-primary VerMas"><i class="fa fa-plus"></i></button>
                </div>
        
                <div class="col-lg-5 col-8"></div>
        
                <div class="col-lg-6 col-12">
                    <div class="DescripcionCurso" style="background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;" >
                        <h5>Descripcion del nivel 1</h5>
                        <br>
                        <h5>Costo del nivel: $0.00</h5>
                        <button data-toggle="modal" data-target="#modalPurchased" class="btn btn-primary btn-category" style="margin-top: 2%;">Comprar este nivel</button>
                    </div>
                </div>
        
               </div>

               <div class="row" style="color: black;">
        
                    <div class="col-lg-5 col-8" style=" background-color: #80b5e2;">
                    <h4>
                        Nivel 2
                    </h4>               
                    </div>
            
                    <div class="col-lg-1 col-4" style="background-color: #80b5e2;">
                        <button style="margin-top: 6%;" type="button" class="btn btn-primary VerMas"><i class="fa fa-plus"></i></button>
                    </div>
            
                    <div class="col-lg-5 col-8"></div>
            
                    <div class="col-lg-6 col-12">
                        <div class="DescripcionCurso" style="background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;" >
                            <h5>Descripcion del nivel 2</h5>
                            <br>
                            <h5>Costo del nivel: $400.00</h5>
                            <button type="button" class="btn btn-primary btn-category" data-toggle="modal" data-target="#ModalPay" >Comprar este nivel</button>

                        </div>
                    </div>
        
               </div>

               <div class="row" style="color: black;">
        
                <div class="col-lg-5 col-8" style=" background-color: #80b5e2;">
                <h4>
                    Nivel 3
                </h4>               
                </div>
        
                <div class="col-lg-1 col-4" style="background-color: #80b5e2;">
                    <button style="margin-top: 6%;" type="button" class="btn btn-primary VerMas"><i class="fa fa-plus"></i></button>
                </div>
        
                <div class="col-lg-5 col-8"></div>
        
                <div class="col-lg-6 col-12">
                    <div class="DescripcionCurso" style="background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;" >
                        <h5>Descripcion del nivel 3</h5>
                        <br>
                       <button type="button" onClick="window.location.href='http://localhost:8012/Acodemia/level.php';" class="btn btn-primary btn-category" >Ir al nivel</button>

                    </div>
                </div>
    
           </div>
         


      
         
 <!--Comentarios-->
               <div class="row">
                   <div class="col-12 col-lg-6">
                        <hr style="border: 2px solid #b8d2e5; border-radius: 5px;">
                       

                        <div class="row" style="padding-bottom: 2%;">
                            <div class="text-left " style="padding-top:2%; ">
                                <h5 style="color: whitesmoke;" class="subtitle-text">Comentarios</h5>
                            </div>
                        </div>

                        <!--Escribir comentario-->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="comment-wrapper">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                Comment panel
                                            </div>
                                            <div class="panel-body">
                                                <textarea class="form-control" placeholder="write a comment..." rows="3"></textarea>
                                                <br>
                                                <button type="button" style="width: 30%;" class="btn btn-primary pull-right">Post</button>
                                                <div class="clearfix"></div>
                                                <hr>
                                               
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                            </div>

                            <div class="row">
                                
                <!-- COMMENT 1 - START -->
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="blog-comment">
                               
                                <ul class="comments">

                                <li class="clearfix">
                                  <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar" alt="">
                                  <div class="post-comments">
                                      <p class="meta"> <a href="#">JohnDoe</a> says : <i class="pull-right"></i></p>
                                      <p>
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                          Etiam a sapien odio, sit amet
                                      </p>
                                  </div>
                                </li>

                                
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COMMENT 1 - END -->

                 <!-- COMMENT 1 - START -->
                 <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="blog-comment">
                               
                                <ul class="comments">

                                <li class="clearfix">
                                  <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar" alt="">
                                  <div class="post-comments">
                                      <p class="meta"> <a href="#">JohnDoe</a> says : <i class="pull-right"></i></p>
                                      <p>
                                          Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                          Etiam a sapien odio, sit amet
                                      </p>
                                  </div>
                                </li>

                                
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- COMMENT 1 - END -->

                       <!-- COMMENT 1 - START -->
                       <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="blog-comment">
                                   
                                    <ul class="comments">
    
                                    <li class="clearfix">
                                      <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar" alt="">
                                      <div class="post-comments">
                                          <p class="meta"> <a href="#">JohnDoe</a> says : <i class="pull-right"></i></p>
                                          <p>
                                              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                              Etiam a sapien odio, sit amet
                                          </p>
                                      </div>
                                    </li>
    
                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COMMENT 1 - END -->
                            </div>

                        </div>

                            <!--Navigation-->
                            <div class="row" style="margin-top: 5%;">
                                <div class="col-4"></div>
    
                                <div class="col-4">
                                  <nav aria-label="Page navigation example">
                                      <ul class="pagination">
    
                                        <li class="page-item">
                                          <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                          </a>
                                        </li>
    
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
    
                                        <li class="page-item">
                                          <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                          </a>
                                        </li>
    
                                      </ul>
                                    </nav>
                                </div>
    
                                <div class="col-4"></div>
                              </div>

                   </div>
               </div>
        
            </div>

        </div>

        <!--Espacio der-->
        <div class="col-2"></div>

    </div>

        <!-- Modal Diploma-->
        <div class="modal fade" id="ModalDip" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                   
                    <div class="modal-body" style="padding-top: 2%; padding-bottom: 2%;">
                
        
                    <div class="row">
                       <!--
                        <img src="http://localhost:8012/Acodemia/diploma/Diploma.png" class="img-fluid" alt="Responsive image">
          -->

          <div id="box-search">
            <div class="thumbnail">
                <img src="http://localhost:8012/Acodemia/diploma/Diploma.png" class="img-fluid diploma" alt="Responsive image">
                <div class="caption">
                    <h1>Certificado de finalización</h1>
                    <h4>Se certifica que </h4>
                    <h2>???</h2>
                    <h6>Ha terminado satisfactoriamente el curso de ??? el dia ?? del mes ?? del año ????</h6>
                </div>
            </div>
        </div>


                    </div>
        
             
                    </div>
                   </div>
                </div>
        </div>

    <!--Modal Pay-->
    <!--https://bbbootstrap.com/snippets/payment-form-three-different-payment-options-13285516 -->
    <div class="modal fade" id="ModalPay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           
            <div class="modal-body" style="padding: 0px;" >
                <div class="card" style="color: black; margin: 0px;">
                    <div class="card-header">
                        <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                            <!-- Credit card form tabs -->
                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                                <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                            </ul>
                        </div> <!-- End -->
                        <!-- Credit card form content -->
                        <div class="tab-content">
                            <!-- credit card info-->
                            <div id="credit-card" class="tab-pane fade show active pt-3">
                                <form role="form" style="margin: 0px;" onsubmit="event.preventDefault()">
                                    <div class="form-group"> <label for="username">
                                            <h6>Card Owner</h6>
                                        </label> <input type="text" name="username" placeholder="Card Owner Name" required class="form-control "> </div>
                                    <div class="form-group"> <label for="cardNumber">
                                            <h6>Card number</h6>
                                        </label>
                                        <div class="input-group"> <input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
                                            <div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group"> <label><span class="hidden-xs">
                                                        <h6>Expiration Date</h6>
                                                    </span></label>
                                                <div class="input-group"> <input type="number" placeholder="MM" name="" class="form-control" required> <input type="number" placeholder="YY" name="" class="form-control" required> </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                    <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                </label> <input type="text" required class="form-control"> </div>
                                        </div>
                                    </div>
                                    <div class="card-footer"> 
                                        <button type="button" class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
                                </form>
                            </div>
                        </div> <!-- End -->
                        <!-- Paypal info -->
                        <div id="paypal" class="tab-pane fade pt-3">
                          
                        <div id="paypal-payment-button">
                        </div>
                        

                        <p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                            
        

                        </div> <!-- End -->
                        <!-- End -->
                    </div>
                </div>
           </div>
        </div>
    </div>
    
 

</body>
</html>