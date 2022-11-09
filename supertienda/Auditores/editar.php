<?php

session_start();
require("../conexion/conexion.php");



        $modi= $_GET['id'];
        $nueva= $_GET['canti'];
        $codi=$_GET['codigo'];
        $detal=$_GET['deta'];
        
        $sql2="SELECT * FROM productos";
        $del=$base->prepare($sql2);
        $del->execute();
        $registro1=$del->fetch(PDO::FETCH_ASSOC);
        $canti=$registro1['existencia'];


        $tot=$canti + $nueva;




    
    try {   
        
        $sql="DELETE FROM detalles WHERE id_factura=:cod ";
        $resultado=$base->prepare($sql);
        $resultado->execute(array(":cod"=>$modi));


        $base->query("DELETE  FROM factura WHERE id_factura='$modi'");



        $sql1="UPDATE  productos SET existencia =:can WHERE codigo_producto=:de";
        $res=$base->prepare($sql1);
        $res->execute(array(":de"=>$codi, ":can" => $tot));

        $base->query("DELETE FROM detalles WHERE detalle='$detal'");


        echo"<script>alert('se anulo correctamente')</script>";
        echo"<script>window.location='inventario.php'</script>";

        $resulta->closeCursor();
    } catch (Exception $th) {
    echo"No se pudo actualizar";
}finally{
    $base=null;
}

?>