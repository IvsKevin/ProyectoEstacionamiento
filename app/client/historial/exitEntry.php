<?php 
include(__DIR__.'/../../../data/class/entryExit.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['QR_code'])) {
    $QR_code = $_POST['QR_code'];

    //Creamos un objeto.
    $carentry = new carentry();
    $resultadoSalida = $carentry->registrarSalidaVehiculo($QR_code);

    if ($resultadoSalida) {
        // Construye la URL con los parámetros de la salida
        $url = '../../../view/client/historial.php?resultadoSalida=' . urlencode($resultadoSalida);
        // Redirecciona a la página historial.php
        header('Location: ' . $url);
    } else { // Indicar que no se pudo completar el registro de la salida.
        echo "No se pudo completar la salida correctamente";
    }
} else {
    echo "No se pudo completar la salida debido a la falta de parámetros necesarios";
}