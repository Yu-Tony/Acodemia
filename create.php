<?php
include_once 'navbar/navbar.php';
//include_once 'footer/footer.php';

?>

<?php

    //Connect to our MySQL database using the PDO extension.
    $pdo = new PDO('mysql:host=127.0.0.1:3307;dbname=acodemiadb', 'root', '');
    $call =  $pdo->prepare('CALL categoriaGetAll()');     

    if($call->execute())
    {
        $categoriasVar = $call->fetchAll(PDO::FETCH_ASSOC);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--Script para agregar y borrar-->
    <script type="text/javascript">

        //Guarda el mail para obtener el id del usuario en otras funciones
        var MailAccount = 0;
        //Guarda el numero de niveles para poner los campos a llenar luego de crear curso
        var numNiveles = 0;
        var cursoActual = 0;

        $(document).ready()
        {
        
            obtenerInfo();
        
        }


                                                   
        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });

        /*----------------------------------OBTENER INFO DEL PERFIL-------------------------------------*/

        function obtenerInfo()
        {
            var jwt = getCookie('jwt');
            $.post("api/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
        
            MailAccount = result.data.email;
              
            });
        }

        /*--------------------------------------------------AGREGAR CATEGORIA--------------------------------------*/
        // trigger when login form is submitted
        $(document).on('submit', '#category_form', function()
        {
            // get form data
            var crearCategoria=$(this);

            // get form data
            var crearCategoria_obj = crearCategoria.serializeObject();
            
            crearCategoria_obj["MailCategory"] =MailAccount; 
                
            // convert object to json string
            var form_data=JSON.stringify(crearCategoria_obj);

            //alert(form_data);
        
            // submit form data to api
            $.ajax({
                url: "create/createCategory.php",
                type : "POST",
                contentType : 'application/json',
                data : form_data,
                success : function(output){
                   
                    var result = $.parseJSON(output);
                    //alert(result[1]);

                    //http://jsfiddle.net/codeandcloud/nr54vx7b/
                    var selects = document.getElementById("dynamic-selects");

                    selects.options[selects.options.length] = new Option(result[1], result[0]);

                    $('.selectpicker').selectpicker('refresh');
   
                    crearCategoria.find('input').val('');
                    crearCategoria.find('textarea').val('');
                
                
                },
                error: function(xhr, resp, text){

                    if ( xhr.status === 403) {
                        alert("Ya existe esa categoria. Favor de crear una nueva o elegir la ya existente.")
                    }
                    
                    console.log("fail");
                    // on error, tell the user login has failed & empty the input boxes
                    console.log("Error al iniciar sesion " + text);
                    console.log("Response text  " + xhr.responseText);
        
                    
                    crearCategoria.find('input').val('');
                    crearCategoria.find('textarea').val('');
                }
            });

            return false;
        });



        /*-------------------------------------------AGREGAR CURSO--------------------------------*/
        
        $(document).on('submit', '#course_form', function()
        {

			var formData = new FormData(this);

            formData.append("usuarioCreate", MailAccount);
            numNiveles = formData.get("nivelesCreate");

            $.ajax({
				url: "create/createCourse.php",
				type: 'POST',
				data: formData,
				success: function (data) {
					//alert(data);
                    cursoActual = data;
          
                for (let i = 0; i < numNiveles; i++) {
                        
                        var strVar="";
                        strVar += "<form class=\"level_form levelform\" method=\"post\" style=\"margin-left: 3%;\">";
                        strVar += " <div class=\"row\">";
                        strVar += " <div class=\"col-md-8\">";
                        strVar += "<div class=\"card\" style=\"max-width: 100%; margin:0px; padding: 5%\">";
                        strVar += "<div class=\"form-group row\">";
                        strVar += "<h2>Información del nivel ";
                        strVar += (i+1);
                        strVar += "<\/h2>";
                        strVar += "<label for=\"tituloNivel\" class=\"col-12 col-form-label\">Titulo del nivel<span style=\" color: red;\">*</span><\/label> ";
                        strVar += "<div class=\"col-12\">";
                        strVar += "<input name=\"tituloNivel\" placeholder=\"Enter Title here\" class=\"form-control here\" required=\"required\" type=\"text\" required  style=\"margin-bottom:2%;\">";
                        strVar += "<\/div>";
                        strVar += "<label  for=\"descNivel\" class=\"col-12 col-form-label\">Descripcion del nivel<span style=\" color: red;\">*</span><\/label> ";
                        strVar += "<div class=\"col-12\">";
                        strVar += "<textarea name=\"descNivel\" cols=\"40\" rows=\"5\" placeholder=\"Escribir una descripción\" class=\"form-control\" style=\"margin-bottom:2%;\"><\/textarea> ";
                        strVar += "<\/div>";
                        strVar += "<label>Costo del nivel<\/label> ";
                        strVar += "<input name=\"costoNivel\" type=\"number\" min=\"0.00\" step=\".01\" style=\"width: 100%; margin-bottom: 3%;\" \/> ";
                        strVar += "<label for=\"videoNivel\" class=\"col-12 col-form-label\">Video del nivel<span style=\" color: red;\">*</span><\/label> ";
                        strVar += "<input type=\"file\" name=\"videoNivel\" required accept=\"video\/mp4\">";
                        strVar += "<label for=\"pdfNivel\" class=\"col-12 col-form-label\">PDF del nivel<\/label> ";
                        strVar += "<input type=\"file\" name=\"pdfNivel\" accept=\"application\/pdf\">";
                        strVar += "<\/div>";
                        strVar += "<\/div>";
                        strVar += "<\/div> ";
                        strVar += "<div class=\"col-md-4 \">";
                        strVar += "<\/div>";
                        strVar += "<\/div>";
                        strVar += "<\/form>";
            

                        $('#newRow').append(strVar);

                    }
        
                   
                    $('.btnSubmitAll').css('visibility', 'visible');
                    $('.form-course-all').hide();
                    $('#course_form').trigger("reset");
                  
				},
                error: function(xhr, resp, text){
                  
                    console.log("fail");
                    // on error, tell the user login has failed & empty the input boxes
                    alert("Error al iniciar sesion " + text);
                    alert("Response text  " + xhr.responseText);
                },
				cache: false,
				contentType: false,
				processData: false
			});

            return false;
		});
        /*-----------------------------------------AGREGAR NIVELES--------------------------------------------------*/       
        //https://stackoverflow.com/questions/23754973/submit-ajax-request-one-by-one-with-each


        function post_form_data(formData) {
            
            
            $.ajax({
                type: 'POST',
                url: 'create/createLevel.php',
                data: formData,
                async :false ,
                success: function (data) {
                   // alert(data);
                
                    console.log('Success');
                },
                error: function (xhr, resp, text) {
                
                    alert("fail");
                    // on error, tell the user login has failed & empty the input boxes
                    alert(text);
                    alert("Response text  " + xhr.responseText); 
                },
				cache: false,
				contentType: false,
				processData: false
            });
        }

        $(document).on('click', '.btnSubmitAll', function(){

            var dataLevel = 0;
            var numNivel = 0;

            $('.level_form').each(function () {

                var $myForm = $(this);
        
                var formData = new FormData(this);

               // console.log(formData.get("videoNivel"));

                if (!$myForm[0].checkValidity()) {
                  alert("Llenar todos los campos de los niveles");
                }
                else
                {
                    formData.append("idCourse", cursoActual);
                    formData.append("numeroNivel", numNivel);

                    /*for (var pair of formData.entries()) {
                        console.log(pair[0]+ ', ' + pair[1]); 
                    }*/

                    post_form_data(formData);
                    numNivel = numNivel + 1;
                }
              
            });

            $(".form-course-all").show();
            $( ".level_form" ).remove();

        });

