<footer>
        <div class="contenedor clearfix footer">
            <div class="footer-informacion">
                <h3>Sobre <span>BAWebCamp</span></h3>
                <p>Duis dictum et dolor id mollis. Vivamus et laoreet mi. Ut vulputate placerat elit, ut vulputate justo. Nam id blandit leo. Pellentesque eget dolor eget arcu porta cursus sed et arcu. Curabitur laoreet odio eu dignissim pharetra. Integer
                    sed gravida eros, ac molestie odio. Sed sagittis, dui a gravida fermentum, urna ligula pharetra nibh, eu auctor lacus mi id magna. Donec blandit, ex vel maximus faucibus, erat mauris iaculis mi, in congue neque lacus sit amet elit.
                    Curabitur suscipit pulvinar. </p>
            </div>
            <div class="ultimos-tweets">
                <h3>Ultimos <span>Tweets</span></h3>
                <a class="twitter-timeline" data-lang="es" data-height="400" data-theme="light" href="https://twitter.com/GabdlrD?ref_src=twsrc%5Etfw">Tweets by GabdlrD</a> 
                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="menu">
                <h3>Redes <span>Sociales</span></h3>
                <nav class="redes-sociales">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </nav>
            </div>
        </div>
        <p class="copyright">Todos los derechos reservados GdlWebCamp <?php echo date("Y"); ?></p>
    </footer>
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="js/plugins.js"></script>            
    <script src="js/main.js"></script>
    <?php
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    switch ($pagina) {
    case "index":
    echo '<script src="js/jquery.animateNumber.js"></script>';
    echo '<script src="js/mapa.js"></script>';
    echo '<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>';
    echo '<script src="js/jquery.countdown.js"></script>';
    echo '<script src="js/animaciones.js"></script>';
    echo '<script src="js/jquery.colorbox.js"></script>';
    break;
    case "conferencia":
    echo '<script src="js/lightbox-plus-jquery.js"></script>';
    break;
    case "invitados":
    echo '<script src="js/jquery.colorbox.js"></script>';
    break;
    case "registro":
        echo '<script src="js/reservaciones.js"></script>';
    break;       
    default:
    echo '';
}
    ?>
    <script src="js/jquery.lettering.js"></script>
    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. 
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'anonymizeIp', true);
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview' );
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async></script>-->

    <?php
        // Guarda todo el contenido a un archivo
        $fp = fopen($archivoCache, "w");
        fwrite($fp, ob_get_contents());
        fclose($fp);
        // Enviar al navegador
        ob_end_flush();
    ?>
</body>

</html>