<?php
session_start();
include '../global/config.php';
include '../global/conexion.php';
?>
<?php
################################CONSULTA PREPARDA PDO######################


//obtener valores de formulario
$correo = $_SESSION['correo'];
$id_cli = $_SESSION['id_cliente'];
//SQL con marcadores
$sql = "SELECT * FROM pedido where id_cli=:id_cli";
//preparar
$stmtPDO = $pdo->prepare($sql);
//vincular y ejecutar (con array)
$stmtPDO->execute(array('id_cli' => $id_cli));


if (!$stmtPDO) {
    die("No se puede realizar la consulta $conexion->errno: $conexion->error");
}

// Mostramos una tabla con el resultado de la consulta
echo "<center><h1>TABLA PEDIDO DE LA BBDD=TACHBOT</h1><br><br>";
echo "<center><table border=2><tr> <th>CLIENTE</th> <th>FECHA PEDIDO</th>  <th>FECHA EXPIRACION</th> <th>PRECIO TOTAL</th> <th>ID PEDIDO</th> <th>RECLAMACION</th></tr>";
//$registro = $stmtPDO->fetch(PDO::FETCH_ASSOC);

while($registro = $stmtPDO->fetch()){
    echo "</tr>";
    echo "<td>" . $registro['id_cli'] . "</td>";
    echo "<td>" . $registro['fecha_pedido'] . "</td>";
    echo "<td>" . $registro['fecha_expiracion'] . "</td>";
    echo "<td>" . $registro['precio_total'] . "</td>";
    echo "<td>" . $registro['id_pedido'] . "</td>";
    echo "<td>" . $registro['reclamacion'] . "</td>";
    echo "</tr>";
 }

?>