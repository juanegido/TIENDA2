<?php
session_start();
include '../global/config.php';
include '../global/conexion.php';
?>

<?php

if (isset($_SESSION['usuario'])) { /* Comrpobamos si la sesión estaba iniciada */
	echo '<p> Sesión iniciada previamente </p>';
	header('Location:../indexLogin.php');
}

if (isset($_POST['correo']) && isset($_POST['contrasena'])) { /* Si hay algo en usuario y contraseña */
	if ($_POST['correo'] != "" && $_POST['contrasena'] != "") { /* Y no está vacío */
		$sql_select = "SELECT * FROM cliente WHERE correo='" . $_POST["correo"] . "'"; /* Seleccionar el cliente que se corresponde al usuario introducido */
		$resultado_select = $pdo->query($sql_select); /* Realizamos la consulta y almacenamos en resultado_select */
		if ($resultado_select) { /* Si hay resultado */
			$usuario_select = $resultado_select->fetch(PDO::FETCH_ASSOC); /* Recorremos las consultas */
			if (password_verify($_POST["contrasena"], $usuario_select['contrasena'])) { /* Si las contraseñas coinciden */
				$_SESSION["correo"] = $_POST["correo"]; /* Guardamos la sesion del usuario */
				$_SESSION["id_cliente"] = $usuario_select["id_cliente"];
				$_SESSION["ultimoAcceso"] = time();
				if(isset($_POST['recordar'])) {
					setcookie("correo",$_POST["correo"] , time() + 60*60*24*365);
				}
				header('Location: ../indexLogin.php'); /* Y nos redirigimos a home */
			} else {
				header('Location: ../vista/login.php?fallo1=true'); /* Si la contraseña no esta asociada a ese usuario volvemos a intentarlo */
			}
		}
	}
}

?>

