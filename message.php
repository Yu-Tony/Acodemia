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

    <link rel="stylesheet" href="http://localhost:8012/Acodemia/Messages/message.css">
    <script src="http://localhost:8012/Acodemia/Messages/message.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>

    <script>

    $(document).ready(function() {

      var jwt = getCookie('jwt');
        $.post("api/validate_token.php", JSON.stringify({ jwt:jwt }))
        .done(function(result) {

          var userMail = result.data.email;
          var queryString = window.location.search;
          var urlParams = new URLSearchParams(queryString);
          var chat = urlParams.get('chat');
          var otherUser = 0;

          $.ajax({
            url: "Messages/getMessages.php",
              type : "POST",
              data: {'idChat': chat, 'mail': userMail, 'idOtherUser':otherUser}, 
              success : function(result) {
                  //alert(result);
              
                  $( "#ChatMessages" ).html( result );

              },
              error: function(xhr, resp, text){
                  // on error, tell the user sign up failed
                  alert("Error al enviar el mensaje. Intente de nuevo");
                  console.log("Error al crear cuenta  " + text);
                  console.log("Response text  " + xhr.responseText);
          
              }
          });

        })



      $( "#sendMessage" ).click(function() 
      {
        
        var jwt = getCookie('jwt');
        $.post("api/validate_token.php", JSON.stringify({ jwt:jwt }))
        .done(function(result) {

          var queryString = window.location.search;
          var urlParams = new URLSearchParams(queryString);
          var searchText = urlParams.get('user');

          var userMail = result.data.email;
          var nombre = result.data.firstname;
         
          var mensaje = document.getElementById('MessageToSend').value;

          if(mensaje!=null)
          {
            $.ajax({
              url: "Messages/sendMessages.php",
                type : "POST",
                data: {'mensaje': mensaje,'mail': userMail, 'usuarioDestino':searchText, 'nombre': nombre }, 
                success : function(result) {
                    //alert(result);
                    document.getElementById("MessageToSend").value = "";
                    $( "#ChatMessages" ).append( result );

                },
                error: function(xhr, resp, text){
                    // on error, tell the user sign up failed
                    alert("Error al enviar el mensaje. Intente de nuevo");
                    console.log("Error al crear cuenta  " + text);
                    console.log("Response text  " + xhr.responseText);
            
                }
            });
          }
          else
          {
            alert("Debe escribir un mensaje antes de enviar");
          }

        
        })

      });

      getMessagesChat();

    });


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
<body  style="background-color: #0b1925;">

  <div class="row">
      <!--Espacio izq-->
      <div class="col-2"></div>
      <!--Principal-->
      <div class="col-8" style="background-color: #073352; padding:0px">

    
        <div class="inbox_msg">
           
          <div class="mesgs">
            <div class="msg_history" id="ChatMessages">


                  
             

                    
            </div>

                  <div class="type_msg">
                    <div class="input_msg_write">
                      <input id="MessageToSend" type="text" class="write_msg" placeholder="Type a message" />

                      <button class="msg_send_btn" id ="sendMessage" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
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