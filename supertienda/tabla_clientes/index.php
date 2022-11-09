<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="indexstyle.css">
	<link rel="icon" href="../img/principal-removebg-preview.png">
	<title> Super Tienda</title>
</head>
<body>
	<?php
	
	include("../conexion/conexion.php");

	
	//--------------paginación-------------
	$registros=3;//indica que se van a ver 3 registro por página
	if(isset($_GET["pagina"])){
		if($_GET["pagina"]==1){
			header("Location:index.php");
		}else{
			$pagina=$_GET["pagina"];
		}
	}else{
		$pagina=1;//muestra página en la que estamos cuando se carga por primera vez
	}
	
	$empieza=($pagina-1)*$registros;//registro desde el cual va a empezar a mostrar
	$sql_total="SELECT * FROM cliente";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

	$resultado=$base->prepare($sql_total);

	$resultado->execute(array());
	$numfilas=$resultado->rowCount();//cuantos registros hay en total
	$totalpagina=ceil($numfilas/$registros);

	$registros=$base->query("SELECT * from cliente LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);
	
	if(isset($_POST['inserta'])){
		$idu=$_POST['idu'];
        $nombre=$_POST['nomb'];
        $apellido=$_POST['apelli'];
        $telefono=$_POST['tele'];
        $direccion=$_POST['dir'];
		?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql="INSERT INTO cliente (id_cliente, nombre_cliente, apellido_cliente, telefono, direccion) values (:id, :nom, :ape,  :tele, :dire )";
		$resultado=$base->prepare($sql);//$base es el nombre de la conexión
		$resultado->execute(array(":id"=>$idu,  ":nom"=>$nombre,   ":ape"=>$apellido, ":tele"=>$telefono, ":dire"=>$direccion));

		header("Location:index.php");
	}

	?>
	
<h3 align="center"  class="centro">PANEL DE OPCIONES DE LOS CLIENTES</h3>
<form action=" " method="post" autocomplete="off">
		<table align="center"  border="2" class="titulo" bordercolor="orange">
			<tr>
				<th class="pri">Documento</th>
                <th class="pri">Nombre</th>
                <th class="pri">Apellidos</th>
                <th class="pri">Telefonos</th>
				<th class="pri">Direcciones</th>
				<th class="pri" colspan="2">Acciones</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $usuario) :?> 
			<tr>
				<td class="secu"><?php echo $usuario->id_cliente?></td>
                <td class="secu"><?php echo $usuario->nombre_cliente?></td>
                <td class="secu"><?php echo $usuario->apellido_cliente?></td>
                <td class="secu"><?php echo $usuario->telefono?></td>
                <td class="secu"><?php echo $usuario->direccion?></td>
			
					
			<td><a href="eliminar.php?id=<?php echo $usuario->id_cliente?> & nomb=<?php echo $usuario->nombre_cliente?>"><input type="button" class="boton1" name="elimina" id="elimina" value="Eliminar"></a></td>
			<td><a href="editar.php?id=<?php echo $usuario->id_cliente?> & nomb=<?php echo $usuario->nombre_cliente?>"><input type="button" class="boton1" name="edita" value="Editar"></a></td></tr>
			

			
			<?php
			endforeach;
		
			?>
			
			<td><input type="number" name="idu"></td>
			<td><input type="text" name="nomb"></td>
            <td><input type="text" name="apelli"></td>
            <td><input type="number" name="tele"></td>
           <td><input type="varchar" name="dir" ></td>
	

				</select> </td>
				<td colspan="5" align="center"><input  type="submit" class="boton2" name="inserta" value="Insertar" >
				<a href="admi/admi.php"><input type="button" name="admin" class="boton3" value="Cerrar"onmouseup="window.close()"></a></td>
			</tr>
		
			
	</tr>
				
				
	
		</table>
</form>

<table border="0" align="center">
	<tr>	
<?php
for($i=1; $i<=$totalpagina; $i++){
	?>
	 <td><?php echo " <a href='?pagina=" . $i . "'>" . $i . "  </a>  ";?></td>
		
<?php
	
$base=null;//vaciar los datos de conexión 
}
?>

