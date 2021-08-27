
    <!--bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!--iconos-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--css-->
    <link rel="stylesheet" href="http://localhost:8012/Acodemia/NavBar/navbar.css">





<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top" style="padding-right: 3%; padding-left: 3%; ">
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
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categorias</a>

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
            <div class=" col-xl-8 col-lg-8 col-md-8 col-sm-12" style="margin: 1%;">
                <form action="#" class="search-wrap">
                    <div class="input-group w-100"> <input type="text" class="form-control search-form" style="width:55%;" placeholder="Search">
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
         
                <button type="button" class="btn btn-primary" style="margin: 1%;" data-toggle="modal" data-target="#exampleModalCenter">Crear Cuenta</button>

                <button type="button" class="btn btn-secondary" style="margin: 1%;">Iniciar Sesion</button>
                <!---->
            </div>
        </div>

    </nav>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
           
            <div class="modal-body">
        

            <div class="row">
                <div class="col-sm-12 text-center">
                    <!-- Default form login -->
                    <form action="#!">
                        <p class="h4 mb-4 text-left">Login to continue</p>
                        <p class="text-left">Signin to create, discover and connect with the global community</p> <!-- Email --> <label for="mail" class="in">Username</label> <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Enter Username"> <!-- Password --> <label for="pass" class="in">Password</label> <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Enter Password">
                        <div class="d-flex justify-content-left">
                            <div>
                                <!-- Remember me -->
                                <div class="custom-control custom-checkbox text-left"> <input type="checkbox" class="custom-control-input"> <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label> </div>
                            </div>
                        </div> <!-- Sign in button --> <button class="btn btn-info btn-block " type="submit" style="background-image: url(https://i.imgur.com/6YuRxJA.png)">LOGIN</button> <button class="btn btn-info btn-block my" type="submit">Forgot Password?</button>
                    </form>
                </div>
  
            </div>

     
            </div>
           </div>
        </div>
    </div>

