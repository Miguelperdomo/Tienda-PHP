
<!DOCTYPE html>
<html>  
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="icon" href="img/principal-removebg-preview.png">
	<link rel="stylesheet" href="Vendedor/style.css">
	<title>Super Tienda</title>
</head>

<header class="header">
    <div class="container imagen-nav-container">
		<a href="#" class="imagen"><img src="img/auditor-removebg-preview.png"></a>
        <nav class="navigation">
            <ul>
                <li><a href="Administrador/cerrar.php">Cerrar Sesion</a></li>
			</ul>	
				<p>Bienvenido<br><?php echo $registro['nombre_usua'];?><br>Auditor</p>
        </nav>                   
	</div>  

</div>
</header>           
<body>
	
	<div class="texto">
		<h2><?php include ("fecha.php"); echo fechas();?> </h2>
	</div>
	<div class="contenedor">
		<div class="caja1">
			<img src="img/Fcatura_auditorio.png"><a href="Auditores/inventario.php?id=<?php echo $docu;?> & nombaux=<?php echo $nombre?>" target=_blank><input class="boton" type="submit" name="iest" value="Ingresar">
			<p><h3>Ver las Facturas</h3></p>
		</div>
	
	</div>



</body>
</html>