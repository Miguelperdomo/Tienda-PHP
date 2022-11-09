<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../tabla_usuarios/styleeli.css">
	<link rel="icon" href="../img/principal-removebg-preview.png">
    <title>Super Tienda</title>
</head>
<body>
<?php
	
	$busca=$_GET["id"];

 
try{
$base=new PDO("mysql:host=localhost;dbname=supertienda", "root", "");//pdo es la clase
$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//muestra el tipo de error
$base->exec("set character set utf8");
//echo "Conexión exitosa";
$sql="SELECT  * from roles  where id_rol=:co";//consulta con marcador, el marcador es :codigo

$resultado=$base->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
$resultado->execute(array(":co"=>$busca));

	if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
		
		?>
		<form action="validareliminar.php" method="get">

		<h4 class="titulo1">¿Seguro quieres Eliminar esta fila?</h4>

		<table border="2" class="principal">
			
            <tr>
			 	<th class="ti"> Id rol </th>
				<td class="titulo">
					<input type="text"  class="in" readonly name="idrol" value="<?php echo $registro['id_rol']?>">
				</td>
			</tr>
			
            <tr>
				<th class="ti"> Nombre del Rol </th>
				<td class="titulo">
					<input type="text"  class="in" name="nom" value="<?php echo $registro['nombre_rol']?>">
				</td>
			</tr>
            <tr>
				<td colspan="2" align="center">
					<input class="enviar" type="submit" name="elimina" id="elimina" value="Eliminar">
				</td>
			</tr>
			
			
		</table>
	</form>

<?php
	}else{
		echo "No existe cliente con cédula $busca";
	}

	



$resultado->closeCursor();

}catch(Exception $e){
	die("Error: ". $e->GetMessage());

}finally{
	$base=null;//vaciar memoria
}


?>

</form>
</body>
</html>