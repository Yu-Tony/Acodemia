<?php

    $pdo = new PDO('mysql:host=127.0.0.1:3307;dbname=acodemiadb', 'root', '');
    $call =  $pdo->prepare('CALL categoriaGetAll()');     

    if($call->execute())
    {
        $categoriasVar = $call->fetchAll(PDO::FETCH_ASSOC);
    }

?>
    
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!--iconos-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--css-->
    <link rel="stylesheet" href="http://localhost:8012/Acodemia/NavBar/navbar.css">
    <script src="http://localhost:8012/Acodemia/NavBar/navbar.js"></script>

    <!--iconos-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!--Media-->
    <link rel="stylesheet" href="http://localhost:8012/Acodemia/Media/media.css">
    <link rel="stylesheet" href="http://localhost:8012/Acodemia/Main/card.css">
    <link rel="stylesheet" href="http://localhost:8012/Acodemia/Main/tabs.css">
    <link rel="stylesheet" href="http://localhost:8012/Acodemia/Main/titles.css">

    <!--Jquery plugin bootstrap-select-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!--Video plugin-->
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>

    <!---JS-->


    
  <script type="text/javascript">

//------------------------------------------USER IS LOGGED OR NOT---------------------------------
    $(document).ready()
    {
    
      getTypeAccount();
      
    }

    function getTypeAccount()
    {
        // validate jwt to verify access
        var jwt = getCookie('jwt');
        $.post("api/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
          document.getElementById("NavUserLog").style.display = "inline";
          document.getElementById("NavUserNotLog").style.display = "none";

         // alert(result.data.typeAccount);
          if(result.data.typeAccount==1)
          {
            console.log("TYPE 1");
            document.getElementById("btn-crear-curso").style.display = "inline";
          }
          else
          {
            console.log("TYPE 0");
            document.getElementById("btn-crear-curso").style.display = "none";
          }

 
          $fname = result.data.firstname; 
          $space = " ";
       
          $lname = result.data.lastname; 

          
          $("#UserNameLog").html($fname+$space+$lname);


        })

        // show login page on error
        .fail(function(result){
            document.getElementById("NavUserLog").style.display = "none";
          document.getElementById("NavUserNotLog").style.display = "inline";   
        });
    }

    /*----------------------------------------------SIGN IN---------------------------------------*/

     // trigger when registration form is submitted
    $(document).on('submit', '#sign_up_form', function(){
    
        // get form data
        var sign_up_form=$(this);
        var form_data=JSON.stringify(sign_up_form.serializeObject());


        ///////alert(form_data);
        // submit form data to api
        $.ajax({
            url: "api/create_user.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result) {
                // if response is a success, tell the user it was a successful sign up & empty the input boxes
                $('#response-sign').html("<div class='alert alert-success'>Successful sign up. Please login.</div>");
                $('#ModalSign').modal('hide');
                sign_up_form.find('input').val('');
            },
            error: function(xhr, resp, text){
                // on error, tell the user sign up failed
                console.log("Error al crear cuenta  " + text);
                console.log("Response text  " + xhr.responseText);
                $('#response-sign').html("<div class='alert alert-danger'>Unable to sign up. Please contact admin.</div>");
            }
        });

        return false;
    });

    /*--------------------------------------------------LOGIN--------------------------------------*/
    // trigger when login form is submitted
    $(document).on('submit', '#login_form', function()
    {
     

        // get form data
        var login_form=$(this);
        var form_data=JSON.stringify(login_form.serializeObject());

        
        // submit form data to api
        $.ajax({
            url: "api/login.php",
            type : "POST",
            contentType : 'application/json',
            data : form_data,
            success : function(result){
       
                // store jwt to cookie
                setCookie("jwt", result.jwt, 1);
                console.log("sucess");
                // show home page & tell the user it was a successful login
                /*showHomePage();*/
                $('#response-log').html("<div class='alert alert-success'>Successful login.</div>");
                $('#ModalLog').modal('hide');
                login_form.find('input').val('');
                document.getElementById("NavUserLog").style.display = "inline";
                document.getElementById("NavUserNotLog").style.display = "none";

                getTypeAccount();
               
            },
            error: function(xhr, resp, text){
              console.log("fail");
                // on error, tell the user login has failed & empty the input boxes
                console.log("Error al iniciar sesion " + text);
                console.log("Response text  " + xhr.responseText);
      

                $('#response-log').html("<div class='alert alert-danger'>Login failed. Email or password is incorrect.</div>");
                login_form.find('input').val('');
            }
        });

        return false;
    });

    /*---------------------------------------------SEARCH------------------------------*/
         // trigger when registration form is submitted
         $(document).on('submit', '#search_form', function(){
    


          var formData = new FormData(this);
          var searchText = formData.get('searchword');

  
          //https://stackoverflow.com/questions/44419945/ajax-request-redirect-with-params
          window.location = 'http://localhost:8012/Acodemia/search.php?searchword=' + searchText + "&page=1";
          // submit form data to api
        

          return false;
        });

    // function to set cookie
    function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                var expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

    // get or read cookie
    function getCookie(cname){
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' '){
                c = c.substring(1);
            }
    
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    // function to make form values to json format
    $.fn.serializeObject = function()
    {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function() {
          if (o[this.name] !== undefined) {
              if (!o[this.name].push) {
                  o[this.name] = [o[this.name]];
              }
              o[this.name].push(this.value || '');
          } else {
              o[this.name] = this.value || '';
          }
      });
      return o;
    };

    function clearResponse(){
        $('#response-log').html('');
        $('#response-sign').html('');
    }

    function LogOut()
    {
      setCookie("jwt", "", 1);
      location.replace("http://localhost:8012/Acodemia/");
    }


    </script>


