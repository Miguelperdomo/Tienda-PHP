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
	$sql_total="SELECT * FROM roles";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

	$resultado=$base->prepare($sql_total);

	$resultado->execute(array());
	$numfilas=$resultado->rowCount();//cuantos registros hay en total
	$totalpagina=ceil($numfilas/$registros);

	$registros=$base->query("SELECT * from roles LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);
	
	if(isset($_POST['inserta'])){
		$nit=$_POST['idrol'];
        $nombre=$_POST['nomb'];
      
        ?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql="INSERT INTO roles (id_rol, nombre_rol) values (:id, :nom)";
		$resultado=$base->prepare($sql);//$base es el nombre de la conexión
		$resultado->execute(array(":id"=>$nit,  ":nom"=>$nombre));

		header("Location:index.php");
	}

	?>
	
<h3 align="center" class="centro" >PANEL DE OPCIONES ROLES </h3>
<form action=" " method="post" autocomplete="off">
		<table align="center" border="2" class="titulo"  bordercolor="orange">
			<tr>
				<th class="pri">Id Rol </th>
                <th class="pri">Nombre Rol</th>
				<th  class="pri" colspan="2">Acciones</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $roles) :?> 

				<td class="secu"><?php echo $roles->id_rol?></td>
                <td class="secu"><?php echo $roles->nombre_rol?></td>
			
					
			<td><a href="eliminar.php?id=<?php echo $roles->id_rol?> & nomb=<?php echo $roles->nombre_rol?>"><input type="button" class="boton1" name="elimina" id="elimina" value="Eliminar"></a></td>
			<td><a href="editar.php?id=<?php echo $roles->id_rol?> & nomb=<?php echo $roles->nombre_rol?> "><input type="button" class="boton1" name="edita" value="Editar"></a></td></tr>
			

			
			<?php
			endforeach;
		
			?>
			
			<td><input type="number" name="idrol"></td>
			<td><input type="text" name="nomb"></td>
		
				
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

