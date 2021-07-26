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
    Listado de invitados
    </h1>
    
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
    <div class="col-xs-12">
        <div class="box">
        <div class="box-header">
            <h3 class="box-title">Maneja las lista de invitados en esta sección</h3>
        </div> 
        <!-- /.box-header -->
        <div class="box-body">
            <table id="registros" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Biografia</th>
                <th>Imagen</th>
                <th>Acciones</th>               
            </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $sql = "SELECT * FROM invitados";
                    $resultado = $conn->query($sql);

                } catch (Exception $e) {
                    $error = $e->getMessage();
                    echo $error;
                }
                while ($invitados = $resultado->fetch_assoc() ) {?>
                    <tr>
                        <td><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado'] ; ?></td>
                        <td><?php echo $invitados['descripcion']; ?></td>
                        <td><img src="../img/invitados/<?php echo $invitados['url_imagen']?>" width="150px"></td>
                        <td><a href="editar-invitados.php?id=<?php echo $invitados['invitado_id']; ?>" class="btn bg-orange btn-flat margin">
                        |<i class="fa fa-pencil"></i></a>
                            <a href="#" data-id="<?php echo $invitados['invitado_id'];?>" data-tipo="invitados" class="btn bg-maroon btn-flat borrar-registro margin">
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
                <th>Biografia</th>
                <th>Imagen</th>
                <th>Acciones</th>   
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

