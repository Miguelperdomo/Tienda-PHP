<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styileindex.css">
	<link rel="icon" href="../img/principal-removebg-preview.png">
	<title>Factura</title>
</head>

<body  onload="form1.ide.focus()">
	
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" name="form1" method="get">
	<div  class="todo">
<?php
if(!isset($_GET["buscar"])){
 $idu=$_GET['id'];
 $auxiliar=$_GET['nombaux'];

 }else{
 $idu=$_GET['id'];
 $auxiliar=$_GET['nombaux'];

}

include("../conexion/conexion.php");

 ?>
	<div class="logotipo">
        <img src="../img/factura1.png">
    </div>

	<div class="tabla">
		<tr>
			<td>Usted ingeso el
				<?php include ("fecha.php"); echo fechas();?>
			</td>
			
		</tr>
</div>

	<input type="hidden" name="id" value="<?php echo $idu?>">
	<input type="hidden" name="nombaux" value="<?php echo $auxiliar?>">
	
	
	<h3>FACTURA</h3>
    <h3>Usuario:<br>
		<?php echo $auxiliar?>
	</h3>
	<table class="tabla1">
		
		<tr>
			<td class="dat">
				<h3>Datos del Cliente</h3>
			</td>
		</tr>
		<tr>
			<td class="tos">
				Indentificación:
				<input type="text" class="iput1" name="ide" placeholder="Documento del Cliente">

				<input id="uno" type="submit" name="buscar" class="iput"  value="Buscar" >
			</td>
		</tr>
		
<?php
require('../conexion/conexion.php');
if(isset($_GET["buscar"])){
	$busqueda=$_GET['ide'];
$sql="SELECT  * from cliente  where id_cliente=:id";
$resultado=$base->prepare($sql);
$resultado->execute(array(":id"=>$busqueda));
	if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
	$idcliente=			$registro['id_cliente'];
	$nombre=				$registro['nombre_cliente'];
	$apellido=				$registro['apellido_cliente'];
	$telefono=				$registro['telefono'];
	$direccion=				$registro['direccion'];
	$idu=					$_GET['id'];
   	$auxiliar=				$_GET['nombaux'];
   
	 ?>
	 </form>

	<form  action="detalletemp.php" name="form1" method="get">
		<table id="tabla">
			<tr>
				<td class="tos1">Nombre:
					<input type="varchar" class="iput2" name="nomb" readonly  value="<?php echo $nombre?>">
				</td>
			</tr>
			<tr>
				<td  class="tos1">Apellido:
					<input type="varchar" class="iput2" name="ape" readonly value="<?php echo $apellido?>">
				</td>
			</tr>
			<tr>
				<td  class="tos2">Identificación:
					<input type="number" class="iput2" name="ide" readonly value="<?php echo $idcliente?>">
				</td>
			</tr>
			<tr>
				<td  class="tos1">Telefono:
					<input type="number" class="iput2" name="tele" readonly value="<?php echo $telefono?>">
				</td>
			</tr>
			<tr>
				<td  class="tos1">Direccion:
					<input type="varchar" class="iput2" name="dir" readonly value="<?php echo $direccion?>">
				</td>
			</tr>
			<input type="hidden" name="id" value="<?php echo $idu?>">
			<tr>
				<td  class="tos1">Vendedor:
					<input type="text" class="iput2" name="nombaux" readonly value="<?php echo $auxiliar?>">
				</td>
			</tr>
		</table>
   
	
	</table>
<?php
	
	}else{
		echo  "<center><div><a href='crearcliente.php' target=_blank> Este cliente no se encuentra, Registralo</a></div>";
	}
}
?>
 
	<br>
	<h3>Agregar  Productos</h3>
	<table class="tabla2">
		<tr>
			<td>
				<input type="submit" class="boton1" name="cargar" value="Agregar">
			</td>
			<td>
				<input type="button" class="boton2" name="cerrar" value="Cerrar" onmouseup="self.close() " >
			</td>
		</tr>
	
	<?php
	

	?>
	</div>
</table>	
</form>
</form>
</body>
</html>