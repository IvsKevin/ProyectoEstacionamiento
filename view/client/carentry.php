<!DOCTYPE html>
<?php include_once "navbar.php"; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Entrada de Vehículo</title>
</head>
<body class="bg-gray-100">
<div class="container mx-auto flex justify-center items-center h-screen">
    <div class="max-w-md w-full bg-gris-oscurito rounded-lg shadow-lg p-6">
        <h1 class="text-xl font-semibold mb-4">Registro de Entrada de Vehículo</h1>
        <a href="historial.php" class="text-blue-500 hover:text-blue-700">
            <i class="bx bx-arrow-back"></i> Volver
        </a>
        <form class="mt-4" method="post" action="carResultado.php">
            <div class="mb-4">
                <label for="QR_code" class="block text-sm font-medium text-gray-700">Código de Acceso (QR):</label>
                <input type="text" id="QR_code" name="QR_code" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            </div>
            <div class="mb-4">
                <label for="selectedParking" class="block text-sm font-medium text-gray-700">Seleccionar Parking:</label>
                <select id="selectedParking" name="selectedParking"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <?php
                    include_once(__DIR__ . "/../../data/class/parking.php");
                    $myParking = new Parking();
                    $myParking->setFKclient($_SESSION['client_id']);
                    $parkingResult = $myParking->getParkingActive();

                    if ($parkingResult && mysqli_num_rows($parkingResult) > 0) {
                        while ($row = mysqli_fetch_assoc($parkingResult)) {
                            echo '<option value="' . $row['pk_parking'] . '">' . $row['parking_location'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="registrar_entrada"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Registrar Entrada
            </button>
        </form>
    </div>
</div>
</body>
</html>
