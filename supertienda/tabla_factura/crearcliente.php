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


		header("Location:index.php?id=<?php echo $docu;?> & nombaux=<?php echo $nombre1?>");
	}

	?>
	
    <form method="post">
			<td>
                <tr>Documento: <br>
                    <input type="number" name="idu"></td>
                </tr><br>
			<td>
                <tr>Nombre: <br>     
                    <input type="text" name="nomb"></td>
                </tr><br>
            <td>
                <tr> Apellido: <br>
                    <input type="text" name="apelli"></td>
                </tr><br>
            <td>
                <tr> Telefono: <br>
                    <input type="number" name="tele"></td>
                </tr><br>
           <td>
                <tr> Direccion: <br>
                    <input type="varchar" name="dir" >
				</tr>
			</td>
				
				</select> </td>
				<td colspan="5" align="center"><input  type="submit" class="boton2" name="inserta" value="Insertar" >
				<a href="index.php"><input type="button" name="admin" class="boton3" value="Cerrar"onmouseup="window.close()"></a></td>
			</tr>
		
			
	</tr>
				
				
	
		</table>
</form>



