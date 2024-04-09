<?php
// Incluimos las clases necesarias
include(__DIR__ . '/../../../data/class/parking.php');

session_start();

// Procesar el formulario para agregar un nuevo estacionamiento
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ubicacionParking']) && isset($_POST['capacidadParking'])) {
    $parking = $_POST['numeroParking'];
    $location = $_POST['ubicacionParking'];
    $capacity = $_POST['capacidadParking'];

    $parkingHandler = new Parking();
    $parkingHandler->parking_number = $parking;
    $parkingHandler->setFKclient($_SESSION['client_id']); //Setteamos el client_id.
    // Agregar el nuevo estacionamiento
    if ($parkingHandler->addParking($location, $capacity)) {
        echo "Estacionamiento agregado correctamente";
        header('Location: ../../../view/client/parking.php');
    } else {
        $errorEst = 'El número de estacionamiento ya está en uso. Por favor, elige otro..';
        header('Location: ../../../view/client/parking.php?errorEst=' . urlencode($errorEst) . '');
    }
}
