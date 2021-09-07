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

    <script>
      $(function(){ /* DOM ready */
          $(".edit-things").click(function() {
              //alert('best take my own advice ');
              
              $('input[type=text], input[type=email], input[type=password]').removeAttr('readonly');
              $('.save-things').css( "display", "" );
             
              $(this).css( "display", "none" );
              $('.cancel-things').css( "display", "" );
            
          });
      });

      $(function(){ /* DOM ready */
          $(".cancel-things").click(function() {
              //alert('best take my own advice ');
              
              $('input[type=text], input[type=email], input[type=password]').prop('readonly', true);
              $('.save-things').css( "display", "none" );
             
              $(this).css( "display", "none" );
              $('.edit-things').css( "display", "" );
            
          });
      });

    
        $(function(){ /* DOM ready */ 
            $('.VerMas').click(function(){ 
                if ( $(this).parent().parent().find('.DescripcionCurso').css('display') == 'none' ) 
                    $(this).parent().parent().find('.DescripcionCurso').css('display','block'); 
                else $(this).parent().parent().find('.DescripcionCurso').css('display','none'); 
            }); 
        }); 
    

  </script>

</head>
<body style="background-color: #0b1925;">

    <div class="row">
        <!--Espacio izq-->
        <div class="col-2"></div>

        <!--Principal-->
        <div class="col-8" style="background-color: #073352; padding-left: 4%; padding-right: 4%; color: black;">

          <div class="container" style="margin-top: 5%; ">
            <div class="main-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card" style="background-color: whitesmoke;">
                    <div class="card-body" >
                      <div class="d-flex flex-column align-items-center text-center">
                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                        <div class="mt-3">
                          <h4>John Suh</h4>
                          <h6>Fecha de registro</h6>
                          <p>Última vez que se realizó un cambio</p>
                        </div>

                        <input type="file" name="profile_pic" id="profile_pic" hidden onchange="readURL(this);"  accept="image/x-png,image/jpeg" />
                          <label for="profile_pic" class="btn btn-outline-primary center">Choose file</label>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="card" style="background-color: whitesmoke;">
                    <div class="card-body">
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Nombre</h6>
                        </div>
                        <div class="col-sm-3 text-secondary">
                          <input type="text" class="form-control" value="John" readonly>
                        </div>
                         <div class="col-sm-3">
                          <h6 class="mb-0">Apellido</h6>
                        </div>
                        <div class="col-sm-3 text-secondary">
                          <input type="text" class="form-control" value="Suh" readonly>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="email" class="form-control" value="john@example.com" readonly>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Género</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="text" class="form-control" value="(239) 816-9029" readonly>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Fecha de nacimiento</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="text" class="form-control" value="Bay Area, San Francisco, CA" readonly>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Contraseña</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="password" class="form-control" value="Bay Area, San Francisco, CA" readonly>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 text-secondary">
                          <input type="button" class="btn btn-primary px-4 save-things" value="Guarda cambios" style="display: none;">
                        </div>
                        <div class="col-sm-4">
                          <button class="btn btn-primary edit-things">Editar</button>
                          <button class="btn btn-primary cancel-things" style="display: none;">Cancelar</button>
                       </div>
                      </div>
                    </div>
                  </div>

                  <!--ALUMNOS-->
                  <!--Historial de cursos-->
            
                  <div class="row" style="margin-top: 5%;">
                    <div class="col-sm-12">
                      <div class="card" style="background-color: whitesmoke;">
                        <div class="card-body">
                          <h5 class="d-flex align-items-center mb-3">Historial de cursos</h5>
                
                          <!--Cards historial-->
                          <div class="row" style="padding-bottom: 2%;">
                            <div class="col-sm-12">
                              <div class="card" style="background-color:#9ed5fb;">
                                <div class="card-body" style="margin-left:3%;">
                                  <div class="row">
                                    <div class="col-sm-4" style="margin-right: 3%;">
                                      <div class="row" style="margin-bottom: 3%;"> <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img" alt="..."></div>
                                      <div class="row"><a href="http://localhost:8012/Acodemia/course.php">Titulo del curso</a></div>
                                    </div>
                                    <div class="col-sm-6" >
                                      <div class="row">Progreso 23%</div>
                                      <div class="row">Fecha de inscripción 23/01/21</div>
                                      <div class="row">Fecha de terminación del curso 02/05/21</div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                          </div>

                          <div class="row" style="padding-bottom: 2%;">
                            <div class="col-sm-12">
                              <div class="card" style="background-color:#9ed5fb;">
                                <div class="card-body" style="margin-left:3%;">
                                  <div class="row">
                                    <div class="col-sm-4" style="margin-right: 3%;">
                                      <div class="row" style="margin-bottom: 3%;"> <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img" alt="..."></div>
                                      <div class="row"><a href="#">Titulo del curso</a></div>
                                    </div>
                                    <div class="col-sm-6" >
                                      <div class="row">Progreso 23%</div>
                                      <div class="row">Fecha de inscripcion 23/01/21</div>
                                      <div class="row">Ultima vez que se accedió 02/05/21</div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                          </div>
                          

                           <!--Navigation-->
                          <div class="row" style="margin-top: 5%;">
                            <div class="col-4"></div>

                            <div class="col-4">
                              <nav aria-label="Page navigation example">
                                  <ul class="pagination">

                                    <li class="page-item">
                                      <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                      </a>
                                    </li>

                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>

                                    <li class="page-item">
                                      <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                    </li>

                                  </ul>
                                </nav>
                            </div>

                            <div class="col-4"></div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
      
                   <!--Diplomas-->
             
                    <div class="row" style="margin-top: 5%; margin-bottom: 5%;">
                    <div class="col-sm-12">
                      <div class="card" style="background-color: whitesmoke;">
                        <div class="card-body">
                          <h5 class="d-flex align-items-center mb-3">Diplomas</h5>
                
                       <!--Diploma individual-->
                          <div class="row" style="padding-bottom: 2%;">
                         
                            <div class="col-6">

                              <div class="card" style="width: 18rem; background-color: #9ed5fb;">
                                <img class="card-img-top" src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" alt="Card image cap">
                                <div class="card-body">
                                  <h5 class="card-title">Card title</h5>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              
                            <div class="card" style="width: 18rem; background-color: #9ed5fb;">
                              <img class="card-img-top" src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" alt="Card image cap">
                              <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                              </div>
                            </div>
                            </div>

                          </div>

          

                            <!--Navigation-->
                          <div class="row" style="margin-top: 5%;">
                            <div class="col-4"></div>

                            <div class="col-4">
                              <nav aria-label="Page navigation example">
                                  <ul class="pagination">

                                    <li class="page-item">
                                      <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                      </a>
                                    </li>

                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>

                                    <li class="page-item">
                                      <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                    </li>

                                  </ul>
                                </nav>
                            </div>

                            <div class="col-4"></div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
          

                  <!--ESCUELA-->
                  <!--Cursos creados-->
                
                  <div class="row" style="margin-top: 5%;">
                    <div class="col-sm-12">
                      
                      <div class="card" style="background-color: whitesmoke; ">
                        <div class="card-body">
                          <h5 class="d-flex align-items-center mb-3">Historial de cursos</h5>
                
                                <!--Curso-->
                          <div class="row" style="color: black;">
                    
                            <div class="col-sm-12" style=" background-color: transparent;">
                              <div class="row" >
                                <div class="col-sm-12">
                                  <div class="card" style="background-color:#9ed5fb; margin: 0px;">
                                    <div class="card-body" >
                                      <div class="row">

                                        <div class="col-sm-4">
                                          <div class="row" style="margin-bottom: 3%;"> <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img" alt="..."></div>
                                          <div class="row"><h6>Titulo del curso</h6></div>
                                        </div>

                                        <div class="col-sm-4"></div>

                                        <div class="col-sm-4" style="text-align: right;">
                                      
                                            <button style="margin-top: 6%; margin-bottom: 5%; width: 50%;" type="button" class="btn btn-primary VerMas"><i class="fa fa-plus"></i></button>
                                            <br>
                                            Alumnos 33
                                            <br>
                                            33% terminado
                                            <br>
                                            $4,000.00

                                          
                                        </div>

                                        <div class="col-sm-12" >
                                          <div class="DescripcionCurso" style="background-color: #b8d2e5; display: none; margin-bottom: 2%;" >
                                            
                                            <div class="row p-2"> 

                                              <div class="col-3">
                                                <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img" alt="...">
                                                <br>
                                                <h6>Nombre del alumno</h6>
                                           
                                              </div>

                                              <div class="col-9" style="text-align: right;">
                                                Feha de inscripción
                                                <br>
                                                28% completado
                                                <br>
                                                $1,000.00
                                                <br>
                                                Pago con tarjeta
                                              </div>

                                            </div>
                                
                                          </div>
                                      </div>

                                      </div>

                                      <hr>
                                      <div  style="text-align: right;"> Pagos con tarjeta: $4,000.00</div>

                                      <div  style="text-align: right;"> Pagos con PayPal: $4,000.00</div>
                                      <hr>
                                      <div  style="text-align: right;"> Total: $8,000.00</div>
                                    </div>
                                  </div>
                                </div>
                                
                              </div>       
                            </div>               
                          </div>
                          
                 

                            <!--Navigation-->
                          <div class="row" style="margin-top: 5%;">
                            <div class="col-4"></div>

                            <div class="col-4">
                              <nav aria-label="Page navigation example">
                                  <ul class="pagination">

                                    <li class="page-item">
                                      <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                      </a>
                                    </li>

                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>

                                    <li class="page-item">
                                      <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                      </a>
                                    </li>

                                  </ul>
                                </nav>
                            </div>

                            <div class="col-4"></div>
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

         <!--Espacio der-->
         <div class="col-2"></div>
    </div>


    
</body>
</html>