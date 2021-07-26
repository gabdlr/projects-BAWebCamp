<?php include_once 'includes/templates/header.php'; ?>
    <section class="seccion contenedor">
        <h2>La mejor conferencia de diseño web en español</h2>
        <p>Phasellus ut posuere quam. Duis ac suscipit tortor. Ut iaculis vitae ante sed scelerisque. Donec sed venenatis nisi. Praesent maximus sem id iaculis imperdiet. In eleifend magna at ligula porta tempor. Fusce porttitor commodo porta.</p>
    </section>
    <!--seccion-->
    <section class="programa">
        <div class="contenedor-video">
            <video autoplay="" muted="" loop="" poster="img/bg-talleres.jpg">
                <source src="video/video.mp4" type="video/mp4">
                <source src="video/video.webm" type="video/webm">
                <source src="video/video.ogv" type="video/ogg">
            </video>
        </div>
        <!--.contenedor-video-->
        <div class="contenido-programa">
            <div class="contenedor">
                <div class="programa-evento">
                    <h2>Programa del evento</h2>
                    <?php try {
            require_once('includes/funciones/bd_conexion.php');
            $sql = " SELECT * FROM `categoria_evento`";
            $resultado = $conn->query($sql);
        } 
        catch (\Exception $e) {
            echo $e->getMessage();
        }?>
        <nav class="menu-programa">
        <?php while($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
        <?php $categoria = $cat['cat_evento']; ?>
            <a href="#<?php echo strtolower($categoria); ?>">
            <i class="<?php echo $cat['icono']; ?>" aria-hidden="true"></i>
            <?php echo $categoria; ?></a>
        <?php } ?>
                    </nav>

        <?php try {
            require_once('includes/funciones/bd_conexion.php');
            //Como es un multi query despues de finalizar cada consulta hay que colocar ;
            $sql = " SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`,`nombre_invitado`, `apellido_invitado` ";
            $sql .= " FROM `eventos` ";
            $sql .= " INNER JOIN `categoria_evento` ";
            $sql .= " ON `eventos`.`id_cat_evento` = `categoria_evento`.`id_categoria` ";
            $sql .= " INNER JOIN `invitados` ";
            $sql .= " ON `eventos`.`id_inv` = `invitados`.`invitado_id` ";
            $sql .= "AND eventos.id_cat_evento = 1";
            //Limit 2 establece cuantos elementos de la consulta se va a traer
            //La siguiente linea seria el final de esta consulta por ello hay un ; despues de LIMIT 2
            $sql .= " ORDER BY `evento_id` LIMIT 2 ;";
            //Multiconsulta
            $sql .= " SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`,`nombre_invitado`, `apellido_invitado` ";
            $sql .= " FROM `eventos` ";
            $sql .= " INNER JOIN `categoria_evento` ";
            $sql .= " ON `eventos`.`id_cat_evento` = `categoria_evento`.`id_categoria` ";
            $sql .= " INNER JOIN `invitados` ";
            $sql .= " ON `eventos`.`id_inv` = `invitados`.`invitado_id` ";
            //Esta es la linea que cambia para esta consulta (de la id_cat_evento 1 a la 2 y luego sera a la 3)
            $sql .= "AND eventos.id_cat_evento = 2";
            $sql .= " ORDER BY `evento_id` LIMIT 2 ;";
            $sql .= " SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`,`nombre_invitado`, `apellido_invitado` ";
            $sql .= " FROM `eventos` ";
            $sql .= " INNER JOIN `categoria_evento` ";
            $sql .= " ON `eventos`.`id_cat_evento` = `categoria_evento`.`id_categoria` ";
            $sql .= " INNER JOIN `invitados` ";
            $sql .= " ON `eventos`.`id_inv` = `invitados`.`invitado_id` ";
            $sql .= "AND eventos.id_cat_evento = 3";
            $sql .= " ORDER BY `evento_id` LIMIT 2 ;";   
        } 
        catch (\Exception $e) {
            echo $e->getMessage();
        }?>
                <?php $conn->multi_query($sql); ?>
                <?php 
                //store_result, more_results y next_result son funciones de mysqli
                
                do {
                            $resultado = $conn->store_result();
                            $row = $resultado->fetch_all(MYSQLI_ASSOC); ?>
                            <?php $i= 0; ?>
                            <?php foreach($row as $evento): ?>
                            <?php
                            //Esto significa si el modulo de i es 0 es decir que i es un numero par
                            //De esta manera este div solo se creara uno por cada categoria y no en
                            //cada iteracion del foreach
                                 if($i % 2 == 0) {?>
                            <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">
                                 <?php } ?>
                        <div class="detalle-evento">
                            <h3><?php 
                            //Utf8_encode para sortear los caracteres como acentos, etc (a veces va, a veces no, depende de la db)
                            echo utf8_encode($evento['nombre_evento']); ?></h3>
                            <p><i class="far fa-clock"></i><?php echo $evento['hora_evento']; ?></p>
                            <p><i class="fas fa-calendar-alt"></i><?php echo $evento['fecha_evento']; ?></p>
                            <p><i class="fas fa-user"></i><?php echo $evento['nombre_invitado']; ?></p>
                        </div>
                        <?php 
                        //Esto solo se imprime luego de una consulta impar
                        if($i % 2 == 1): ?>
                            <a href="/calendario.php" class="button float-right">Ver todos</a>
                            </div><!--Talleres-->
                            <?php endif ; ?>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                    <?php
                    //Tras hacer unmulti query hay que liberar la consultacon esta funcion/metodo/ w/e (free())
                    $resultado->free(); ?>
                    <?php    } while 
                                   ( $conn->more_results() && $conn->next_result() );
                                 ?>
                    <!--Seminarios-->
                </div>
                <!--.programa-evento-->
            </div>
            <!--.contenedor-->
        </div>
        <!--.contenido-programa-->
    </section>
    <!--.programa-->
    <?php include_once 'includes/templates/invitados.php'; ?>
        <!--.contenedor-->
    	<div class="contador parallax">
		<div class="contenedor">
			<ul class="resumen-evento clearfix">
			<li><p class="numero">6</p> Invitados</li>
			<li><p class="numero">15</p> Talleres</li>
			<li><p class="numero">3</p> Dias</li>
			<li><p class="numero">9</p> Conferencias</li>
		</div>
	</div>
    <!--.contador-->
    <section class="precios seccion">
        <h2>Precios</h2>
        <div class="contenedor">
            <ul class="lista-precios clearfix">
                <li>
                    <div class="tabla-precio">
                        <h3>Pase por dia</h3>
                        <p class="numero">$30</p>
                        <ul>
                            <li>Bocadillos gratis.</li>
                            <li>Todas las conferencias.</li>
                            <li>Todos los talleres.</li>
                        </ul>
                        <a href="registro.php?tipo=pase_1dia&cantidad=1" class="button hollow">Comprar</a>
                    </div>
                </li>
                <li>
                    <div class="tabla-precio">
                        <h3>Todos los dias</h3>
                        <p class="numero">$50</p>
                        <ul>
                            <li>Bocadillos gratis.</li>
                            <li>Todas las conferencias.</li>
                            <li>Todos los talleres.</li>
                        </ul>
                        <a href="registro.php?tipo=pase_completo&cantidad=1" class="button">Comprar</a>
                    </div>
                </li>
                <li>
                    <div class="tabla-precio">
                        <h3>Pase por 2 dias</h3>
                        <p class="numero">$45</p>
                        <ul>
                            <li>Bocadillos gratis.</li>
                            <li>Todas las conferencias.</li>
                            <li>Todos los talleres.</li>
                        </ul>
                        <a href="resgistro.php?tipo=pase_2dias&cantidad=1" class="button hollow">Comprar</a>
                    </div>
                </li>
            </ul>
        </div>
        <!--.contenedor-->
    </section>
    <!--.precios-->
    <div id="mapa" class="mapa"></div>
    <!--mapa-->
    <section class="seccion">
        <h2>Testimoniales</h2>
        <div class="testimoniales contenedor clearfix">
            <div class="testimonial">
                <blockquote>
                    <p>Suspendisse et porta nulla. Fusce gravida auctor euismod. Donec eleifend augue neque, eget finibus dui faucibus eget. Cras egestas eros nulla, non imperdiet massa suscipit sed. Etiam rhoncus nulla vel egestas congue.</p>
                    <footer class="info-testimonial clearfix"><img src="img/testimonial.jpg" alt="imagen testimonial"><cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--.testimonial-->
            <div class="testimonial">
                <blockquote>
                    <p>Suspendisse et porta nulla. Fusce gravida auctor euismod. Donec eleifend augue neque, eget finibus dui faucibus eget. Cras egestas eros nulla, non imperdiet massa suscipit sed. Etiam rhoncus nulla vel egestas congue.</p>
                    <footer class="info-testimonial clearfix"><img src="img/testimonial.jpg" alt="imagen testimonial"><cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--.testimonial-->
            <div class="testimonial">
                <blockquote>
                    <p>Suspendisse et porta nulla. Fusce gravida auctor euismod. Donec eleifend augue neque, eget finibus dui faucibus eget. Cras egestas eros nulla, non imperdiet massa suscipit sed. Etiam rhoncus nulla vel egestas congue.</p>
                    <footer class="info-testimonial clearfix"><img src="img/testimonial.jpg" alt="imagen testimonial"><cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                    </footer>
                </blockquote>
            </div>
            <!--.testimonial-->
        </div>
    </section>
    <!--.testimoniales-->
    <div class="newsletter parallax">
        <div class="contenido contenedor">
            <p>registrate al newsletter</p>
            <h3>BAWebCamp</h3>
            <a href="#" class="button transparente">Registro</a>
        </div>
        <!--.contenido-->
    </div>
    <!--.newsletter-->
    <section class="seccion">
        <h2>Faltan</h2>
        <div class="cuenta-regresiva contenedor">
            <ul class="clearfix">
                <li>
                    <p class="numero" id="dias"></p>días
                </li>
                <li>
                    <p class="numero" id="horas"></p>horas
                </li>
                <li>
                    <p class="numero" id="minutos"></p>minutos
                </li>
                <li>
                    <p class="numero" id="segundos"></p>segundos
                </li>
            </ul>
        </div>
    </section>
    <!--.contador-->
    <?php include_once 'includes/templates/footer.php'; ?>
    