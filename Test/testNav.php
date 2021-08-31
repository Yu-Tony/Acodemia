
<script>
    function daysInMonth(month, year) {
  return new Date(year, month, 0).getDate();
}

  /*$('ul').on('click', 'a',function() {
      //if(this==$('#leEstaCosa'))
        $.post("/ProfileController", {name : "Message from jsp"});
   });*/
    /*function PruebaServlet(){
    $.ajax({
            url:'/ProfileController',
            data:{name : "Message from jsp"},
            type:'post',
            cache:false,
            success:function(data){
               alert(data); 
            },
            error:function(){
              alert('error');
            }
        }}*/
    function PruebaServlet(){
         System.out.println("Message from jsp");
        $.post("./ProfileController", {name : "Message from jsp"}, alert(""));
       
    }
    
    $('#yearDropdown, #monthDropdown').change(function() {

      if ($('#yearDropdown').val().length > 0 && $('#monthDropdown').val().length > 0) 
      {
        $('#dayDropdown').prop('disabled', false);
        $('#dayDropdown').find('option').remove();

        //var days = new Date($('#monthDropdown').val(), $('#yearDropdown').val(), 0).getDate();
        var daysInSelectedMonth = daysInMonth($('#monthDropdown').val(), $('#yearDropdown').val());

        for (var i = 1; i <= daysInSelectedMonth; i++) {
          $('#dayDropdown').append($("<option></option>").attr("value", i).text(i));
        }


      } 
      else {
        $('#dayDropdown').prop('disabled', true);
      }


    });

    function LogOut()
    {
        '${NombreUsuario}' = null;
        alert('${NombreUsuario}');
    }
    
  
  

</script>


    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
   <body onload="loadAgeSelector()">
          <!--NAVBAR-->
  

  <nav class="navbar sticky-top navbar-expand-lg navbar-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation" style="background-color: #82B7DC;">
      <span class="navbar-toggler-icon"></span>
    </button>
      
    <a class="navbar-brand" href="/DbConnection" style="color: whitesmoke;">  <img src = 'assets/Images/conversation.png' style="height: 30px; margin-right: 5px;" /> ASKY</a>
  
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        
        <form action="./SearchController" method="POST" enctype="multipart/form-data">
            <input id = "busqueda" name = "busqueda"class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width:400px" ">
            <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
        </form>
      </ul>
               
      
      <div class="inline my-2 my-lg-0">
        
       
     
      
      </div>


       

        <span class="navbar-text" style="margin-right: 2%">
         
          <ul class="navbar-nav mr-auto">
          
            <li class="nav-item">
              <button class="btn btn-outline-primary my-2 my-sm-0" id="btnPregunta" onclick="location.href = '/DbConnection/assets/html/CrearPreguntas.jsp';">Preguntar  <i class="fas fa-question"></i></button>
            </li>

            <form action="./LoginController" method="POST" id="ModalLogIn" enctype="multipart/form-data">
              <!-- Button trigger modal -->
              <c:if test = "${NombreUsuario == null}">
              <button type="button" class="btn btn-outline-primary" data-toggle="modal" id="btnIniciarSesion" data-target="#modalIniciar">
                Iniciar sesion
              </button>
              </c:if>

              <!-- Modal -->
              <div class="modal fade" id="modalIniciar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                     
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"  style="padding-left: 0px; padding-right: 0px;">
                      <div class="container-fluid">
                        <div class="row"  >
                          <div class="col-image col-lg-6">
                            <img src="assets/Images/login.jpg" class="img-fluid" alt="Responsive image">
                          </div>

                          <div class="col-sm-12 col-md-12 col-lg-6">
                                                     
                              <div class="container">
                        
                                <div class="text-center">
                                  <img src="https://www.edmundsgovtech.com/wp-content/uploads/2020/01/default-picture_0_0.png" class="img-fluid rounded-circle" alt="Responsive image" style="margin-bottom: 30px;"/>
                                  <input id="emailLI" type="text" class="form-control input-sm" placeholder="Enter Email" name="correo" required autocomplete="off" required /> 
                                  <input id="ps1LI" type="password" class="form-control input-sm" placeholder="Enter Password" name="contrasena" required /> 
                                </div>

                
                               
                
                        
                                <div class="container text-center" >
                                  <div class="col-4">  <span class="psw">Forgot <a href="https://www.youtube.com/watch?v=Fc-fa6cAe2c">password?</a></span></div>
                                  <div class="col-4"> <button  type="submit" class="btn btn-primary">Login</button></div>
                                  <div class="col-4">  <label style="float: right;"> <input type="checkbox" checked="checked" name="remember" /> Remember me </label></div>

                                
                                 
                                
                                </div>
                        
                
                              </div>
                
                          </div>
                        </div>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
                    
            </form>

            <form action="./UsersController" method="POST" id="ModalRegistrarse" enctype="multipart/form-data">
              <!-- Button trigger modal -->
      
 <c:if test = "${NombreUsuario == null}">
                       <button type="button" class="btn btn-outline-primary" data-toggle="modal" id="btnRegistrarse" data-target="#modalRegistrarse">
                        Registrarse
                     </button>
