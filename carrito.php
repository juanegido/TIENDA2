<?php
session_start();

$mensaje="";

if(isset($_POST['btnAccion'])){ //si se ha presionado el boton 'Añadir al carrito' sobre un producto concreto.
    switch($_POST['btnAccion']){//como parametro se le pasa el valor del boton
        case 'Agregar'://si el valor del boton es agregar
            //COMPROBAMOS QUE LA INFORMACIÓN (que desea comprar el ususario) NO HAYA SIDO MANIPULADA:
            //para el id del producto.
            if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){ //comprobamos si al desencriptar la informacion es un numero 
                $id_prod=openssl_decrypt($_POST['id'],COD,KEY);//se asigna el id_prod
                $mensaje.="Ok ID ".$id_prod." correcto"."</br>";
            }else{
                $mensaje.="Ups... ID ".$id_prod." incorrecto"."</br>";
            }
            //para el nombre
            if(is_string( openssl_decrypt($_POST['nombre'],COD,KEY))){ //comprobamos si al desencriptar la informacion es un numero 
                $nombre=openssl_decrypt($_POST['nombre'],COD,KEY);//se asigna el id_prod
                $mensaje.="Ok nombre ".$nombre." correcto"."</br>";
            }else{
                $mensaje.="Ups... nombre ".$nombre." incorrecto"."</br>";
            }
            //para el cantidad
            if(is_numeric( openssl_decrypt($_POST['cantidad'],COD,KEY))){ //comprobamos si al desencriptar la informacion es un numero 
                $cantidad=openssl_decrypt($_POST['cantidad'],COD,KEY);//se asigna el id_prod
                $mensaje.="Ok cantidad ".$cantidad." correcto"."</br>";
            }else{
                $mensaje.="Ups... cantidad ".$cantidad." incorrecto"."</br>";
            }
            //para el precio
            if(is_numeric( openssl_decrypt($_POST['precio'],COD,KEY))){ //comprobamos si al desencriptar la informacion es un numero 
                $precio=openssl_decrypt($_POST['precio'],COD,KEY);//se asigna el id_prod
                $mensaje.="Ok precio ".$precio." correcto"."</br>";
            }else{
                $mensaje.="Ups... precio ".$precio." incorrecto"."</br>";
            }
        //COMPROBAMOS si no se creo la session_carrito para crearla con la información que el usuario ha seleccionado
        if(!isset($_SESSION['carrito'])){
            $producto=array('id'=>$id_prod,'nombre'=>$nombre,'cantidad'=>$cantidad,'precio'=>$precio);
            $_SESSION['carrito'][0]=$producto;
            $mensaje="Producto agregado al carrito";
        }else{//si ya se habia creado la sesion_carrito se continuan añadiendo lineas
            $idProductos=array_column($_SESSION['carrito'],"id"); //guardamos todos los id's existentes en el carrito
            if(in_array($id_prod,$idProductos)){//restringimos que se compre dos veces el mismso producto
                echo "<script>alert('El producto ya ha sido añadido al carrito');</script>"; 
                $mensaje="";//sobreescribe el mensaje, para no montrar informacion del producto.
            }else{

            $NumProd=count($_SESSION['carrito']);
            $producto=array('id'=>$id_prod,'nombre'=>$nombre,'cantidad'=>$cantidad,'precio'=>$precio);
            $_SESSION['carrito'][$NumProd]=$producto;
            $mensaje="Producto agregado al carrito";
            }
        }
        //$mensaje=print_r($_SESSION, true);

        break;

        case 'Eliminar'://si el valor del boton es eliminar
            if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){ //comprobamos si al desencriptar la informacion es un numero 
                $id_prod=openssl_decrypt($_POST['id'],COD,KEY);//se asigna el id_prod
                foreach($_SESSION['carrito'] as $indice=>$producto){
                    if($producto['id']==$id_prod){
                        unset($_SESSION['carrito'][$indice]);
                        echo "<script>alert('Elemento borrado');</script>";
                    }
                }
                
                $mensaje.="Ok cantidad ".$id_prod." correcto"."</br>";
            }else{
                $mensaje.="Ups... cantidad ".$id_prod." incorrecto"."</br>";
            }
        

        break;


        
    }
}