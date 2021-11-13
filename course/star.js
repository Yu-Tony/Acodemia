$(document).ready(function(){
  
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
  
  $( "#btnComment" ).click(function() {
  
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

    
});


