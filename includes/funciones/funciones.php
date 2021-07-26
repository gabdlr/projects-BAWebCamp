<?php
//El & siginifica que se pasa por referencia (\_-_-_/) 
function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0){
    $dias = array(0 => 'un_dia', 1 => 'pase_completo', 2 => 'pase_2dias');
    //Esto se agrego posteriormente al crear el modelo para agregar registros desde el admin
    //unset elimina este valor en el arreglo para guardar menos datos en la base de datos
    unset($boletos['un_dia']['precio']);
    unset($boletos['completo']['precio']);
    unset($boletos['2dias']['precio']);
    //array_combine combina las indices de $boletos (0,1,2) con los valores (key) de $dias (un_dia, pase_completo, pase_2dias)
    $total_boletos = array_combine($dias, $boletos);
   

    $camisas = (int) $camisas;
    if ($camisas > 0):
        $total_boletos['camisas'] = $camisas;
    endif;

    $etiquetas = (int) $etiquetas;
    if ($etiquetas > 0):
        $total_boletos['etiquetas'] = $etiquetas;
    endif;
    //Siempre que se desee utilizar la funcion json_encode debe venir en un arreglo
    return json_encode($total_boletos);
}

function eventos_json(&$eventos) {
    $eventos_json = array();
    foreach($eventos as $evento):
        //Los corchetes vacios es para que se traiga todos los eventos
            $eventos_json['eventos'][] = $evento;
    endforeach;

    return json_encode($eventos_json);
}

?>