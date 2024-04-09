<?php include_once "navbar.php"; ?>
<?php include_once "modals/historialModal.php"; ?>
<?php include_once(__DIR__ . '/../../data/class/entryExit.php'); ?>

<?php
$carentry = new carentry();
$result = '';

if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
    // Traemos toda la informacion del historial del cliente de entradas y salidas.
    $result = $carentry->getCheckInOutData($client_id);
} else {
    echo "La sesión no está iniciada o el cliente no está identificado.";
}
?>
<div>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <div class="navbar rounded-box">
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-info" onclick="agregarEntrada()">Registrar entrada</button>
                    </div>
                    <div class="flex-1 px-2 lg:flex-none">
                        <button class="btn h-8 min-h-8 btn-outline btn-error" onclick="agregarSalida()">Registrar salida</button>
                    </div>
                </div>
                <div class="overflow-x-auto mt-4">
                    <h1 class="text-2xl font-bold mb-4">Registro de entradas y salidas</h1>
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
</div>

<?php
// Verifica si el parámetro 'resultado' está presente en la URL
if (isset($_GET['resultado'])) {
    // Recupera el valor del parámetro 'resultado'
    $resultado = $_GET['resultado'];
    // Muestra los detalles de la entrada al usuario
    echo "<dialog id='resultadoEntrada' class='modal bg-black-300 text-white'>
            <div class='modal-box'>
                <form method='dialog'>
                    <button class='btn btn-sm btn-circle btn-ghost absolute right-2 top-2'>✕</button>
                </form>
                <h3 class='font-bold text-lg'>Detalles de la entrada</h3>
                <div class='modal-action  flex flex-col items-center'>";
    if ($resultado != '') {
        echo "<p>$resultado</p>";
    }
    echo "</div>
            </div>
        </dialog>";
?>
    <script>
        resultadoEntrada.showModal();
    </script>
<?php } ?>


<?php
// Verifica si el parámetro 'resultado' está presente en la URL
if (isset($_GET['resultadoSalida'])) {
    // Recupera el valor del parámetro 'resultado'
    $resultadoSalida = $_GET['resultadoSalida'];

    // Muestra los detalles de la entrada al usuario
    echo "<dialog id='resultadoSalidaModal' class='modal bg-black-300 text-white'>
            <div class='modal-box'>
                <form method='dialog'>
                    <button class='btn btn-sm btn-circle btn-ghost absolute right-2 top-2'>✕</button>
                </form>";

    // Verifica si el resultado de la salida indica que el empleado no ha registrado su entrada
    if ($resultadoSalida === 'no_registrado') {
        echo "<h3 class='font-bold text-lg'>Error:</h3>";
        echo "<div class='modal-action flex flex-col items-center'>";
        echo "<p>Debes registrar tu entrada antes de registrar la salida.</p>";
    } else {
        // Muestra la hora de salida
        echo "<h3 class='font-bold text-lg'>Hora de salida:</h3>";
        echo "<div class='modal-action flex flex-col items-center'>";
        echo "<p>$resultadoSalida</p>";
    }

    echo "</div>
            </div>
        </dialog>";
?>
    <script>
        resultadoSalidaModal.showModal();
    </script>
<?php } ?>
