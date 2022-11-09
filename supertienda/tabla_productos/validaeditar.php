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

    
    $codigo=                        $_GET["id"];
    $codigo1=                        $_GET["cod"];
    $nombre=                      $_GET["nom"];
    $precio=                    $_GET["pre"];
    $existencia=                    $_GET["exis"];
    $nuevaexis=                    $_GET["nuevaexis"];
    $exis = $existencia + $nuevaexis;

   

try{
$sql="UPDATE productos SET codigo_producto=:cod, nombre_producto=:nom, precio=:pre, existencia=:exi   WHERE id=:ir";
$resultado=$base->prepare($sql);  //$base guarda la conexión a la base de datos
$resultado->execute(array(":ir"=>$codigo, ":cod"=>$codigo1,":nom"=>$nombre,":pre"=>$precio, ":exi"=>$exis));//asigno las variables a los marcadores
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