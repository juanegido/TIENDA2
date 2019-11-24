<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

<?php //comprobamos que que se haya logueado (sesion)
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
    
    ?>

<br>
<h3>Lista del carrito</h3>
<?php if(!empty($_SESSION['carrito'])){?>

<table class="table table-bordered">
    <tbody>
        <!--cabecera de la tabla-->
        <tr>
            <th width="40%">Descripción</th>
            <th width="15%" class="text-center">Cantidad</th>
            <th width="20%" class="text-center">Precio</th>
            <th width="20%" class="text-center">Total</th>
            <th width="5%">--</th>
        </tr>
        <?php $total=0;?>
        <!--datos que se encluyen dentro de la tabla-->
        <?php foreach($_SESSION['carrito'] as $indice=>$producto){ ?>
        <tr>
            <td width="40%"><?php echo $producto['nombre'];?></td>
            <td width="15%" class="text-center"><?php echo $producto['cantidad'];?></td>
            <td width="20%" class="text-center"><?php echo $producto['precio'];?></td>
            <td width="20%" class="text-center"><?php echo number_format($producto['precio']*$producto['cantidad'],2);?>
            </td>
            <td width="5%">
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id'],COD,KEY);?>">
                    <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php $total=$total+$producto['precio']*$producto['cantidad'];?>
        <?php } //cierre foreach?>
        <tr>
            <td colspan="3" align="right">
                <h3>Total</h3>
            </td>
            <td align="right">
                <h3><?php echo number_format($total,2);?>€</h3>
            </td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
                <form action="pagar.php" method="post">
                    <div class="alert alert-success">
                        <div class="form-group">
                            <label for="my-input">Correo de contacto:</label>
                            <input id="email" name="email" class="form-control" type="email"
                                placeholder="por favor escribe tu correo" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">Los productos se enviaran a este
                            correo</small>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnAccion"
                        value="Proceder">Proceder a pagar >></button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
<?php }else{ ?>
<div class="alert alert-success"> No hay productos en el carrito </div>
<?php } ?>
<?php } ?>


<?php include 'templates/pie.php';?>