//https://www.codeproject.com/Questions/4532857/How-do-I-pass-value-from-foreach-loop-with-AJAX-to
       /* $('button').on('click', function () {
            $('.levelform').each(function () {
                alert($(this).serialize());
                //post_form_data($(this).serialize());
            });
        });*/

       /* $('.level_form').on('submit', function (event) {
            event.preventDefault();
            if (!onformsubmitContactUs()) return false;

            var _this = $(this);

            $.ajax({
                url: '@Url.Action("AddComment", "Home")',
                type: 'post',
                data: _this.serialize(),
                beforeSend: function () {
                    $('.b',_this).val('sending .......'); // change submit button text
                    $('.Name',_this).css("borderColor", "");
                    $('.Msg',_this).css("borderColor", "");
                },
                ....
        }*/


    /*--------------------------------TOOLTIP PARA AYUDA-------------------- */
    $(function () {
    $('[data-toggle="tooltip"]').tooltip();
    })
            
    </script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>


</head>
<body  style="background-color: #0b1925;">

    <div class="row">
        <!--Espacio izq-->
        <div class="col-2"></div>

        <!--Principal-->
        <!--https://bootsnipp.com/snippets/klabB-->
        <div class="col-8" style="background-color: #073352; padding:0px">
        
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1>Crear un nuevo curso</h1>
                                        <span>Los campos con <span style="color:red;">*</span> son obligatorios. Puede pasar el cursor sobre los campos para obtener más información</span>

                                    </div>
                               
                                    
                                </div>
                                <hr style="border: 1px solid #1879d1;
                                border-radius: 5px;">
                                <div class="row form-course-all">
                                  
                                
                                    <form id="course_form" method="post" style="margin-left: 3%;">

                                        <div class="row">
                                            <div class="col-md-8">

                                               
                                                <div class="card" style="max-width: 100%; margin:0px; padding: 5%">
                                                    <div class="form-group row">

                                                        <h2>Información general</h2>


                                                        <label for="tituloCreate" class="col-12 col-form-label">Titulo del curso<span style=" color: red;">*</span></label> 
                                                        <div class="col-12">
                                                            <input id="tituloCreate" name="tituloCreate" placeholder="Enter Title here" class="form-control here" required="required" type="text" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="descCreate" class="col-12 col-form-label">Descripción del curso<span style=" color: red;">*</span></label> 
                                                        <div class="col-12">
                                                        <textarea id="descCreate" name="descCreate" cols="40" rows="5" class="form-control" required></textarea>
                                                    </div>

                                           

                                                    <div class="form-group row">
                                                      
                                                       <label for="costCreate" class="col-12 col-form-label" data-toggle="tooltip" data-placement="right" title="Si el curso completo tiene un precio, ingresar monto. Si es gratis o solo los niveles tiene precio dejar este campo en blanco">Costo del curso completo</label> 
                                                       <div class="col-12">
                                                           <input id="costoCreate" name="costoCreate"  type="number" min="0.00" step="any" style="width: 100%;" />
                                                       </div>
                                                       
                                                                      
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-12 col-form-label" data-toggle="tooltip" data-placement="right" title="Puede seleccionar múltiples categorías">Categoría<span style=" color: red;">*</span></label> 
   
                                                            <select required  id="dynamic-selects"  class="selectpicker" multiple aria-label="size 3 select example" name='categoriaCreate[]' id="categoriaCreate">
                                                                    <?php foreach($categoriasVar as $categoriaVar): ?>
                                                                        <option value="<?= $categoriaVar['categoriaId']; ?>"><?= $categoriaVar['categoriaNombre']; ?></option>
                                                                    <?php endforeach; ?>
                                                            </select>


                                                        <label class="col-12 col-form-label">¿No encuentras la categoría que necesitas?<a href="#crearCategoria"> Crea una nueva </a></label> 

                                                        <label for="nivelesCreate" class="col-12 col-form-label" data-toggle="tooltip" data-placement="right" title="En base a este número se crearán los campos de nivel a llenar">Numero de niveles<span style=" color: red;">*</span></label> 
                                                         <div class="col-12">
                                                             <input id="nivelesCreate" name="nivelesCreate" type="number" min="1" step="1" style="width: 100%;" required />
                                                         </div>
                                                    </div>                                         
                                                    
                                                    <div class="row">

                                                        <div class="col-lg-12">

                                                                <!--Agrega niveles   -->
                                                            

                                                            <div id="inputFormRow">
                                                                                
                                                                <div class="row">
                                                                    <!--
                                                                    <div class="col-sm-9" >
                                                                                                                                                    
                                                                        <input type="text" name="title[]" class="form-control m-input" placeholder="Escribir titulo" autocomplete="off" style="margin-bottom:2%;">
                                                                        <textarea name="textarea" cols="40" rows="5" placeholder="Escribir una descripción" class="form-control" style="margin-bottom:2%;"></textarea>                                                           
                                                                        <label>Costo del nivel</label> 
                                                                        <input type="number" min="0.00" step=".01" style="width: 100%; margin-bottom: 3%;" />
                                                                

                                                                    </div>
                                                                    <div class="col-sm-3" style="text-align: right;">
                                                                        <button id="removeRow" type="button" class="btn btn-danger" >Remove</button>
                                                                    </div>
                                                                    -->
                                                                </div>

                                                            </div>
                                                                <!-- <button id="addRow" type="button" class="btn btn-info">Añadir otro nivel</button>-->   
                                                            </div>
                                                                          
                                                        </div>
                                                    
                                                    </div>
                                                </div>
       

                                            </div> 
                                                
                                            <div class="col-md-4 ">
                                                        
                                                                <div class="card mb-3" style="max-width: 18rem;">
                                                                        <div class="card-header bg-light" data-toggle="tooltip" data-placement="right" title="Subir imagen con formato jpeg, jpg o png">Agregar imagen principal<span style=" color: red;">*</span></div>
                                                                        <div class="card-footer bg-light">
                                                                            <input type="file"name="imagenPrincipal" accept="image/jpeg, image/png" required>
                                                                        </div>
                                                                </div>

                                                                <div class="card mb-3" style="max-width: 18rem;">
                                                                        <div class="card-header bg-light" data-toggle="tooltip" data-placement="right" title="Subir video con formato mp4">Agregar video introductorio</div>
                                                                        <div class="card-footer bg-light">
                                                                            <input type="file"name="videoPrincipal" accept="video/mp4">
                                                                        </div>
                                                                </div>


                                                                <div class="card mb-3" style="max-width: 18rem;">
                                                                    <div class="card-header bg-light">Crear curso</div>
                                                                        <div class="card-footer bg-light">
                                                                            <input class="btn btn-primary btn-sm" type="submit" name="next" value="Crear curso" data-toggle="tooltip" data-placement="right" title="Click para crear el curso y pasar a crear los niveles"/>
                                                                            
                                                                            
                                                                        </div>
                                                                </div>
                                                        
                                            </div>
                                        </div>

                                    </form>


                                    <form  method="post" style="margin-left: 3%;"  id="category_form">

                                       
                                        <div class="row">
                                            <div class="col-md-8" id = "crearCategoria">

                                                <div class="card" style="max-width: 100%; margin:0px; padding: 5%"> 

                                                    <div class="form-group row">
                                                    
                                                        <h2>Agregar categoría</h2>

                                                        <label for="#CategoryName" class="col-12 col-form-label">Nombre de la categoría<span style="color:red;">*</span> </label> 
                                                        <input id="CategoryName" name="CategoryName" class="form-control here" required type="text">
                                                        <label for="#categoryDesc" class="col-12 col-form-label" data-toggle="tooltip" data-placement="right" title="Explicar qué tipo de cursos puede contener esta categoría">Descripción de la categoría<span style="color:red;">*</span> </label> 
                                                        <textarea id="categoryDesc" name="categoryDesc" cols="40" rows="5" class="form-control" required></textarea>
                                                    
                                                        <input class="btn btn-primary btn-sm" type="submit" name="Categoria" value="Agregar categoría" data-toggle="tooltip" data-placement="right" title="Click para crear una nueva categoria"/>

                                            
                                                    </div>

                                                </div>
                               
                                            </div>
                                        </div> 

                                    </form>

                                  
                                   
                                    
                                </div>

                                <div id="newRow" class="row">
                                
                 

                              </div>

                              <button  class="btn btn-primary btn-sm btnSubmitAll" style="visibility: hidden" data-toggle="tooltip" data-placement="right" title="Click para crear los niveles y publicar el curso">Crear niveles</button>




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