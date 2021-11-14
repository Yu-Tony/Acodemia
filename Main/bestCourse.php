<?php

require_once '../api/config/database.php'; 
    
$data = json_decode(file_get_contents("php://input"));


$database = new Database();
$db = $database->getConnection();

$call = 'call topRated()';
    
// prepare
$stmt = $db->prepare($call);


// execute

if($stmt->execute())
{
    $busqueda = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if($busqueda!=null)
    {
        foreach ($busqueda as $result) 
        {}
    }
			
}


/*
echo "<div class=\"carousel-item active\">";
echo "<!--Card-->";
echo "<div class=\"cards-wrapper\">";
echo "<!--card1-->";
echo "<div class=\"card carousel\">";
echo "<img src=\"https://i.ytimg.com/vi/rbuYtrNUxg4/maxresdefault.jpg\" class=\"card-img-top\" alt=\"...\">";
echo "<div class=\"card-body\">";
echo "<a href=\"course.php\">";
echo "<h5 class=\"font-weight-normal\">Desarrollo Web Completo con HTML5</h5>";
echo "</a>";
echo "<div class=\"post-meta\"><span class=\"small lh-120\">Aprende Desarrollo Web con este curso 100% práctico,";
echo "<br>";
echo "paso a paso y sin conocimientos previos</span></div>";
echo "<div class=\"d-flex my-4\">";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i></div>";
echo "<div class=\"d-flex justify-content-between\">";
echo "<div class=\"col pl-0\"><span class=\"text-muted font-small d-block mb-2\">Precio</span> <span class=\"h5 text-dark font-weight-bold\">$800.00</span></div>";
echo "<div class=\"col pr-0\"><span class=\"text-muted font-small d-block mb-2\">Niveles</span> <span class=\"h5 text-dark font-weight-bold\">3</span></div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "<!--card2-->";
echo "<div class=\"card carousel d-none d-md-block\">";
echo "<img src=\"Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg\" class=\"card-img-top\" alt=\"...\">";
echo "<div class=\"card-body\">";
echo "<a href=\"#\">";
echo "<h5 class=\"font-weight-normal\">Titulo del curso 2</h5>";
echo "</a>";
echo "<div class=\"post-meta\"><span class=\"small lh-120\">Breve descripcion del lo que se trata el curso</span></div>";
echo "<div class=\"d-flex my-4\">";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i></div>";
echo "<div class=\"d-flex justify-content-between\">";
echo "<div class=\"col pl-0\"><span class=\"text-muted font-small d-block mb-2\">Precio</span> <span class=\"h5 text-dark font-weight-bold\">$300.00</span></div>";
echo "<div class=\"col pr-0\"><span class=\"text-muted font-small d-block mb-2\">Niveles</span> <span class=\"h5 text-dark font-weight-bold\">8</span></div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "<!--card3-->";
echo "<div class=\"card carousel d-none d-md-block\">";
echo "<img src=\"Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg\" class=\"card-img-top\" alt=\"...\">";
echo "<div class=\"card-body\">";
echo "<a href=\"#\">";
echo "<h5 class=\"font-weight-normal\">Titulo del curso 3</h5>";
echo "</a>";
echo "<div class=\"post-meta\"><span class=\"small lh-120\">Breve descripcion del lo que se trata el curso</span></div>";
echo "<div class=\"d-flex my-4\">";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-secondary\"></i></div>";
echo "<div class=\"d-flex justify-content-between\">";
echo "<div class=\"col pl-0\"><span class=\"text-muted font-small d-block mb-2\">Precio</span> <span class=\"h5 text-dark font-weight-bold\">$300.00</span></div>";
echo "<div class=\"col pr-0\"><span class=\"text-muted font-small d-block mb-2\">Niveles</span> <span class=\"h5 text-dark font-weight-bold\">8</span></div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "";
echo "</div>";
echo "</div>";
echo "";
echo "<div class=\"carousel-item\">";
echo "<!--Card-->";
echo "<div class=\"cards-wrapper\">";
echo "<!--card4-->";
echo "<div class=\"card carousel\">";
echo "<img src=\"Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg\" class=\"card-img-top\" alt=\"...\">";
echo "<div class=\"card-body\">";
echo "<a href=\"#\">";
echo "<h5 class=\"font-weight-normal\">Titulo del curso 4</h5>";
echo "</a>";
echo "<div class=\"post-meta\"><span class=\"small lh-120\">Breve descripcion del lo que se trata el curso</span></div>";
echo "<div class=\"d-flex my-4\">";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i></div>";
echo "<div class=\"d-flex justify-content-between\">";
echo "<div class=\"col pl-0\"><span class=\"text-muted font-small d-block mb-2\">Precio</span> <span class=\"h5 text-dark font-weight-bold\">$300.00</span></div>";
echo "<div class=\"col pr-0\"><span class=\"text-muted font-small d-block mb-2\">Niveles</span> <span class=\"h5 text-dark font-weight-bold\">8</span></div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "<!--card5-->";
echo "<div class=\"card carousel d-none d-md-block\">";
echo "<img src=\"Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg\" class=\"card-img-top\" alt=\"...\">";
echo "<div class=\"card-body\">";
echo "<a href=\"#\">";
echo "<h5 class=\"font-weight-normal\">Titulo del curso 5</h5>";
echo "</a>";
echo "<div class=\"post-meta\"><span class=\"small lh-120\">Breve descripcion del lo que se trata el curso</span></div>";
echo "<div class=\"d-flex my-4\">";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i></div>";
echo "<div class=\"d-flex justify-content-between\">";
echo "<div class=\"col pl-0\"><span class=\"text-muted font-small d-block mb-2\">Precio</span> <span class=\"h5 text-dark font-weight-bold\">$300.00</span></div>";
echo "<div class=\"col pr-0\"><span class=\"text-muted font-small d-block mb-2\">Niveles</span> <span class=\"h5 text-dark font-weight-bold\">8</span></div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "<!--card6-->";
echo "<div class=\"card carousel d-none d-md-block\">";
echo "<img src=\"Media/reza-namdari-ZgZsKFnSbEA-unsplash.jpg\" class=\"card-img-top\" alt=\"...\">";
echo "<div class=\"card-body\">";
echo "<a href=\"#\">";
echo "<h5 class=\"font-weight-normal\">Titulo del curso 6</h5>";
echo "</a>";
echo "<div class=\"post-meta\"><span class=\"small lh-120\">Breve descripcion del lo que se trata el curso</span></div>";
echo "<div class=\"d-flex my-4\">";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i>";
echo "<i class=\"star fas fa-star text-warning\"></i></div>";
echo "<div class=\"d-flex justify-content-between\">";
echo "<div class=\"col pl-0\"><span class=\"text-muted font-small d-block mb-2\">Precio</span> <span class=\"h5 text-dark font-weight-bold\">$300.00</span></div>";
echo "<div class=\"col pr-0\"><span class=\"text-muted font-small d-block mb-2\">Niveles</span> <span class=\"h5 text-dark font-weight-bold\">8</span></div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";*/

?>