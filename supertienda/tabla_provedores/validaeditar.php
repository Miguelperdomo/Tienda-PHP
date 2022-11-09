<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/principal-removebg-preview.png">
	<link rel="stylesheet" href="../css/editar.css">
    <title>Super Tienda</title>
</head>
<body>
<?php
require("../conexion/conexion.php");

    

    $nit=                        $_GET["nit"];
    $nombre=                      $_GET["nom"];
    $telefono=                    $_GET["tele"];
    $direccion=                    $_GET["dir"];
   

try{
$sql="UPDATE provedor SET  nombre=:nom, telefono=:tel, direccion=:dirr   WHERE nit=:nit";
$resultado=$base->prepare($sql);  //$base guarda la conexión a la base de datos
$resultado->execute(array(":nit"=>$nit,":nom"=>$nombre,":tel"=>$telefono, ":dirr"=>$direccion));//asigno las variables a los marcadores
echo '<script>alert("Haz actualizado nuestra Base de Datos, Yuju!");</script>';
echo '<script>window.location= "index.php"</script>';

 



$resultado->closeCursor();
}catch(Exception $e){
	//die("Error: ". $e->GetMessage());
 	echo "Ya existe la cédula " . $codigo;
}finally{
	$base=null;//vaciar memoria
}


?>
</body>
</html>