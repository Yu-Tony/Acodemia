
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
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

  <script type="text/javascript">

        function daysInMonth(month, year) {
      return new Date(year, month, 0).getDate();
    }

    $(function(){ /* DOM ready */
    $("#yearDropdown, #monthDropdown").change(function() {
        //alert('The option with value ' + $(this).val());
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
});
       





    </script>


<nav class="navbar navbar-expand-md sticky-top" style="padding-right: 3%; padding-left: 3%; ">
        <!--Logo de la pagina-->
        <a href="http://localhost:8012/Acodemia/" class="navbar-brand">Brand</a>

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

                        <li><a class="dropdown-item" href="http://localhost:8012/Acodemia/search.php">HTML</a></li>

                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="#">CSS</a>
                            <div class="dropdown-menu top add-to-dropdown-div">
                            <a class="dropdown-item" href="#">Selectores</a>
                                <a class="dropdown-item" href="#">Comentarios</a>
                            </div>
                        </li>

                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="#">JS</a>
                            <div class="dropdown-menu top add-to-dropdown-div">
                            <a class="dropdown-item" href="#">Variables</a>
                                <a class="dropdown-item" href="#">Eventos</a>
                                <a class="dropdown-item" href="#">Comentarios</a>
                                <a class="dropdown-item" href="#">Operadores</a>
                                <a class="dropdown-item" href="#">Metodos</a> 
   
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <!--Search bar-->
            <div class=" col-xl-8 col-lg-8 col-md-8 col-sm-12" style="margin-top: 1%;">
                <form action="http://localhost:8012/Acodemia/search.php" class="search-wrap">
                    <div class="input-group w-100"> <input type="text" class="form-control search-form" style="width:55%; " placeholder="Buscar">
                        <div class="input-group-append"> <button class="btn btn-primary search-button" type="submit"> <i class="fa fa-search"></i> </button> </div>
                    </div>
                </form>
            </div>

        
            
            <div class="navbar-nav ">
               
                <!--Cuando el usuario esta loggeado-->
                <!--  -->
                <div class="navbar-nav">
                    <button type="button" onClick="window.location.href='http://localhost:8012/Acodemia/create.php';" class="btn btn-primary" >Crear Curso</button>

                    <div class="btn-group">
                      <button type="button" style="width: 200%; margin-left: 5%;" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Nakamoto Yuta <img style="height:35px;" src="https://64.media.tumblr.com/c3a5c053d6575c728ca15780c6752d90/286f48adcddead0a-e3/s2048x3072/42a32e6408fbd276bb14a1d243ca67c128c5bc49.jpg" class="avatar" alt="Avatar"> 
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a href="http://localhost:8012/Acodemia/profile.php" class="dropdown-item"><i class="fa fa-user-o"></i> Perfil</a></a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a></a>
                      </div>
                  </div>


                
                </div>
              

                <!--Cuando no hay usuario loggeado-->
         <!-- 
                <button type="button" class="btn btn-primary" style="margin: 1%;" data-toggle="modal" data-target="#ModalSign">Crear Cuenta</button>

                <button type="button" class="btn btn-secondary" style="margin: 1%;" data-toggle="modal" data-target="#ModalLog">Iniciar Sesion</button>
               -->
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
                        <!-- Default form login -->
                        <form action="#!" style="margin: 5%;">
                            <p class="h4 mb-4 text-left">¡Comencemos!</p>
                            <p class="text-left">Crea una cuenta para explorar nuestros cursos</p> 

                            <div class="input-group" style="margin-bottom: 15px;"> 

                            
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-12">
                                        <img src="https://www.edmundsgovtech.com/wp-content/uploads/2020/01/default-picture_0_0.png" id="imagen_perfil" class="img-fluid rounded-circle" alt="Imagen de perfil" style="margin-bottom: 20px; width: 300px;  "/>
                          
                                        <input type="file" name="profile_pic" id="profile_pic" hidden onchange="readURL(this);"  accept="image/x-png,image/jpeg" />
                                        <label for="profile_pic" class="btn btn-outline-primary center">Choose file</label>
                                    </div>
                                </div>

                            
                                       
                         
                            

                        
                                <div class="row" style="padding-bottom: 2%;">

                                  <div class="col-12">
                                    <label >Tipo de cuenta</label>
                                  </div>
                                
                                  <div class="col-6">
                                   
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                    Alumno
                                    </label>
                                  </div>
                                  </div>

                                  <div class="col-6">
                                    <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                      Escuela
                                    </label>
                                  </div>
                                  </div>

                                </div>
                               
                                <hr style=" border-top: 8px solid #bbb;
                                border-radius: 5px;">
                  
                               

                                 <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nameSign">Nombre</label>
                                      <input id="nameSign" type="text" class="form-control input-sm" placeholder="Ingresa tu nombre" name="nombre" required oninput="validateFName();" />
                                    </div>
                                    <div class="form-group col-md-6">
                                      <label for="lastSign">Apellido</label>
                                      <input id="lastSign" type="text" class="form-control input-sm" placeholder="Ingresa tu apellido" name="apellidos" required oninput="validateLName();" /> 
                                    </div>
                                  </div>
                           
                              </div> 

                              <div class="form-group">
                                <label for="GenderForm">Género</label>
                                <select class="form-control" id="GenderForm" required>
                                  <option value="">Seleccionar</option>
                                  <option>Hombre</option>
                                  <option>Mujer</option>
                                  <option>No binario</option>
                                  <option>Ninguno/Agénero</option>
                                  <option>Prefiero no decir</option>
                                </select>
                              </div>

                              <label for="Birthday">Fecha de nacimiento</label>
                              <div class="form-row">
       
                                <div class="form-group col-md-4">
                                  <div class="form-group">
                          
                                     <select class="form-control" style="margin-top: 8px;" id="yearDropdown" required>
                                     <option value="">Seleccionar año</option>
                      
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
                          
                                    <select class="form-control"  style="margin-top: 8px;" id="monthDropdown" required>
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
                          
                                    <select class="form-control"  style="margin-top: 8px;" id="dayDropdown" disabled required>
                                              <option value="">Seleccionar dia</option>      
                                    </select>
                                      
                   
                                  </div>
                                </div>
                      
                          
                      
                              </div>
                            
                            <!-- Email --> 
                            <label class="in">Correo</label> 
                            <input type="email" id="mailSign" class="form-control mb-4" placeholder="Ingresa tu correo" required oninput="validateMail();"> 
                            <!-- Password --> 
                            <label  class="in">Contraseña</label> 
                            <input type="password" id="passwordSign" class="form-control mb-4" placeholder="Ingresa tu contraseña" required oninput="validatePassword();">
                           
                            <label  class="in">Confirmar contraseña</label> 
                            <input id="passwordSign2" type="password" class="form-control mb-4" placeholder="Ingresar contraseña de nuevo" required oninput="validatePassword();"/> 
                            
                            <div class="d-flex ">
                                
                                <a href="" class="">¿Olvidaste tu contraseña?</a>
                                <!-- Sign in button --> <button class="btn btn-info btn-block " style="  width: 50%;" type="submit">Iniciar Sesión</button> 
                            
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
                    <!-- Default form login -->
                    <form action="#!" style="margin: 5%;">
                        <p class="h4 mb-4 text-left">¡Hola de vuelta!</p>
                        <p class="text-left">Inicia sesión para continuar con tus cursos</p> 
                        <!-- Email --> <label for="mail" class="in">Usuario</label> <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Ingresa tu usuario"> 
                        <!-- Password --> <label for="pass" class="in">Contraseña</label> <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Ingresa tu contraseña">
                        <div class="d-flex ">
                            
                            <a href="" class="">¿Olvidaste tu contraseña?</a>
                            <!-- Sign in button --> <button class="btn btn-info btn-block " style="  width: 50%;" type="submit">Iniciar Sesión</button> 
                        
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

