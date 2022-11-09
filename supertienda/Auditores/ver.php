<?php
  //ini_set("default_charset", "UTF-8");
  require '../fpdf/fpdf.php';
  	
	require("../conexion/conexion.php");      
	include("../conexion/conexion.php");
	$id=$_GET["id"];       
	       
    		$sql="SELECT  * from factura where id_factura=:nf";
        	$resultado=$base->prepare($sql);
        	$resultado->execute(array(":nf"=>$id));
	   		$registro=$resultado->fetch(PDO::FETCH_ASSOC);
	   		$nufactura=			$registro['id_factura'];
	   		$idcliente=			$registro['id_cliente'];
	   		$date=				$registro['fecha'];
	   		$total=				$registro['total'];
	   		$usuario=			$registro['id_usuario'];
			$estado=			$registro['id_estado'];
	   		//consultar datos del cliente que corresponde a la última factura generada
	   		$sql="SELECT * from cliente where id_cliente=:id";
	   		$resultado=$base->prepare($sql);
	   		$resultado->execute(array(":id"=>$idcliente));
	   		$registro=$resultado->fetch(PDO::FETCH_ASSOC);

	   		
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(70,15);//alinea la próxima celda a 50 p sobre el eje X y a 50 p sobre el eje y
$pdf->Image('../img/factura1.png',15,10,30);
$pdf->Cell(50, 10, 'SUPER TIENDA',0, 1, 'R');//celda de ancho 30, alto 10 relleno 1 con un salto de línea texto alineado a la derecha
$pdf->SetFont('Arial','',10);
$pdf->SetXY(120,30);
$pdf->Cell(50, 10, 'FACTURA N°',0, 0, 'R');
$pdf->SetXY(120,30);
$pdf->Cell(55, 10, $nufactura,0, 1, 'R');
$pdf->SetXY(110,40);
$pdf->Cell(50,10, 'FECHA',0, 0, 'R');
$pdf->Cell(35, 10, $date,0, 1, 'R');
$pdf->SetFont('Arial','B',14);
$pdf->SetXY(72,50);
$pdf->Cell(50, 10,'DATOS DEL CLIENTE',0, 1,'C');
$pdf->SetFont('Arial','',12);
$pdf->SetXY(20,60);
$pdf->Cell(50, 10,utf8_decode('Identificación:'),0, 0,'C');
$pdf->Cell(1, 10,$registro['id_cliente'],0, 1,'R');
$pdf->SetXY(14,65);
$pdf->Cell(52, 10,'Nombre:',0, 0,'C');
$pdf->Cell(1, 10,utf8_decode($registro['nombre_cliente']),0, 0,'R');
$pdf->Cell(70, 10,'Apellido:',0, 0,'C');
$pdf->Cell(1, 10,$registro['apellido_cliente'],0, 1,'R');
$pdf->SetXY(14,70);
$pdf->Cell(55, 10,utf8_decode('Dirección:'),0, 0,'C');
$pdf->Cell(1, 10,$registro['direccion'],0, 0,'R');
$pdf->Cell(65, 10,utf8_decode('Teléfono:'),0, 0,'C');
$pdf->Cell(2, 10,$registro['telefono'],0, 1,'R');
$sql="SELECT  * from usuario where id_usuario=:iu";
$resultado=$base->prepare($sql);
$resultado->execute(array(":iu"=>$usuario));
$registrou=$resultado->fetch(PDO::FETCH_ASSOC);
$pdf->Cell(42, 8,('Vendedor'),0, 0,'R');
$pdf->Cell(35, 8,$registrou['nombre_usua'],0, 1,'R');
$pdf->SetFont('Arial','B',14);
$pdf->setXY(72,80);

$pdf->Cell(50,30,'DETALLE DE PRODUCTOS',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->setXY(10,85);
$pdf->Cell(55, 45,utf8_decode('Código'),0, 0,'C');
$pdf->Cell(1, 45,('Nombre'),0, 0,'C');
$pdf->Cell(55, 45,('Cantidad'),0, 0,'C');
$pdf->Cell(10, 45,('V/Unitario'),0, 0,'C');
$pdf->Cell(40, 45,('V/Total'),0, 1,'C');
$pdf->setXY(10,112);
$registrosdet=$base->query("SELECT * from detalles where id_factura=$nufactura ")->fetchALL(PDO::FETCH_OBJ);
foreach ($registrosdet as $producto) :
$codigo=$producto->codigo_producto;
$cantidad=$producto->cantidad;
$precio_venta=$producto->precio_comple;			
$pdf->SetFont('Arial','',12);
//$pdf->Cell(50, 8, $producto->codproducto,0, 0,'C');
$sql="SELECT nombre_producto, precio  from productos where codigo_producto=:co";
$resultado=$base->prepare($sql);
$resultado->execute(array(":co"=>$codigo));
$registrop=$resultado->fetch(PDO::FETCH_ASSOC);
$nombre=$registrop['nombre_producto'];
$precio=$registrop['precio'];
//$pdf->Cell(12, 8, $registrop['nombre'],0, 1,'C');
//$pdf->Cell(89,1, $producto->cantidad,0,0,'R');
//$pdf->Cell(30,1, $registrop['precio'],0,1,'R');
//$pdf->Cell(150,1,$producto->precio_venta,0,1,'R');
$pdf->Cell(50, 8, $codigo,0, 0,'C');
$pdf->Cell(12, 8, $nombre,0, 0,'C');
$pdf->Cell(42, 8, $cantidad,0, 0,'C');
$pdf->Cell(25, 8, $precio,0, 0,'C');
$pdf->Cell(25, 8, $precio_venta,0, 1,'C');


endforeach; 

$pdf->Cell(133,10,'Valor Total',0,0,'R');
$pdf->Cell(15,10, '$'. $total, 0,1,'C');
$sql="SELECT  * from estado where id_estado=:iu";
$resultado=$base->prepare($sql);
$resultado->execute(array(":iu"=>$estado));
$registrou=$resultado->fetch(PDO::FETCH_ASSOC);
$pdf->Cell(42, 8,('Estado de Factura'),0, 0,'R');
$pdf->Cell(35, 8,$registrou['nombre_estado'],0, 1,'R');
$pdf->Output();


?>