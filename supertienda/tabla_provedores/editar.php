<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/principal-removebg-preview.png">
	<link rel="stylesheet" href="../tabla_usuarios/styleedita.css">
    <title> Super Tienda</title>
</head>
<body>
<?php
	 
	$busca=$_GET["id"];


try{
$base=new PDO("mysql:host=localhost;dbname=supertienda", "root", "");//pdo es la clase
$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//muestra el tipo de error
$base->exec("set character set utf8");
//echo "Conexión exitosa";
$sql="SELECT  * from provedor where nit=:id";//consulta con marcador, el marcador es :codigo

$resultado=$base->prepare($sql);//el objeto $base llama al metodo prepare que recibe por parametro la instrucción sql, el metodo prepare devuelve un objeto de tipo PDO que se almacena en la variable resultado
$resultado->execute(array(":id"=>$busca));

	if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
		
		?>
		<form action="validaeditar.php" method="get">

		<h4 class="titulo1">¿Vas a Actualizar esta Fila?</h4>

		<table border="2" class="principal">
			
            <tr>
			 	<th class="ti">Nit</th>
				<td  class="titulo">
					<input type="text" class="in" readonly name="nit" value="<?php echo $registro['nit']?>">
				</td>
			</tr>
			
            <tr>
				<th class="ti">Nombre Provedor</th>
				<td  class="titulo">
					<input type="text" class="in" name="nom" value="<?php echo $registro['nombre']?>">
				</td>
			</tr>
			
            <tr>
				<th class="ti">Telefono</th>
				<td  class="titulo">
					<input type="text" class="in" name="tele" value="<?php echo $registro['telefono']?>">
				</td>
			</tr>
            
            <tr>
				<th class="ti">Direccion</th>
				<td  class="titulo">
					<input type="text" class="in" name="dir" value="<?php echo $registro['direccion']?>">
				</td>
			</tr>
            <tr>
				<td colspan="2" align="center">
					<input class="enviar" type="submit" name="edita" id="ingresa" value="Guardar">
				</td>
			</tr>
			
			
		</table>
	</form>

<?php
	}else{
		echo "No existe usuario con cédula $busca";
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