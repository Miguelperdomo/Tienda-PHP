<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/editar.css">
    <title>Super Tienda</title>
</head>
<body>
<?php
require("conexion/conexion.php");

    

    $id=                        $_GET["id"];
    $nombre=                    $_GET["nom"];
    $correo=                  $_GET["corr"];
    $usuario=                   $_GET["usu"];
  
try{
$sql="UPDATE usuario SET  nombre_usua=:no, correo=:cor, usuario=:us   WHERE id_usuario=:id";
$resultado=$base->prepare($sql);  //$base guarda la conexión a la base de datos
$resultado->execute(array(":id"=>$id, ":no"=>$nombre, ":cor"=>$correo, ":us"=>$usuario));//asigno las variables a los marcadores
echo '<script>alert("Yuju, Se han guardado los cambios Correctamente, Gracias");</script>';
echo '<script>window.location="crud.php"</script>';





$resultado->closeCursor();
}catch(Exception $e){
	//die("Error: ". $e->GetMessage());
 	echo "Ya existe la cédula " . $id;
}finally{
	$base=null;//vaciar memoria
}


?>
</body>
</html>