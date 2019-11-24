<?php
include '../global/config.php';
include '../global/conexion.php';


try {
    $archivo = simplexml_load_file("servicio.xml");
    foreach ($archivo->children() as $servicio) {
        $nombre = $servicio->nombre;
        $id_servicio = $servicio->id_servicio;
        $precio = $servicio->precio;
        $descripcion = $servicio->descripcion;
        $imagen = $servicio->imagen;

        $sentencia = $pdo->prepare("INSERT INTO `servicio` (`nombre`, `id_servicio`, `precio`, `descripcion`, `imagen`) VALUES (:nombre, :id_servicio, :precio, :descripcion, :imagen);");
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":id_servicio", $id_servicio);
        $sentencia->bindParam(":precio", $precio);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":imagen", $imagen);
        $sentencia->execute();

        echo 'INSERTANDO...';
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
