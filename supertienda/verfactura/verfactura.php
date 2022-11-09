<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style.css">
	<link rel="icon" href="../img/principal-removebg-preview.png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<title> Super Tienda</title>
</head>
<body>
	<?php
	
	include("../conexion/conexion.php");

	
	//--------------paginación-------------
	$registros=3;//indica que se van a ver 3 registro por página
	if(isset($_GET["pagina"])){
		if($_GET["pagina"]==1){
			header("Location:verfactura.php");
		}else{
			$pagina=$_GET["pagina"];
		}
	}else{
		$pagina=1;//muestra página en la que estamos cuando se carga por primera vez
	}
	
	$empieza=($pagina-1)*$registros;//registro desde el cual va a empezar a mostrar
	$sql_total="SELECT * FROM factura";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

	$resultado=$base->prepare($sql_total);

	$resultado->execute(array());
	$numfilas=$resultado->rowCount();//cuantos registros hay en total
	$totalpagina=ceil($numfilas/$registros);

	$registros=$base->query("SELECT * from factura LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);
	
	if(isset($_POST['inserta'])){
		$factur=$_POST['fact'];
        $idcliente=$_POST['client'];
        $codigopr=$_POST['codigo'];
        $fecha=$_POST['fecha'];
        $nombreclie=$_POST['nombrecl'];
        $apellidocli=$_POST['apellidocl'];
        $telefono=$_POST['tele'];
		$direccion=$_POST['dire'];
        $idusuario=$_POST['usuario'];
        $tota=$_POST['total'];
        ?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql="INSERT INTO factura (id_factura, id_cliente, codigo_producto, fecha, nombre_cliente, apellido_cliente, telefono, direccion, id_usuario, total) values (:fac, :ic, :cd, :fe, :nc, :apc, :tel, :dir, :idu, :tot)";
		$resultado=$base->prepare($sql);//$base es el nombre de la conexión
		$resultado->execute(array(":fac"=>$factur,  ":ic"=>$idcliente,   ":cd"=>$codigopr, ":fe"=>$fecha, ":nc"=>$nombreclie, ":apc"=>$apellidocli, ":tel"=>$telefono, ":dir"=>$direccion, ":idu"=>$idusuario, ":tot"=>$tota ));

		header("Location:verfactura.php");
	}

	?>
	
<h3 align="center" class="centro">PANEL DE OPCIONES DE FACTURAS</h3>
<form action=" " method="post" autocomplete="off">
		<table align="center" border="2" class="titulo" bordercolor="orange">
			<tr>
				<th class="pri">N° Factura </th>
                <th  class="pri">Identificacion Cliente</th>
                <th  class="pri">Codigo Producto</th>
                <th  class="pri">Fecha</th>
                <th class="pri">Nombre Cliente</th>
				<th class="pri">Apellido Cliente</th>
				<th class="pri">Telefono</th>
                <th class="pri">Direccion</th>
                <th class="pri">Identificacion Vendedor</th>
                <th class="pri">Total</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $factura) :?> 
			<tr>
				<td class="secu"><?php echo $factura->id_factura?></td>
                <td class="secu"><?php echo $factura->id_cliente?></td>
                <td class="secu"><?php echo $factura->codigo_producto?></td>
                <td class="secu"><?php echo $factura->fecha?></td>
                <td class="secu"><?php echo $factura->nombre_cliente?></td>
                <td class="secu"><?php echo $factura->apellido_cliente?></td>
                <td class="secu"><?php echo $factura->telefono?></td>
                <td class="secu"><?php echo $factura->direccion?></td>
                <td class="secu"><?php echo $factura->id_usuario?></td>
                <td class="secu"><?php echo $factura->total?></td>
		
			

			
			<?php
			endforeach;
		
			?>
			
	
            
		
			</tr>
		
			
	</tr>
				
				
	
		</table>
</form>


<table border="0" align="center">
	<tr>	
<?php
for( $i=1; $i<=$totalpagina; $i++){
	?>
	 <td><?php echo " <a href='?pagina=" . $i . "'>" . $i . "  </a>  ";?></td>
	 	</ul>
<?php
	
$base=null;//vaciar los datos de conexión 
}


?>
</td><a href="../Vendedor/index.php"><input type="button" name="admin" class="boton" value="Cerrar"onmouseup="window.close()"></a></td>

<a href="../tabla_factura/index.php?id=<?php echo $docu;?> & nombaux=<?php echo $nombre?>" target=_blank class="fac">¿Quieres Hacer una Factura?</a>