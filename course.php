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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="course/star.css">
    <!--<script src="course/star.js"></script>-->

    <!--Toggle de los cursos-->
    <script> 

        


        $(document).ready()
        {  
         
            var userMail=0;
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            searchText = urlParams.get('course');
           
            if(searchText!=null)
            {
                // validate jwt to verify access
                var jwt = getCookie('jwt');
                $.post("api/validate_token.php", JSON.stringify({ jwt:jwt }))
                .done(function(result) {
                    userMail = result.data.email;
                    
                    $.ajax({
                        url: "course/showCourse.php",
                        type : "POST",
                        data: {'course': searchText,'mail': userMail }, 
                        success : function(result) {

              
                            $("#TituloCurso").html(result);                         
                            
                        },
                        error: function(xhr, resp, text){
                            // on error, tell the user sign up failed
                            window.location = ' error/404.html';
                            console.log("Error al crear cuenta  " + text);
                            console.log("Response text  " + xhr.responseText);
                            //$('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
                        }
                    });
               
                })
                .fail(function() {
                    $.ajax({
                        url: "course/showCourse.php",
                        type : "POST",
                        data: {'course': searchText,'mail': userMail }, 
                        success : function(result) {

                            $("#TituloCurso").html(result);                         
                            
                        },
                        error: function(xhr, resp, text){
                            // on error, tell the user sign up failed
                            window.location = ' error/404.html';
                            console.log("Error al crear cuenta  " + text);
                            console.log("Response text  " + xhr.responseText);
                            //$('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
                        }
                    });
                });
            }
        }

 
        window.setTimeout(function(){
              /*---------------------------------------ESTRELLAS-------------------------------- */

            $(function(){ /* DOM ready */ 
                $('.VerMas').click(function(){ 
                    if ( $(this).parent().parent().find('.DescripcionCurso').css('display') == 'none' ) 
                        $(this).parent().parent().find('.DescripcionCurso').css('display','block'); 
                    else $(this).parent().parent().find('.DescripcionCurso').css('display','none'); 
                }); 
            }); 

            var ratingValue = 0;

            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function(){
                    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
                
                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function(e){
                    if (e < onStar) {
                    $(this).addClass('hover');
                    }
                    else {
                    $(this).removeClass('hover');
                    }
                });
                
            }).on('mouseout', function(){
                $(this).parent().children('li.star').each(function(e){
                    $(this).removeClass('hover');
                });
            });
                
                
            /* 2. Action to perform on click */
            $('#stars li').on('click', function(){
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');
                
                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }
                
                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }
                
                // JUST RESPONSE (Not needed)
                ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);

            
            });
                
            $( "#btnComment" ).click(function() 
            {
            
                if(document.getElementById("commentArea").value != '')
                {
                    var comment = document.getElementById("commentArea").value;
                    var userMail=0;
                    var userName=0;
                    var searchText = urlParams.get('course');

                    var jwt = getCookie('jwt');
                    $.post("api/validate_token.php", JSON.stringify({ jwt:jwt }))
                    .done(function(result) {
                        userMail = result.data.email;
                        userName = result.data.firstname;
                        
                        $.ajax({
                        url: "course/submitComment.php",
                        type : "POST",
                        data: {'comment': comment,'stars': ratingValue, 'mail':userMail, 'id': searchText, 'username':userName}, 
                        success : function(result) {

                            //alert(result);
                            $("#commentSection").append(result);
                            //ponerComentario
                            $('#ponerComentario'). css ("display", "none");
                            //document.getElementById("commentArea").value = "";
                            //$("#commentSection").html(result);                         
                            
                        },
                        error: function(xhr, resp, text){
                            // on error, tell the user sign up failed
                            window.location = ' error/404.html';
                            console.log("Error al crear cuenta  " + text);
                            console.log("Response text  " + xhr.responseText);
                            //$('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
                        }
                        });
                    
                    });


                }
                else
                {
                    alert("Debe escribir un comentario")
                }
            });
        }, 600);



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

            <!--Titulo del curso-->
            <div id="TituloCurso"></div>


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