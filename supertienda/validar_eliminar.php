<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php
require("conexion/conexion.php");

$guardar =$_GET["elimina"];

$id=                        $_GET["id"];
try{
$sql="DELETE FROM usuario WHERE id_usuario=:id";
$resultado=$base->prepare($sql);  //$base guarda la conexión a la base de datos
$resultado->execute(array(":id"=>$id,));//asigno las variables a los marcadores
echo '<script>alert(Uju, Eliminaste una fila de tu base de datos");</script>';
echo '<script>window.location="crud.php"</script>';
$resultado->closeCursor();

}
catch(Exception $e){
	//die("Error: ". $e->GetMessage());
 	echo "F" . $id;
}
finally{
	$base=null;//vaciar memoria
}
?>
</body>
</html>