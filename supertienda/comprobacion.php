<?php
require("conexion/conexion.php");
ini_set("default_charset", "utf-8");

if(!isset($_SESSION["documento"]) and !isset($_POST["Enviar"])){
	header("Location: index.php");
	
}

else if(isset($_POST["Enviar"])){

try{

$login=				htmlentities(addslashes($_POST["documento"]));
$password=			htmlentities(addslashes($_POST["clave"]));
$contador=0;

$sql="SELECT * FROM usuario WHERE id_usuario= :id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$login));//marcador login se corresponde con lo que el usuario introdujo en el cuadro de texto login
	if ($registro=$resultado->fetch(PDO::FETCH_ASSOC)) {
		
		if(password_verify($password, $registro['clave'])){
		
		$valida=			$registro['id_rol'];
		$nombre=			$registro['nombre_usua'];
		$_SESSION['nomb']=$nombre;
		$usua=$_SESSION['nomb'];

		$nombre1=			$registro['nombre_usua'];
        $usuario=			$registro['usuario'];
        $correo=			$registro['correo'];

		$docu=			$registro['id_usuario'];
		$_SESSION['docuu']=$docu;
		$cedu=$_SESSION['docuu'];

				$contador++;
			}
		}
		
		if ($contador>0){
			
			if($valida==1){
				require("administrador/index.php");
			}
			
			elseif ($valida==2){
				require("vendedor/index.php");
			}

			elseif ($valida==3){
				require("Auditores/index.php");
			}else{
				require("Bodega/index.php");
			}
			
			
		}
		
		else{
			echo '<script>alert("Uju No se encontro este Usuario en la Base de Datos, Verifica Bien);</script>';
			echo '<script>window.location="loginerror.php"</script>';
			require("loginerror.php");
		}
		$resultado->closecursor();
		$base->exec("set character set utf8");
	
		
			
		
}catch(Exception $e){
	die("error" . $e->getMessage());

}
}

?>