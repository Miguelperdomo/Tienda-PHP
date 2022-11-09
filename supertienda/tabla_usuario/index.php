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
	$sql_total="SELECT * FROM usuario";//muestra los 3 primeros, primer parametro indica en que posición impieza en este caso posición 0, el segundo parametro cuantos registros quiere mostrar en este caso 3 registros

	$resultado=$base->prepare($sql_total);

	$resultado->execute(array());
	$numfilas=$resultado->rowCount();//cuantos registros hay en total
	$totalpagina=ceil($numfilas/$registros);

	$registros=$base->query("SELECT * from usuario LIMIT $empieza, $registros")->fetchALL(PDO::FETCH_OBJ);
	
	if(isset($_POST['inserta'])){
		$documento=$_POST['doc'];
        $nombre=$_POST['nomb'];
        $correo=$_POST['corre'];
        $usuario=$_POST['usua'];
        $password=$_POST['cla'];
		$pass_cifrado=password_hash($password,PASSWORD_DEFAULT,array("cost"=>12));//encripta lo que hay en la variable password
		$tipo=$_POST['rol'];
        ?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql="INSERT INTO usuario (id_usuario, nombre_usua, correo, usuario, clave, id_rol) values (:id, :nom, :corr,  :usu, :cla, :tip)";
		$resultado=$base->prepare($sql);//$base es el nombre de la conexión
		$resultado->execute(array(":id"=>$documento,  ":nom"=>$nombre,   ":corr"=>$correo, ":usu"=>$usuario, ":cla"=>$pass_cifrado, ":tip"=>$tipo));

		header("Location:index.php");
	}

	?>
	
<h3 align="center"  class="centro">PANEL DE OPCIONES USUARIOS</h3>
<form action=" " method="post" autocomplete="off">
		<table align="center" border="2" class="titulo" bordercolor="orange">
			<tr>
				<th class="pri">Documento </th>
                <th class="pri">Nombre Usuario</th>
                <th class="pri">Correo</th>
                <th class="pri">usuario</th>
				<th class="pri">clave</th>
				<th class="pri">Tipo</th>
				<th class="pri" colspan="2">Acciones</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $usuario) :?> 
			<tr>
				<td  class="secu"><?php echo $usuario->id_usuario?></td>
                <td  class="secu"><?php echo $usuario->nombre_usua?></td>
                <td  class="secu"><?php echo $usuario->correo?></td>
                <td  class="secu"><?php echo $usuario->usuario?></td>
                <td  class="secu"><?php echo /*$persona->clave*/'XXXX'?></td>

                <?php
				if($usuario->id_rol==1){
					$aux="Administrador"
					?>
					<td><?php echo $aux;?></td>
				<?php
				}
				else{
					$aux="Vendedor"
					?>
					<td><?php echo $aux;?></td>
				<?php
                }
				
			?>	
			
					
			<td><a href="eliminar.php?id=<?php echo $usuario->id_usuario?> & nomb=<?php echo $usuario->nombre_usua?>"><input type="button" class="boton1" name="elimina" id="elimina" value="Eliminar"></a></td>
			<td><a href="editar.php?id=<?php echo $usuario->id_usuario?> & nomb=<?php echo $usuario->nombre_usua?> "><input type="button" class="boton1" name="edita" value="Editar"></a></td></tr>
			

			
			<?php
			endforeach;
		
			?>
			
			<td><input type="number" name="doc"></td>
			<td><input type="text" name="nomb"></td>
            <td><input type="email" name="corre"></td>
            <td><input type="varchar" name="usua"></td>
           <td><input type="password" name="cla" ></td>
			<td><select name="rol">
			<?php
			$sql= "SELECT * FROM roles "; 
			$resultado=$base->prepare($sql);
			$resultado->execute(array());
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
			?>
			?>
				<option value="<?php echo $registro['id_rol'];?>"><?php echo $registro['nombre_rol'];?></option>
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

