<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        .form-control {
            border: 0;
            outline: 0;
            border-bottom: 2px solid #eee;
            font-size: 16px;
            color: #ccc;
            background-color: transparent
        }

        .form-control:focus {
            border: 0;
            color: #fff;
            background-color: transparent;
            border-color: #fff;
            outline: 0;
            border-bottom: 2px solid #fff;
            box-shadow: 0 0 0 0.2rem transparent
        }
        
    </style>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="background-color: purple;">
<div class="container my-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="form-group"> <input type="text" id="name" class="form-control" required> <label class="form-control-placeholder" for="name"></label> </div>
            <div class="form-group"> <input type="text" id="name" class="form-control" required> <label class="form-control-placeholder" for="name"></label> </div>
            <div class="form-group"> <input type="text" id="password" class="form-control" required> <label class="form-control-placeholder" for="password"></label> </div>
            <div class="form-group"> <input type="text" id="password" class="form-control" required> <label class="form-control-placeholder" for="password"></label> </div>
        </div>
    </div>
</div>
</body>
</html>