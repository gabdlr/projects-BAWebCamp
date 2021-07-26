<?php include_once 'includes/templates/header.php';

use PayPal\Rest\ApiContext;

use PayPal\Api\PaymentExecution; 

use PayPal\Api\Payment;

require 'includes/paypal.php';

include 'includes/db_conecxion.php'

?>

<section class="seccion contenedor">

        <h2>Resumen registro</h2>

        <?php 

        $paymentId = $_GET['paymentId'];

        $idPago = (int) $_GET['id_pago'];

	$resultado = $_GET['exito'];

        //Peticion a REST API



        //$pago = Payment::get($paymentId, $this->_api_context);

        //$execution = new PaymentExecution();

        //$execution->setPayerId( $_GET['PayerID']);

        //Resultado tiene la informacion de la transaccion

        //$resultado = $pago->execute($execution, $this->_api_context);

        //$respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;

        //if ($respuesta == "Completed") {

            //echo "<div class='resultado exito'>";

            //echo "El pago se realizo correctamente <br>";

            //echo "El ID es {$paymentId}";

            //echo "</div>";

            //require_once('includes/funciones/bd_conexion.php');
	

        if ($resultado == "true" && $paymentId != null) {
	echo "<div class='resultado exito'>";
            echo "El pago se realizo correctamente <br>";
            echo "El ID es {$paymentId}";
	 echo "</div>";
		
		$stmt = $conn->prepare(' UPDATE registrados SET pagado = ? WHERE ID_Registrado = ? ');

            $pagado = 1;

            $stmt->bind_param('ii', $pagado, $idPago);

            $stmt->execute();

            $stmt->close();

            $conn->close();

        	} else {

            echo "<div class='resultado correcto'>";

            echo "El pago no se realizo";

            echo "</div>";

        }

            
        ?>        

</section>

<?php include_once 'includes/templates/footer.php'; ?>