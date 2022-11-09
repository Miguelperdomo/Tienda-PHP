<?php
    include("../conexion/conexion.php");


    $id=$_GET["id"];
    if (isset($_GET['cedu'])){
        $docu=$_GET['cedu'];
        $nombre=$_GET['nombc'];
        $ape=$_GET['ape'];
        $celu=$_GET['celu'];
        $ubic=$_GET['dir'];
        $ven=$_GET['idd'];
        $nomven=$_GET['nombb'];
    }

    $borrar=("DELETE FROM temporal WHERE detalle=:co");
    $sentencia=$base->prepare($borrar);
    $sentencia->execute(array(":co"=>$id));

    header("Location: detalletemp.php?ide=$docu & nomb=$nombre  & ape=$ape & tele=$celu & dir=$ubic & id=$ven & nombre= $nomven");


?> 