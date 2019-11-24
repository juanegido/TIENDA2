<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'templates/cabecera.php';
session_start();
echo "<script>
                alert('ERROR!!PAGO CANCELADO.........');
                window.location= 'indexLogin.php'
    </script>";
echo "ERROR!!PAGO CANCELADO.........";

    //Borramos el pedido que ha sido cancelado
    $id_pedido=$_SESSION['id_pedido'];
    echo $id_pedido;
    $sentencia=$pdo->prepare("DELETE FROM `pedido` WHERE id_pedido=$id_pedido");
    $sentencia->execute();


?>