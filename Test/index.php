<?php

/*print_r($_POST);
print_r($_FILES);*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


	<script>
//https://stackoverflow.com/questions/10899384/uploading-both-data-and-files-in-one-form-using-ajax
		$(document).on('submit', '#data', function()
{
			//e.preventDefault();    
			//alert("hola");
			var formData = new FormData(this);


			$.ajax({
				url: "testNav.php",
				type: 'POST',
				data: formData,
				success: function (data) {
					alert(data);
				},
				cache: false,
				contentType: false,
				processData: false
			});
		});
	</script>
</head>
<body>

<form id="data" method="post" enctype="multipart/form-data">
    <input type="text" name="first" value="Bob" />
    <input type="text" name="middle" value="James" />
    <input type="text" name="last" value="Smith" />
    <input name="imageOne" type="file" />
	<input name="imageTwo" type="file" />
    <button>Submit</button>
</form>
</body>
</html>