</c:if>

              <!-- Modal -->
              <div class="modal fade" id="modalRegistrarse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                     
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"  style="padding-left: 0px; padding-right: 0px;">
                      <div class="container-fluid">
                        <div class="row"  >
                          <div class="col-image col-lg-6">
                            <img src="assets/Images/signin.jpg" class="img-fluid" alt="Responsive image">
                          </div>

                          <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                  
                              
                              
                            <div class="text-center">
                              <img src="https://www.edmundsgovtech.com/wp-content/uploads/2020/01/default-picture_0_0.png" id="imagen_perfil" class="img-fluid rounded-circle" alt="Imagen de perfil" style="margin-bottom: 30px; width: 300px;  "/>
                          
                              <input type="file" name="profile_pic" id="profile_pic" hidden onchange="readURL(this);"  accept="image/x-png,image/jpeg" />
                              <label for="profile_pic" class="btn btn-outline-primary center">Choose file</label>
                              <div class="input-group" style="margin-bottom: 15px;"> 
                        
                                <input id="nombre" type="text" class="form-control input-sm" placeholder="Nombres" name="nombre" required oninput="validateFName();" />
                                <input id="apellidos" type="text" class="form-control input-sm" placeholder="Apellidos" name="apellidos" required oninput="validateLName();" /> 
                      
                              </div> 
                              <input id="correo" type="text" class="form-control input-sm" placeholder="Enter Email" name="correo" autocomplete="off" required oninput="validateMail();"/> 
                              <input id="username" type="text" class="form-control input-sm" placeholder="Enter Username" name="username" autocomplete="off" required/> 
                              <input id="contrasena" type="password" class="form-control input-sm" placeholder="Enter Password" name="contrasena" required oninput="validatePassword();" /> 
                              <input id="pw2SU" type="password" class="form-control input-sm" placeholder="Confirm Password" name="pw2" required  oninput="validatePassword();"/>  
                              <label for="Birthday"><b>Fecha de nacimiento</b></label>
                              <div class="form-row">
                                 
                                                  
                                <div class="form-group col-md-4">
                                  <div class="form-group">
                          
                                     <select class="form-control" style="margin-top: 8px;" id="yearDropdown">
                                     <option value="">Seleccionar a�o</option>
                      
                                    </select>

                                      <script>
                                        let dateDropdown = document.getElementById('yearDropdown'); 

                                        let currentYear = new Date().getFullYear();    
                                        let earliestYear = 1970;     
                                        while (currentYear >= earliestYear) {      
                                          let dateOption = document.createElement('option');          
                                          dateOption.text = currentYear;      
                                          dateOption.value = currentYear;        
                                          dateDropdown.add(dateOption);      
                                          currentYear -= 1;    
                                        }
                                      </script>
                                  </div>
                                </div>
                                  
                                <div class="form-group col-md-4">
                                  <div class="form-group">
                          
                                    <select class="form-control"  style="margin-top: 8px;" id="monthDropdown">
                                        <option value="">Seleccionar mes</option>
                                     <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">Novermber</option>
                                        <option value="12">December</option>
                      
                                    </select>
                                  </div>
                                </div>
      
                                  
                                <div class="form-group col-md-4">
                                  <div class="form-group">
                          
                                    <select class="form-control"  style="margin-top: 8px;" id="dayDropdown" disabled>
                                              <option value="">Seleccionar dia</option>      
                                    </select>
                                      
                   
                                  </div>
                                </div>
                      
                          
                      
                              </div>

                              <div class="container" >
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 text-center" style="visibility: hidden;">https://www.youtube.com/watch?v=H0_HrmPljVU</div>
                                    <div class="col-md-4 col-sm-12 text-center" > <button id = "buttonSignUp" type="submit" value="Registrarse" class="btn btn-outline-primary" style="align-self: center;">Sign In</button></div>
                                    <div class="col-md-4 col-sm-12 text-center"> <label style="float: right;"> <input type="checkbox" checked="checked" name="remember" /> Remember me </label>
                                    </div>
                                </div>
                            </div>
                            </div>

                      

              
                           </div>

                        </div>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
                    
            </form>
       
            <c:if test = "${NombreUsuario != null}">
                 <div class="dropdown" id="ProfileDropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown" >
                  <img id="ImageDropPerfil" src="https://64.media.tumblr.com/0ec4ce1891988685d8e0fde02613e879/360aba19a5843b67-af/s640x960/eb66bc39b8a25fefb7b489237fccd01fb6bdc297.jpg" style="max-width: 25px;">
                 <span class="caret"></span>
              </button>
                
              <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="menu1">
                  
                  <a onclick = "PruebaServlet()" id="leEstaCosa" href="#" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>             
                <a href="#" class="dropdown-item"><i class="fa fa-sliders"></i> Settings</a>
                <div class="divider dropdown-divider"></div>
                <a href=""  class="dropdown-item"><i class="fas fa-sign-out-alt"></i>Logout</a>
              </ul>
            </div> 
                
            </c:if>

          
            
          </ul>
        </span>




    </div>
  </nav>



  
    </body>
