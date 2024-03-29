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
        Crear administrador
        <small>completa el formulario para crear un nuevo administrador</small>
      </h1>
      
    </section>
      <div class="row">
        <div class="col-md-8">
        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Crear Administrador</h3>

            
          </div>
          <div class="box-body">
          <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-admin.php">
                <div class="box-body">
                  <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input name="usuario" type="text" class="form-control" id="usuario">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input name="nombre" type="text" class="form-control" id="nombre">
                  </div>
                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input name="password" type="password" class="form-control" id="password">
                  </div>
                  <div class="form-group">
                    <label for="password">Repetir Password:</label>
                    <input name="repetir_password" type="password" class="form-control" id="repetir_password">
                    <span id="resultado_password" class="help-block"></span>
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <input type="hidden" name="registro" value="nuevo">
                  <button type="submit" class="btn btn-primary">Añadir</button>
                </div>
              </form>
          </div>
          <!-- /.box-body -->
          
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
        </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

<?php

include_once 'templates/footer.php';

?>

