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

      var AccountTypeGlobal = 0;
      var MailAccount = 0;

    //--------------------------------Comenzar imagen--------------------//
    $(document).ready()
    {
      
      showUpdateAccountForm();
      getTypeAccount();
      
    }
    
    //----------------------------Mostrar Info--------------------------//
     function showUpdateAccountForm(){
        // validate jwt to verify access
        var jwt = getCookie('jwt');
        $.post("api/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
    
          MailAccount = result.data.email;
          document.getElementById("firstnameP").value = result.data.firstname;
          document.getElementById("lastnameP").value = result.data.lastname;
          document.getElementById("emailP").value = result.data.email;
          document.getElementById("SecretMail").value = result.data.email;


          $("#fechaRegistro").html(result.data.registro);

          
          var dd = document.getElementById('genderP');
          dd.selectedIndex = result.data.gender;


          //console.log(result.data);
          document.getElementById('birthdayP').value = result.data.birthday;
          
          


          $fname = result.data.firstname; 
          $space = " ";
       
          $lname = result.data.lastname; 

          $("#UserNameProfile").html($fname+$space+$lname);
        
          
          var parametros = {
                  "valorID" : result.data.id
          };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   'profile/view.php', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                 
                        //$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                  $("#resultado").html(response);
                        //alert(response);
                        //alert("wooo");
                },
                error: function(xhr, resp, text){
                // on error, tell the user sign up failed
                console.log("Error al cargar imagen  " + text);
                console.log("otro coso  " + xhr.responseText);
              
            }
        });


   
        })
    
        // on error/fail, tell the user he needs to login to show the account page
        .fail(function(result){
  
            $('#mensaje').html("<div class='alert alert-danger'>Please login to access the account page.</div>");
        });
    }
    //--------------------Tipo de cuenta----------------------------//
    function getTypeAccount()
    {
        // validate jwt to verify access
        var jwt = getCookie('jwt');
        $.post("api/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
        
          AccountTypeGlobal = result.data.typeAccount;
         // alert(result.data.typeAccount);
          if(AccountTypeGlobal==1)
          {
            console.log("TYPE 1");
            $('.historial-escuela').css('display','inline');
            $('.historial-alumnos').css('display','none');
          }
          else
          {
            console.log("TYPE 0");
            $('.historial-escuela').css('display','none');
            $('.historial-alumnos').css('display','inline');
          }

        })

        // show login page on error
        .fail(function(result){
          console.log("Error type");
        });
    }

    //-------------------------Hacer update------------------------//
    // trigger when 'update account' form is submitted
    $(document).on('submit', '#update_account_form', function(){
    
      // handle for update_account_form
      var update_account_form=$(this);

      // validate jwt to verify access
      var jwt = getCookie('jwt');


      // get form data
     var update_account_form_obj = update_account_form.serializeObject();
      
      update_account_form_obj["TypeAccountP"] =AccountTypeGlobal; 
      

      // add jwt on the object
      update_account_form_obj.jwt = jwt;
      
      // convert object to json string
      var form_data=JSON.stringify(update_account_form_obj);

     // alert("updating " + form_data);
      // submit form data to api
      $.ajax({
          url: "api/update_user.php",
          type : "POST",
          contentType : 'application/json',
          data : form_data,
          success : function(result) {
      
              // tell the user account was updated
              $('#mensaje').html("<div class='alert alert-success'>Account was updated.</div>");
      
              // store new jwt to coookie
              setCookie("jwt", result.jwt, 1);

              $('input[type=text], input[type=email], input[type=password]').prop('readonly', true);
              $('.save-things').css( "display", "none" );
              $('.cancel-things').css( "display", "none" );

              document.getElementById("birthdayP").disabled = true;
              document.getElementById("genderP").disabled = true;
             
              $(this).css( "display", "none" );
              $('.edit-things').css( "display", "" );
          },
      
          // show error message to user
          error: function(xhr, resp, text){
              if(xhr.responseJSON.message=="Unable to update user."){
                  $('#mensaje').html("<div class='alert alert-danger'>Unable to update account.</div>");
              }
          
              else if(xhr.responseJSON.message=="Access denied."){
                  showLoginPage();
                  $('#mensaje').html("<div class='alert alert-success'>Access denied. Please login</div>");
              }

          }
      });

      return false;
  });

