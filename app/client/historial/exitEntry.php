<?php 
include(__DIR__.'/../../../data/class/entryExit.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['entry_id'])) {
    //Creamos un objeto.
    $carentry = new carentry();
    $resultadoEntrada = $carentry->registrarSalidaVehiculo($_POST['entry_id']);

    if ($resultadoEntrada) {
        // Construye la URL con los parámetros de la entrada
        $url = '../../../view/client/historial.php?resultadoSalida=' . urlencode($resultadoEntrada);
        // Redirecciona a la página historial.php
        header('Location: ' . $url);
    } else { // Indicar que no se pudo completar el registro de la entrada.
        echo "No se pudo completar la salida correctamente";
    }
} else {
    echo "No se pudo completar la salida debido a la falta de parametros necesarios";
}