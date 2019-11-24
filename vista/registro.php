<?php

include '../global/config.php';
include '../global/conexion.php';
include '../templates/cabecera_anteslogin.php';
?>

<!--tarjetas (contenido)-->
<!--contenido REGISTRO-->
<div align="center" class="card" style="background-color:lightblue">
    <legend>REGISTRO</legend>
    <form action="../controlador/procesoregistro.php" method="POST">
        Introduzca su correo:<br>
        <input type="email" size="40" maxlength="64" name="correo" required /><br><br>
        Introduzca su contraseña:<br>
        <input type="password" size="40" name="contrasena" required /><br><br>
        Introduzca su Nombre:<br>
        <input type="text" size="40" maxlength="64" NAME="nombre" /><br><br>
        Introduzca su Ciudad:<br>
        <input type="text" size="40" maxlength="64" NAME="ciudad" /><br><br>
        Introduzca su Telefono:<br>
        <input type="text" size="40" maxlength="64" NAME="telefono" /><br><br>
        <input type="submit" name="btnlog" value="Enviar" class="btn btn-primary" />
        <input type="reset" name="borrar" value="Borrar" class="btn btn-primary" />
        <br>
        <?php
			//FEEDBACK para incorrecto
			if (isset($_GET["fallo1"]) && ($_GET["fallo1"]) == 'true') {
				echo "</br><div align='center' style='color:red'>Error al registrar.<br>Vuelva a intentarlo</div>";
			}
			?>
    </form>
</div>

<!--JAVA SCRIPT-->
<!-- <script src="https://account.snatchbot.me/script.js"></script><script>window.sntchChat.Init(74039)</script> 
	-->
</body>

</html>

<?php include '../templates/pie.php';?>