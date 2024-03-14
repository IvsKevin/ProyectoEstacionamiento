<?php 
include_once "navbar.php"; 
include_once(__DIR__.'/../../data/conexion.php');
include_once(__DIR__ . '/../../data/class/entryExit.php');

$conexion = new conexion();
$connected = $conexion->connect();

$carentry = new carentry();
$result = '';

if ($connected) {
    if (isset($_SESSION['client_id'])) {
        $client_id = $_SESSION['client_id'];
        $result = $carentry->getCheckInOutData($client_id);
    } else {
        echo "La sesión no está iniciada o el cliente no está identificado.";
    }
}
?>

<div class="relative md:pt-32 pb-32 pt-12">
    <div class="px-4 md:px-10 mx-auto w-full">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-4">Registro de entradas y salidas de visitantes</h1>
            <div class="navbar rounded-box">
                <div class="flex-1 px-2 lg:flex-none">
                    <a href="carentry.php" class="btn h-8 min-h-8 btn-outline btn-info">Entrada</a>
                </div>
                <div class="flex-1 px-2 lg:flex-none">
                    <a href="carexit.php" class="btn h-8 min-h-8 btn-outline btn-info">Salida</a>
                </div>
            </div>
            <div class="overflow-x-auto mt-4">
                <table class="table bg-gris-oscurito shadow-xl text-center items-center w-full">
                    <thead class="text-gray-200 font-semibold text-base">
                        <tr>
                            <th>ID</th>
                            <th>Fecha de Entrada</th>
                            <th>Fecha de Salida</th>
                            <th>Persona</th>
                            <th>Matrícula</th>
                            <th>Parking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr class="text-base">
                                <td><?php echo $row['pk_check']; ?></td>
                                <td class="<?php echo $row['date_in'] ? 'text-green-500' : 'text-red-500'; ?>">
                                    <?php echo $row['date_in'] ? $row['date_in'] : 'Sin fecha de entrada'; ?>
                                </td>
                                <td class="<?php echo $row['date_out'] ? 'text-green-500' : 'text-red-500'; ?>">
                                    <?php echo $row['date_out'] ? $row['date_out'] : 'Sin fecha de salida'; ?>
                                </td>
                                <td><?php echo $row['person_name'] ? $row['person_name'] : $row['visit_name']; ?></td>
                                <td><?php echo $row['matricula'] ? $row['matricula'] : 'Sin vehículo asociado'; ?></td>
                                <td><?php echo $row['parking_location'] ? $row['parking_location'] : 'Sin parking'; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
