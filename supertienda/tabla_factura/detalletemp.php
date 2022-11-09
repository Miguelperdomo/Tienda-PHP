<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styledetalle.css">
	<link rel="icon" href="/img/principal-removebg-preview.png">
	<title>Detalle temporal</title>
</head>
<body> 

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" autocomplete="off">

	<?php
	require("../conexion/conexion.php");
	if(!isset($_GET["buscarm"]) and !isset($_GET['agr'])){
	$idcliente=	$_GET['ide'];
	$nombre=		$_GET['nomb'];
	$apellido=		$_GET['ape'];
	$telefono=		$_GET['tele'];
	$direccion=		$_GET['dir'];
	$idu=			$_GET['id'];
	$_SESSION['id']=$idu;
	$cedu=['id'];
	$auxiliar=		$_GET['nombaux'];
	}else{
	$idcliente=		$_GET['ide'];
	$nombre=			$_GET['nomb'];
	$apellido=			$_GET['ape'];
	$telefono=		$_GET['tele'];
	$direccion=		$_GET['dir'];
	$idu=				$_GET['id'];
	$_SESSION['id']=$idu;
	$cedu=['id'];

	$auxiliar=			$_GET['nombre'];	
	}
	
	?>
	<div id="logotipo">
        <img src="">
    </div>
	<table class="tabla">
		<tr>
			<td>
				<h3>DATOS DEL CLIENTE</h3><br><br>
			</td>
		</tr>
		<tr>
			<td>Identificación:
				<input type="text" name="ide" readonly value="<?php echo $idcliente?>">
			</td>
		</tr>
		<tr>
			<td>Nombre
				<input type="text" name="nomb" readonly value="<?php echo $nombre?>">
			</td>
		</tr>
		<tr>
			<td>Apellido
				<input type="text" name="ape" readonly value="<?php echo $apellido?>">
			</td>
		</tr>
		<tr>
			<td>Telefono:
				<input type="text" name="tele" readonly value="<?php echo $telefono?>">
			</td>
		</tr>
		<tr>
			<td>Direccion:
				<input type="text" name="dir" readonly value="<?php echo $direccion?>">
			</td>
		</tr>

		<input type="hidden" name="id" value="<?php echo $idu?>">

		<tr>
			<td>Vendedor
				<input type="text" name="nombre"value="<?php echo $auxiliar?>">
			</td>
			
		</tr>
	</table>
    <table class="tabla1">
		<tr>
			<td>
				<h3>PRODUCTOS</h3><br>
			</td>
		</tr>
		<tr>
			<td>
				Código:
				<input id="dos" type="text" name="codi">
				
				<input id="uno" type="submit" name="buscarm" value="Buscar">

				<input type="hidden" name="codpro">
			</td>
		</tr>
	</table>
	<table id="tabla">
		<?php
	   if(isset($_GET['buscarm'])){
		$busca=	$_GET['codi'];
        $sql="SELECT  * from productos  where codigo_producto=:co";
        $resultado=$base->prepare($sql);
        $resultado->execute(array(":co"=>$busca));
	   if($registro=$resultado->fetch(PDO::FETCH_ASSOC)){

		?>
		<tr>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>

			<th colspan="2">Acción</th>
		</tr>
		<tr>
			<td>
				<input type="text"  name="nomb" value=" <?php echo $registro['nombre_producto'];?>" disabled>
			</td>
			<td>
				<input type="text" name="hora" value=" <?php echo $registro['precio'];?>" >
			</td>
			<td>
				<input type="number" name="can" placeholder="Ingrese cantidad">
			</td>
			<td>
				<input id="uno" type="submit" name="agr" value="Agregar">
			</td>
		</tr>
	</table>
		
	<input type="hidden" name="codm" value="<?php echo $registro['codigo_producto'];?>">
	<?php
	}
    }
    if(isset($_GET['agr'])){
    	
		$cedu=$_SESSION['id'];
    	$codigo=		$_GET['codm'];
    	$nombrem=		$_GET['nomb'];
		$prec=			$_GET['hora'];
		$cant=			$_GET['can']; //cambie aca//
		$valorT=$prec*$cant;

		
		$nkl="SELECT * FROM productos WHERE codigo_producto= :id";
        $resultado2=$base->prepare($nkl);
        $resultado2->execute(array(":id"=>$codigo));
        $regis=$resultado2->fetch(PDO::FETCH_ASSOC);

        $exist = $regis['existencia'];

        if($exist<$cant){
            ?>
            <div class="container">
                <h4>La cantidad que quiere el cliente excede a la cantidad que hay en el supertienda, digale al cliente que compre menos productos, gracias</h4>
            </div>
        <?php
        }else{

		
		
        $sql="INSERT INTO temporal (id_usuario, codigo_producto,  cantidad, precio_comple) values (:id, :co,:ca,:pre)";
		$resultado=$base->prepare($sql);//$base es el nombre de la conexión
		$resultado->execute(array(":id"=>$cedu, ":co"=>$codigo, ":ca"=>$cant, ":pre"=>$valorT));
		}
		
	}
	$registros=$base->query("SELECT * from temporal")->fetchALL(PDO::FETCH_OBJ);
			?>
			<table class="tabla2">
			<th>Código</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Valor Total</th>
			<th>Eliminar</th>
			
			<?php
			
			$contador=0;
			$total=0;
	        foreach ($registros as $temporal) :

			if ($_SESSION['id'] == $temporal->id_usuario and $temporal ->precio_comple ) {

			///$total =$total + $temporal->precio_comple * $temporal->cantidad;
			?> 
			
			<tr>
			<?php $cod_pro=$temporal->codigo_producto;
				$sql="SELECT nombre_producto, precio from productos WHERE codigo_producto = :co";
				$resultado=$base->prepare($sql);
	            $resultado->execute(array(":co"=>$cod_pro));
	            $registrocant=$resultado->fetch(PDO::FETCH_ASSOC);


				$detalle=$temporal->detalle;
				$sql="SELECT codigo_producto, precio_comple, cantidad from temporal WHERE detalle = :de";
				$resultado=$base->prepare($sql);
	            $resultado->execute(array(":de"=>$detalle));
	            $registro1=$resultado->fetch(PDO::FETCH_ASSOC);

				$total = $total + $registro1['precio_comple'];

	            ?>
			
				<td><?php echo $temporal->codigo_producto?></td>

	            <td align="center"><?php echo $registrocant['nombre_producto'];?></td>
				<td align="center"><?php echo $registrocant['precio'];?></td>
				<td align="center"><?php echo $registro1['cantidad'];?></td>
				<td align="center"><?php echo $registro1['precio_comple'];?></td>
				
	                               
				<?php $contador=$contador+1;?>
				</tr>
				<tr>


				
	<?php 
  
	}endforeach;
	
	?>
	
	
	</table><br>
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
	<form  name="form1"  method="post" action=" ">
	<div id="logotipo">
        <img src="">
    </div>
	<table class="tabla">
		</tr>

			<h3>
			<?php echo"Se va a generar la Factura con $contador Productos, al Cliente $nombre, el que Vendio su producto fue $auxiliar, si está seguro presione Si de lo contrario Volver"?>;
                <a href="facturar.php?id=<?php echo $idcliente?> & nomb=<?php echo $nombre?>  & contador=<?php echo $contador?> & iduser=<?php echo $idu?> & nombaux=<?php echo $auxiliar?> & total=<?php echo $total?> & codigo=<?php echo $codigo?> & cantidad=<?php echo $cant?> & dir=<?php echo $direccion ?> & tele=<?php echo $telefono?> & ape=<?php echo $apellido?> & nomb=<?php echo $nombre?>"><input id="uno" type="button" name="matricular" value="Facturar"></a>
                <a href="eliminavolve.php"><input type="button" name="vuelve" value="Volver" onmouseup="self.close()"></a>
			</h3>
			
		
			

	</table>
</form>
	</table>
	
	
	
</form>
</body>
</html>