<?php include_once "navbar.php"; ?>
<?php include_once "modals/historialModal.php"; ?>
<?php include_once(__DIR__ . '/../../data/class/entryExit.php'); ?>

<?php

$carentry = new carentry();
$result = '';

if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
    // Traemos toda la información del historial del cliente de entradas y salidas.
    $result = $carentry->getCheckInOutData($client_id);
} else {
    echo "La sesión no está iniciada o el cliente no está identificado.";
}

function obtenerTokenAcceso() {
    $client_id = "f65a4b60bbac45dfb142deaa692bd61e";
    $client_secret = "5ee126c416844200a9b222de3e2e1fd0";

    $token_url = 'https://accounts.spotify.com/api/token';
    $data = array(
        'grant_type' => 'client_credentials',
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: Basic " . base64_encode("$client_id:$client_secret"),
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context  = stream_context_create($options);
    $response = file_get_contents($token_url, false, $context);
    $token_data = json_decode($response, true);

    return $token_data['access_token'];
}

function buscarCancion($nombre_cancion) {
    $token = obtenerTokenAcceso();
    $url = "https://api.spotify.com/v1/search?q=" . urlencode($nombre_cancion) . "&type=track";
    
    $opciones = array(
        'http' => array(
            'header' => "Authorization: Bearer " . $token
        )
    );
    
    $contexto = stream_context_create($opciones);
    $json = file_get_contents($url, false, $contexto);
    $data = json_decode($json, true);
    return $data;
}

if (isset($_POST['cancion'])) {
    $nombre_cancion = $_POST['cancion'];
    $informacion_cancion = buscarCancion($nombre_cancion);
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
                <form method="post">
                    <input style="margin-left: 10px"type="text" name="cancion" placeholder="Buscar canción...">
                    <button type="submit">Buscar</button>
                </form>
                <?php if (isset($informacion_cancion)) { ?>
                    <?php if (isset($informacion_cancion['tracks']['items']) && count($informacion_cancion['tracks']['items']) > 0) { ?>
                        <div class="overflow-x-auto mt-4">
                            <h1 class="text-2xl font-bold mb-4">Resultados de búsqueda</h1>
                            <table class="table bg-gris-oscurito shadow-xl text-center items-center w-full">
                                <thead class="text-gray-200 font-semibold text-base">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Artista</th>
                                        <th>Álbum</th>
                                        <th>Enlace Spotify</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($informacion_cancion['tracks']['items'] as $cancion) { ?>
                                        <tr class="text-base">
                                            <td><?php echo $cancion['name']; ?></td>
                                            <td><?php echo $cancion['artists'][0]['name']; ?></td>
                                            <td><?php echo $cancion['album']['name']; ?></td>
                                            <td><a href="<?php echo $cancion['external_urls']['spotify']; ?>" target="_blank"><img src="../../assets/iconos/spotify.png" alt="Spotify Logo" style="width: 30px; height: 30px; margin-left: 100px;"></a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p>No se encontraron resultados para la búsqueda.</p>
                    <?php } ?>
                <?php } ?>

                <?php if (mysqli_num_rows($result) > 0) { ?>
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
                <?php } ?>
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
    echo "<div id='resultadoEntrada' class='modal bg-black-300 text-white'>
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
        </div>";
?>
    <script>
        document.getElementById('resultadoEntrada').showModal();
    </script>
<?php } ?>


<?php
// Verifica si el parámetro 'resultado' está presente en la URL
if (isset($_GET['resultadoSalida'])) {
    // Recupera el valor del parámetro 'resultado'
    $resultadoSalida = $_GET['resultadoSalida'];

    // Muestra los detalles de la entrada al usuario
    echo "<div id='resultadoSalidaModal' class='modal bg-black-300 text-white'>
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
        </div>";
?>
    <script>
        document.getElementById('resultadoSalidaModal').showModal();
    </script>
<?php } ?>
