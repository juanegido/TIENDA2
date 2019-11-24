<?php
session_start();
include '../global/config.php';
include '../global/conexion.php';
?>

<?php
$nombre = $_POST["nombre"];
$ciudad = $_POST["ciudad"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$administrador = false;
$contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT);

$sql = "INSERT INTO cliente ( nombre, ciudad, telefono, correo, contrasena, id_cliente, administrador) VALUES (:nombre, :ciudad, :telefono, :correo,:contrasena, NULL, :administrador)";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute(array(':nombre' => $nombre, ':ciudad' => $ciudad, ':telefono' => $telefono, ':correo' => $correo, ':contrasena' => $contrasena, ':administrador'=> $administrador));
    $_SESSION['correo'] = $_POST["correo"];
    echo "Inserción completada";
    header('Location:../indexLogin.php');
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    header('Location:../vista/registro.php?fallo1=true');
}

?>