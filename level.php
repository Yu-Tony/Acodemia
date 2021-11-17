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

        $(document).ready()
        {  
         
         getMessagesChat();

            var userMail=0;
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            var searchText = urlParams.get('level');
            var searchCourse = urlParams.get('course');

            var jwt = getCookie('jwt');
            $.post("api/validate_token.php", JSON.stringify({ jwt:jwt }))
            .done(function(result) {

                var userMail = result.data.email;
                var tipo=result.data.typeAccount;
                
                $.ajax({
                    url: "level/showLevel.php",
                    type : "POST",
                    data: {'level': searchText, 'course': searchCourse, 'mail': userMail}, 
                    success : function(result) {

                        //alert(result);
                        $("#levelPrincipal").html(result);                         
                        
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
                    url: "level/showLevelsInLevel.php",
                    type : "POST",
                    data: {'course': searchCourse, 'course': searchCourse, 'mail': userMail, 'tipo': tipo}, 
                    success : function(result) {

                        //alert(result);
                        $("#allLevels").html(result);                         
                        
                    },
                    error: function(xhr, resp, text){

                        if(text == "Gone")
                        {
                            window.location = 'http://localhost:8012/Acodemia/';
                        }
                        else
                        {
                            window.location = ' error/404.html';
                        }
                        // on error, tell the user sign up failed
                        
                        console.log("Error al crear cuenta  " + text);
                        console.log("Response text  " + xhr.responseText);
                        //$('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
                    }
                });
            
            })
            .fail(function() {
          
                window.location = 'http://localhost:8012/Acodemia/';
        
               
            });


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



        window.setTimeout(function(){
            $(function(){ /* DOM ready */ 
                $('.VerMas').click(function(){ 
                    if ( $(this).parent().parent().find('.DescripcionCurso').css('display') == 'none' ) 
                        $(this).parent().parent().find('.DescripcionCurso').css('display','block'); 
                    else $(this).parent().parent().find('.DescripcionCurso').css('display','none'); 
                }); 
            }); 

            $( "#Terminar" ).click(function() 
            {
                var userMail=0;
                var queryString = window.location.search;
                var urlParams = new URLSearchParams(queryString);
                var searchText = urlParams.get('level');

                var jwt = getCookie('jwt');
                $.post("api/validate_token.php", JSON.stringify({ jwt:jwt }))
                .done(function(result) {

                    var userMail = result.data.email;
                    
                    $.ajax({
                        url: "level/completarLevel.php",
                        type : "POST",
                        data: {'level': searchText,'mail': userMail}, 
                        success : function(result) {

                            alert("Nivel terminado");
                            document.getElementById('Terminar').style.visibility = 'hidden';
                            //
                            //$("#levelPrincipal").html(result);                         
                            
                        },
                        error: function(xhr, resp, text){
                            // on error, tell the user sign up failed
                           alert("Error al tratar de terminar el nivel, intente de nuevo");
                            console.log("Error al crear cuenta  " + text);
                            console.log("Response text  " + xhr.responseText);
                            //$('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
                        }
                    });
                
                })

            });
        }, 600);

    </script>

</head>
<body style="background-color: #0b1925;">

    <div class="row">
        <!--Espacio izq-->
        <div class="col-2"></div>

        <!--Principal-->
        <div class="col-8" style="background-color: #073352; padding:1%; color: whitesmoke;">
            <div class="row">
              <div class="col-sm-8 col-12" id="levelPrincipal">
   


              </div>
                
              <div class="col-sm-4 col-12" id="allLevels">
                


              </div>
            </div>
           
        </div>
        
        <!--Espacio der-->
        <div class="col-2"></div>
    </div>
    
</body>
</html>