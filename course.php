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
    <link rel="stylesheet" href="course/input.css">
    <script src="Payment/card.js"></script>

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
                    var tipo=result.data.typeAccount;
                    
                    $.ajax({
                        url: "course/showCourse.php",
                        type : "POST",
                        data: {'course': searchText,'mail': userMail, 'tipo': tipo }, 
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

 
        window.setTimeout(function(){

            /*----------------------------------------------------------------------ESTRELLAS--------------------------------------------- */

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
                
            /*----------------------------------------------------------------------COMENTAR--------------------------------------------- */


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

            /*----------------------------------------------------------------------BORRAR--------------------------------------------- */


            $( "#DeleteCourse" ).click(function() 
            {

                    var queryString = window.location.search;
                    var urlParams = new URLSearchParams(queryString);
                    searchText = urlParams.get('course');

                    var jwt = getCookie('jwt');
                    $.post("api/validate_token.php", JSON.stringify({ jwt:jwt }))
                    .done(function(result) {
                        userMail = result.data.email;
                        userName = result.data.firstname;
                        
                        $.ajax({
                        url: "course/deleteCourse.php",
                        type : "POST",
                        data: {'course':searchText}, 
                        success : function(result) {

                            alert(result);
                            //$("#commentSection").append(result);
                                  
                            
                        },
                        error: function(xhr, resp, text){
                            // on error, tell the user sign up failed
                            //
                            
                            if(text == "Gone")
                            {
                                window.location = ' index.php';
                            }
                            else
                            {
                                window.location = ' error/404.html';
                            }
                            console.log("Error al crear cuenta  " + text);
                            console.log("Response text  " + xhr.responseText);
                            //$('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
                        }
                        });
                    
                    });
            });

            /*----------------------------------------------------------------------EDITAR--------------------------------------------- */
            $( "#EditCourse" ).click(function() 
            {
                $('#nameEdit').css('display','inline-block');
                $('#descEdit').css('display','inline-block');

                $('#SaveCourse').css('display','inline-block');
                $('#CancelEditCourse').css('display','inline-block');

                $(this).css('display','none');

                $("#displayName").css('display','none');
                $("#displayDesc").css('display','none');
               

            });
            
            $( "#SaveCourse" ).click(function() 
            {

                var newName = document.getElementById("nameEdit").value;
                var newDesc = document.getElementById("descEdit").value;
                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                searchText = urlParams.get('course');

                var jwt = getCookie('jwt');
                $.post("api/validate_token.php", JSON.stringify({ jwt:jwt }))
                .done(function(result) {
                   
                    
                    $.ajax({
                    url: "course/editCourse.php",
                    type : "POST",
                    data: {'name':newName, 'desc':newDesc, 'idCurso':searchText}, 
                    success : function(result) {

                        //alert(result);

                        $('#displayName').html(newName);
                        $('#displayDesc').html(newDesc);


                        $('#nameEdit').css('display','none');
                        $('#descEdit').css('display','none');

                        $('#SaveCourse').css('display','none');
                        $('#CancelEditCourse').css('display','none');

                        $('#EditCourse').css('display','inline-block');

                        $("#displayName").css('display','inline-block');
                        $("#displayDesc").css('display','inline-block');
                        //$("#commentSection").append(result);
                              
                        
                    },
                    error: function(xhr, resp, text){
                        // on error, tell the user sign up failed
                        //
    
                        
                        if(text == "Gone")
                        {
                            alert("Error al editar curso, intente de nuevo");
                        }
                        /*else
                        {
                            window.location = ' error/404.html';
                        }*/
                        console.log("Error al crear cuenta  " + text);
                        console.log("Response text  " + xhr.responseText);
                        //$('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
                    }
                    });
                
                });
            });

            $( "#CancelEditCourse" ).click(function() 
            {
                $('#nameEdit').css('display','none');
                $('#descEdit').css('display','none');

                $('#SaveCourse').css('display','none');
                $('#CancelEditCourse').css('display','none');

                $('#EditCourse').css('display','inline-block');

                $("#displayName").css('display','inline-block');
                $("#displayDesc").css('display','inline-block');

            });
            
            $( ".btnComprar" ).click(function() 
            {
                var precio = ($(this).siblings("div").find(".precioIndividual").html());
                localStorage.setItem("precio", precio);
    
                if($(this).hasClass("btnCurso"))
                {
                   
                    var cursoName = $('#displayName').html();
                    localStorage.setItem("name", cursoName);

                    localStorage.setItem("tipoCompra", "Curso");

                    var queryString = window.location.search;
                    var urlParams = new URLSearchParams(queryString);
                    var searchText = urlParams.get('course');
                    localStorage.setItem("id", searchText);

                    console.log(localStorage);

                }

                if($(this).hasClass("btnNivel"))
                {
                    var nivelName =$(this).parent().parent().siblings(".divName").find(".nombreNivelDisplay").html();
                    localStorage.setItem("name", nivelName);

                    localStorage.setItem("tipoCompra", "Nivel");

                    var nivelId =$(this).parent().parent().siblings(".divName").find(".nivelIdComprado").html();
                    localStorage.setItem("id", nivelId);
                    
                    console.log(localStorage);
                }
                
//
            });

            /*----------------------------------------------------------------------A;OS PARA LA TARJETA--------------------------------------------- */
            $('#yearpicker').html('<option value="">Seleccionar un año</option>');
            var html = '';
                    for (var i =new Date().getFullYear(); i <= 2040; i++) {
                        html += '<option value="' + i + '">' + i + '</option>';
                    }
                    $('#yearpicker').append(html);

            /*----------------------------------------------------------------------COMPRAR CON TARJETA--------------------------------------------- */

             $('#CardPayment').on('submit', function(e){
                e.preventDefault();
                
                var jwt = getCookie('jwt');
                $.post("api/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
                
        
                    var email = result.data.email;
                    var temp = localStorage.getItem("tipoCompra");
                    var id = localStorage.getItem("id");

                    if(temp=="Curso")
                    {
                        $.ajax({
                        url: "Payment/comprarCurso.php",
                        type : "POST",
                        data: {'idCurso': id,'mail': email, 'metodo': 1 }, 
                        success : function(result) {

                            //console.log(result);  
                      
                            $("#ResultPayment").html("Pago realizado exitosamente. Gracias por su compra");       
  
                            $(':input','#ModalPay')
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .prop('checked', false)
                            .prop('selected', false);

                            localStorage.clear();                      
                            
                        },
                        error: function(xhr, resp, text){
                            
                            if(text == "Gone")
                            {
                                alert("Error al hacer el pago, intente de nuevo");
                            }

                            console.log("Error al crear cuenta  " + text);
                            console.log("Response text  " + xhr.responseText);
                            localStorage.clear();  
                    
                        }
                        });
                    }
                    else
                    { 
                        $.ajax({
                        url: "Payment/comprarNivel.php",
                        type : "POST",
                        data: {'idNivel': id,'mail': email, 'metodo': 1 }, 
                        success : function(result) {

                
                            $("#ResultPayment").html("Pago realizado exitosamente. Gracias por su compra");       
                           
                          
                            $(':input','#ModalPay')
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .prop('checked', false)
                            .prop('selected', false);
                                
                            localStorage.clear();                  
                            
                        },
                        error: function(xhr, resp, text){
                            if(text == "Gone")
                            {
                                alert("Error al hacer el pago, intente de nuevo");
                            }

                            console.log("Error al crear cuenta  " + text);
                            console.log("Response text  " + xhr.responseText);
                            localStorage.clear(); 
                        }
                        });

                    }
                    
                    })

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
                                <form role="form" style="margin: 0px;" id="CardPayment" onsubmit="event.preventDefault()">
                                    <div class="form-group"> 
                                        <label for="username">
                                            <h6>Nombre del titular</h6>
                                        </label> 
                                        <input type="text" pattern="[a-zA-Z]*" id="cardName" name="username" placeholder="Nombre del titular de la tarjeta" required class="form-control"  oninput="validateCardName();"> 
                                    </div>

                                    <div class="form-group"> 
                                        <label for="cardNumber">
                                            <h6>Numero de tarjeta</h6>
                                        </label>
                                        <div class="input-group"> 
                                            <input type="number" name="cardNumber" id="cardNumber" placeholder="Número de tarjeta valido" class="form-control" oninput="validateCardNumber();" required>
                                            <div class="input-group-append"> 
                                                <span class="input-group-text text-muted"> 
                                                    <i class="fab fa-cc-visa mx-1"></i> 
                                                    <i class="fab fa-cc-mastercard mx-1"></i>
                                                    <i class="fab fa-cc-amex mx-1"></i> 
                                                </span> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group"> <label><span class="hidden-xs">
                                                        <h6>fecha de expiración</h6>
                                                    </span></label>
                                                <div class="input-group"> 
                                                    <select required>
                                                        <option value="">Selecciona un mes</option>
                                                        <option value="01">Enero</option>
                                                        <option value="02">Febrero </option>
                                                        <option value="03">Marzo</option>
                                                        <option value="04">Abril</option>
                                                        <option value="05">Mayo</option>
                                                        <option value="06">Junio</option>
                                                        <option value="07">Julio</option>
                                                        <option value="08">Agosto</option>
                                                        <option value="09">Septiembre</option>
                                                        <option value="10">Octubre</option>
                                                        <option value="11">Noviembre</option>
                                                        <option value="12">Diciembre</option>
                                                    </select>
    
                                                    <select required name="yearpicker" id="yearpicker"></select>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group mb-4"> <label data-toggle="tooltip" title="Los 3 dígitos atrás de tu tarjeta">
                                                    <h6>Codigo de seguridad <i class="fa fa-question-circle d-inline"></i></h6>
                                                </label> <input id="CVV"  maxlength="3" pattern="\d{3}" type="password" placeholder="3 dígitos" required class="form-control" oninput="validateCardCVV();"> </div>
                                        </div>
                                        
                                    </div>
                                    <div id="ResultPayment" style="backgrund-color: rgb(119,221,119);"></div>
                                    <div class="card-footer"> 
                                        <button type="submit" class="subscribe btn btn-primary btn-block shadow-sm"> Confirmar Pago </button>
                                </form>
                            </div>
                            <!-- End -->
                        </div> 


                        <!-- Paypal info -->
                        <div id="paypal" class="tab-pane fade pt-3">

                            <div id="paypal-payment-button"></div>
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