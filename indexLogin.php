<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<?php
    if (!isset($_SESSION['correo'])) {
        echo '<div align="center" class="card" style="background-color:lightblue">';
        echo 'ERROR!! debe registrarse: <a href="vista/login.php"> Login </a> </div>';
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
                window.location.assign("vista/login.php"); </script>';
            }
        }
        echo '<h5 class="card-title">Bienvenid@ a Tachbot: '.$_SESSION['correo'] .'</h5> ';
    
    ?>

        <br>

        <?php if($mensaje!=""){ ?>
            <div class="alert alert-success" role="alert">
                <?php echo $mensaje;?>
                <?php //print_r($_POST);?>
                <a href="mostrarCarrito.php" class="badge badge-success"> Ver carrito </a>
            </div>
        <?php } ?>
        <div class="row">
            <?php
            $sentencia=$pdo->prepare("SELECT * FROM `servicio`");
            $sentencia->execute();
            $listadeProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            //print_r($listadeProductos);
            ?>
            <?php
            foreach($listadeProductos as $producto){?>
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="img/<?php echo $producto['imagen']?>" alt="titulo"
                        data-toggle="popover" data-content="<?php echo $producto['descripcion'];?>"
                        data-trigger="hover" height="250px">
                    <div class="card-body">
                        <span><?php echo $producto['nombre'];?></span>
                        <h5 class="card-title"><?php echo $producto['precio'];?>€</h5>
                        <p class="card-text"><?php echo $producto['descripcion'];?></p>
                        <form action="" method="post">
                            <input type="hidden" name="id" id="id"
                                value="<?php echo openssl_encrypt($producto['id_servicio'],COD,KEY);?>">
                            <input type="hidden" name="nombre" id="nombre"
                                value="<?php echo openssl_encrypt($producto['nombre'],COD,KEY);?>">
                            <input type="hidden" name="precio" id="precio"
                                value="<?php echo openssl_encrypt($producto['precio'],COD,KEY);?>">
                            <input type="hidden" name="cantidad" id="cantidad"
                                value="<?php echo openssl_encrypt(1,COD,KEY);?>">
                            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Agregar al
                                carrito</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php  } ?>
        </div>

    <?php } ?>
        <!-- --------------- JAVASCRIPT --------------------->
        <script>
        $(function() {
            $('[data-toggle="popover"]').popover()
        });
        </script>
<?php include 'templates/pie.php';?>