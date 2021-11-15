<?php
include_once 'navbar/navbar.php';
//include_once 'footer/footer.php';


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
    <title>ACodemia</title>

    <!--Para el date picker-->
    <!--https://gijgo.com/datepicker/example/daterangepicker -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <script>
        var searchText = 0;
        var pageText = 0;
   

        $(document).ready()
        {
            //$("#SelectFilter").val("");

            //https://easyautotagging.com/javascript-get-url-parameter/
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            searchText = urlParams.get('searchword');
            pageText = urlParams.get('page');
            if(searchText!=null)
            {
                //alert("serach by word "+searchText);

                $.ajax({
                    url: "Search/SearchByName.php",
                    type : "POST",
                    data: {'searchword': searchText, 'page':pageText}, 
                    success : function(result) {

                        $('#resultados-word').html(searchText);
                        $("#CourseRow").html(result); 

                        // if response is a success, tell the user it was a successful sign up & empty the input boxes
                        //location.href = "http://www.example.com/ThankYou.html"
                    },
                    error: function(xhr, resp, text){
                     
                        window.location = ' error/404.html';
                        console.log("Error al crear cuenta  " + text);
                        console.log("Response text  " + xhr.responseText);
                    }
                });
        
            }
            else
            {
                searchText = urlParams.get('category');
                if(searchText!=null)
                {
                    $.ajax({
                    url: "Search/SearchByCategory.php",
                    type : "POST",
                    data: {'searchword': searchText, 'page':pageText}, 
                    success : function(result) {
                        //alert(result);
                        $('#resultados-word').html(searchText);
                        $("#CourseRow").html(result); 
                    },
                    error: function(xhr, resp, text){
                        
                        //window.location = ' error/404.html';
                        console.log("Error al crear cuenta  " + text);
                        console.log("Response text  " + xhr.responseText);
                    }
                });
                }
                else
                {
                    searchText = urlParams.get('user');
                    if(searchText!=null)
                    {
                        $.ajax({
                        url: "Search/SearchByUser.php",
                        type : "POST",
                        data: {'searchword': searchText, 'page':pageText}, 
                        success : function(result) {
                            //alert(result);

                         
                                $('#resultados-word').html(searchText);
                                $("#CourseRow").html(result); 

                            },
                            error: function(xhr, resp, text){

                                window.location = ' error/404.html';
                                console.log("Error al crear cuenta  " + text);
                                console.log("Response text  " + xhr.responseText);
                            }
                        });
                    }
                    else
                    {
                        searchTextTo = urlParams.get('to');
                        searchTextFrom = urlParams.get('from');
                        if((searchTextTo!=null)||(searchTextFrom!=null))
                        {
                            $.ajax({
                            url: "Search/SearchByDate.php",
                            type : "POST",
                            data: {'searchTextTo': searchTextTo, 'searchTextFrom': searchTextFrom, 'page':pageText}, 
                            success : function(result) {

                                //alert(result);
                                    $('#resultados-word').html(searchText);
                                    $("#CourseRow").html(result); 

                                },
                                error: function(xhr, resp, text){

                                    window.location = ' error/404.html';
                                    console.log("Error al crear cuenta  " + text);
                                    console.log("Response text  " + xhr.responseText);
                                }
                            });
                        }
                
                    }
                }
            }
           

         
            $("#btnSubmit").click(function(){
                alert("button");
            }); 

        }

//Get multiple URL PARAMETERS
//https://www.codexpedia.com/javascript/javascript-get-the-query-string-param-from-url/

/*--------------------------------ON CHANGE FILTER-----------------------*/
    function getval(sel)
    {
        if(sel.value == "categoria")
        {
            window.location = 'http://localhost:8012/Acodemia/search.php?category=' + searchText + "&page=1";
        }
        if(sel.value == "usuario")
        {
            window.location = 'http://localhost:8012/Acodemia/search.php?user=' + searchText + "&page=1";
        }
        if(sel.value == "curso")
        {
            window.location = 'http://localhost:8012/Acodemia/search.php?searchword=' + searchText + "&page=1";
        }
        if(sel.value == "fecha")
        {
            
           $('#DatePicker').css( "display", "inline-block" );
           $('#btnFecha').css( "display", "inline-block" );
        }

    
    }



