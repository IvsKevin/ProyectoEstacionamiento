<?php
//Pergo gay
//Incluimos la clase Espacios para crear el objeto.
include(__DIR__.'/../../../data/class/parking.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['parking_id']) && isset($_POST['location'])) {
    $parkingID = $_POST['parking_id'];
    $parking_number = $_POST['parking'];
    $capacity = $_POST['capacity'];
    $location = $_POST['location'];
    if($_POST['status'] == 1) {
        $status = 1;
    } else {
        $status = 2;
    }
    // Crear una instancia de la clase Parking
    $parkingHandler = new Parking();
    $parkingHandler -> parking_number = $parking_number;
    $parkingHandler -> parking_capacity = $capacity;
    
    // Lógica para actualizar el estacionamiento
// Verificar si el número de espacios disponibles no supera la capacidad
if ($espaciosDisponibles <= $capacity) {
    if ($parkingHandler->updateParking($parkingID, $location, $capacity, $status)) {
        echo "Estacionamiento actualizado correctamente";
        header('Location: ../../../view/client/parking.php');
    } else {
        echo "Error al actualizar estacionamiento";
        $errorElimiacion = 'No se puede actualizar la capacidad a un valor menor que los espacios ocupados.';
    header('Location: ../../../view/client/parking.php?errorEliminacion=' . urlencode($errorElimiacion) . '');
    }
} else {
    echo "Error: El número de espacios disponibles supera la capacidad del estacionamiento.";
}

}

// if (isset($_GET['id'])) {
//     $parkingID = $_GET['id'];
//     // Crear una instancia de la clase Parking
//     $parkingHandler = new Parking();

//     // Obtener detalles del estacionamiento usando el método getParkingDetails
//     $parkingDetails = $parkingHandler->getParkingDetails($parkingID);

//     if (!$parkingDetails) {
//         // Redirige a alguna página de manejo de errores si no se pueden obtener detalles.
//         header("Location: error_page.php");
//         exit();
//     }
// } else {
//     // Redirige a alguna página de manejo de errores si no se proporciona un ID.
//     header("Location: error_page.php");
//     exit();
// }
?>