
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!--iconos-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--css-->
    <link rel="stylesheet" href="http://localhost:8012/Acodemia/NavBar/navbar.css">


    <script>
        function daysInMonth(month, year) {
      return new Date(year, month, 0).getDate();
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

    </script>


<nav class="navbar navbar-expand-md sticky-top" style="padding-right: 3%; padding-left: 3%; ">
        <!--Logo de la pagina-->
        <a href="#" class="navbar-brand">Brand</a>

        <!--Rallitas al minimizarlo-->
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            
            <!--Dropdown-->
            <div class="navbar-nav">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" style="color: whitesmoke;">Categorias</a>

                    <ul class="dropdown-menu add-to-ul" aria-labelledby="navbarDropdownMenuLink">

                        <li><a class="dropdown-item" href="#">Categ 1</a></li>

                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="#">Something else here</a>
                            <div class="dropdown-menu top add-to-dropdown-div">
                                <a class="dropdown-item" href="#">A</a>
                                <a class="dropdown-item" href="#">b</a>
                                <a class="dropdown-item" href="#">b</a>
                                <a class="dropdown-item" href="#">b</a>
                                <a class="dropdown-item" href="#">b</a> <a class="dropdown-item" href="#">b</a> <a class="dropdown-item" href="#">b</a>
                            </div>
                        </li>

                        <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="#">Something else here</a>
                            <div class="dropdown-menu top add-to-dropdown-div">
                                <a class="dropdown-item" href="#">Nya</a>
                                <a class="dropdown-item" href="#">b</a>
   
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <!--Search bar-->
            <div class=" col-xl-8 col-lg-8 col-md-8 col-sm-12" style="margin-top: 1%;">
                <form action="#" class="search-wrap">
                    <div class="input-group w-100"> <input type="text" class="form-control search-form" style="width:55%; " placeholder="Search">
                        <div class="input-group-append"> <button class="btn btn-primary search-button" type="submit"> <i class="fa fa-search"></i> </button> </div>
                    </div>
                </form>
            </div>

        
            
            <div class="navbar-nav ">
               
                <!--Cuando el usuario esta loggeado-->
                <!--
                <div class="navbar-nav">
                    <button type="button" class="btn btn-primary" >Mis Cursos</button>
                    <a href="#" class="nav-item nav-link messages"><i class="fa fa-envelope-o"></i><span class="badge">10</span></a></a>
                    <div class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><img style="height:30px;" src="https://64.media.tumblr.com/c3a5c053d6575c728ca15780c6752d90/286f48adcddead0a-e3/s2048x3072/42a32e6408fbd276bb14a1d243ca67c128c5bc49.jpg" class="avatar" alt="Avatar"> Paula Wilson <b class="caret"></b></a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item"><i class="fa fa-user-o"></i> Perfil</a></a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Cerrar Sesion</a></a>
                        </div>
                    </div>
                </div>
                -->

                <!--Cuando no hay usuario loggeado-->
         
                <button type="button" class="btn btn-primary" style="margin: 1%;" data-toggle="modal" data-target="#ModalSign">Crear Cuenta</button>

                <button type="button" class="btn btn-secondary" style="margin: 1%;" data-toggle="modal" data-target="#ModalLog">Iniciar Sesion</button>
                <!---->
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
                        
                                <input id="nombre" type="text" class="form-control input-sm" placeholder="Nombres" name="nombre" required oninput="validateFName();" />
                                <input id="apellidos" type="text" class="form-control input-sm" placeholder="Apellidos" name="apellidos" required oninput="validateLName();" /> 
                      
                              </div> 

                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Género</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                              </div>

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
                            
                            <!-- Email --> <label for="mail" class="in">Usuario</label> <input type="email" id="defaultSigninFormEmail" class="form-control mb-4" placeholder="Ingresa tu usuario"> 
                            <!-- Password --> <label for="pass" class="in">Contraseña</label> <input type="password" id="defaultSigninFormPassword" class="form-control mb-4" placeholder="Ingresa tu contraseña">
                            <div class="d-flex ">
                                
                                <a href="" class="">¿Olvidaste tu contraseña?</a>
                                <!-- Sign in button --> <button class="btn btn-info btn-block " style="  width: 50%;" type="submit">Iniciar Sesión</button> 
                            
                            </div> 
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 text-center">
    
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

                </div>
  
            </div>

     
            </div>
           </div>
        </div>
    </div>

