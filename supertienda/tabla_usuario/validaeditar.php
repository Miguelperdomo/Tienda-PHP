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

    

    $documento=                        $_GET["doc"];
    $nombre=                      $_GET["nom"];
    $correo=                    $_GET["corr"];
    $usuario=                    $_GET["usu"];
    $clave=                    $_GET["cla"];
    $rol=                    $_GET["rol"];
    $pass_cifrado=password_hash($clave,PASSWORD_DEFAULT,array("cost"=>12));
   

try{
$sql="UPDATE usuario SET  nombre_usua=:nom, correo=:co, usuario=:us, clave=:cla, id_rol=:ro  WHERE id_usuario=:id";
$resultado=$base->prepare($sql);  //$base guarda la conexión a la base de datos
$resultado->execute(array(":id"=>$documento,":nom"=>$nombre,":co"=>$correo, ":us"=>$usuario, ":cla"=>$pass_cifrado, ":ro"=>$rol ));//asigno las variables a los marcadores
echo '<script>alert("Haz actualizado nuestra Base de Datos, Yuju!");</script>';
echo '<script>window.location= "index.php"</script>';

 



$resultado->closeCursor();
}catch(Exception $e){
	//die("Error: ". $e->GetMessage());
 	echo "Ya existe la cédula " . $documento;
}finally{
	$base=null;//vaciar memoria
}


?>
</body>
</html>