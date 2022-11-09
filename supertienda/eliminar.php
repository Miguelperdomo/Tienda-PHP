<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/eliminar.css">
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
$sql="SELECT  * from usuario  where id_usuario=:co";//consulta con marcador, el marcador es :codigo

$resultado=$base->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
$resultado->execute(array(":co"=>$busca));

	if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
		
		?>
		<form action="validar_eliminar.php" method="get">

		<h4>ELIMINAR</h4>

		<table>
			
            <tr>
			 	<th>Identificacion</th>
				<td>
					<input type="text" readonly name="id" value="<?php echo $registro['id_usuario']?>">
				</td>
			</tr>
			
            <tr>
				<th>Tipo</th>
				<td>
					<input type="text"  name="tipo" value="<?php echo $registro['id_rol']?>">
				</td>
			</tr>
			
            <tr>
				<th>Nombre</th>
				<td>
					<input type="text"  name="nom" value="<?php echo $registro['nombre_usua']?>">
				</td>
			</tr>
            
            <tr>
				<th>Apellido</th>
				<td>
					<input type="text"  name="corr" value="<?php echo $registro['correo']?>">
				</td>
			</tr>
						
            <tr>
				<th>Usuario</th>
				<td>
					<input type="text"  name="usu" value="<?php echo $registro['usuario']?>">
				</td>
			</tr>

            <tr>
				<th>Contraseña</th>
				<td>
					<input type="text" name="contraseña"  value="<?php echo $registro['clave']?>">
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