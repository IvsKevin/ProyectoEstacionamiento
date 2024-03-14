<?php include_once "navbar.php"; ?>
<?php 

include_once(__DIR__ . '/../../data/class/entryExit.php');

$resultadoEntrada = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['QR_code'])) {
    $QR_code = $_POST['QR_code'];
    $selectedParking = $_POST['selectedParking'];
    $carentry = new carentry();
    $resultadoEntrada = $carentry->registrarEntradaVehiculo($QR_code, $selectedParking);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Entrada de Vehículo</title>
</head>
<body class="bg-gray-100">
<div class="container mx-auto flex justify-center items-center h-screen">
    <div class="max-w-md w-full bg-gris-oscurito rounded-lg shadow-lg p-6">
        <h1 class="text-xl font-semibold mb-4">Resultado de Entrada de Vehículo</h1>
        <a href="historial.php" class="text-blue-500 hover:text-blue-700">
            <i class='bx bx-arrow-back'></i> Volver
        </a>

        <div class="mt-4">
            <?php
            if ($resultadoEntrada != '') {
                echo "<p>$resultadoEntrada</p>";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
