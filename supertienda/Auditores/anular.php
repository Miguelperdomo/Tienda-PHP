<?php

session_start();
require("../conexion/conexion.php");


        $sql3="SELECT MAX(id_estado) as last_id FROM estado";
        $sel=$base->prepare($sql3);
        $sel->execute(array());
        $estado=$sel->fetch(PDO::FETCH_ASSOC);
        $esta=$estado['last_id'];

        $modi= $_GET['id'];
        $nueva= $_GET['canti'];
        $codi=$_GET['codigo'];
        $detal=$_GET['deta'];
        $canti=$_GET['cantip'];
        

        $tot=$canti + $nueva;




    
    try {   
        


        
        $sql1="UPDATE  factura SET id_estado=:can WHERE id_factura=:de";
        $res=$base->prepare($sql1);
        $res->execute(array(":de"=>$modi, ":can" => $esta));




        $sql1="UPDATE  productos SET existencia=:can WHERE codigo_producto=:de";
        $res=$base->prepare($sql1);
        $res->execute(array(":de"=>$codi, ":can" => $tot));



        echo"<script>alert('se anulo correctamente')</script>";
        echo"<script>window.location='inventario.php'</script>";

        $resulta->closeCursor();
    } catch (Exception $th) {
    echo"No se pudo actualizar";
}finally{
    $base=null;
}

?>