//-------------------------------------------------------------------------Habilitar editar----------------------------------------------------//

      $(function(){ /* DOM ready */
          $(".edit-things").click(function() {
              //alert('best take my own advice ');
              
              $('input[type=text], input[type=email], input[type=password]').removeAttr('readonly');

              document.getElementById("birthdayP").disabled = false;
              document.getElementById("genderP").disabled = false;

              $('.save-things').css( "display", "" );
             
              $(this).css( "display", "none" );
              $('.cancel-things').css( "display", "" );
            
          });
      });

      $(function(){ /* DOM ready */
          $(".cancel-things").click(function() {
              //alert('best take my own advice ');
              
              $('input[type=text], input[type=email], input[type=password]').prop('readonly', true);
              document.getElementById("birthdayP").disabled = true;
              document.getElementById("genderP").disabled = true;
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


        
//-------------------------------------------------------------------------Mostrar imagen seleccionada----------------------------------------------------//
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-pic')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    

  </script>

</head>
<body style="background-color: #0b1925;">

    <div class="row">
        <!--Espacio izq-->
        <div class="col-2"></div>

        <!--Principal-->
        <div class="col-lg-8 col-12" style="background-color: #073352; padding-left: 4%; padding-right: 4%; color: black;">

          <div class="container" style="margin-top: 5%; ">
            <div class="main-body">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card" style="background-color: whitesmoke;">
                    <div class="card-body" >
                      <div class="d-flex flex-column align-items-center text-center">

                        <form action="profile/upload.php" method="post" enctype="multipart/form-data" style="margin: 0px;">

 
                        <div id="resultado"></div>

                          <div class="mt-3">
                            <h4 id="UserNameProfile"></h4>
                            <h6> Fecha de registro</h6>
                            <h6 id="fechaRegistro"> </h6>
                          </div>

                             <input type="text" hidden name="SecretMail" id="SecretMail" />

                          <input type="file" name="profile_pic" id="profile_pic" hidden onchange="readURL(this);"  accept="image/x-png,image/jpeg" />
                          <label for="profile_pic" class="btn btn-outline-primary center">Choose file</label>

                          <input type="submit" class="btn btn-outline-primary center" name="submit" value="Upload">

                        </form>


                       
                      </div>

                    </div>
                  </div>
                </div>

                <div class="col-lg-8">
                  <form style="width: 100%; margin: 0px;" id='update_account_form'>
                    <div class="card" style="background-color: whitesmoke;">
                      <div class="card-body">
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Nombre</h6>
                          </div>
                          <div class="col-sm-3 text-secondary">
                            <input type="text" class="form-control" name="firstnameP" id="firstnameP" required readonly />
                          </div>
                          <div class="col-sm-3">
                            <h6 class="mb-0">Apellido</h6>
                          </div>
                          <div class="col-sm-3 text-secondary">
                            <input type="text" class="form-control" name="lastnameP" id="lastnameP" required readonly />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            <input type="email" class="form-control" name="emailP" id="emailP" required readonly />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Género</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                          <div class="form-group">
                         
                            <select class="form-control" id="genderP" name="genderP" disabled required>
                              <option value="">Seleccionar</option>
                              <option value="1">Hombre</option>
                              <option value="2">Mujer</option>
                              <option value="3">No binario</option>
                              <option value="4">Ninguno/Agénero</option>
                              <option value="5">Prefiero no decir</option>
                            </select>
                          </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Fecha de nacimiento</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            <input id="birthdayP" disabled type="date" name="birthdayP"  min='1899-01-01' max="<?=date('Y-m-d',strtotime('now'));?>" style="margin-bottom: 5%; "/>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-sm-3">
                            <h6 class="mb-0">Contraseña</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                            <input type="password" class="form-control" name="passwordP" id="passwordP" readonly oninput="validatePasswordEdit();" />
                          </div>

                        
                        </div>
                        <div class="row">
                          <div id="mensaje" class="col-sm-12"></div>

                        

                          <div class="col-sm-4"></div>
                          <div class="col-sm-4 text-secondary">
                            <button type='submit' class='btn btn-primary save-things' style="display: none;"> Save Changes</button>
                          </div>
                          <div class="col-sm-4">
                            <input type="button" class="btn btn-primary edit-things" value="Editar">
                            <input type="button" class="btn btn-primary cancel-things" style="display: none;" onclick="showUpdateAccountForm();" value="Cancelar">

                        </div>
                        </div>
                      </div>
                    </div>
                  </form>
          

                  <!--ALUMNOS-->
                  <!--Historial de cursos-->
            
                  <div class="row historial-alumnos" style="display: none; margin-top: 5%;  margin-bottom:5%">
                    <div class="col-sm-12" style="padding: 0%; margin-top: 5%; margin-bottom: 5%;">
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
      
             
          

                  <!--ESCUELA-->
                  <!--Cursos creados-->
                
                  <div class="row historial-escuela" style="display: none;">
                    <div class="col-sm-12" style="padding: 0%; margin-top: 5%; margin-bottom: 5%;">
                      
                      <div class="card" style="background-color: whitesmoke; ">
                        <div class="card-body">
                          <h5 class="d-flex align-items-center mb-3">Historial de cursos</h5>
                
                                <!--Curso-->
                          <div class="row" style="color: black;">
                    
                            <div class="col-sm-12" style=" background-color: transparent;">
                              <div class="row" >
                                <div class="col-sm-12" style="margin-bottom:2%">
                                  <div class="card" style="background-color:#9ed5fb; margin: 0px;">
                                    <div class="card-body" style="margin-bottom: 3%">
                                      <div class="row">

                                        <div class="col-sm-4">
                                          <div class="row" style="margin-bottom: 3%;"> <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img" alt="..."></div>
                                          <div class="row"><h6>Titulo del curso</h6></div>
                                        </div>

                                        <div class="col-sm-2"></div>

                                        <div class="col-sm-6" style="text-align: right;">
                                      
                                            <button style="margin-top: 6%; margin-bottom: 5%; width: 50%;" type="button" class="btn btn-primary VerMas"><i class="fa fa-plus"></i></button>
                                            <br>
                                            Alumnos 33
                                            <br>
                                            33% terminado
                                            <hr>
                                            <div  style="text-align: right;"> Pagos con tarjeta: $2,000.00</div>

                                            <div  style="text-align: right;"> Pagos con PayPal: $2,000.00</div>
                                            <hr>
                                            Total: $4,000.00

                                          
                                        </div>

                                        <div class="col-sm-12" >
                                          <div class="DescripcionCurso" style="background-color: #b8d2e5; display: none; margin-bottom: 2%;" >
                                            
                                            <div class="row p-2"> 

                                              <div class="col-4 col-lg-4">
                                                <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img" alt="...">
                                                <br>
                                                <h6>Nombre del alumno</h6>
                                           
                                              </div>

                                              <div class="col-lg-8 col-12" style="text-align: right;">
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
                                        
                                        <div class="col-sm-12" >
                                          <div class="DescripcionCurso" style="background-color: #b8d2e5; display: none; margin-bottom: 2%;" >
                                            
                                            <div class="row p-2"> 

                                              <div class="col-4 col-lg-4">
                                                <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img" alt="...">
                                                <br>
                                                <h6>Nombre del alumno</h6>
                                           
                                              </div>

                                              <div class="col-lg-8 col-12" style="text-align: right;">
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

                                            <!--Navigation-->      
                                        <div class="col-sm-12" >
                                          <div class="DescripcionCurso" style=" display: none; margin-bottom: 2%;" >
               
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
                                        
                                        <!---->

                                
                                        
                                    </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-12" style="margin-bottom:2%">
                                  <div class="card" style="background-color:#9ed5fb; margin: 0px;">
                                    <div class="card-body" style="margin-bottom: 3%">
                                      <div class="row">

                                        <div class="col-sm-4">
                                          <div class="row" style="margin-bottom: 3%;"> <img src="http://localhost:8012/Acodemia/Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg" class="card-img" alt="..."></div>
                                          <div class="row"><h6>Titulo del curso</h6></div>
                                        </div>

                                        <div class="col-sm-2"></div>

                                        <div class="col-sm-6" style="text-align: right;">
                                      
                                            <button style="margin-top: 6%; margin-bottom: 5%; width: 50%;" type="button" class="btn btn-primary VerMas"><i class="fa fa-plus"></i></button>
                                            <br>
                                            Alumnos 33
                                            <br>
                                            33% terminado
                                            <hr>
                                            <div  style="text-align: right;"> Pagos con tarjeta: $2,000.00</div>

                                            <div  style="text-align: right;"> Pagos con PayPal: $2,000.00</div>
                                            <hr>
                                            Total: $4,000.00

                                          
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


                                                         <!--Navigation-->      
                                       <div class="col-sm-12" >
                                          <div class="DescripcionCurso" style=" display: none; margin-bottom: 2%;" >
               
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
                                        
                                        <!---->

                                    </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-12" style="margin-bottom:2%">
                                  <div class="card" style="background-color:#9ed5fb; margin: 0px;">
                                    <div class="card-body" style="margin-bottom: 3%">
                                      <div class="row">

                                        <div class="col-sm-6"></div>


                                        <div class="col-sm-6" style="text-align: right;">
                                          <hr style=" border: 1px solid #282E34; border-radius: 5px;">
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