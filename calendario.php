<?php include_once 'includes/templates/header.php'; ?>
    <body class="conferencias">
   
    <!--seccion-->
    <section class="seccion contenedor">
        <h2>Calendario de eventos</h2>
        <?php try {
            require_once('includes/funciones/bd_conexion.php');
            $sql = " SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`,`nombre_invitado`, `apellido_invitado` ";
            $sql .= " FROM `eventos` ";
            $sql .= " INNER JOIN `categoria_evento` ";
            $sql .= " ON `eventos`.`id_cat_evento` = `categoria_evento`.`id_categoria` ";
            $sql .= " INNER JOIN `invitados` ";
            $sql .= " ON `eventos`.`id_inv` = `invitados`.`invitado_id` ";
            $sql .= " ORDER BY `evento_id` ";
            $resultado = $conn->query($sql);
        } 
        catch (\Exception $e) {
            echo $e->getMessage();
        } ?>
        <div class="calendario clearfix">

            <?php 
            //Creamos un array que se va a llenar luego con nuestro otro array ($evento)
            $calendario = array();
             while($eventos = $resultado->fetch_assoc() ) {

            //Ordena por fecha 
            $fecha = $eventos['fecha_evento'];
            //Ordena por categoria
            $categoria = $eventos['cat_eventos'];
             $evento = array(
                 'titulo' => $eventos['nombre_evento'],
                 'fecha' => $eventos['fecha_evento'],
                 'hora' => $eventos['hora_evento'],
                 'categoria' => $eventos['cat_evento'],
                 'icono' => $eventos['icono'],
                 'invitado' => $eventos['nombre_invitado'] . " " . $eventos['apellido_invitado']
             );
             //La variable que corresponde al orden que deseemos implementar en el primer corchete
             $calendario[$fecha][] = $evento; ?>
             <?php } //While del fetch assoc?>
             <?php
             //Imprime todos los eventos
             foreach($calendario as $dia => $lista_eventos) {?>
                <h3 class="clearfix titles"><i class="fas fa-calendar">
                    <?php
                    //Toda la mierda a continuacion es para mostrar las fechas
                    //Unix
                    setLocale(LC_TIME, 'es_ES.UTF-8');
                    //Windows
                    setLocale(LC_TIME, 'spanish');
                     echo strftime("%d de %B del %Y ", strtotime($dia) ); ?>
                     </i></h3>
                     <?php foreach($lista_eventos as $evento) {?>
                        <div class="dia">
                            <p class="titulo"><?php echo utf8_encode($evento['titulo']); ?></p>
                            <p class="hora"><i class="fas fa-clock-o" aria-hidden="true"></i>
                            <?php echo $evento['fecha'] . " " . $evento['hora']; ?></p>
                            <p><i class="<?php echo $evento['icono']; ?>" aria-hidden="true"></i>
                                <?php echo $evento['categoria']; ?></p>
                            <p class="hora"><i class="fas fa-user" aria-hidden="true"></i>
                            <?php echo $evento['invitado']; ?></p>
                        </div>
                    <?php }; 
                    //fin foreach eventos-?>
                     <?php } //fin foreach de dias?>
        </div>
        <?php $conn->close();?>
    </div>
    </section>
    <?php include_once 'includes/templates/footer.php'; ?>