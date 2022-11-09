<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styleindex.css">
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
	$sql_total="SELECT * FROM productos";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

	$resultado=$base->prepare($sql_total);

	$resultado->execute(array());
	$numfilas=$resultado->rowCount();//cuantos registros hay en total
	$totalpagina=ceil($numfilas/$registros);

	$registros=$base->query("SELECT * from productos, provedor WHERE productos.nit=provedor.nit LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);
	
	if(isset($_POST['inserta'])){
		$idu=$_POST['id'];
		$codigo=$_POST['codi'];
        $nombre=$_POST['nomb'];
        $precio=$_POST['preci'];
        $existencia=$_POST['exist'];
		$nit=$_POST['nit'];
		?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql="INSERT INTO productos (id, codigo_producto, nombre_producto, precio, existencia, nit) values (:id, :cod, :nom, :pre,  :exis,  :ni)";
		$resultado=$base->prepare($sql);//$base es el nombre de la conexión
		$resultado->execute(array(":id"=>$idu, ":cod"=>$codigo,  ":nom"=>$nombre,   ":pre"=>$precio, ":exis"=>$existencia,    ":ni"=>$nit));

		header("Location:index.php");
	}

	?>
	
<h3 align="center" class="centro">PANEL DE OPCIONES PRODUCTOS</h3>
<form action=" " method="post" autocomplete="off">
		<table align="center" border="2" class="titulo" bordercolor="orange">
			<tr>
				<th class="pri">Identificacion</th>
				<th class="pri">Codigo Producto</th>
                <th class="pri">Nombre Producto</th>
                <th class="pri">Precio</th>
                <th class="pri">Existencia</th>
				<th class="pri">Fecha</th>
				<th class="pri">Nombre del Provedor</th>
				<th colspan="2" class="pri">Acciones</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $usuario) :?> 
			<tr>
				<td  class="secu"><?php echo $usuario->id?></td>
				<td  class="secu"><?php echo $usuario->codigo_producto?></td>
                <td  class="secu"><?php echo $usuario->nombre_producto?></td>
                <td  class="secu"><?php echo $usuario->precio?></td>
                <td  class="secu"><?php echo $usuario->existencia?></td>
                <td  class="secu"><?php echo $usuario->fecha?></td>
                <td  class="secu"><?php echo $usuario->nombre?></td>
			
					
			<td><a href="eliminar.php?id=<?php echo $usuario->id?> & nomb=<?php echo $usuario->nombre_producto?>"><input type="button" class="boton1" name="elimina" id="elimina" value="Eliminar"></a></td>
			<td><a href="editar.php?id=<?php echo $usuario->id?> & nomb=<?php echo $usuario->nombre_producto?> "><input type="button" class="boton1" name="edita" value="Editar"></a></td></tr>
			

			
			<?php
			endforeach;
		
			?>
			<td><input type="number" name="id"></td>
			<td><input type="number" name="codi"></td>
			<td><input type="text" name="nomb"></td>
            <td><input type="number" name="preci"></td>
            <td><input type="number" name="exist"></td>
           <td><input type="text"  name="fech" disabled> </td>
			<td><select name="nit">
			<?php
			$sql= "SELECT * FROM provedor "; 
			$resultado=$base->prepare($sql);
			$resultado->execute(array());
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
			?>
			?>
				<option value="<?php echo $registro['nit'];?>"><?php echo $registro['nombre'];?> <?php echo $registro['nit'];?></option>
				<?php
				}
			 

				?>
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

