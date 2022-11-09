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
$sql="SELECT  * from productos  where codigo_producto=:co";//consulta con marcador, el marcador es :codigo

$resultado=$base->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
$resultado->execute(array(":co"=>$busca));

	if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
		
		?>
		<form action="./validaeliminar.php" method="get">

		<h4 class="titulo1">¿Seguro quieres Eliminar esta fila?</h4>

		<table border="2" class="principal">
			
            <tr>
			 	<th class="ti"> Codigo de Producto </th>
				<td class="titulo">
					<input type="text"  class="in" readonly name="cod" value="<?php echo $registro['codigo_producto']?>">
				</td>
			</tr>
			
            <tr>
				<th class="ti"> Nombre del Producto </th>
				<td class="titulo">
					<input type="text"  class="in" name="nom" value="<?php echo $registro['nombre_producto']?>">
				</td>
			</tr>
			
            <tr>
				<th class="ti"> Precio</th>
				<td class="titulo">
					<input type="text"  class="in" name="pre" value="<?php echo $registro['precio']?>">
				</td>
			</tr>
            
            <tr>
				<th class="ti">Existencia</th>
				<td class="titulo">
					<input type="text"  class="in" name="exis" value="<?php echo $registro['existencia']?>">
				</td>
			</tr>
						
            <tr>
				<th class="ti">Fecha</th>
				<td class="titulo">
					<input type="text"  class="in" name="fech" value="<?php echo $registro['fecha']?>">
				</td>
			</tr>

            <tr>
				<th class="ti"> nit </th>
				<td class="titulo">
					<input type="text"  class="in" name="nit"  value="<?php echo $registro['nit']?>">
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