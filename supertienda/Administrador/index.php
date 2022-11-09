
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
	<link rel="stylesheet" href="Administrador/style.css">
	<title>Super Tienda</title>
</head>

<header class="header">
    <div class="container imagen-nav-container">
		<a href="#" class="imagen"><img src="img/admi-removebg-preview.png"></a>
        <nav class="navigation">
            <ul>
                <li><a href="Administrador/cerrar.php">Cerrar Sesion</a></li>
			</ul>	
				<p>Bienvenido<br><?php echo $registro['nombre_usua'];?><br>Administrador</p>
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
			<img src="img/productos.png"><a href="tabla_productos/index.php?id=<?php echo $id;?> & nomb=<?php echo $nombre?>" target=_blank><input class="boton" type="submit" name="iest" value="Ingresar">
			<p><h3>Productos</h3></p>
		</div>
		<div class="caja2">
			<img src="img/usua.png"><a href="tabla_usuario/index.php?id=<?php echo $id;?> & nomb=<?php echo $nombre?>" target=_blank><input class="boton1" type="submit" name="imate" value="Ingresar">
			<p><h3>Ver Usuarios</h3></p>
		</div>
		<div class="caja3">
			<img src="img/provedor.png"><a href="tabla_provedores/index.php?id=<?php echo $id;?> & nomb=<?php echo $nombre?>" target=_blank><input class="boton2" type="submit" name="imatri" value="Ingresar">
			<p><h3>Ver Provedores </h3></p>
		</div>
		<div class="caja4">
			<img src="img/cliente.png"><a href="tabla_clientes/index.php?id=<?php echo $id;?> & nomb=<?php echo $nombre?>" target=_blank><input class="boton3" type="button" name="usario" value="Ingresar">
			<p><h3>Clientes </h3></p>
		</div>
		<div class="caja5">
			<img src="img/matricular_ja-removebg-preview.png"><a href="verfactura/verfactura.php?id=<?php echo $docu;?> & nombaux=<?php echo $nombre?>" target=_blank><input class="boton4" type="submit" name="imatri" value="Ingresar">
			<p><h3>Ver Facturas</h3></p>
		</div>
		<div class="caja6">
			<img src="img/roles.png"><a href="tabla_roles/index.php?id=<?php echo $docu;?> & nombaux=<?php echo $nombre?>" target=_blank><input class="boton4" type="submit" name="imatri" value="Ingresar">
			<p><h3>Ver roles</h3></p>
		</div>
		
	
	
	</div>



</body>
</html>