/*----------------------------------ON CLICK NEXT - PREV-------------------- */

    $(document).on('click','#nextPage', function() {
       
       var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        pageText = urlParams.get('page');
        pageText = parseInt(pageText);
        pageText = (pageText+1);

   

        urlParams.set('page', pageText);

        //window.location.search = urlParams;

        //window.location.search = jQuery.query.set("page", pageText);
        //queryString.searchParams.set('page', pageText);
        
        window.location = 'http://localhost:8012/Acodemia/search.php?' + urlParams;
    }); 



    $(document).on('click','#prevPage', function() {
       
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        pageText = urlParams.get('page');
        pageText = parseInt(pageText);
   
        if(pageText>1)
        {
            pageText = (pageText-1);
            //alert(pageText);
            urlParams.set('page', pageText);
            window.location = 'http://localhost:8012/Acodemia/search.php?' + urlParams;
           // queryString.searchParams.set('page', pageText);
           // window.location = 'http://localhost:8012/Acodemia/search.php';
        }
    }); 

/*-----------------------------DISPLAY FECHA------------------------*/

function obtenerFecha()
{
    
    var startDate = document.getElementById("startDate").value;
    if(startDate!=0)
    {
        var dateAr = startDate.split('/');
        startDate = dateAr[2] + '-' + dateAr[0] + '-' + dateAr[1].slice(-2);
    }
  

    var endDate = document.getElementById("endDate").value;
    if(endDate!=0)
    {
        dateAr = endDate.split('/');
        endDate = dateAr[2] + '-' + dateAr[0] + '-' + dateAr[1].slice(-2);
    }
  

    window.location = 'http://localhost:8012/Acodemia/search.php?from=' + startDate + "&to=" + endDate + "&page=1";

    
}
  

        
    </script>


</head>
<body style="background-color: #0b1925;">
    <div class="row">
        <!--Espacio izq-->
        <div class="col-2"></div>

        <!--Principal-->
        <div class="col-8" style="background-color: #073352; padding-left: 4%; padding-right: 4%;">
        
            <div class="text-left " style="padding-top:2%; ">
               <h4 style="color: whitesmoke;" class="subtitle-text">Resultados para <span id="resultados-word"></span></h4>
            </div>

            <div class="text-left " style="padding-top:2%;">
                <h5 style="color: whitesmoke;" class="subtitle-text">Buscar por</h5>
                
             </div>

             <!--Form filtro-->
             <div class="form-group">
                <select class="form-control" onchange="getval(this);" id="SelectFilter">
                  <option value="">Cualquier resultado</option>
                  <option value="categoria">Categoría</option>
                  <option value="curso">Curso</option>
                  <option value="usuario">Usuario</option>
                  <option value="fecha">Fecha</option>
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

            

            <a class="btn btn-primary btn-category" style="display: none;" onclick='obtenerFecha();' id="btnFecha">Buscar</a>


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
                            <?php foreach($categoriasVar as $categoriaVar): ?>
                            <a href="http://localhost:8012/Acodemia/search.php?category=<?= $categoriaVar['categoriaId'] ?>&page=1" class="list-group-item list-group-item-action"><?= $categoriaVar['categoriaNombre'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    

                </div>
                <div class="col-xl-10" id="CourseRow" >
                </div>

                <div class="col-xl-10"  >
                       <!--navigation-->
                    <div class="row">
                          <div class="col-4"></div>
                          <div class="col-4">

                          <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item" id="prevPage">
                                    <a class="page-link">Previous</a>
                                </li>
                               
                                <li class="page-item" id="nextPage">
                                    <a class="page-link">Next</a>
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

<!--






delimiter &ZV
create procedure searchByFecha(in p_date1 date, in p_date2 date)
begin
    select cursoId, cursoNombre, cursoMiniatura, cursoDescripcion, cursoCosto, cursoNiveles 
    from Curso where cursoFechaPublicacion between p_date1 and p_date2 limit 10;
end &ZV
-->