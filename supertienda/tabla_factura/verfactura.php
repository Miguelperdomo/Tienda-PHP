

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="verfact.css">
	<title>Ver Factura</title>
</head>
<body>
<form method="get">
	<div class="todo">
	<table>
		
		<tr>
			<td>
				<table class="tabla">
					<tr>
						<th colspan="3">
								
							<div id="logotipo">
								<img src="../img/factura1.png">
							</div>

							<div class="titulo">
								<label>
									<h1>SUPERMERCADO LA QUINTA</h1>
									<h1>¡La tienda que consigues<br><br> todo!</h1>
								</label>
							</div>
						</th>
					</tr>
					<?php
						require("../conexion/conexion.php");
						//consuta el último número de matricula generado
						$sql = "SELECT MAX(id_factura) as last_id FROM factura";
						$resultado=$base->prepare($sql);
						$resultado->execute(array());
						$registro=$resultado->fetch(PDO::FETCH_ASSOC);
						$numatricula=$registro['last_id'];
						//consulta los datos  de la última matricula generada
						$sql="SELECT  * from factura where id_factura=:nm";
						$resultado=$base->prepare($sql);
						$resultado->execute(array(":nm"=>$numatricula));
						$registro=$resultado->fetch(PDO::FETCH_ASSOC);
						$idcliente=		$registro['id_cliente'];
						$codigo=		$registro['codigo_producto'];
						$date=				$registro['fecha'];
						$nombre=		$registro['nombre_cliente'];
						$apellido=		$registro['apellido_cliente'];
						$telefono=		$registro['telefono'];
						$direccion=		$registro['direccion'];
						$idu=				$registro['id_usuario'];
						$total=				$registro['total'];
						//consultar datos del estudiante que corresponde a la última matricula generada
						$sql="SELECT * from cliente where id_cliente=:id";
						$resultado=$base->prepare($sql);
						$resultado->execute(array(":id"=>$idcliente));
						$registro=$resultado->fetch(PDO::FETCH_ASSOC);
// cambie
					
					?>
						
					<tr>
						<td class="tit" colspan="2">
							<h2>Factura N° 
								<?php echo $numatricula ?>
							</h2>
							<h2>Fecha: 
								<?php echo $date ?>
							</h2>
						</td>
					</tr>
					<tr>
						<td class="dta" colspan="2">
							<h3>DATOS DEL CLIENTE</h3>
						</td>
					</tr>
					<tr>
						<td class="cli1" colspan="2">
							<h3>Identificación: 
								<?php echo $registro['id_cliente']?>
							</h3>
						</td>
					</tr>
					<tr>
						<td class="cli2" colspan="2">
							<h3>Nombre: 
								<?php echo $registro['nombre_cliente']?>
							</h3>
						</td>
					</tr>
					<tr>
						<td class="cli" colspan="2">
							<h3>Apellido: 
								<?php echo $registro['apellido_cliente']?>
							</h3>
						</td>
						<td class="cli3" colspan="2"> 
							<h3>Telefono: 
								<?php echo $registro['telefono']?>
							</h3>
						</td>
						<td colspan="2">
							<h3>Direccion: 
								<?php echo $registro['direccion']?>
							</h3>
						</td> 
					</tr>
					<?php 
						$sql="SELECT  * from usuario where id_usuario=:ie";
						$resultadou=$base->prepare($sql);
						$resultadou->execute(array(":ie"=>$idu));
						$registrou=$resultadou->fetch(PDO::FETCH_ASSOC);
						
						$auxiliar=$registrou['nombre_usua'];
					?>
					<tr>
						<td class="dtt" colspan="2">
							<h3>DATOS DEL VENDEDOR</h3>
						</td>
					</tr>
					<tr class="ven">
						<td>
							<h3>Vendedor: 
								<?php echo $auxiliar ?>
							</h3>
						</td>
					</tr>
				</table><br>
				<table  class="tabla1">
					<h1>DETALLES DEL PRODUCTOS</h1>
					<tr border="2" class="td">
						<th>Código</th>
						<th>Nombre Producto</th>
						<th>Precio</th>
						<th>Cantidad</th>
						<th>Total</th>

					</tr>
					<tr>
						<?php
							//consulta a la tabla detallefactura
							$registrosdet=$base->query("SELECT * from detalles where id_factura=$numatricula ")->fetchALL(PDO::FETCH_OBJ);
							$cuenta=0;
							foreach ($registrosdet as $detalles) :?> 
								<td class="dd">
									<?php echo $detalles->codigo_producto?>
								</td>
								<?php
								$codi=$detalles->codigo_producto;
							
							
							
							//consulto el nombre de la materia en la tabla materia
							$sql="SELECT nombre_producto, precio from productos where codigo_producto=:co";
							$resultado=$base->prepare($sql);
							$resultado->execute(array(":co"=>$codi));
							$registrom=$resultado->fetch(PDO::FETCH_ASSOC);

						
						?>

						<td class="dd" align="center">
							<?php echo $registrom['nombre_producto'];?>
						</td>
						<td  class="dd" align="center">
							<?php echo $registrom['precio'];?>
						</td>
						<td class="dd" align="center">
							<?php echo $detalles->cantidad;?>
						</td>
						<td class="dd" align="center">
							<?php echo $detalles->precio_comple;?>
						</td>
						<?php
							$cuenta=$cuenta+1
						?>
					</tr>
							
						<?php
							endforeach;
						?>
					<tr>
						<td colspan="4">
							<div class="paga">Total Productos: 
								<?php echo " ", $cuenta;?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="paga1" colspan="4">
							<div>Total a Pagar: 
								<?php echo " ", $total;?>
							</div>
						</td>
					</tr>
					
				</table>
				<table class="tabla2">
					<tr>
						<td>
							<input id="sumbmit" type='button' class="impir" onclick='window.print();' value='Imprimir'>
							<a href="index.php?iduser=<?php echo $auxiliar?> & nombaux=<?php echo $auxiliar?>">
								<input type="button" class="impir1" name="vuelve" value="Nueva Factura">
							</a>
							<a href="pdf.php?iduser=<?php echo $auxiliar?> & nombaux=<?php echo $auxiliar?>">
								<input type="button" class="impir1" name="vuelve" value="Ver en PDF">
							</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	</div>	
</form>
</body>
</html>