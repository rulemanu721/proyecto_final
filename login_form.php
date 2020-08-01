<?php

include 'dbtext.php';
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sesiones</title>

    <link rel="stylesheet" href="main.css">
</head>

<body>
    <form action="" method="POST">
        <?php

            if(isset($errorLogin)){
                echo $errorLogin;
            }

       ?>
        <h2 class="text-center text-white pt-5 ">Iniciar sesión</h2>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                    <h3 class="text-center text-info"><img src= "/img/w.jpeg" ></h3>
                        <p class="text-info">Nombre de usuario: <br>
                            <input class="form-control" type="text" name="username"></p>
                        <p class="text-info" class="Password">Password: <br>
                            <input class="form-control" type="password" name="password"></p>
                        <p class="center"><input class="btn btn-info btn-md" type="submit" value="Iniciar Sesión"></p>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>