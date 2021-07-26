<?php
    include_once 'funciones/funciones.php';
    $nombre = $_POST['nombre_invitado'];
    $apellido = $_POST['apellido_invitado'];
    $biografia = $_POST['biografia_invitado'];
    $id_registro = $_POST['id_registro'];

if($_POST['registro'] == "nuevo") {

        /* Para comprobar que se envia todo correctamente
        $respuesta = array(
            'post' => $_POST,
            'file' => $_FILES
        );
        */

        //Aca se van a guardar las imagenes de los invitados
        $directorio = "../img/invitados/";
        
        //Esto crear la carpeta invitados en caso de que no exista los parametros se refieren a los permisos 
        //(esta sintaxis es de linux/unix)
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        //Mueve los archivos de la carpeta temporal a la carpeta que designamos para guardar las imagenes
        if(move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $_FILES['archivo_imagen']['name'])){
            $imagen_url = $_FILES['archivo_imagen']['name'];
            $imagen_resultado = "Cargado correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        };


        try {
        $stmt = $conn->prepare("INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $nombre, $apellido, $biografia, $imagen_url);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado,
                'resultado_imagen' => $imagen_resultado
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
            
        }
        die(json_encode($respuesta));
}

if($_POST['registro'] == "actualizar") {

    $directorio = "../img/invitados/";
        
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        if(move_uploaded_file($_FILES['archivo_imagen']['tmp_name'], $directorio . $_FILES['archivo_imagen']['name'])){
            $imagen_url = $_FILES['archivo_imagen']['name'];
            $imagen_resultado = "Cargado correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        };
    
        try {
            if ($_FILES['archivo_imagen']['size'] > 0) {
                //Cuando cambia la imagen
                $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen = ?, editado = NOW() WHERE invitado_id = ?");
                $stmt->bind_param('ssssi', $nombre, $apellido, $biografia, $imagen_url, $id_registro);                
            } else {
                //No cambia la imagen
                $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, editado = NOW() WHERE invitado_id = ?");
                $stmt->bind_param('sssi', $nombre, $apellido, $biografia, $id_registro);
            }
            $stmt->execute();
            $registros = $stmt->affected_rows;
       
                if ($registros >0) {
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'id_actualizado' => $id_registro
                    );
                }  
                else {
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }

            $stmt->close();
            $conn->close();
    }   catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            ); 
        }

        die(json_encode($respuesta));
    }

if($_POST['registro'] == "eliminar") {
    $id_borrar = $_POST['id'];

    try {
        $stmt = $conn->prepare('DELETE FROM invitados WHERE invitado_id = ?');
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute();
            if($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_eliminado' => $id_borrar
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }

    } catch (Exception $e) {
        $respuesta  = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}
