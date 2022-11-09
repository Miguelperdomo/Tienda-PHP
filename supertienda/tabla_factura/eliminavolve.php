<?php

    include("../conexion/conexion.php");


        $sql="DELETE FROM temporal";
        $resultado=$base->prepare($sql);
        $resultado->execute(array());

        header("Location: index.php");

?>

