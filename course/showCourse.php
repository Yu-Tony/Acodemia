<?php
    require_once '../api/config/database.php'; 
    
    $data = json_decode(file_get_contents("php://input"));


    $database = new Database();
    $db = $database->getConnection();

    ////////////////////////////

    $searchWord = $_POST['course'];
    $userMail = $_POST['mail'];
    $tipo = $_POST['tipo'];
    $userId =0;
    $cursoComprado = 0;

    if($userMail!=0)
    {
        $call = 'call userGetId(?,@idUser)';
    
		// prepare
		$stmt = $db->prepare($call);
	

		$stmt->bindParam(1, $userMail);
	
	
		// execute
		
		if($stmt->execute())
		{
			$sql = "SELECT @idUser";
			$stmt = $db->prepare($sql);
			$stmt->execute();
	
			list($userId) = $stmt->fetch(PDO::FETCH_NUM);
 					
		}
    }
    
    
    $call =  $db->prepare('CALL compraCursoVerificar(:p_user, :p_curso)');
    $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
    $call->bindParam(':p_curso', $searchWord, PDO::PARAM_INT);

    if($call->execute())
    {
        $comentariosCurso = $call->fetchAll(PDO::FETCH_ASSOC);
        
        if($comentariosCurso!=null)
        {
            foreach ($comentariosCurso as $comentarios) 
            { 

                $existe= $comentarios['count(ventaCursoId)'];

                if($existe==0)
                {
                    $cursoComprado = 0;
                }
                else
                {
                    $cursoComprado = 1;
                }
                                                                                       
            } 
        }
    }

    /*
    delimiter &ZV
    create procedure showCurso(in p_cursoid int)
    begin
        select c.cursoNombre, c.cursoDescripcion, c.cursoMiniatura, c.cursoDescripcion, 
        c.cursoCosto, c.cursoNiveles, c.cursoFechaPublicacion, c.cursoVideoIntroductorio, c.cursoMiniatura, 
        c.cursoEstado, u.usuarioNombre
        from Curso as c inner join Usuario as u on c.cursoProfesorId = u.usuarioId where cursoId = p_cursoid;
    end &ZV
    */

    $call =  $db->prepare('CALL showCurso(:p_cursoid)');
    $call->bindParam(':p_cursoid', $searchWord, PDO::PARAM_INT); 


 

    if($call->execute())
    {
        $busqueda = $call->fetchAll(PDO::FETCH_ASSOC);

        if($busqueda!=null)
        {
            foreach ($busqueda as $result) 
            {
                //									
                $cursoNombre = $result['dNombre'];
                $cursoDescripcion = $result['dDesc'];
                $cursoCosto = $result['dCosto'];
                $cursoNiveles = $result['dNiveles'];
                $cursoFechaPublicacion = $result['dFecha'];
                $cursoVideoIntroductorio = $result['dVideo'];
                $cursoMiniatura = $result['dImage'];
                $cursoEstado = $result['dEstado'];
                $usuarioNombre = $result['dUsername'];
                $usuarioIdResult =  $result['dUserId'];

                

                if(($cursoEstado==1) || ($cursoComprado==1))
                {
                    echo "<div class=\"row\" >";
                    echo "<div class=\"col-lg-8\"></div>";
                    echo "<div class=\"col-lg-4 col-md-12 col-sm-12 col-12\">";
                    echo "<div class=\"card card-desc buy-card\" >";
                   
                    if($cursoVideoIntroductorio)
                    {
                        echo "<video id=\"my-video\" class=\"video-js vjs-16-9 \" controls  preload=\"auto\" data-setup=\"{}\">";
                        echo "<source src=\"uploads/$cursoVideoIntroductorio\" type=\"video/mp4\" />";
                        echo "<p class=\"vjs-no-js\">To view this video please enable JavaScript, and consider upgrading to a web browser that";
                        echo "<a href=\"https://videojs.com/html5-video-support/\" target=\"_blank\">supports HTML5 video</a>";
                        echo "</p>";
                        echo "</video>";
                    }

                    echo "<div class=\"card-body\" style=\"padding-left: 10%;\">";
                    echo "<div class=\"row\">";
                    echo "<span class=\"text-muted font-small d-block mb-2\">Categorias</span>";
                    echo "</div>";

                            
                    $call =  $db->prepare('CALL showCategorias(:p_cursoid)');
                    $call->bindParam(':p_cursoid', $searchWord, PDO::PARAM_INT); 
                    
                   if($call->execute())
                    {
                        $categoriasCurso = $call->fetchAll(PDO::FETCH_ASSOC);
                        
                        if($categoriasCurso!=null)
                        {
                            foreach ($categoriasCurso as $categ) 
                            { 
                                $categ= $categ['categoriaNombre'];
                                echo "<a class=\"btn btn-primary btn-category\" href=\"http://localhost:8012/Acodemia/search.php?category=$categ&page=1\">$categ</a>";
                                                             
                            } 
                        }
                    }
                   

                 

                    $call = 'call valoracionGet(?,@p_valoracion)';
                    $stmt = $db->prepare($call);
                    $stmt->bindParam(1, $searchWord);
                    if($stmt->execute())
                    {
                        $sql = "SELECT @p_valoracion";
                        $stmt = $db->prepare($sql);
                        $stmt->execute();
                
                        list($calificacionCourse) = $stmt->fetch(PDO::FETCH_NUM);
                                 
                    }

                    echo "<div class=\"col pl-0\" style=\"margin-top: 10%\"><span class=\"text-muted font-small d-block mb-2\">Calificacion</span> <span class=\"h5 text-dark font-weight-bold\">$calificacionCourse</span></div>";


                    echo "<span class=\"h5 text-dark font-weight-bold\"></span>";

                    echo "<div class=\"d-flex justify-content-between\">";
                    echo "<div class=\"col pl-0\"><span class=\"text-muted font-small d-block mb-2\">Precio</span> <span class=\"h5 text-dark font-weight-bold\">$<span class=\"h5 text-dark font-weight-bold precioIndividual\">$cursoCosto</span></span></div>";
                    echo "<div class=\"col pr-0\"><span class=\"text-muted font-small d-block mb-2\">Niveles</span> <span class=\"h5 text-dark font-weight-bold\">$cursoNiveles</span></div>";
                    echo "</div>";

                    /**delimiter &ZV
                    create procedure compraCursoVerificar(in p_user int, in p_curso int)
                    begin
                        select count(ventaCursoId) from Ventas_curso where usuarioId = p_user and cursoId = p_curso;
                    end &ZV
                    */


                    $call =  $db->prepare('CALL cursoTerminado(:p_user, :p_curso)');
                    $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
                    $call->bindParam(':p_curso', $searchWord, PDO::PARAM_INT); 
                    
                    if($call->execute())
                    {
                        $nivelesCurso = $call->fetchAll(PDO::FETCH_ASSOC);
                        
                        if($nivelesCurso==null)
                        {
                            if(($cursoCosto!=0) && ($userMail!=0) && ($cursoComprado == 0) && ($tipo==0))
                            {
                        
                         
                                echo "<button type=\"button\" class=\"btn btn-primary btnCurso btnComprar\" style=\"margin-top: 10%;\" data-toggle=\"modal\" data-target=\"#ModalPay\" >Comprar</button>";
                         
                            }
                        }
                    }


       
                    if($userId==$usuarioIdResult)
                    {
       
 
                        echo "<button type=\"button\" class=\"btn btn-secondary\" style=\"margin-top: 2%;\" id=\"EditCourse\">Editar Curso</button>";


                        echo "<button id=\"SaveCourse\" type=\"button\" class=\"btn btn-secondary\" style=\"margin-top: 2%; display: none;\" >Guardar</button>";
                        echo "<button id=\"CancelEditCourse\" type=\"button\" class=\"btn btn-secondary\" style=\"margin-top: 2%; display: none;\" >Cancelar</button>";
         
                     
                        echo "<button data-toggle=\"modal\" data-target=\"#modalDelete\" class=\"btn btn-danger\" style=\"margin-top: 2%;\">Eliminar Curso</button>";    
                    
                    }
         
                    echo "</div>";
                    echo "</div>";
                    echo "<!-- Modal Eliminar -->";
                    echo "<div class=\"modal fade\" id=\"modalDelete\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">";
                    echo "<div class=\"modal-dialog modal-dialog-centered\" role=\"document\">";
                    echo "<div class=\"modal-content\">";
                    echo "<div class=\"modal-header\">";
                    echo "<h4 class=\"modal-title\">Eliminar curso</h4>";
                    echo "</div>";
                    echo "<div class=\"modal-body\">";
                    echo "¿Borrar este curso?";
                    echo "</div>";
                    echo "<div class=\"modal-footer\">";
                    echo "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancelar</button>";
                    echo "<button type=\"button\" class=\"btn btn-danger\" id=\"DeleteCourse\">Eliminar</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    
                    echo "<!-- Modal Comprar -->";
                    echo "<div class=\"modal fade\" id=\"modalPurchased\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">";
                        echo "<div class=\"modal-dialog modal-dialog-centered\" role=\"document\">";
                            echo "<div class=\"modal-content\">";
                                echo "<div class=\"modal-header\">";
                                    echo "<h4 class=\"modal-title\">Comprar curso</h4>";
                                echo "</div>";
                                echo "<div class=\"modal-body\">";
                                    echo "Curso comprado con exito";
                                echo "</div>";
                                echo "<div class=\"modal-footer\">";
                                    echo "<button type=\"button\" class=\"btn btn-success\" data-dismiss=\"modal\">OK</button>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    
                
                    echo "<div class=\"bgimg-4\" style=\"background-image: url('uploads/$cursoMiniatura'); min-height: 400px;\">";
                    echo "<div class=\"container\" style=\" background-color: rgba(0, 0, 0, 0.705);\">";
                    echo "<div class=\"row\" style=\"padding-top: 8%; color: whitesmoke;\">";
                    echo "<div class=\"col-xl-8 col-sm-8 col-12\">";
                    echo "<div class=\"text-left \" style=\"padding-top:2%; \">";
                    
                   
                    echo "<h1 id=\"displayName\" class=\"subtitle-text\">$cursoNombre</h1>";
                    echo "<div class=\"form-group\"> 
                    <input type=\"text\" id=\"nameEdit\" class=\"form-control modify\" value=\"$cursoNombre\" style=\"display: none;\" required>  
                    </div>";
                    echo "</div>";
                    echo "<div class=\"text-left \" style=\"padding-top:2%; \">";
                    echo "<h4 id=\"displayDesc\" class=\"subtitle-text\">$cursoDescripcion</h4>";
                    echo "<div class=\"form-group\"> 
                    <input type=\"text\" id=\"descEdit\" class=\"form-control modify\" value=\"$cursoDescripcion\" style=\"display: none;\" required>  
                    </div>";
                    echo "</div>";
                    echo "<div class=\"text-left \" style=\"padding-top:20%;\">";
                    echo "<h6 class=\"subtitle-text\">$usuarioNombre<button onClick=\"window.location.href='http://localhost:8012/Acodemia/message.php?user=$usuarioIdResult';\" style=\"width: 10%; margin-left: 2%; margin-top: 0px;\" class=\"btn btn-secondary\"><i class=\"fas fa-envelope\"></i></button></h6>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class=\"col-12 col-sm-4\" ></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                    /*
                    delimiter &ZV
                    create procedure showNiveles(in p_cursoid int)
                    begin
                        select nivelId, nivelNumero, nivelNombre, nivelCosto, nivelContenido, nivelVideo, nivelPDF
                        from Curso where cursoId = p_cursoid;
                    end &ZV
                    */

                    /*******************************niveles************************************* */

                    echo "<div class=\"col-12\" style=\"padding-left: 10%; padding-right: 4%; \">";
                    echo "";
                    echo "<div class=\"row\" style=\"padding-bottom: 2%;\">";
                    echo "<div class=\"col-lg-12 col-12 text-left\" style=\"padding-top:2%; \">";
                    echo "";
                    echo "<h5 style=\"color: whitesmoke;\" class=\"subtitle-text\">Progreso del curso : 75%</h5>";
                    echo "";
                    echo "</div>";
                    echo "<div class=\"col-lg-6 col-12\">";
                    echo "<div class=\"progress\" style=\"z-index: 5px;\">";
                    echo "<div class=\"progress-bar progress-bar-striped progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"75\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 75%\"></div>";
                    echo "</div>";
                    echo "";
                    echo "<button type=\"button\" class=\"btn btn-primary\" style=\"margin-top: 10%; width: 30%;\" data-toggle=\"modal\" data-target=\"#ModalDip\" >Obtener diploma</button>";
                    echo "";
                    echo "</div>";
                    echo "";
                    echo "</div>";
                    echo "";
                    echo "<div class=\"row\" style=\"padding-bottom: 2%;\">";
                    echo "<div class=\"text-left \" style=\"padding-top:2%; \">";
                    echo "<h5 style=\"color: whitesmoke;\" class=\"subtitle-text\">Contenido del curso</h5>";
                    echo "</div>";
                    echo "</div>";
                    echo "";

                    /*
                        delimiter &ZV
                        create procedure showNiveles(in p_cursoid int)
                        begin
                            select nivelId, nivelNumero, nivelNombre, nivelCosto, nivelContenido, nivelVideo, nivelPDF
                            from Curso where cursoId = p_cursoid;
                        end &ZV 
                    */
  

                    $call =  $db->prepare('CALL showNiveles(:p_cursoid)');
                    $call->bindParam(':p_cursoid', $searchWord, PDO::PARAM_INT); 
                    
                    if($call->execute())
                    {
                        $nivelesCurso = $call->fetchAll(PDO::FETCH_ASSOC);
                        
                        if($nivelesCurso!=null)
                        {
                            foreach ($nivelesCurso as $niveles) 
                            { 
                                $nivelId= $niveles['nivelId'];
                                $nivelNumero= $niveles['nivelNumero'];
                                $nivelNombre= $niveles['nivelNombre'];
                                $nivelCosto= $niveles['nivelCosto'];
                                $nivelContenido= $niveles['nivelContenido'];
                                $nivelVideo= $niveles['nivelVideo'];
                                $nivelPDF= $niveles['nivelPDF'];

                            
            
                                if( $nivelCosto==0 || ($cursoComprado==1))
                                {
                                    echo "<!--Nivel gratis-->";
                                    echo "<div class=\"row\" style=\"color: black;\">";
                                    echo "";
                                    echo "<div class=\"col-lg-5 col-8 divName\" style=\" background-color: #80b5e2;\">";
                                    echo "<h4 class=\"nombreNivelDisplay\">$nivelNombre</h4>";
                                    echo "<h4 class=\"nivelIdComprado\" style=\"display: none;\">$nivelId</h4>";
                                    echo "</div>";
                                    echo "";
                                    echo "<div class=\"col-lg-1 col-4\" style=\"background-color: #80b5e2;\">";
                                    if(($userMail!=0))
                                    {
                                        echo "<button style=\"margin-top: 6%;\" type=\"button\" class=\"btn btn-primary VerMas\"><i class=\"fa fa-plus\"></i></button>";
                                    }                                    
                                    echo "</div>";
                                    echo "";
                                    echo "<div class=\"col-lg-5 col-8\"></div>";
                                    echo "";
                                    echo "<div class=\"col-lg-6 col-12\">";
                                    echo "<div class=\"DescripcionCurso\" style=\"background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;\" >";
                                    echo "<h5>$nivelContenido</h5>";
                                    echo "<br>";
                                    echo "<div>";
                                    echo "<h5>Costo del nivel: $<span class=\"precioIndividual\">$nivelCosto</span></h5>";
                                    echo "</div>";
                                    if($tipo==0)
                                    {
                                       echo "<a class=\"btn btn-primary btn-category\" href=\"http://localhost:8012/Acodemia/level.php?course=$searchWord&level=$nivelId\">Ir al nivel</a>";

                                    }
                                    echo "</div>";
                                    echo "</div>";
                                    echo "";
                                    echo "</div>";
                                    echo "";
                                }
                                else
                                {
            
                                    echo "<!--Nivel pago-->";
                                    echo "";
                                    echo "<div class=\"row\" style=\"color: black;\">";
                                    echo "";
                                    echo "<div class=\"col-lg-5 col-8 divName\" style=\" background-color: #80b5e2;\">";
                                    echo "<h4 class=\"nombreNivelDisplay\">$nivelNombre</h4>";
                                    echo "<h4 class=\"nivelIdComprado\" style=\"display: none;\">$nivelId</h4>";
                                    echo "</div>";
                                    echo "";
                                    echo "<div class=\"col-lg-1 col-4\" style=\"background-color: #80b5e2;\">";
                                    if(($userMail!=0))
                                    {
                                        echo "<button style=\"margin-top: 6%;\" type=\"button\" class=\"btn btn-primary VerMas\"><i class=\"fa fa-plus\"></i></button>";
                                    }
                                    echo "</div>";
                                    echo "";
                                    echo "<div class=\"col-lg-5 col-8\"></div>";
                                    echo "";
                                    echo "<div class=\"col-lg-6 col-12\">";
                                    echo "<div class=\"DescripcionCurso\" style=\"background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;\" >";
                                    echo "<h5>$nivelContenido</h5>";
                                    echo "<br>";
                                    echo "<div>";
                                    echo "<h5>Costo del nivel: $<span class=\"precioIndividual\">$nivelCosto</span></h5>";
                                    echo "</div>";

                                    /*delimiter &ZV
                                    create procedure compraNivelVerificar(in p_user int, in p_nivel int)
                                    begin
                                        select count(ventaNivelId) from Ventas_nivel where usuarioId = p_user and nivelId = p_nivel;
                                    end &ZV
                                    */

                                    
                                    $call =  $db->prepare('CALL compraNivelVerificar(:p_user, :p_nivel)');
                                    $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
                                    $call->bindParam(':p_nivel', $nivelId, PDO::PARAM_INT);

                                    if($call->execute())
                                    {
                                        $comentariosCurso = $call->fetchAll(PDO::FETCH_ASSOC);
                                        
                                        if($comentariosCurso!=null)
                                        {
                                            foreach ($comentariosCurso as $comentarios) 
                                            { 

                                                $existe= $comentarios['count(ventaNivelId)'];

                                                if($tipo==0)
                                                {
                                                    if($existe==0)
                                                    {
                                                        echo "<button type=\"button\" class=\"btn btn-primary btn-category btnNivel btnComprar\" data-toggle=\"modal\" data-target=\"#ModalPay\" >Comprar este nivel</button>";
                                                    }
                                                    else
                                                    {
                                                        echo "<a class=\"btn btn-primary btn-category\" href=\"http://localhost:8012/Acodemia/level.php?course=$searchWord&level=$nivelId\">Ir al nivel</a>";
    
                                                    }
                                                }
                                               
                                                                                                                       
                                            } 
                                        }
                                    }

                                    echo "</div>";
                                    echo "</div>";
                                    echo "";
                                    echo "</div>";
                                    echo "";
                                }

                                                            
                            } 
                        }
                    }
       

               
        


                    /*
                    NIVEL YA COMPRADO
                    echo "<!--Nivel-->";
                    echo "";
                    echo "<div class=\"row\" style=\"color: black;\">";
                    echo "";
                    echo "<div class=\"col-lg-5 col-8\" style=\" background-color: #80b5e2;\">";
                    echo "<h4>";
                    echo "Nivel 3";
                    echo "</h4>";
                    echo "</div>";
                    echo "";
                    echo "<div class=\"col-lg-1 col-4\" style=\"background-color: #80b5e2;\">";
                    echo "<button style=\"margin-top: 6%;\" type=\"button\" class=\"btn btn-primary VerMas\"><i class=\"fa fa-plus\"></i></button>";
                    echo "</div>";
                    echo "";
                    echo "<div class=\"col-lg-5 col-8\">";
                    echo "";
                    echo "</div>";
                    echo "";
                    echo "<div class=\"col-lg-6 col-12\">";
                    echo "<div class=\"DescripcionCurso\" style=\"background-color: #b8d2e5; display: none; padding:2%; margin-bottom: 2%;\" >";
                    echo "<h5>Descripcion del nivel 3</h5>";
                    echo "<br>";
                    echo "<button type=\"button\" onClick=\"window.location.href='http://localhost:8012/Acodemia/level.php';\" class=\"btn btn-primary btn-category\" >Ir al nivel</button>";
                    echo "";
                    echo "</div>";
                    echo "</div>";
                    echo "";
                    echo "</div>";
                    echo "";
                    echo "";*/

                    echo "<!--Comentarios-->";
                    echo "";
                    echo "<div class=\"row\">";
                    echo "<div class=\"col-12 col-lg-6\">";
                    echo "<hr style=\"border: 2px solid #b8d2e5; border-radius: 5px;\">";
                    echo "";
                    echo "";
                    echo "<div class=\"row\" style=\"padding-bottom: 2%;\">";
                    echo "<div class=\"text-left \" style=\"padding-top:2%; \">";
                    echo "<h5 style=\"color: whitesmoke;\" class=\"subtitle-text\">Comentarios</h5>";
                    echo "</div>";
                    echo "</div>";
                    echo "";

                    echo "<!--Escribir comentario-->";
                    echo "<div class=\"container\">";

                    /*
                    delimiter &ZV
                    create procedure cursoTerminado(in p_user int, in p_curso int)
                    begin
                        select historialCursoConcluido from Historial_curso where usuarioId = p_user and cursoId = p_curso;
                    end &ZV */

              
                    $call =  $db->prepare('CALL cursoTerminado(:p_user, :p_curso)');
                    $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
                    $call->bindParam(':p_curso', $searchWord, PDO::PARAM_INT); 
                    
                    if($call->execute())
                    {
                        $nivelesCurso = $call->fetchAll(PDO::FETCH_ASSOC);
                        
                        if($nivelesCurso!=null)
                        {
                          
                              /*delimiter &ZV
                            create procedure comentarioHecho(in p_user int, in p_curso int)
                            begin
                                select count(comentarioId) from Comentario where usuarioId = p_user and cursoId = p_curso;
                            end &ZV
                            */

                            $call =  $db->prepare('CALL comentarioHecho(:p_user, :p_curso)');
                            $call->bindParam(':p_user', $userId, PDO::PARAM_INT); 
                            $call->bindParam(':p_curso', $searchWord, PDO::PARAM_INT); 

                            if($call->execute())
                            {
                                $result = $call->fetchAll(PDO::FETCH_ASSOC);
                                if($result!=null)
                                {
                                    foreach ($result as $comment) 
                                    { 
                                        $comentarios= $comment['count(comentarioId)'];
                                        //print_r($comentarios);

                                        if(($comentarios==0)&&($userMail!=0))
                                        {
                                            echo "<div class=\"row\" id=\"ponerComentario\">";
                                                echo "<h6 style=\"color: whitesmoke;\">Escribe un comentario</h6>";
                                                echo "<div class=\"col-md-12 col-sm-12\">";
                                                    echo "<div class=\"comment-wrapper\">";
                                                        echo "<div class=\"panel panel-info\">";
                                                            echo "<div class=\"panel-body\">";
                                                                echo "<textarea class=\"form-control\" id=\"commentArea\" placeholder=\"write a comment...\" rows=\"3\"></textarea>";
                                                                echo "<br>";
                                                                echo "<h6 style=\"color: whitesmoke;\">Deja una calificacion</h6>";

                                                                echo "<div class='rating-stars text-center'>";
                                                                echo "<ul id='stars'>";
                                                                echo "<li class='star' title='Poor' data-value='1'>";
                                                                echo "<i class='fa fa-star fa-fw'></i>";
                                                                echo "</li>";
                                                                echo "<li class='star' title='Fair' data-value='2'>";
                                                                echo "<i class='fa fa-star fa-fw'></i>";
                                                                echo "</li>";
                                                                echo "<li class='star' title='Good' data-value='3'>";
                                                                echo "<i class='fa fa-star fa-fw'></i>";
                                                                echo "</li>";
                                                                echo "<li class='star' title='Excellent' data-value='4'>";
                                                                echo "<i class='fa fa-star fa-fw'></i>";
                                                                echo "</li>";
                                                                echo "<li class='star' title='WOW!!!' data-value='5'>";
                                                                echo "<i class='fa fa-star fa-fw'></i>";
                                                                echo "</li>";
                                                                echo "</ul>";
                                                                echo "</div>";
                                                                

                                                                echo "<button type=\"button\" id=\"btnComment\" style=\"width: 30%;\" class=\"btn btn-primary pull-right\">Post</button>";
                                                                echo "<div class=\"clearfix\"></div>";
                                                                echo "<hr style=\"border: 2px solid #b8d2e5; border-radius: 5px;\">";
                                                                echo "";
                                                                echo "</div>";
                                                            echo "</div>";
                                                        echo "</div>";
                                                    echo "</div>";
                                                echo "</div>";
                                            echo "<div class=\"row\" id=\"commentSection\">";
                                        }
                                    }
                                }
                                            
                            }
                        }
                    }


                    /*
                    delimiter &ZV
                    create procedure showComentarios(in p_cursoid int)
                    begin
                        select c.comentarioId, c.comentarioContenido, c.comentarioCalificacion, u.usuarioNombre
                        from Comentario as c inner join Usuario as u on c.usuarioId = u.usuarioId
                        where c.cursoId = p_cursoid;
                    end &ZV*/

                    $call =  $db->prepare('CALL showComentarios(:p_cursoid)');
                    $call->bindParam(':p_cursoid', $searchWord, PDO::PARAM_INT); 

                    if($call->execute())
                    {
                        $comentariosCurso = $call->fetchAll(PDO::FETCH_ASSOC);
                        
                        if($comentariosCurso!=null)
                        {
                            foreach ($comentariosCurso as $comentarios) 
                            { 

                                $comentarioId= $comentarios['comentarioId'];
                                $comentarioContenido= $comentarios['comentarioContenido'];
                                $comentarioCalificacion= $comentarios['comentarioCalificacion'];
                                $usuarioNombre= $comentarios['usuarioNombre'];
                        
                                echo "<!-- COMMENT 1 - START -->";
                                echo "<div class=\"container\">";
                                    echo "<div class=\"row\">";
                                        echo "<div class=\"col-xl-12\">";
                                            echo "<div class=\"blog-comment\">";
                                                echo "<ul class=\"comments\">";
                                                    echo "<li class=\"clearfix\">";
                                                        echo "<div class=\"post-comments\" style=\"padding-left:2%\">";
                                                            echo "<p > <a> $usuarioNombre</a>: <i class=\"pull-right\"></i></p>";
                                                            echo "<p>$comentarioContenido</p>";
                                                        echo "</div>";
                                                     echo "</li>";
                                                echo "</ul>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                                echo "<!-- COMMENT 1 - END -->";
                                                           
                            } 
                        }
                    }
                    else
                    {
                    
                    }




                    echo "</div>";
                    echo "";
                    echo "</div>";
                    echo "";

 

                    echo "";
                    echo "</div>";
                    echo "";
                    echo "</div>";
                    echo "";
                    echo "</div>";

                   
                }
                else
                {
                    http_response_code(404);
                }



     
               
            }
        }
        else
        {
        
            http_response_code(404);
           
           
        }
    
         return true;
    }
    else
    {
        return false;
    }


?>


