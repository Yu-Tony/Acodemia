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

    <!--Script para agregar y borrar-->
    <script type="text/javascript">
        // add row
        $(function(){ /* DOM ready */ 
            $("#addRow").click(function () {

            var html = '' + 
            '<div id="inputFormRow">' + 
            '<div class="row">' + 
            '<div class="col-sm-9" >' + 
            '<input type="text" name="title[]" class="form-control m-input" placeholder="Escribir titulo" autocomplete="off" style="margin-bottom:2%;">' + 
            '<textarea name="textarea" cols="40" rows="5" placeholder="Escribir una descripción" class="form-control" style="margin-bottom:2%;"></textarea>' + 
            '<label>Costo del nivel</label>'+
            '<input type="number" min="0.00" step=".01" style="width: 100%; margin-bottom: 3%;" />'+
            '</div>' + 
            '<div class="col-sm-3" style="text-align: right;">' + 
            '<button id="removeRow" type="button" class="btn btn-danger" >Remove</button>' + 
            '</div>' + 
            '</div>' + 
            '<label for="myfile">Escoge un archivo:</label>' + 
            '<input type="file" id="myfile" name="myfile" multiple="multiple" accept=".jpg, .png, .jpeg|image/*" onchange="checkFiles(this.files)">' + 
            '</div>';
                
    
            $('#newRow').append(html);
        });
    
        }); 

         
                                                                
        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });

        //Solo una cantidad de archivos
        function checkFiles(files) {       
            if(files.length>3) {
                alert("No se permiten mas de 3 imagenes");

                event.preventDefault();
            }       
        }

        //Solo poner el costo de curso cuando lo tiene
        $(function(){ /* DOM ready */
        $("#tipoCosto").change(function() {
          
          if ($('#tipoCosto').val() = "Precio por el curso completo") 
            {
                alert('todo' );
              /*$('#dayDropdown').prop('disabled', false);
              $('#dayDropdown').find('option').remove();*/
      

      
      
            } 
            else {
              /*$('#dayDropdown').prop('disabled', true);*/
            }
      });
    });
        
    </script>




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
                                    <div class="col-md-3">
                                        <h4>Crear un nuevo curso</h4>
                                    </div>
                                    <div class="col-md-7">
                                     
                                    </div>
                                    
                                </div>
                                <hr style="border: 1px solid #1879d1;
                                border-radius: 5px;">
                                <div class="row">
                                    <div class="col-md-8">
                                        <form>
                                          <div class="form-group row">
                                            <label for="titleCreate" class="col-12 col-form-label">Titulo del curso</label> 
                                            <div class="col-12">
                                              <input id="titleCreate" name="text" placeholder="Enter Title here" class="form-control here" required="required" type="text" required>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="descCreate" class="col-12 col-form-label">Descripción del curso</label> 
                                            <div class="col-12">
                                              <textarea id="descCreate" name="textarea" cols="40" rows="5" class="form-control" required></textarea>
                                            </div>
                                          </div> 
                                          <div class="form-group row">
                                            <label class="col-12 col-form-label">Tipo de costo del curso</label> 
                                            
                                            <select class="selectpicker" data-width="200%" title="Selecciona tipo de costo..." required>
                                                <option>Curso completo gratuito</option>
                                                <option>Precio por el curso completo</option>
                                                <option>Precio solo por los niveles</option>
                                                <option>Precio por niveles y curso completo</option>
                                            </select>

                                            <label for="costCreate" class="col-12 col-form-label">Costo del curso completo</label> 
                                            <div class="col-12">
                                                <input id="costCreate"  type="number" min="0.00" step="any" style="width: 100%;" />
                                            </div>
                                            
                                          </div>
                                          <div class="form-group">
                                          <label class="col-12 col-form-label">Categoría</label> 
                                                <select class="selectpicker" data-live-search="true" multiple title="Selecciona una categoría..." data-width="100%" required>
                                                    <option data-tokens="ketchup mustard">HTML</option>
                                                    <option data-tokens="mustard">CSS</option>
                                                    <option data-tokens="frosting">JS</option>
                                                </select>

                                          </div>

                                          <div class="form-group row">
                                            <label class="col-12 col-form-label">¿No encuentras la categoría que necesitas? Crea una nueva</label> 
                                            <div class="col-12">

                                              <button data-toggle="modal" data-target="#modalCateg" class="btn btn-primary" style="margin-top: 2%;">Agregar categoría</button>
    
                                            </div>
                                        
                                          </div>

                                                  <!-- Modal -->
                                        <div class="modal fade" id="modalCateg" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">    
    
                                                <div class="modal-header">
                
                                                <h4 class="modal-title">Agregar categoría</h4>
                                                </div>
                                                <div class="modal-body">
                                                <label for="#CategoryName" class="col-12 col-form-label">Nombre de la categoría</label> 
                                                <input id="CategoryName" name="text" class="form-control here" required type="text">
                                                <label for="#CategoryDesc" class="col-12 col-form-label">Descripción de la categoría</label> 
                                                <textarea id="descCreate" name="textarea" cols="40" rows="5" class="form-control" required></textarea>
                                        
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary" >Agregar</button>

                                                </div>
                                            </div>
                                            
                                            </div>
                                        </div>


                                          <hr style=" border: 1px solid #1879d1;
                                          border-radius: 5px;">
                                      
                                            <div class="row">

                                                <div class="col-lg-12">

                                                    Agrega niveles
                                        

                                                    <div id="inputFormRow">
                                                       
                                                        <div class="row">
                                                            <div class="col-sm-9" >
                                                                                                                        
                                                                <input type="text" name="title[]" class="form-control m-input" placeholder="Escribir titulo" autocomplete="off" style="margin-bottom:2%;">
                                                                <textarea name="textarea" cols="40" rows="5" placeholder="Escribir una descripción" class="form-control" style="margin-bottom:2%;"></textarea>                                                           
                                                                <label>Costo del nivel</label> 
                                                                <input type="number" min="0.00" step=".01" style="width: 100%; margin-bottom: 3%;" />
                                     

                                                            </div>
                                                            <div class="col-sm-3" style="text-align: right;">
                                                                <button id="removeRow" type="button" class="btn btn-danger" >Remove</button>
                                                            </div>
                                                        </div>

                                                        <label for="myfile">Escoge un archivo:</label>

                                                        <input type="file" id="myfile" name="myfile" multiple="multiple" accept=".jpg, .png, .jpeg|image/*" onchange="checkFiles(this.files)">


                                                    </div>
                                        
                                                    <div id="newRow"></div>
                                                    <button id="addRow" type="button" class="btn btn-info">Añadir otro nivel</button>
                                                </div>
                                                
                                            </div>
                                     

                                        </form>
                                    </div>

                                    <div class="col-md-4 ">
                                        <div class="card mb-3" style="max-width: 18rem;">
                                            <div class="card-header bg-light ">Agregar imagen principal</div>
                                            <div class="card-footer bg-light">
                                                <input type="file"name="myfile" >
                                            </div>
                                      </div>

                                        <div class="card mb-3" style="max-width: 18rem;">
                                              <div class="card-header bg-light ">Publicar curso</div>
                                              <div class="card-footer bg-light">
                                                <button type="button" class="btn btn-primary btn-sm">Publicar</button>
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