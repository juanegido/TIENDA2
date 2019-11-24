<?php
//------------------------------CONEXION PDO----------------------

//creamos la cadena de conexion a traves del archivo config.php
$servidor="mysql:dbname=".BD.";host=".SERVIDOR;

try{
    //creamos variable PDO a traves de una nueva instancia PDO (parametros de archivo config.php)
    //para crear una conexion a la BBDD
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
    //echo "<script>alert('Conectado con la bbdd...')</script>";

}catch(PDOException $e){

    //echo "<script>alert('Error al conectar con la bbdd...')</script>";
}

?>