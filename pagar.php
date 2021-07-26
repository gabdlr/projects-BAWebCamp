<?php

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
// use PayPal\Api\Details; :( lo elimino
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'includes/paypal.php';

if (isset($_POST['submit'])): 
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $regalo = $_POST['regalo'];
    $total = $_POST['total_pedido'];
    /* Y año, m mes, d dia H horas, i minutos, s segundos*/
    $fecha = date('Y-m-d H:i:s');

    //Pedidos
    $boletos = $_POST['boletos'];
    $numeroBoletos = $boletos;
    $pedidoExtra = $_POST['pedido_extra'];
    $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
    $precioCamisas = $_POST['pedido_extra']['camisas']['precio'];
    $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
    $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];
    include_once 'includes/funciones/funciones.php';
    $pedido = productos_json($boletos, $camisas, $etiquetas);
    
    //Eventos
    $eventos = $_POST['registro'];
    $registro = eventos_json($eventos);

    //Insercion de datos a la BD yay
    
    try {
            require_once('includes/funciones/bd_conexion.php');

            //stmt statement, prepared statements
            $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?,?,?,?,?,?,?,?)" );
            $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);
            $stmt->execute();
            $idRegistro = $stmt->insert_id;
            $stmt->close();
            $conn->close();
            /*Esta funcion la utilizamos para prevenir que un usuario
            envie multiples veces los mismo datos a la base de datos refrescando el navegador
            debe ejecutarse antes de que sea enviado cualquier elemento al navegador
            por eso lo colocamos aca*/
            // header('Location: validar_registro.php?exitoso=1');
    } catch (\Exception $e) {
            echo $e->getMessage();
            }
        endif;

$compra = new Payer();
$compra->setPaymentMethod('paypal');

$i = 0;
$arregloPedido = array();

foreach ($numeroBoletos as $key => $value) {
    if ((int) $value['cantidad'] > 0) {
        ${"articulo$i"} = new Item();
        $arregloPedido[] = ${"articulo$i"};
        ${"articulo$i"}->setName('Pase: ' . $key)
                        ->setCurrency('USD')
                        ->setQuantity((int) $value['cantidad'])
                        ->setPrice((int) $value['precio']);
        $i++;
    }
}

foreach ($pedidoExtra as $key => $value) {
    if ((int) $value['cantidad'] > 0) {

        if ($key == 'camisas') {
            $precio = (float) $value['precio'] * 0.93;
        } else {
            $precio = (int) $value['precio']; 
        }

        ${"articulo$i"} = new Item();
        $arregloPedido[] = ${"articulo$i"};
        ${"articulo$i"}->setName('Extras: ' . $key)
                        ->setCurrency('USD')
                        ->setQuantity((int) $value['cantidad'])
                        ->setPrice($precio);
        $i++;
    }
}

$listaArticulos = new ItemList();
$listaArticulos->setItems($arregloPedido);

/*$detalles = new Details();
$detalles->setShipping($envio)
        ->setSubtotal($precio); Lo elimino :(*/


$cantidad = new Amount();
$cantidad->setCurrency('USD')
        ->setTotal($total);
    
$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
        ->setItemList($listaArticulos)
        ->setDescription('Pago GDLWebCamp')
        ->setInvoiceNumber($idRegistro);

$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO . "pago_finalizado.php?exito=true&id_pago={$idRegistro}")
            ->setCancelUrl(URL_SITIO . "pago_finalizado.php?exito=false&id_pago={$idRegistro}"); //Por que pondria el registro si es false no.

$pago = new Payment();
$pago->setIntent("sale")
    ->setPayer($compra)
    ->setRedirectUrls($redireccionar)
    ->setTransactions(array($transaccion));

try {
    $pago->create($apiContext); 
} catch (PayPal\Exception\PayPalConnectionException $pce) {
    echo "<pre>";
    print_r(json_decode($pce->getData()));
    exit;
    echo "</pre>";

}

$aprobado = $pago->getApprovalLink();
header("Location: {$aprobado}");

