<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="icon" href="img/principal-removebg-preview.png">
    <link rel="stylesheet" href="CSS/index2.css">
    <title>Super Tienda</title>
</head>
<body onload="form1.documento.focus()">
    <form method="post" action="comprobacion.php" name="form1" id="formulario" autocomplete="off">
        <div class="contenedor">
            <img src="img/indepri.gif" class="imagen" ><br>
            <h1 class="titulo"> Error a Iniciar Sesión </h1>
            <label for="documento" class="titulo1">Documento:<br><input class="login" type="number" name="documento" id="documento" placeholder="Ingrese su Documento"></label><br>
            <label for="contraseña" class="titulo1">Contraseña: <br><input class="login" type="password" name="clave" id="clave" placeholder="Ingrese su Contraseña"></label><br><br>
            <input class="boton" type="submit" name="Enviar" value="Iniciar Sesión"><br><br>
            <a href="#" class="olvide">¿Has Olvidado tu Contraseña?</a>
        </div>
    </form> 
    
    
</body>
</html>