<nav class="navbar navbar-expand-md sticky-top" style="padding-right: 3%; padding-left: 3%; ">
        <!--Logo de la pagina-->
        <a href="http://localhost:8012/Acodemia/" class="navbar-brand">Acodemia</a>

        <!--Rallitas al minimizarlo-->
        <button style="background-color: #5c89b0;" type="button" class="navbar-toggler custom-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon" ></span>
        </button>


        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            
          <!--Dropdown-->
            <div class="navbar-nav">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: whitesmoke;">Categorías</a>

                    <ul class="dropdown-menu add-to-ul" aria-labelledby="navbarDropdownMenuLink">

                        <?php foreach($categoriasVar as $categoriaVar): ?>
                          <li><a  href="http://localhost:8012/Acodemia/search.php?category=<?= $categoriaVar['categoriaId'] ?>&page=1" class="dropdown-item" href="http://localhost:8012/Acodemia/search.php"><?= $categoriaVar['categoriaNombre']; ?></a></li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>

            <!--Search bar-->
            <div class=" col-xl-8 col-lg-8 col-md-8 col-sm-12" style="margin-top: 1%;">
                <form class="search-wrap" id="search_form">
                    <div class="input-group w-100"> 

                      <input type="text" name="searchword" class="form-control search-form" style="width:55%; " placeholder="Buscar">

                      <div class="input-group-append"> 
                        <button class="btn btn-primary search-button" type="submit"> 
                          <i class="fa fa-search"></i> 
                        </button> 
                      </div>

                    </div>
                </form>
            </div>

        
            
            <div class="navbar-nav ">
               
                <!--Cuando el usuario esta loggeado-->
                <!--  -->
                <div class="navbar-nav" id="NavUserLog" style="display: none;">
                    <button type="button" style="width: 200px;margin: 0 auto;display: none;" onClick="window.location.href='http://localhost:8012/Acodemia/create.php';" class="btn btn-primary" id="btn-crear-curso" >Crear Curso</button>

                    <div class="btn-group">
       
                      <button type="button"  id="UserNameLog" style="width: 200%; margin-left: 5%;" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img style="height:35px;" src="https://64.media.tumblr.com/2d670bdba5057dddf2e747e441412798/e6c29b6fecca43a4-cf/s1280x1920/28e06a4b3ab18fff6e733cb9a3701c3eadc731a4.jpg" class="avatar" alt="Avatar"> 
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="http://localhost:8012/Acodemia/profile.php" class="dropdown-item"><i class="fa fa-user-o"></i> Perfil</a></a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" onclick="LogOut()"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a></a>
                      </div>
                  </div>
                </div>
             
 
                <!--Cuando no hay usuario loggeado-->
                <div class="navbar-nav" id="NavUserNotLog">
                  <button type="button" id="SignBtn" class="btn btn-primary" onclick="clearResponse();" style="width: 200px;margin: 0 auto;display: inline;" data-toggle="modal" data-target="#ModalSign">Crear Cuenta</button>

                  <button type="button" id="LoginBtn" class="btn btn-secondary" onclick="clearResponse();" style="width: 200px;margin: 0 auto;display: inline;" data-toggle="modal" data-target="#ModalLog">Iniciar Sesion</button>

                </div>
              <!-- -->
            </div>
        </div>

    </nav>

    <!-- Modal Sign In-->
    <div class="modal fade" id="ModalSign" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
               
                <div class="modal-body" style="padding-top: 2%; padding-bottom: 2%;">
            
    
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                      
                      <p class="h4 mb-4 text-left">¡Comencemos!</p>
                      <p class="text-left">Crea una cuenta para explorar nuestros cursos</p> 

                        <!-- FORM -->
                        <form method="POST" id="sign_up_form" style="margin: 5%;">

             

                          <div class="row" style="padding-bottom: 2%;">

                            <div class="col-12">
                              <label >Tipo de cuenta</label>
                            </div>
                        
                            <div class="col-6">
                            
                              <select class="selectpicker" name="typeAccount" data-width="200%" title="Selecciona un tipo de cuenta..." required>
                                <option value="1">Maestro</option>
                                <option value="0">Alumno</option>
                              </select>
                              

                            </div>
                      
                          </div>
                
                          <hr style=" border-top: 8px solid #bbb; border-radius: 5px;">

                          <div class="form-row">

                            <div class="form-group col-md-6">
                              <label for="firstname">Nombre</label>
                              <input type="text" class="form-control" name="firstname" id="firstname" required placeholder="Ingresa tu nombre" oninput="validateFName();"/>
                            </div>

                            <div class="form-group col-md-6">
                              <label for="lastname">Apellido</label>
                              <input type="text" class="form-control" name="lastname" id="lastname" required placeholder="Ingresa tu apellido" oninput="validateLName();" />
                            </div>

                          </div>
          
          
                          <div class="form-group">
                              <label for="email">Correo</label>
                              <input type="email" class="form-control" name="email" id="email" required autocomplete="off"/>
                          </div>
          
                          <div class="form-group">
                              <label for="password">Contraseña</label>
                              <input type="password" class="form-control" name="password" id="password" required oninput="validatePassword();"  />
                          </div>

                          <div class="form-group">
                            <label  class="in">Confirmar contraseña</label> 
                            <input id="passwordSign2" type="password" class="form-control mb-4" placeholder="Ingresar contraseña de nuevo" required oninput="validatePassword();"/> 
                          </div>



                          <div class="form-group">
                            <label for="gender">Género</label>
                            <select class="form-control" id="gender" name="gender" required>
                              <option value="">Seleccionar</option>
                              <option value="1">Hombre</option>
                              <option value="2">Mujer</option>
                              <option value="3">No binario</option>
                              <option value="4">Ninguno/Agénero</option>
                              <option value="5">Prefiero no decir</option>
                            </select>
                          </div>

                          <label for="birthday">Fecha de nacimiento</label>
                          <div class="form-row">


                           <input id="birthday"  type="date" name="birthday"  min='1899-01-01' max="<?=date('Y-m-d',strtotime('now'));?>" style="margin-bottom: 5%; "/>
             
                      
                  
                          </div>

                          <div id="response-sign"></div>

                          <div class="d-flex ">
                            <button class="btn btn-info btn-block " style="  width: 50%;" type="submit">Crear Cuenta</button> 
                          </div> 
                        </form>
                       
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                      <img src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png" class="img-fluid" style="padding-top:80%;" alt="">
                    </div>
      
                </div>
    
         
                </div>
               </div>
            </div>
    </div>


    <!--Modal Log In-->
    <div class="modal fade" id="ModalLog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
           
         
            <div class="modal-body" style="padding-top: 10%; padding-bottom: 10%;">
        

            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                  <p class="h4 mb-4 text-left">¡Hola de vuelta!</p>
                  <p class="text-left">Inicia sesión para continuar con tus cursos</p> 
                  <!-- FORM -->
                  

                    <form id="login_form" style="margin: 5%;" method="post" >
                      
                      <div class='form-group'>
                        <!-- Email --> 
                        <label for="email" class="in">Corre Electronico</label> 
                        <input type="email" id="email" name='email' class="form-control mb-4" placeholder="Ingresa tu correo" required autocomplete="off">  
                      </div>
          
                      <div class='form-group'>
                          <!-- Password --> 
                          <label for="password" class="in">Contraseña</label> 
                          <input type="password" name='password' id="password" class="form-control mb-4" placeholder="Ingresa tu contraseña" required>
                      </div>

                      <div id="response-log"></div>

                      <div class="d-flex ">
                          
                          <a href="" class="">¿Olvidaste tu contraseña?</a>
                          <!-- Sign in button --> 
                          <button class="btn btn-info btn-block " style="  width: 50%;" type="submit">Iniciar Sesión</button> 
                      
                      </div> 
                  </form>


                 
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                <img src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png" class="img-fluid"  alt="">
                </div>
  
            </div>

     
            </div>
           </div>
        </div>
    </div>

