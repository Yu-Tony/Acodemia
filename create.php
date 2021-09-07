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
            '<input type="file" id="myfile" name="myfile" multiple="multiple">' + 
            '</div>';
                
            /*var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="text" name="title[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';*/
    
            $('#newRow').append(html);
        });
    
        }); 

         
                                                                
        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
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
                                              <input id="titleCreate" name="text" placeholder="Enter Title here" class="form-control here" required="required" type="text">
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <label for="descCreate" class="col-12 col-form-label">Descripción del curso</label> 
                                            <div class="col-12">
                                              <textarea id="descCreate" name="textarea" cols="40" rows="5" class="form-control"></textarea>
                                            </div>
                                          </div> 
                                          <div class="form-group row">
                                            <label for="costCreate" class="col-12 col-form-label">Costo del curso completo</label> 
                                            <div class="col-12">
                                                <input id="costCreate"  type="number" min="0.00" step="any" style="width: 100%;" />
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label for="categCreate">Selecciona una categoría</label>
                                            <select class="form-control" id="categCreate">
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                          </div>
                                          <div class="form-group row">
                                            <label for="categNewCreate" class="col-12 col-form-label">¿No encuentras la categoría que necesitas? Crea una nueva</label> 
                                            <div class="col-12">
                                              <input id="categNewCreate" name="text" class="form-control here" required="required" type="text">
                                              <button type="button" class="btn btn-primary" style=" width: 30%" >Agregar categoría</button>
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
                                                        <input type="file" id="myfile" name="myfile" multiple="multiple">


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