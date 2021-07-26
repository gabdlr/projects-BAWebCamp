<?php include_once 'includes/templates/header.php'; ?>
<?php $tipo = $_GET['tipo'];?>
    <section class="seccion contenedor">
        <h2>Registro de usuarios</h2>
        <form id="registro" class="registro" action="pagar.php" method="POST">
            <div id="datos_usuario" class="registro caja clearfix">
                <div class="campo">
                    <label for="nombre">Nombre:</label><input type="text" id="nombre" name="nombre" placeholder="Tu Nombre">
                </div>
                <div class="campo">
                    <label for="apellido">Apellido:</label><input type="text" id="apellido" name="apellido" placeholder="Tu Apellido">
                </div>
                <div class="campo">
                    <label for="email">E-mail:</label><input type="email" id="email" name="email" placeholder="Tu Email">
                </div>
                <div id="error"></div>
                <!--Final datos usuario-->
            </div>

            <div id="paquetes" class="paquetes">
                <h3>Elige el numero de boletos</h3>

                <ul class="lista-precios clearfix">
                    <li>
                        <div class="tabla-precio">
                            <h3>Pase por dia (Viernes)</h3>
                            <p class="numero">$30</p>
                            <ul>
                                <li>Bocadillos gratis.</li>
                                <li>Todas las conferencias.</li>
                                <li>Todos los talleres.</li>
                            </ul>
                            <div class="orden"><label for="pase_dia">Boletos deseados:</label>
                                <input type="number" name="boletos[un_dia][cantidad]" min="0" id="pase_dia" size="3" placeholder="0" value="<?php if($tipo == "pase_1dia") {echo "1";} ?>">
                                <input type="hidden" value="30" name="boletos[un_dia][precio]">
                            </div>
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
                            <div class="orden"><label for="pase_completo">Boletos deseados:</label>
                                <input type="number" name="boletos[completo][cantidad]" min="0" id="pase_completo" size="3" placeholder="0" value="<?php if($tipo == "pase_completo") {echo "1";} ?>">
                                <input type="hidden" value="50" name="boletos[completo][precio]">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="tabla-precio">
                            <h3>Pase por 2 dias(Viernes y sabado)</h3>
                            <p class="numero">$45</p>
                            <ul>
                                <li>Bocadillos gratis.</li>
                                <li>Todas las conferencias.</li>
                                <li>Todos los talleres.</li>
                            </ul>
                            <div class="orden"><label for="pase_dos_dias">Boletos deseados:</label>
                                <input type="number" name="boletos[2dias][cantidad]" min="0" id="pase_dos_dias" size="3" placeholder="0" value="<?php if($tipo == "pase_2dias") {echo "1";} ?>>
                                <input type="hidden" value="45" name="boletos[2dias][precio]">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!--#paquetes-->
            <div id="eventos" class="eventos clearfix">
                <h3>Elige tus talleres</h3>
                <?php
                
                try {
                    require_once('includes/funciones/bd_conexion.php');
                    $sql  = "SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado";
                    $sql .= " FROM eventos ";
                    $sql .= " JOIN categoria_evento ";
                    $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                    $sql .= " JOIN invitados ";
                    $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                    $sql .= " ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento ";
                    $resultado = $conn->query($sql);                 
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                //Creamos el arreglo
                $eventos_dias = array();
                while ($eventos = $resultado->fetch_assoc()) {
                    
                    $fecha = $eventos['fecha_evento'];
                    //Convierte los dias de la semana de inglés a español (server Windows)
                    //setlocale(LC_ALL,"spanish");
                    //server (linux)
                    //setlocale(LC_ALL,"es_ES");
                    //Convertir de fecha a dia de la semana ("%A") = Dia
                    $dia_semana = strftime("%A", strtotime($fecha));
                    //Triste solucion a no anda strreplace
                    if ($dia_semana == "Friday"){
                        $dia_semana = "viernes";
                    } else if ($dia_semana == "Saturday") {
                        $dia_semana = "sabado";
                    } else {
                        $dia_semana = "domingo";
                    }
                    $categoria = $eventos['cat_evento'];
                    //Array multidimensional php
                    $dia = array(    
                        'nombre_evento' => $eventos['nombre_evento'],
                        'hora' => $eventos['hora_evento'],
                        'id' => $eventos['evento_id'],
                        'nombre_invitado' => $eventos['nombre_invitado'],
                        'apellido_invitado' => $eventos['apellido_invitado']
                    );
                    //A cada vuelta agrega los datos al final del arreglo
                    $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
                }
                ?>
            
                <div class="caja">
                    <?php foreach ($eventos_dias as $dia => $eventos) { ?>
                            <div id="<?php echo $dia; ?>" class="contenido-dia clearfix">
                                <h4><?php echo $dia; ?></h4>
                                <?php foreach ($eventos['eventos'] as $tipo => $evento_dia):?>
                                <div>
                                    <p><?php echo $tipo ?></p>
                                        <?php foreach($evento_dia as $evento) {?>
                                    <label><input type="checkbox" name="registro[]" id="<?php echo $evento['id']?>" value="<?php echo $evento['id']?>">
                                    <time><?php echo $evento['hora']?></time>
                                    <?php echo utf8_encode($evento['nombre_evento'])?>
                                    <br>
                                    <span class="autor"><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></span>
                                    </label>
                                    <?php }//Foreach $evento_dia?>
                                </div>
                                <?php endforeach;//Foreach $eventos['eventos']?>
                            </div>
                    <!--#contenido-dia-->
                    <?php } //Foreach $eventos_dias?>              
                </div>
                <!--.caja-->
            </div>
            <!--#eventos-->
            <div id="resumen " class="resumen">
                <h3>Pago y extras</h3>
                <div class="caja clearfix">
                    <div class="extras">
                        <div class="orden">
                            <label for="camisa_evento">Camisa del evento $10 <small>(promocion 7% de descuento)</small></label>
                            <input type="number" name="pedido_extra[camisas][cantidad]" min="0" id="camisa_evento" size="3" placeholder="0">
                            <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                        </div>
                        <!--.orden-->
                        <div class="orden">
                            <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML, CSS3, JavaScript)</small></label>
                            <input type="number" name="pedido_extra[etiquetas][cantidad]" min="0" id="etiquetas" size="3" placeholder="0">
                            <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
                        </div>
                        <!--.orden-->
                        <div class="orden">
                            <label for="regalo">Seleccione un regalo</label><br>
                            <select id="regalo" name="regalo" required>
                                <option value="">-- Seleccione un regalo --</option>
                                <option value="1">Pulsera</option>
                                <option value="2">Etiquetas</option>
                                <option value="3">Plumas</option>
                             </select>
                        </div>
                        <!--.orden-->
                        <input type="button" id="calcular" class="button" value="calcular">
                    </div>
                    <!--.extras-->
                    <div class="total">
                        <p>Resumen: </p>
                        <div id="lista-productos"></div>
                        <p>Total: </p>
                        <div id="suma-total"></div>
                        <input type="hidden" name="total_pedido" id="total_pedido">
                        <input id="btnRegistro" type="submit" name="submit" class="button" value="Pagar">
                    </div>
                    <!--.total-->
                </div>
                <!--caja-->
            </div>
            <!--resumen-->
        </form>
    </section>
    <?php include_once 'includes/templates/footer.php'; ?>