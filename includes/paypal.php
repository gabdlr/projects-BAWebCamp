<?php



require 'paypal/autoload.php';



define('URL_SITIO', 'http://bawcproject.epizy.com/'); //Define no puede quedar vacio



$apiContext = new \PayPal\Rest\ApiContext(

    new \PayPal\Auth\OAuthTokenCredential(

        'Cliente',//Cliente ID

        'Secret'//Secret

    )

);



?>
