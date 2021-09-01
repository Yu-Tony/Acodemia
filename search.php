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
    <title>ACodemia</title>

    <!--Para el date picker-->
    <!--https://gijgo.com/datepicker/example/daterangepicker -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        $(function(){ /* DOM ready */
            $("#SelectFilter").change(function() {
                //alert('The option with value ' + $(this).val());
                if ($('#SelectFilter').val().length > 0 && $('#SelectFilter').val() == "Fecha") 
                {
                   
                    $('#DatePicker').css( "display", "inline-block" );
            
                } 
                else {
                    $('#DatePicker').css( "display", "none" );
                }
            });
        });
    </script>


</head>
<body style="background-color: #0b1925;">
    <div class="row">
        <!--Espacio izq-->
        <div class="col-2"></div>

        <!--Principal-->
        <div class="col-8" style="background-color: #0f2540; padding-left: 4%; padding-right: 4%;">
        
            <div class="text-left " style="padding-top:2%; ">
               <h4 style="color: whitesmoke;" class="subtitle-text">100 resultados para  ....</h4>
            </div>

            <div class="text-left " style="padding-top:2%;">
                <h5 style="color: whitesmoke;" class="subtitle-text">Buscar por</h5>
                
             </div>

             <!--Form filtro-->
             <div class="form-group">
                <select class="form-control" id="SelectFilter">
                  <option value="">Cualquier resultado</option>
                  <option>Categoría</option>
                  <option>Curso</option>
                  <option>Usuario</option>
                  <option>Fecha</option>
                </select>
              </div>

              <!--Date picker-->
              <div class="container" style="color: whitesmoke; display: none;" id="DatePicker">
                <div class="row">
                    <div class="col-6">
                        Start Date: <input id="startDate" width="276" />
                    </div>
                    <div class="col-6">
                        End Date: <input id="endDate" width="276" />
                    </div>
                </div>
              
            </div>

            <script>
                var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                $('#startDate').datepicker({
                    uiLibrary: 'bootstrap4',
                    iconsLibrary: 'fontawesome',
                    maxDate: today
                });
                $('#endDate').datepicker({
                    uiLibrary: 'bootstrap4',
                    iconsLibrary: 'fontawesome',
                    maxDate: today,
                    minDate: function () {
                        return $('#startDate').val();
                    }

                    
                });
            </script>

            <div class="row" style="padding-top: 2%;">
                <div class="col-xl-2 d-none d-sm-none d-xl-inline">
                    <div class="text-left " style="padding-top:2%;">
                        <h6 style="color: whitesmoke;" class="subtitle-text">Categorias</h6>
                    </div>
                 
                
                        <div class="list-group  bg-transparent" >
                            <a href="#" class="list-group-item list-group-item-action">
                                Categoria 1
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                Categoria 2
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                Categoria 3
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                Categoria 4
                            </a>
                        </div>
                    

                </div>
                <div class="col-xl-10">

                    <div class="card-deck" style="margin-bottom: 5%;">
                        <div class="card">
                            <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="font-weight-normal">Titulo del curso 1</h5>
                                </a>
                                <div class="post-meta"><span class="small lh-120">Breve descripcion del lo que se trata el curso</span></div>
                                <div class="d-flex my-4">
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i></div>
                                <div class="d-flex justify-content-between">
                                    <div class="col pl-0"><span class="text-muted font-small d-block mb-2">Precio</span> <span class="h5 text-dark font-weight-bold">$300.00</span></div>
                                    <div class="col pr-0"><span class="text-muted font-small d-block mb-2">Niveles</span> <span class="h5 text-dark font-weight-bold">8</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="font-weight-normal">Titulo del curso 2</h5>
                                </a>
                                <div class="post-meta"><span class="small lh-120">Breve descripcion del lo que se trata el curso</span></div>
                                <div class="d-flex my-4">
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i></div>
                                <div class="d-flex justify-content-between">
                                    <div class="col pl-0"><span class="text-muted font-small d-block mb-2">Precio</span> <span class="h5 text-dark font-weight-bold">$300.00</span></div>
                                    <div class="col pr-0"><span class="text-muted font-small d-block mb-2">Niveles</span> <span class="h5 text-dark font-weight-bold">8</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="font-weight-normal">Titulo del curso 3</h5>
                                </a>
                                <div class="post-meta"><span class="small lh-120">Breve descripcion del lo que se trata el curso</span></div>
                                <div class="d-flex my-4">
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i></div>
                                <div class="d-flex justify-content-between">
                                    <div class="col pl-0"><span class="text-muted font-small d-block mb-2">Precio</span> <span class="h5 text-dark font-weight-bold">$300.00</span></div>
                                    <div class="col pr-0"><span class="text-muted font-small d-block mb-2">Niveles</span> <span class="h5 text-dark font-weight-bold">8</span></div>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="card-deck" style="margin-bottom: 5%;">
                        <div class="card">
                            <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="font-weight-normal">Titulo del curso 4</h5>
                                </a>
                                <div class="post-meta"><span class="small lh-120">Breve descripcion del lo que se trata el curso</span></div>
                                <div class="d-flex my-4">
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i></div>
                                <div class="d-flex justify-content-between">
                                    <div class="col pl-0"><span class="text-muted font-small d-block mb-2">Precio</span> <span class="h5 text-dark font-weight-bold">$300.00</span></div>
                                    <div class="col pr-0"><span class="text-muted font-small d-block mb-2">Niveles</span> <span class="h5 text-dark font-weight-bold">8</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="font-weight-normal">Titulo del curso 5</h5>
                                </a>
                                <div class="post-meta"><span class="small lh-120">Breve descripcion del lo que se trata el curso</span></div>
                                <div class="d-flex my-4">
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i></div>
                                <div class="d-flex justify-content-between">
                                    <div class="col pl-0"><span class="text-muted font-small d-block mb-2">Precio</span> <span class="h5 text-dark font-weight-bold">$300.00</span></div>
                                    <div class="col pr-0"><span class="text-muted font-small d-block mb-2">Niveles</span> <span class="h5 text-dark font-weight-bold">8</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="font-weight-normal">Titulo del curso 6</h5>
                                </a>
                                <div class="post-meta"><span class="small lh-120">Breve descripcion del lo que se trata el curso</span></div>
                                <div class="d-flex my-4">
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i></div>
                                <div class="d-flex justify-content-between">
                                    <div class="col pl-0"><span class="text-muted font-small d-block mb-2">Precio</span> <span class="h5 text-dark font-weight-bold">$300.00</span></div>
                                    <div class="col pr-0"><span class="text-muted font-small d-block mb-2">Niveles</span> <span class="h5 text-dark font-weight-bold">8</span></div>
                                </div>
                            </div>
                        </div>
                        
                      </div>

                      <div class="card-deck" style="margin-bottom: 5%;">
                        <div class="card">
                            <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="font-weight-normal">Titulo del curso 7</h5>
                                </a>
                                <div class="post-meta"><span class="small lh-120">Breve descripcion del lo que se trata el curso</span></div>
                                <div class="d-flex my-4">
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i></div>
                                <div class="d-flex justify-content-between">
                                    <div class="col pl-0"><span class="text-muted font-small d-block mb-2">Precio</span> <span class="h5 text-dark font-weight-bold">$300.00</span></div>
                                    <div class="col pr-0"><span class="text-muted font-small d-block mb-2">Niveles</span> <span class="h5 text-dark font-weight-bold">8</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="font-weight-normal">Titulo del curso 8</h5>
                                </a>
                                <div class="post-meta"><span class="small lh-120">Breve descripcion del lo que se trata el curso</span></div>
                                <div class="d-flex my-4">
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i></div>
                                <div class="d-flex justify-content-between">
                                    <div class="col pl-0"><span class="text-muted font-small d-block mb-2">Precio</span> <span class="h5 text-dark font-weight-bold">$300.00</span></div>
                                    <div class="col pr-0"><span class="text-muted font-small d-block mb-2">Niveles</span> <span class="h5 text-dark font-weight-bold">8</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#">
                                    <h5 class="font-weight-normal">Titulo del curso 9</h5>
                                </a>
                                <div class="post-meta"><span class="small lh-120">Breve descripcion del lo que se trata el curso</span></div>
                                <div class="d-flex my-4">
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i>
                                    <i class="star fas fa-star text-warning"></i></div>
                                <div class="d-flex justify-content-between">
                                    <div class="col pl-0"><span class="text-muted font-small d-block mb-2">Precio</span> <span class="h5 text-dark font-weight-bold">$300.00</span></div>
                                    <div class="col pr-0"><span class="text-muted font-small d-block mb-2">Niveles</span> <span class="h5 text-dark font-weight-bold">8</span></div>
                                </div>
                            </div>
                        </div>
                        
                      </div>

                      <div class="row">
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

        <!--Espacio der-->
        <div class="col-2"></div>

    </div>
    
</body>
</html>