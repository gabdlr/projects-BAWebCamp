<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';
?>





<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Listado de registros
    </h1>
    
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header">
            <h3 class="box-title">Maneja los registros en esta sección</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="registros" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha Registro</th>
                <th>Articulos</th>
                <th>Talleres</th>
                <th>Regalo</th>
                <th>Compra</th>
                <th>Acciones</th>                 
            </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $sql = " SELECT registrados.*, regalos.nombre_regalo FROM registrados ";
                    $sql .= " JOIN regalos ";
                    $sql .= "ON registrados.regalo = regalos.ID_regalo";    
                    $resultado = $conn->query($sql);

                } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                }
                while ($registrados = $resultado->fetch_assoc()) {?>
                    <tr>
                        <td><?php echo $registrados['nombre_registrado'] . " " . $registrados['apellido_registrado']; 
                            $pagado = $registrados['pagado'];
                            if ($pagado == 1) {
                                echo '<span class="badge bg-green">Pagado</span>';
                            } else {
                                echo '<span class="badge bg-red">No pagado</span>';
                            }
                        
                        
                        ?></td>
                        <td><?php echo $registrados['email_registrado']; ?></td>
                        <td><?php echo $registrados['fecha_registro']; ?></td>
                        <td>
                            <?php $articulos = json_decode($registrados['pases_articulos'], true);
                            //True me retorna el json como un array de lo contrario seria accedido como un objeto
                            $arreglo_articulos = array(
                                'un_dia' => 'Pase 1 dia',
                                'pase_2dias' => 'Pase 2 dias',
                                'pase_completo' => 'Pase completo',
                                'camisas' => 'Camisas',
                                'etiquetas' => 'Etiquetas'
                            
                            );
                            foreach ($articulos as $key => $articulo) {
                                //Esta solucion me parecio super pirata pero bueno
                                if (array_key_exists('cantidad',$articulo)) {
                                echo $articulo['cantidad'] . " " . $arreglo_articulos[$key] . "<br>";
                                } else 
                                echo $articulo . " " . $arreglo_articulos[$key] . "<br>";
                            } ?>
                        </td>
                        <td>
                            <?php 
                                $evento_resultado = $registrados['talleres_registrados'];
                                $talleres = json_decode($evento_resultado, true);
                                //Funcion implode
                                $talleres = implode("', '", $talleres['eventos']);
                                $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE clave IN ('$talleres') OR evento_id IN ('$talleres') ";
                                $resultado_talleres = $conn->query($sql_talleres);
                                while ( $eventos = $resultado_talleres->fetch_assoc() ){
                                    echo utf8_encode($eventos['nombre_evento']) . " " . $eventos['fecha_evento'] . " " . $eventos['hora_evento'] . "<br>";
                                }                            
                            ?>
                        </td>
                        <td><?php echo $registrados['nombre_regalo']; ?></td>
                        <td>$ <?php echo $registrados['total_pagado']; ?></td>
                        <td><a href="editar-registro.php?id=<?php echo $registrados['ID_Registrado']; ?>" class="btn bg-orange btn-flat margin">
                        |<i class="fa fa-pencil"></i></a>
                            <a href="#" data-id="<?php echo $registrados['ID_Registrado'];?>" data-tipo="registrado" class="btn bg-maroon btn-flat borrar-registro margin">
                        |<i class="fa fa-trash"></i></a>
                        </td> 
                    </tr>                 
                <?php
                }
                ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha Registro</th>
                <th>Articulos</th>
                <th>Talleres</th>
                <th>Regalo</th>
                <th>Compra</th>
                <th>Acciones</th>   
            </tr>
            </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
</div>
</div>
<!-- /.content-wrapper -->

<?php

include_once 'templates/footer.php';

?>