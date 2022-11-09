<?php
session_start();
include("../conexion/conexion.php");



	
	$cantidad=$_GET['cantidad'];
	$codigopr=$_GET['codigo'];
   	$idcliente=			$_GET['id'];
	$direccion=			$_GET['dir'];
	$telefono=				$_GET['tele'];
	$apellido=				$_GET['ape'];
	$nombre=				$_GET['nomb'];
	$contador=				$_GET['contador'];
	$idu=					$_REQUEST['iduser'];
	$auxiliar=				$_GET['nombaux'];	
	$total=$_GET['total'];
?>


<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/matricular.css">
	<link rel="icon" href="../img/principal-removebg-preview.png">
	<title>Factura de la Tienda </title>
</head>
<body>
	<form method="post">
	<table class="tabla3">
	<tr>
		<th colspan="4">Total Productos a Facturar:</th>
		<td colspan="3">
			<?php echo $contador;?>
		</td>
	</tr>
	<tr>
		<th colspan="4">Total a Pagar de la Factura:</th>
		<td colspan="3">
			<?php echo $total;?>
		</td>
		</tr>
	</table>
		<input type="int" name="cambio" placeholder="Coloca el efectivo">
		<input type="submit" name="si"  value="Si">
		<input type="button" name="vuelve" value="Volver" onmouseup="self.close()">
</form>
<?php 



	
    
    if(isset($_POST['si'])){

		$plata=0;
		$plata= $_POST['cambio'];
		$cambio= $plata - $total;

		echo '<script> alert ("Su cambio fue '.$cambio.' ");</script>';
		echo '<script>window.location="verfactura.php"</script>';



	$sql="INSERT INTO factura (id_cliente, id_usuario, total, codigo_producto, nombre_cliente, apellido_cliente, telefono, direccion, id_estado) values (:ic, :iu, :tot, :cd, :nm, :ap, :te, :di, 1)";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":ic"=>$idcliente, ":iu"=>$idu, ":tot"=>$total, ":cd"=>$codigopr, ":nm"=>$nombre, ":ap"=>$apellido, ":te"=>$telefono, ":di"=>$direccion));
	//consultar el número de matricula generado
	$sql = "SELECT MAX(id_factura) as last_id FROM factura";
    $resultado=$base->prepare($sql);
    $resultado->execute(array());
    $registro=$resultado->fetch(PDO::FETCH_ASSOC);
    $numatricula=$registro['last_id'];
   

	//ingresar el número de matricula en la tabla detalletemp
	$sql="UPDATE temporal SET id_factura='$numatricula'";
	$resultado=$base->prepare($sql); 
    $resultado->execute(array());

    // copia todos los registrso de detalletemp en detalle
    $sql="INSERT into detalles (id_factura, id_usuario, codigo_producto, cantidad, precio_comple) select  id_factura, id_usuario, codigo_producto, cantidad, precio_comple  from temporal";
    $resultado=$base->prepare($sql);
    $resultado->execute(array());

	//consulta a la tabla temp
                            
	$fi=$base->query("SELECT * from temporal where id_factura=$numatricula ")->fetchALL(PDO::FETCH_OBJ);
                        
	foreach ($fi as $temporal) :
		$codp= $temporal->codigo_producto;
		$cantp= $temporal->cantidad;

		$sql="SELECT * from productos where codigo_producto=:cod";
		$existencia=$base->prepare($sql);
		$existencia->execute(array(":cod"=>$codp));
		$exist=$existencia->fetch(PDO::FETCH_ASSOC);
		$antes=$exist['existencia'];
  
		$actual=$antes - $cantp;
			
		$sql="UPDATE productos set existencia =:qu WHERE codigo_producto =:co";
		$resultado=$base->prepare($sql); 
		$resultado->execute(array(":co"=>$codp, ":qu"=>$actual));                                
	endforeach;

    //borra todos los regisros de la tabla detalletemp
    $sql="DELETE from temporal WHERE id_usuario=:id";
	$resultado=$base->prepare($sql); 
    $resultado->execute(array(":id"=>$idu));
	
	$sql="SELECT * from detalles where codigo_producto=:cod";
        $existencia=$base->prepare($sql);
        $existencia->execute(array(":cod"=>$codigopr));
        $existencia1=$existencia->fetch(PDO::FETCH_ASSOC);
        $existencia2=$existencia1['existencia'];
        $existencia3=$existencia2 - $cantidad;
        $sql="UPDATE productos set existencia='$existencia3' WHERE codigo_producto :co";
        $resultado=$base->prepare($sql); 
        $resultado->execute(array(":co"=>$codigopr));
	

	}


?>



</body>

</html>