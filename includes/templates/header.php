<?php 

//Definir un nombre para cachear

$archivo = basename($_SERVER['PHP_SELF']);

$pagina = str_replace(".php", "", $archivo);

//Definir archivo para cachear (puede ser .php tambien)

$archivoCache = 'cache/'.$pagina.'.php';

//Cuanto tiempo debera estar este archivo almacenado

$tiempo = 36000;

//Chequear que el archivo exista, el tiempo sea el adecuado y mostrarlo

if (file_exists($archivoCache) && time() - $tiempo < filemtime($archivoCache)) {

    include($archivoCache);

    exit;

}

//Si el archivo no existe, o el tiempo de cacheo ya se vencio, se genera uno nuevo

ob_start();

?>



<!doctype html>

<html class="no-js" lang="">



<head>

    <meta charset="utf-8">

    <title>BAWebCamp</title>

    <meta name="description" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1">



    <meta property="og:title" content="">

    <meta property="og:type" content="">

    <meta property="og:url" content="">

    <meta property="og:image" content="">



    <link rel="manifest" href="site.webmanifest">

    <link rel="apple-touch-icon" href="icon.png">

    <!-- Place favicon.ico in the root directory -->





    <link rel="stylesheet" href="css/normalize.css">

    <link href="css/fontawesome.css" rel="stylesheet">

    <link href="css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&family=Oswald:wght@200;300;400;500;600;700&family=PT+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/main.css">

    <?php

    $archivo = basename($_SERVER['PHP_SELF']);

    $pagina = str_replace(".php", "", $archivo);

    switch ($pagina) {

    case "index":

    echo '<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"

       integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="

       crossorigin="">';

    echo '<link rel="stylesheet" href="css/colorbox.css">';

    break;

    case "conferencia":

    echo '<link rel="stylesheet" href="css/lightbox.css">';

    break;

    case "invitados":

    echo '<link rel="stylesheet" href="css/colorbox.css">';

    break;    

    default:

    echo '';

}

    ?>

    <meta name="theme-color" content="#fafafa">


</head>

<body class="<?php echo $pagina; ?>">



    <header class="site-header">

        <div class="hero">

            <div class="contenido-header">

                <nav class="redes-sociales">

                    <a href="#"><i class="fab fa-facebook-f"></i></a>

                    <a href="#"><i class="fab fa-twitter"></i></a>

                    <a href="#"><i class="fab fa-pinterest"></i></a>

                    <a href="#"><i class="fab fa-youtube"></i></a>

                    <a href="#"><i class="fab fa-instagram"></i></a>

                </nav>

                <div class="informacion-evento">

                    <div class="clearfix">

                        <p class="fecha"><i class="fas fa-calendar-alt"></i>17-19 Dic</p>

                        <p class="ciudad"><i class="fas fa-map-marker-alt"></i>Buenos Aires, ARG</p>

                    </div>

                    <h1 class="nombre-sitio">BAWebCamp</h1>

                    <p class="slogan">La mejor conferencia de <span>diseño web</span>

                </div>

                <!--Informacion evento-->

                </p>

            </div>

        </div>

        <!--Hero-->



    </header>

    <div class="barra">

        <div class="contenedor clearfix">

            <div class="logo">

                <a href="index.php"><img src="img/logo.svg" alt="logo gdlwebcamp"></a>

            </div>

            <div class="menu-movil"><span></span>

                <span></span>

                <span></span>

            </div>

            <nav class="navegacion-principal clearfix">

                <a href="conferencia.php">Conferencia</a>

                <a href="calendario.php">Calendario</a>

                <a href="invitados.php">Invitados</a>

                <a href="registro.php">Reservaciones</a>

            </nav>

        </div>

        <!--.contenedor-->

    </div>

    <!--.barra-->