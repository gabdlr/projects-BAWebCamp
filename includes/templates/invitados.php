<section class="seccion invitados contenedor">
        <h2>Invitados</h2>
<?php try {
            require_once('includes/funciones/bd_conexion.php');
            $sql = " SELECT * FROM `invitados`";
            $resultado = $conn->query($sql);
        } 
        catch (\Exception $e) {
            echo $e->getMessage();
        }?>
        <div class="calendario clearfix">
        <?php while($invitados = $resultado->fetch_assoc()) {?>
            <ul class="lista-invitados clearfix">
            <li>
                <div class="invitado">
                    <a class="invitado-info" href="#invitado<?php echo $invitados['invitado_id'];?>">
                        <img src="img/invitados/<?php echo $invitados['url_imagen']?>" alt="imagen invitado">
                        <p><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado'] ?></p>
                        </a>
                </div>
                <div style="display:none">
                    <div class="invitado-info cbox-padding" id="invitado<?php echo $invitados['invitado_id'];?>">
                        <h2><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado']; ?></h2>
                        <img src="img/invitados/<?php echo $invitados['url_imagen']?>" alt="imagen invitado">
                        <p><?php echo $invitados['descripcion']?></p>
                    </div>
                </div>   
            </li>
        <?php }; ?>
        </ul>      
        </div>
        <?php $conn->close();?>
    </section>
    