<?php
session_start();
include '../global/config.php';
include '../global/conexion.php';
include '../templates/cabecera_admin.php';
?>

<?php
        ###################################################################
        //----------Comprobamos sesion y si es administrador-----//
        ###################################################################
    if (!isset($_SESSION['correo']) ||  $_SESSION['administrador']==false) { //comprobamos que se haya logueado como administrador
        echo '<div align="center" class="card" style="background-color:lightblue">';
        echo 'ERROR!! debe registrarse con una cuenta válida: <a href="login.php"> Login </a> </div>';
    } else { //si la sesión existe 
        if (isset($_SESSION['ultimoAcceso'])) { //comprueba que no haya pasado x tiempo desde la sesion
            $ahora = time();
            $antes = $_SESSION['ultimoAcceso'];
            $_SESSION['ultimoAcceso'] = $ahora;
            if ($ahora - $antes > 3600) {
                $_SESSION = array(); //eliminamos las variables de sesión
                session_destroy();
                //eliminamos las cookies de sesión:
                $paramCookies = session_get_cookie_params();
                setcookie(session_name(), 0, time() - 3600, $paramCookies["path"]);
                echo '<script type="text/javascript">
                alert("Sesión expiró. Vuelve a loguearte");
                window.location.assign("login.php"); </script>';
            }
        }

        
        echo '<h5 class="card-title">Bienvenid@ a la página de administración de Tachbot: '.$_SESSION['correo'] .'</h5> ';
        ###################################################################
        //-----------------XML muestra el contenido de: xml servicios---------------//
        ###################################################################
        $archivo = simplexml_load_file("../xml/servicio.xml");
        echo "<br><h5>DATOS DEL XML 'SERVICIOS'</h5>";
        foreach ($archivo as $indice=>$servicio){
            echo "Nombre: ".$servicio->nombre."<br>";
            echo "Id: ".$servicio->id_servicio."<br>";
            echo "Precio: ".$servicio->precio."<br>";
            echo "Descripcion: ".$servicio->descripcion."<br>";
            echo "Imagen: ".$servicio->imagen."<br>";
        echo "----------------------------------------------- <br>";
        }
       
 } ?>

<!--
        ##########################################################################################
        //---------AJAX que llama a funcion php para insertar XML en la tabla (BBDD)------------//
        #########################################################################################
-->

<input type="submit" name="" value="Insertar XML:servicio" onclick="insertar();">
<script src="../js/jquery-3.4.1.js"></script>
<script>
function insertar() {
    $.ajax({
        type: 'POST', //aqui puede ser igual get
        url: '../xml/funcionesAdmin.php', //aqui va tu direccion donde esta tu funcion php
        //data: $(this).serialize(),
        success: function(data) {
            //lo que devuelve tu archivo mifuncion.php
            alert(data);
        },
        error: function(data) {
            //lo que devuelve si falla tu archivo mifuncion.php
            alert(data);
        }
    });
}
</script>

<?php include '../templates/pie.php';?>