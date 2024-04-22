<?php
include_once "navbar.php";
include_once "modals/tarjetasModal.php";

// Manejar la solicitud para eliminar una tarjeta
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'delete') {
    if (isset($_POST['employee_id'])) {
        $employee_id = $_POST['employee_id'];

        // Cargar el contenido del archivo JSON
        $json_data = file_get_contents(__DIR__ . '/../../app/client/empleados/employee_data.json');

        // Decodificar el JSON en un array asociativo
        $employee_data = json_decode($json_data, true);

        // Eliminar la tarjeta correspondiente del array
        foreach ($employee_data as $key => $employee) {
            if ($employee['id'] === $employee_id) {
                unset($employee_data[$key]);
                break;
            }
        }

        // Guardar el JSON actualizado
        file_put_contents(__DIR__ . '/../../app/client/empleados/employee_data.json', json_encode(array_values($employee_data), JSON_PRETTY_PRINT));

        // Redirigir después de eliminar
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Cargar el contenido del archivo JSON después de manejar la solicitud para eliminar
$json_data = file_get_contents(__DIR__ . '/../../app/client/empleados/employee_data.json');

// Decodificar el JSON en un array asociativo
$employee_data = json_decode($json_data, true);
?>

<div>
    <div class="relative md:pt-32 pb-32 pt-12">
        <div class="px-4 md:px-10 mx-auto w-full">
            <div>
                <!--Inicio de la barrita de navegacion-->
                <div class="navbar rounded-box">
                    <div class="flex justify-end flex-1 px-2">
                        <div class="flex items-stretch">
                            <a class="btn h-8 min-h-8 btn-ghost rounded-btn">Button</a>
                            <div class="dropdown dropdown-end">
                                <div id="cambiarVista" tabindex="0" role="button" class="btn h-8 min-h-8 btn-ghost rounded-btn" onclick="toggleView()">Tarjeta</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!empty($employee_data)) { ?>
                    <!-- Contenedor para la vista en tarjetas -->
                    <div class="overflow-x-auto" id="card-view">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php foreach ($employee_data as $employee) { ?>
                                <div class="bg-gris-oscurito p-6 rounded-xl shadow-md relative overflow-hidden">
                                    <!-- ID y Tipo de tarjeta del propietario -->
                                    <span class="absolute top-0 left-0 w-1/5 h-5 bg-blue-900 text-white rounded-sm flex items-center justify-center">
                                        <?= $employee['id'] ?>
                                    </span>
                                    <span class="absolute top-0 right-0 w-4/5 h-5 bg-gris-oscurito border-b border-blue-900 text-white rounded-sm text-sm flex items-center justify-center">
                                        <?= $employee['tarjeta_acceso']['card_type'] ?>
                                    </span>
                                    <!-- Foto propietario de la tarjeta -->
                                    <div class="mb-4 mt-5">
                                        <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" alt="Employee Photo" class="w-full rounded-full">
                                    </div>
                                    <!-- QR y nombre del propietario -->
                                    <div class="mb-4">
                                        <p class="text-sm font-semibold">QR: <?= $employee['tarjeta_acceso']['QR_code'] ?></p>
                                        <p class="text-sm text-gray-500">Propietario: <?= $employee['nombre'] ?></p>
                                    </div>
                                    <!-- Fechas de vencimiento de las tarjetas -->
                                    <p class="text-sm text-gray-500 mb-4"><strong>Fecha de vencimiento:</strong> <?= $employee['tarjeta_acceso']['creation_date'] . ' ' . $employee['tarjeta_acceso']['end_date'] ?></p>
                                    <!-- Detalles del empleado -->
                                    <button class="btn btn-outline btn-success btn-xs" onclick="verDetalles(
                                        '<?= $employee['id'] ?>',
                                        '<?= $employee['nombre'] ?>',
                                        '<?= $employee['apellidoPaterno'] ?>',
                                        '<?= $employee['apellidoMaterno'] ?>',
                                        '<?= $employee['rol'] ?>'
                                    )">Detalles</button>
                                    <!-- Botón para eliminar -->
                                    <form method="post">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="employee_id" value="<?= $employee['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Contenedor para la vista en tabla -->
                    <div class="overflow-x-auto" id="table-view" style="display: none;">
                        <table class="table bg-gris-oscurito shadow-xl text-center items-center">
                            <!-- Cabecera de la tabla -->
                            <thead>
                                <tr class="text-gray-200 font-semibold text-base">
                                    <th>ID</th>
                                    <th>QR Code</th>
                                    <th>Fecha de Creación</th>
                                    <th>Fecha de Vencimiento</th>
                                    <th>Tipo de Tarjeta</th>
                                    <th>Nombre</th>
                                    <th>Foto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas de datos -->
                                <?php foreach ($employee_data as $employee) { ?>
                                    <tr class="text-base">
                                        <td><?= $employee['id'] ?></td>
                                        <td><?= $employee['tarjeta_acceso']['QR_code'] ?></td>
                                        <td><?= $employee['tarjeta_acceso']['creation_date'] ?></td>
                                        <td><?= $employee['tarjeta_acceso']['end_date'] ?></td>
                                        <td><?= $employee['tarjeta_acceso']['card_type'] ?></td>
                                        <td><?= $employee['nombre'] ?></td>
                                        <td>
                                            <div class="avatar online">
                                                <div class="w-16 rounded-full">
                                                    <img src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form method="post">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="employee_id" value="<?= $employee['id'] ?>">
                                                <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                                            </form>
                                        </td>
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
</body>
<!-- Script para cambiar entre la vista de tabla y tarjetas -->
<script>
    function toggleView() {
        var cambiarVista = document.getElementById('cambiarVista');
        var tableView = document.getElementById('table-view');
        var cardView = document.getElementById('card-view');

        // Si la vista de tarjetas está visible, ocúltala y muestra la vista de tabla (y viceversa)
        if (cardView.style.display === 'block' || cardView.style.display === '') {
            cardView.style.display = 'none';
            tableView.style.display = 'block';
            cambiarVista.innerText = "Tabla";
        } else {
            cardView.style.display = 'block';
            tableView.style.display = 'none';
            cambiarVista.innerText = "Tarjeta";
        }
    }

    // Inicializar la vista en tarjetas al cargar la página
    window.onload = function() {
        toggleView();
    };
</script>
