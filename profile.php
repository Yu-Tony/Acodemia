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

  </script>

</head>
<body style="background-color: #0b1925;">

    <div class="row">
        <!--Espacio izq-->
        <div class="col-2"></div>

        <!--Principal-->
        <div class="col-8" style="background-color: #073352; padding-left: 4%; padding-right: 4%; color: black;">

          <div class="container" style="margin-top: 5%;">
            <div class="main-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                        <div class="mt-3">
                          <h4>John Doe</h4>
                          <h6c>Fecha de registro</h6c>
                        </div>

                        <input type="file" name="profile_pic" id="profile_pic" hidden onchange="readURL(this);"  accept="image/x-png,image/jpeg" />
                          <label for="profile_pic" class="btn btn-outline-primary center">Choose file</label>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="card">
                    <div class="card-body">
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Nombre</h6>
                        </div>
                        <div class="col-sm-3 text-secondary">
                          <input type="text" class="form-control" value="John Doe" readonly>
                        </div>
                         <div class="col-sm-3">
                          <h6 class="mb-0">Apellido</h6>
                        </div>
                        <div class="col-sm-3 text-secondary">
                          <input type="text" class="form-control" value="John Doe" readonly>
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
                          <h6 class="mb-0">Nombre de usuario</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="text" class="form-control" value="(320) 380-4539" readonly>
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
                  <div class="row" style="margin-top: 5%;">
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="card-body">
                          <h5 class="d-flex align-items-center mb-3">Historial de cursos</h5>
                
<!--Cards historial-->
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-4" style="margin-right: 3%;">
            <div class="row" style="margin-bottom: 3%;"> <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img" alt="..."></div>
            <div class="row"><h6>Titulo del curso</h6></div>
          </div>
          <div class="col-sm-6" style=" text-align: right;">
            <div class="row">Progreso 23%</div>
            <div class="row">Fecha de inscripcion 23/01/21</div>
            <div class="row">Ultima vez que se accedio 02/05/21</div>
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