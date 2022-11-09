<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="admi/style1.css">
	<title></title>
</head>
<body>
	<?php
	
	include("conexion/conexion.php");

	
	//--------------paginación-------------
	$registros=3;//indica que se van a ver 3 registro por página
	if(isset($_GET["pagina"])){
		if($_GET["pagina"]==1){
			header("Location:crud.php");
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
		$idu=$_POST['idu'];
        $nombre=$_POST['nomb'];
        $correo=$_POST['correo'];
        $usuario=$_POST['usua'];
        $password=$_POST['clave'];
		$pass_cifrado=password_hash($password,PASSWORD_DEFAULT,array("cost"=>12));//encripta lo que hay en la variable password

		$rol=$_POST['rol'];
		?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql="INSERT INTO usuario (id_usuario, nombre_usua, correo, usuario, clave, id_rol) values (:id, :nom, :corre,  :usu, :cla, :rol)";
		$resultado=$base->prepare($sql);//$base es el nombre de la conexión
		$resultado->execute(array(":id"=>$idu,  ":nom"=>$nombre,   ":corre"=>$correo, ":usu"=>$usuario, ":cla"=>$pass_cifrado,   ":rol"=>$rol));

		header("Location:crud.php");
	}

	?>
	
<h3 align="center">PANEL DE OPCIONES USUARIOS</h3>
<form action=" " method="post" autocomplete="off">
		<table align="center" border="" bordercolor="orange">
			<tr>
				<th>Documento</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Usuario</th>
				<th>Contraseña</th>
				<th>Rol</th>
				<th colspan="2">Acciones</th>
			</tr>
			<?php
			//por cada objeto que hay dentro del array repite el código
			foreach ($registros as $usuario) :?> 
			<tr>
				<td><?php echo $usuario->id_usuario?></td>
                <td><?php echo $usuario->nombre_usua?></td>
                <td><?php echo $usuario->correo?></td>
                <td><?php echo $usuario->usuario?></td>
                <td><?php echo /*$usuario->clave*/'XXXX'?></td>
               

				<?php
				if($usuario->id_rol==1){
					$aux="Administrador"
					?>
					<td><?php echo $aux;?></td>
				<?php
				}else{
					$aux="Vendedor"
					?>
					<td><?php echo $aux;?></td>
				<?php
				}
				
			?>
			
					
			<td><a href="eliminar.php?id=<?php echo $usuario->id_usuario?> & nomb=<?php echo $usuario->nombre_usua?>  & corre=<?php echo $usuario->correo?>  & usua=<?php echo $usuario->usuario?>  & rol=<?php echo $aux?>"><input type="button" name="elimina" id="elimina" value="Eliminar"></a></td>
			<td><a href="editar.php?id=<?php echo $usuario->id_usuario?> & nomb=<?php echo $usuario->nombre_usua?> & corre=<?php echo $usuario->correo?>  & usua=<?php echo $usuario->usuario?>  & rol=<?php echo $aux?>"><input type="button" name="edita" value="Editar"></a></td></tr>
			

			
			<?php
			endforeach;
		
			?>
			
			<td><input type="number" name="idu"></td>
			<td><input type="text" name="nomb"></td>
            <td><input type="email" name="correo"></td>
            <td><input type="text" name="usua"></td>
           <td><input type="password" name="clave" ></td>
			<td><select name="rol">
			<?php
			$sql= "SELECT * FROM roles"; 
			$resultado=$base->prepare($sql);
			$resultado->execute(array());
			while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
			?>
			?>
				<option value="<?php echo $registro['id_rol'];?>"><?php echo $registro['nombre_rol']?></option>
				<?php
				}
			 

				?>
				</select> </td>
				<td colspan="5" align="center"><input  type="submit" name="inserta" value="Insertar" >
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

