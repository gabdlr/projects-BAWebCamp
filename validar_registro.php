<?php if (isset($_POST['submit'])): 
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $regalo = $_POST['regalo'];
        $total = $_POST['total_pedido'];
        /* Y año, m mes, d dia H horas, i minutos, s segundos*/
        $fecha = date('Y-m-d H:i:s');

        //Pedidos
        $boletos = $_POST['boletos'];
        $camisas = $_POST['pedido_camisas'];
        $etiquetas = $_POST['pedido_etiquetas'];
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
                $stmt->close();
                $conn->close();
                /*Esta funcion la utilizamos para prevenir que un usuario
                envie multiples veces los mismo datos a la base de datos refrescando el navegador
                debe ejecutarse antes de que sea enviado cualquier elemento al navegador
                por eso lo colocamos aca*/
                header('Location: validar_registro.php?exitoso=1');
        } catch (\Exception $e) {
                echo $e->getMessage();
            }
        ?>
<?php endif;?>
