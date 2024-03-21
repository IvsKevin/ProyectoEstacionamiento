<?php include(__DIR__ . '/../../../data/class/entryExit.php'); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['QR_code'])) {
    $QR_code = $_POST['QR_code'];
    $selectedParking = $_POST['selectedParking'];

    //Creamos un objeto.
    $carentry = new carentry();
    $resultadoEntrada = $carentry->registrarEntradaVehiculo($QR_code, $selectedParking);

    if ($resultadoEntrada) {
        // Construye la URL con los parámetros de la entrada
        $url = '../../../view/client/historial.php?resultado=' . urlencode($resultadoEntrada);
        // Redirecciona a la página historial.php
        header('Location: ' . $url);
    } else { // Indicar que no se pudo completar el registro de la entrada.
        echo "No se pudo completar el registro";
    }
} else {
    echo "No se pudo completar el registro debido a la falta de parametros necesarios";
}
