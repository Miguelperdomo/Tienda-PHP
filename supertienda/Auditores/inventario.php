






<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="admi/style1.css">
	<link rel="icon" href="../img/principal-removebg-preview.png">
	<title>Ver Facturas </title>
</head>
<body>
	<?php
	
	include("../conexion/conexion.php");

	
	//--------------paginación-------------
	$registros=3;//indica que se van a ver 3 registro por página
	if(isset($_GET["pagina"])){
		if($_GET["pagina"]==1){
			header("Location:inventario.php");
		}else{
			$pagina=$_GET["pagina"];
		}
	}else{
		$pagina=1;//muestra página en la que estamos cuando se carga por primera vez
	}
	
	$empieza=($pagina-1)*$registros;//registro desde el cual va a empezar a mostrar
	$sql_total="SELECT * FROM usuario, detalles, factura, cliente  WHERE detalles.id_factura=factura.id_factura and  factura.id_usuario=usuario.id_usuario  and factura.id_cliente=cliente.id_cliente";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

	$resultado=$base->prepare($sql_total);

	$resultado->execute(array());
	$numfilas=$resultado->rowCount();//cuantos registros hay en total
	$totalpagina=ceil($numfilas/$registros);

	$registros=$base->query("SELECT * from usuario, detalles, factura, cliente,productos, estado WHERE detalles.id_factura=factura.id_factura and  factura.id_usuario=usuario.id_usuario  and factura.id_cliente=cliente.id_cliente and detalles.codigo_producto=productos.codigo_producto and factura.id_estado=estado.id_estado LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);

	?>
	
<h3 align="center">PANEL DE OPCIONES FACTURAS</h3>
<form action=" " method="post" autocomplete="off">
		<table align="center" border="" bordercolor="orange">
			<tr>
            <th align="center">Codigo del Producto</th>
            <th align="center">Nombre del Cliente</th>
            <th align="center">Telefono Cliente</th>
            <th align="center">Direccion Cliente</th>
            <th align="center">Fecha de Compra</th>
            <th align="center">Vendedor</th>
            <th align="center">Cantidad</th>
			<th align="center">Estado Factura </th>
            <th align="center">Valor total</th>
            <th align="center">Accion</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $factura) :?> 
			<tr>
				<td><?php echo $factura->codigo_producto?></td>
                <td><?php echo $factura->nombre_cliente?> <?php echo $factura->apellido_cliente?></td>
                <td><?php echo $factura->telefono?></td>
                <td><?php echo $factura->direccion?></td>
                <td><?php echo $factura->fecha?></td>
                <td><?php echo $factura->nombre_usua?></td>
                <td><?php echo $factura->cantidad?></td>
				<td><?php echo $factura->nombre_estado?></td>
                <td><?php echo $factura->total?></td>

     

			
					
			<td><a href="anular.php?id=<?php echo $factura->id_factura?>   & deta=<?php echo $factura->detalle?>  & codigo=<?php echo $factura->codigo_producto?> & canti=<?php echo $factura->cantidad?> & cantip=<?php echo $factura->existencia?>"><input type="button" name="elimina" id="elimina" value="Anular"></a></td>
			<td><a href="ver.php?id=<?php echo $factura->id_factura?> & nomb=<?php echo $factura->nombre_cliente?>  & ape=<?php echo $factura->apellido_cliente?>  & vende=<?php echo $factura->nombre_usua?> & estado=<?php echo $factura->nombre_estado?> "><input type="button" name="edita" value="Ver Factura"></a></td></tr>
			

			
			<?php
			endforeach;
		
			?>
				<a href="admi/admi.php"><input type="button" name="admin" value="Cerrar"onmouseup="window.close()"></a></td>
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

