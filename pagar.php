<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>


<?php if($_POST){
    $total=0; //lo que se le va a acobrar al ususraio
    $SID= session_id();
    $correo=$_POST['email'];
    $id_cliente=$_SESSION["id_cliente"];
    $count=0;
    foreach($_SESSION['carrito'] as $indice=>$producto){
        $total+=($producto['precio']*$producto['cantidad']);
    }
    //inserta en la tabla venta la informacion 
    $sentencia=$pdo->prepare("INSERT INTO `pedido` (`id_cli`, `fecha_pedido`, `fecha_expiracion`, `precio_total`, `id_pedido`, `reclamacion`, `correo`) VALUES (:id_cli, NOW(), NOW(), :precio_total, NULL, '0', :correo);");
    $sentencia->bindParam(":id_cli",$id_cliente);
    $sentencia->bindParam(":precio_total",$total);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->execute();

    $idPedido=$pdo->lastInsertId(); //ultimo id de pedido

    //inserta en la tabla detalleVenta la informacion
    foreach($_SESSION['carrito'] as $indice=>$producto){
        $sentencia=$pdo->prepare("INSERT INTO `detallepedido` (`id_detalle`, `id_pedido`, `id_serv`, `precioUnitario`, `cantidad`, `descargado`) VALUES (NULL, :id_pedido, :id_serv, :precioUnitario, :cantidad, '0');");
        $sentencia->bindParam(":id_pedido",$idPedido);
        $sentencia->bindParam(":id_serv",$producto['id']);
        $sentencia->bindParam(":precioUnitario",$producto['precio']);
        $sentencia->bindParam(":cantidad",$producto['cantidad']);
        $sentencia->execute();
        
    }
   //echo "<h3>".$total."</h3>";
   $_SESSION['id_pedido']=$idPedido;

}?>

<!--mostramos el paso final (precio que va a pagar el usuario)-->
<div class="jumbotron text-center">
    <h1 class="display-4">¡paso final!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de realizar el pago con Paypal la cantidad:
        <h4><?php echo number_format($total,2); ?>€</h4>
        <div id="paypal-button-container"></div>
        <form name="formTPV" method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
			<input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="upload" value="1">
            <?php foreach($_SESSION['carrito'] as $indice=>$producto){
              $count=$count+"1";
              echo  '<input type="hidden" name="item_name_'.$count.'" value="'.$producto['nombre'].'">';
              echo  '<input type="hidden" name="item_number_'.$count.'" value="'.$producto['id'].'">';
              echo  '<input type="hidden" name="amount_'.$count.'" value="'.$producto['precio'].'">';
              echo  '<input type="hidden" name="quantity_'.$count.'" value="1">';	
            } ?>
			<input type="hidden" name="business" value="tachbot-seller@business.example.com">			
			<input type="hidden" name="return" value="http://localhost/proyecto/php/tienda2/pagoconexito.php">
			<input type="hidden" name="cancel_return" value="http://localhost/proyecto/php/tienda2/pagocancelado.php">
			<input type="hidden" name="no_note" value="1">
			<input type="hidden" name="currency_code" value="EUR">
			<input type="hidden" name="first_name" value="nombrecomprador">
			<input type="hidden" name="last_name" value="apellidocomprador">
			<input type="hidden" name="address1" value="avda. Espa">
			<input type="hidden" name="city" value="albacete">
			<input type="hidden" name="zip" value="02004">
			<input type="hidden" name="lc" value="es">
			<input type="hidden" name="tax_1" value="2">
			<input type="hidden" name="tax_2" value="4">
			<input type="hidden" name="country" value="ES">
            <input type="image" src="https://www.paypalobjects.com/webstatic/es_MX/mktg/logos-buttons/redesign/btn_10.png" name="submit" alt="Pagos con PayPal: Rápido, gratis y seguro">
		</form>
    </p>
    <p>Los productos podrán ser descargados una vez que se procese el pago. <br /><strong>*si tiene alguna duda envienos
            un mensaje a: tachbo7@gmail.com</strong></p>
</div>



<!-- Include the PayPal JavaScript SDK -->

<!--
    <script src="https://www.paypal.com/sdk/js?client-id=AYTWxhnrhxlyAoVdyn__o4WS9aGaAQ37am-mq_-3_413hZVhuMz2romz_gNYNeBCx46R8O-AxTIAfLU6&currency=EUR&commit=true&disable-funding=card,credit,sofort"></script>

<style>
/* Media query for mobile viewport */
@media screen and (max-width: 400px) {
    #paypal-button-container {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }
}

/* Media query for desktop viewport */
@media screen and (min-width: 400px) {
    #paypal-button-container {
        width: 250px;
        margin-left: auto;
        margin-right: auto;
    }
}
</style>
<script>
// Render the PayPal button into #paypal-button-container
paypal.Buttons({
    // Set up the transaction
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?php echo $total ?>'
                },
                description: "Compra de productos a Tachbot:<?php  echo number_format($total,2); ?>€",
                custom_id: "<?php echo $SID;?>#<?php echo openssl_encrypt($idVenta,COD,KEY); ?>" //para identificar la venta y la sesión usada en esa venta (para actualizar BBDD)
            }]
        });
    },

    // Finalize the transaction
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            // Show a success message to the buyer
            console.log(details); //datos de paypal cuando se ha realizado el pago
            //window.location="verificador.php?id="+datails.id;
            alert('Transaction completed by ' + details.payer.name.given_name + '!');
        });
    }


}).render('#paypal-button-container');
</script>
-->

<?php include 'templates/pie.php';?>