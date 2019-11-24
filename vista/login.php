<?php
include '../global/config.php';
include '../global/conexion.php';
include '../templates/cabecera_anteslogin.php';
?>


    <!--tarjetas (contenido)-->
    <!--contenido LOGIN-->
    <div align="center" class="card" style="background-color:lightblue" id="box">
        <legend>LOGIN</legend>
        <form action="../controlador/consultalogin.php" method="POST">
            Introduzca su correo:<br>
            <input type="email" size="40" maxlength="64" name="correo" required id="correo" /><br><br>
            Introduzca su contraseña:<br>
            <input type="password" size="40" name="contrasena" id="contrasena" required /><br><br>
            <input type="checkbox" name="recordar" value="recordar"> Recordar durante 1 año<br><br>
            <input type="submit" name="btnlog" value="Enviar" class="btn btn-primary" id="Enviar" />
            <input type="reset" name="borrar" value="Borrar" class="btn btn-primary" />
            <div id="error"></div>

            <?php
			//FEEDBACK para incorrecto
			if (isset($_GET["fallo1"]) && $_GET["fallo1"] == 'true') {
				echo "</br><div align='center' style='color:red'>Usuario o contraseña invalido.<br>Vuelva a intentarlo</div>";
			}
			?>
        </form>

        <div align="center">
            <u> <a style="color:blue" href="registro.php">registrarme</a> </u>
        </div>
        <br>
    </div>


    <!--JAVA SCRIPT-->
    <!--<script src="https://account.snatchbot.me/script.js"></script><script>window.sntchChat.Init(74039)</script> -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>


<?php include '../templates/pie.php';?>