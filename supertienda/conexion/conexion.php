<?php

try{
	$base = new PDO('mysql:host=localhost;dbname=supertienda', 'root', '');
	
  
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->query("set names utf8;");

}catch(Exception $e){
	echo "Ocurrió algo con la base de datos: " . $e->getMessage();
}
?>